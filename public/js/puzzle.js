// Picture puzzle (/play/puzzle/): a building painted over its world's horizon, cut into squares and mixed up.
// Tap two pieces to swap them, or drag one onto another; a piece in the right place locks. The pictures are listed
// in #puzzle-data; best scores stay in this browser only.
(function () {
  'use strict';
  var root = document.querySelector('[data-puzzle]');
  var dataEl = document.getElementById('puzzle-data');
  if (!root || !dataEl) return;
  var pics = JSON.parse(dataEl.textContent);
  var KEY = 'atlas.puzzle', SIZE = 900;
  // Sky behind each world's picture, top and bottom.
  var SKY = {
    egypt: ['#f3dcae', '#fbf1dd'], roman: ['#efdcc4', '#fbf5ec'], modern: ['#c4dcf2', '#eef5fb'],
    green: ['#d2eacb', '#f2f9ee'], future: ['#e6d1c5', '#f7eee8'], heaven: ['#fdeab0', '#fffaf0']
  };
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var load = function (src) {
    return new Promise(function (ok, fail) { var im = new Image(); im.onload = function () { ok(im); }; im.onerror = fail; im.src = src; });
  };
  var start = $('.pz-start'), play = $('.pz-play'), board = $('.pz-board'), peek = $('.pz-peek'), won = $('.pz-won');
  var n = 3, pic = null, url = '', pos = [], sel = -1, moves = 0, done = false, peekTimer = 0, dragged = false;

  // The color of the ground along the bottom of a horizon picture, and how far down it starts being solid.
  var groundOf = function (im) {
    var w = 64, h = Math.max(8, Math.round(w * im.height / im.width)), c = document.createElement('canvas');
    c.width = w; c.height = h;
    var g = c.getContext('2d');
    g.drawImage(im, 0, 0, w, h);
    var d = g.getImageData(0, 0, w, h).data;
    for (var y = h - 1; y >= 0; y--) {
      var r = 0, gr = 0, b = 0, k = 0;
      for (var x = 0; x < w; x++) { var i = (y * w + x) * 4; if (d[i + 3] > 200) { r += d[i]; gr += d[i + 1]; b += d[i + 2]; k++; } }
      if (k > w / 2) return { color: 'rgb(' + Math.round(r / k) + ',' + Math.round(gr / k) + ',' + Math.round(b / k) + ')', low: (y + 1) / h };
    }
    return { color: '#d8c9a8', low: 1 };
  };
  // The part of a picture that is not see-through: [left, top, right, bottom] as fractions of its size.
  var boxOf = function (im) {
    var w = 120, h = Math.round(w * im.height / im.width), c = document.createElement('canvas');
    c.width = w; c.height = h;
    var g = c.getContext('2d');
    g.drawImage(im, 0, 0, w, h);
    var d = g.getImageData(0, 0, w, h).data, x0 = w, y0 = h, x1 = -1, y1 = -1;
    for (var y = 0; y < h; y++) for (var x = 0; x < w; x++) {
      if (d[(y * w + x) * 4 + 3] > 40) { if (x < x0) x0 = x; if (x > x1) x1 = x; if (y < y0) y0 = y; y1 = y; }
    }
    return x1 < 0 ? [0, 0, 1, 1] : [x0 / w, y0 / h, (x1 + 1) / w, (y1 + 1) / h];
  };
  // Paints the picture on a square: sky, ground, the world's horizon, then the building filling the front.
  var paint = function (p) {
    return Promise.all([load(p.h), load(p.b)]).then(function (im) {
      var hz = im[0], bd = im[1], S = SIZE, sky = SKY[p.w] || SKY.modern, c = document.createElement('canvas');
      c.width = c.height = S;
      var g = c.getContext('2d');
      var grad = g.createLinearGradient(0, 0, 0, S * .75);
      grad.addColorStop(0, sky[0]); grad.addColorStop(1, sky[1]);
      g.fillStyle = grad; g.fillRect(0, 0, S, S);
      var gd = groundOf(hz), groundY = S * .7, bh = S * .36, bw = bh * hz.width / hz.height;
      g.fillStyle = gd.color; g.fillRect(0, groundY - 2, S, S - groundY + 2);
      g.drawImage(hz, (S - bw) / 2, groundY - bh * gd.low, bw, bh);
      var bx = boxOf(bd), sx = bx[0] * bd.width, sy = bx[1] * bd.height, sw = (bx[2] - bx[0]) * bd.width, sh = (bx[3] - bx[1]) * bd.height;
      // A wide building may lose a little of its sides, so it still reaches up the picture.
      var f = Math.min(S * 1.12 / sw, S * .92 / sh), dw = sw * f, dh = sh * f;
      g.drawImage(bd, sx, sy, sw, sh, (S - dw) / 2, S * .97 - dh, dw, dh);
      // A data: address: the site's security policy allows those for pictures, but blocks blob: ones.
      return c.toDataURL('image/jpeg', .9);
    });
  };

  var say = function (text) { $('.pz-say').textContent = text; };
  var placeOf = function (k) { return 'row ' + (Math.floor(k / n) + 1) + ', column ' + (k % n + 1); };
  var draw = function () {
    board.style.setProperty('--n', n);
    Array.prototype.forEach.call(board.children, function (b, s) {
      var p = pos[s], ok = p === s;
      b.style.backgroundImage = 'url("' + url + '")';
      b.style.backgroundPosition = (p % n) / (n - 1) * 100 + '% ' + Math.floor(p / n) / (n - 1) * 100 + '%';
      b.classList.toggle('ok', ok);
      b.classList.toggle('sel', s === sel);
      b.setAttribute('aria-pressed', String(s === sel));
      b.setAttribute('aria-label', 'Square ' + (s + 1) + ': piece ' + (p + 1) + (ok ? ', in the right place' : ''));
    });
    $('.pz-moves').textContent = 'Moves: ' + moves;
  };
  var build = function () {
    board.innerHTML = '';
    board.classList.remove('won');
    for (var s = 0; s < n * n; s++) {
      var b = make('button', 'pz-piece');
      b.type = 'button';
      b.tabIndex = s ? -1 : 0;
      (function (s) {
        b.addEventListener('click', function () { if (dragged) { dragged = false; return; } tap(s); });
        b.addEventListener('pointerdown', function (e) { grab(e, s); });
      })(s);
      board.appendChild(b);
    }
  };
  var tap = function (s) {
    if (done) return;
    if (pos[s] === s) { say('That piece is already in the right place.'); return; }
    if (sel < 0) { sel = s; draw(); say('Piece picked up. Now choose where it goes.'); return; }
    if (sel === s) { sel = -1; draw(); say('Piece put back.'); return; }
    swap(sel, s);
  };
  var swap = function (a, b) {
    var t = pos[a]; pos[a] = pos[b]; pos[b] = t;
    sel = -1;
    moves++;
    draw();
    [a, b].forEach(function (s) { var el = board.children[s]; el.classList.remove('pop'); void el.offsetWidth; el.classList.add('pop'); });
    var fits = [a, b].filter(function (s) { return pos[s] === s; }).length;
    if (pos.every(function (p, s) { return p === s; })) win();
    else say(fits ? (fits === 2 ? 'Both pieces fit!' : 'One piece fits!') : 'Swapped.');
  };
  // Dragging a piece onto another swaps them. A short press without moving is a tap.
  var grab = function (e, s) {
    if (done || pos[s] === s || e.button > 0) return;
    var el = board.children[s], x0 = e.clientX, y0 = e.clientY, moving = false;
    var move = function (ev) {
      var dx = ev.clientX - x0, dy = ev.clientY - y0;
      if (!moving && Math.abs(dx) + Math.abs(dy) < 8) return;
      if (!moving) { moving = true; el.classList.add('drag'); sel = -1; draw(); }
      el.style.transform = 'translate(' + dx + 'px,' + dy + 'px) scale(1.06)';
    };
    var up = function (ev) {
      el.removeEventListener('pointermove', move);
      el.removeEventListener('pointerup', up);
      el.removeEventListener('pointercancel', up);
      if (!moving) return;
      dragged = true;
      setTimeout(function () { dragged = false; }, 0);
      el.classList.remove('drag');
      el.style.transform = '';
      el.style.visibility = 'hidden';
      var under = document.elementFromPoint(ev.clientX, ev.clientY);
      el.style.visibility = '';
      var t = under && under.closest ? under.closest('.pz-piece') : null;
      var to = t ? Array.prototype.indexOf.call(board.children, t) : -1;
      if (to > -1 && to !== s && pos[to] !== to) swap(s, to);
    };
    try { el.setPointerCapture(e.pointerId); } catch (err) {}
    el.addEventListener('pointermove', move);
    el.addEventListener('pointerup', up);
    el.addEventListener('pointercancel', up);
  };
  // Arrow keys move between the pieces.
  board.addEventListener('keydown', function (e) {
    var s = Array.prototype.indexOf.call(board.children, document.activeElement);
    if (s < 0) return;
    var to = { ArrowLeft: s % n ? s - 1 : -1, ArrowRight: s % n < n - 1 ? s + 1 : -1, ArrowUp: s - n, ArrowDown: s + n }[e.key];
    if (to === undefined) return;
    e.preventDefault();
    if (to < 0 || to >= n * n) return;
    board.children[s].tabIndex = -1;
    board.children[to].tabIndex = 0;
    board.children[to].focus();
  });
  var win = function () {
    done = true;
    board.classList.add('won');
    var best = store.get(KEY, {}) || {};
    var mine = best[pic.k] || {};
    var prev = mine[n];
    if (!prev || moves < prev) { mine[n] = moves; best[pic.k] = mine; store.set(KEY, best); }
    var flags = store.get('atlas.done', {}) || {};
    if (!flags.puzzle) { flags.puzzle = 1; store.set('atlas.done', flags); }
    if (window.atlasBadges) window.atlasBadges();
    var msg = 'You put the ' + pic.n + ' back together in ' + moves + ' moves!';
    if (prev && moves < prev) msg += ' That is your best yet.';
    else if (prev) msg += ' Your best is ' + prev + ' moves.';
    $('.pz-won-msg').textContent = msg;
    say(msg);
    won.hidden = false;
    $('.pz-again').focus({ preventScroll: true });
  };
  var mix = function () {
    pos = [];
    for (var s = 0; s < n * n; s++) pos.push(s);
    // No piece starts in its own place.
    do { shuffle(pos); } while (pos.some(function (p, s) { return p === s; }));
    sel = -1; moves = 0; done = false;
    won.hidden = true;
    build();
    draw();
    say('Tap two pieces to swap them.');
    board.children[0].focus({ preventScroll: true });
  };
  var begin = function (k) {
    pic = pics[k];
    start.hidden = true;
    play.hidden = false;
    won.hidden = true;
    board.innerHTML = '';
    board.style.setProperty('--n', n);
    $('.pz-name').textContent = pic.n;
    $('.pz-moves').textContent = '';
    $('.pz-read').href = pic.u;
    $('.pz-read').textContent = 'Read about the ' + pic.n;
    say('Mixing up the pieces…');
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
    paint(pic).then(function (u) {
      if (url && url.indexOf('blob:') === 0) URL.revokeObjectURL(url);
      url = u;
      peek.style.backgroundImage = 'url("' + url + '")';
      mix();
    }).catch(function () { say('Sorry, the picture did not load. Please choose another one.'); });
  };
  var drawBest = function () {
    var best = store.get(KEY, {}) || {};
    root.querySelectorAll('[data-best]').forEach(function (s) {
      var mine = best[s.getAttribute('data-best')] || {}, sizes = Object.keys(mine).map(Number).sort(), big = sizes[sizes.length - 1];
      s.textContent = big ? 'Solved: ' + big * big + ' pieces in ' + mine[big] + ' moves' : '';
    });
  };

  root.querySelectorAll('.pz-sizes .chip').forEach(function (c) {
    c.addEventListener('click', function () {
      n = +c.getAttribute('data-size');
      root.querySelectorAll('.pz-sizes .chip').forEach(function (o) { o.setAttribute('aria-pressed', String(o === c)); });
    });
  });
  root.querySelectorAll('.pz-pick').forEach(function (b) { b.addEventListener('click', function () { begin(+b.getAttribute('data-pic')); }); });
  $('.pz-again').addEventListener('click', mix);
  $('.pz-other').addEventListener('click', function () {
    play.hidden = true; start.hidden = false; drawBest();
    root.querySelector('.pz-pick').focus();
  });
  var peekBtn = $('.pz-peek-btn');
  var setPeek = function (on) {
    clearTimeout(peekTimer);
    peek.hidden = !on;
    peekBtn.setAttribute('aria-pressed', String(on));
    if (on) peekTimer = setTimeout(function () { setPeek(false); }, 2500);
  };
  peekBtn.addEventListener('click', function () { setPeek(peek.hidden); });
  drawBest();
})();
