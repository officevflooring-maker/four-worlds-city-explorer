// City builder (/play/city-builder/): place buildings from all four worlds on a 6 x 6 city, see which
// needs the city meets, then save a picture, copy a link or print it. The city is kept in the page
// address (#city=...) and in this browser only; nothing is sent anywhere.
(function () {
  'use strict';
  var root = document.querySelector('[data-builder]');
  if (!root) return;

  var N = 6, Y0 = 12, KEY = 'atlas.city';
  var LETTER = { r: 'roman', m: 'modern', e: 'elven', f: 'future' };
  var WORLD = { roman: 'Ancient Rome', modern: 'the Modern Town', elven: 'the Elven Green World', future: 'the Robotic Future' };
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var all = function (sel) { return Array.prototype.slice.call(root.querySelectorAll(sel)); };
  var city = root.querySelector('.builder-city');
  var tilesEl = city.querySelector('.city-tiles');
  var cells = all('.bcell');
  var status = root.querySelector('.b-status');
  var undoBtn = root.querySelector('[data-act="undo"]');
  var needEls = all('.need');

  // Pieces come from the palette buttons; bases (ground and streets) from the Ground buttons.
  var pieces = {};
  var pieceBtns = all('.piece');
  pieceBtns.forEach(function (b) {
    var d = b.dataset;
    pieces[d.code] = { code: d.code, kind: d.kind, world: d.world, src: d.src, name: d.name, url: d.url, needs: d.needs ? d.needs.split(' ') : [] };
  });
  var bases = {};
  all('[data-base]').forEach(function (b) { bases[b.dataset.base] = { tex: b.dataset.tex, road: b.dataset.road, btn: b }; });
  needEls.forEach(function (li) { li.appendChild(document.createElement('span')).className = 'sr-only need-state'; });

  var blank = function () { var a = []; for (var k = 0; k < N * N; k++) a.push({ g: null, b: null }); return a; };
  var state = { base: 'modern', cells: blank() };
  var tool = 'look';
  var past = [];

  var say = function (text, href) {
    status.textContent = text;
    if (href) { var a = document.createElement('a'); a.href = href; a.textContent = 'Read about it'; status.append(' ', a); }
  };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };

  // ---------- Saving: a short code such as "m;raqueduct.r~water+rolive-tree" ----------
  var encode = function () {
    var parts = state.cells.map(function (c) { return [c.g, c.b].filter(Boolean).join('+'); });
    while (parts.length && !parts[parts.length - 1]) parts.pop();
    return state.base.charAt(0) + ';' + parts.join('.');
  };
  var decode = function (s) {
    var m = /^([rmef]);(.*)$/.exec(s || '');
    if (!m) return null;
    var st = { base: LETTER[m[1]], cells: blank() };
    m[2].split('.').slice(0, N * N).forEach(function (cell, k) {
      cell.split('+').forEach(function (code) {
        var p = pieces[code];
        if (p) st.cells[k][p.kind === 'g' ? 'g' : 'b'] = code;
      });
    });
    return st;
  };
  var save = function () {
    var code = encode();
    store.set(KEY, code);
    try { history.replaceState(null, '', '#city=' + code); } catch (e) {}
  };
  var remember = function () { past.push(JSON.stringify(state)); if (past.length > 60) past.shift(); undoBtn.disabled = false; };
  var isEmpty = function (c) { return !c.g && !c.b; };

  // ---------- Drawing ----------
  var setBase = function (w) {
    var b = bases[w];
    state.base = w;
    city.style.setProperty('--tex', 'url(' + b.tex + ')');
    city.style.setProperty('--roadtex', 'url(' + b.road + ')');
    city.className = city.className.replace(/\bworld-\w+/, 'world-' + w);
    Object.keys(bases).forEach(function (o) { bases[o].btn.setAttribute('aria-pressed', String(o === w)); });
  };
  var tileEls = [];
  var ghost = null;
  var label = function (k) {
    var c = state.cells[k], what = 'empty';
    if (c.b && c.g) what = pieces[c.b].name + ' on ' + pieces[c.g].name.toLowerCase();
    else if (c.b || c.g) what = pieces[c.b || c.g].name;
    return 'Square ' + (k % N + 1) + ', ' + (Math.floor(k / N) + 1) + ': ' + what;
  };
  var drawCell = function (k, pop) {
    var c = state.cells[k], cell = cells[k];
    var g = c.g && pieces[c.g];
    cell.firstChild.style.backgroundImage = g ? 'url(' + g.src + ')' : '';
    cell.classList.toggle('has-g', !!g);
    var p = c.b && pieces[c.b];
    var li = tileEls[k];
    if (p) {
      if (!li) {
        li = tileEls[k] = document.createElement('li');
        li.style.setProperty('--i', k % N);
        li.style.setProperty('--j', Math.floor(k / N));
        li.setAttribute('data-k', k);
        var img = document.createElement('img');
        img.alt = ''; img.className = 'bt-img'; img.draggable = false;
        li.appendChild(img);
        tilesEl.insertBefore(li, ghost);
      }
      li.className = 'tile' + (p.kind === 't' ? ' tile-tree' : '');
      if (li.firstChild.getAttribute('src') !== p.src) li.firstChild.src = p.src;
      if (pop) { void li.offsetWidth; li.classList.add('pop'); }
    } else if (li) {
      li.remove();
      tileEls[k] = null;
    }
    cell.setAttribute('aria-label', label(k));
  };
  var drawNeeds = function () {
    var met = {};
    state.cells.forEach(function (c) {
      [c.g, c.b].forEach(function (code) { if (code) pieces[code].needs.forEach(function (n) { met[n] = met[n] || pieces[code].name; }); });
    });
    var n = 0;
    needEls.forEach(function (li) {
      var by = met[li.dataset.need];
      li.classList.toggle('met', !!by);
      li.title = by ? 'Met by: ' + by : 'Not met yet';
      li.lastChild.textContent = by ? ' (met by ' + by + ')' : ' (not met yet)';
      if (by) n++;
    });
    root.querySelector('.b-score strong').textContent = n;
    root.querySelector('.b-done').hidden = n < needEls.length;
  };
  var drawAll = function () {
    for (var k = 0; k < N * N; k++) drawCell(k);
    drawNeeds();
    undoBtn.disabled = !past.length;
  };

  // ---------- Tools ----------
  var setTool = function (t) {
    tool = t;
    var p = pieces[t];
    pieceBtns.forEach(function (b) { b.setAttribute('aria-pressed', String(b.dataset.code === t)); });
    all('.b-tool').forEach(function (b) { b.setAttribute('aria-pressed', String(b.dataset.tool === t)); });
    city.classList.toggle('placing', !!p);
    city.classList.toggle('placing-g', !!p && p.kind === 'g');
    city.classList.toggle('erasing', t === 'erase');
    if (p && p.kind === 'g') city.style.setProperty('--gprev', 'url(' + p.src + ')');
    drawGhost();
    if (p) say('Now tap squares on the map to place: ' + p.name + '.');
    else if (t === 'erase') say('Eraser: tap a building or a square of ground to remove it.');
    else say('Look: tap anything on the map to find out what it is.');
  };
  var useCell = function (k) {
    if (k < 0) return;
    var c = state.cells[k], p = pieces[tool];
    if (p) {
      var slot = p.kind === 'g' ? 'g' : 'b';
      if (c[slot] === p.code) { say(p.name + ' is already there.'); return; }
      remember();
      c[slot] = p.code;
      drawCell(k, true); drawNeeds(); save();
      say(p.name + ' placed. Tap more squares, or pick something else.');
      return;
    }
    if (tool === 'erase') {
      var which = c.b ? 'b' : (c.g ? 'g' : null);
      if (!which) { say('Nothing to remove there.'); return; }
      remember();
      var gone = pieces[c[which]].name;
      c[which] = null;
      drawCell(k); drawNeeds(); save();
      say(gone + ' removed.');
      return;
    }
    var q = pieces[c.b || c.g];
    if (!q) say('An empty square. Pick something below to build here.');
    else say(q.name + ', from ' + WORLD[q.world] + '.', q.url);
  };

  // ---------- Pointing: the topmost solid building under the pointer, or the ground square ----------
  var alpha = {};
  var solid = function (img, x, y) {
    var m = alpha[img.src];
    if (!m) {
      if (!img.complete || !img.naturalWidth) return true;
      var w = 48, h = Math.max(1, Math.round(w * img.naturalHeight / img.naturalWidth));
      var cv = document.createElement('canvas');
      cv.width = w; cv.height = h;
      var cx = cv.getContext('2d');
      cx.drawImage(img, 0, 0, w, h);
      try { m = alpha[img.src] = { w: w, h: h, a: cx.getImageData(0, 0, w, h).data }; } catch (e) { return true; }
    }
    var r = img.getBoundingClientRect();
    var px = Math.floor((x - r.left) / r.width * m.w), py = Math.floor((y - r.top) / r.height * m.h);
    return px >= 0 && py >= 0 && px < m.w && py < m.h && m.a[(py * m.w + px) * 4 + 3] > 60;
  };
  var pick = function (x, y) {
    var els = document.elementsFromPoint(x, y);
    for (var i = 0; i < els.length; i++) {
      var el = els[i];
      if (el.classList.contains('bt-img')) { if (solid(el, x, y)) return Number(el.parentNode.getAttribute('data-k')); continue; }
      var cell = el.closest && el.closest('.bcell');
      if (cell) return Number(cell.dataset.k);
      if (el === city) break;
    }
    return -1;
  };
  var hot = -1;
  var drawGhost = function () {
    var p = pieces[tool];
    if (hot < 0 || !p || p.kind === 'g') { if (ghost) ghost.hidden = true; return; }
    if (!ghost) {
      ghost = document.createElement('li');
      var im = document.createElement('img');
      im.alt = '';
      ghost.appendChild(im);
      tilesEl.appendChild(ghost);
    }
    ghost.hidden = false;
    ghost.className = 'tile ghost' + (p.kind === 't' ? ' tile-tree' : '');
    ghost.style.setProperty('--i', hot % N);
    ghost.style.setProperty('--j', Math.floor(hot / N));
    if (ghost.firstChild.getAttribute('src') !== p.src) ghost.firstChild.src = p.src;
  };
  var setHot = function (k) {
    if (k === hot) return;
    if (hot > -1) cells[hot].classList.remove('hot');
    hot = k;
    if (k > -1) cells[k].classList.add('hot');
    drawGhost();
  };
  var raf = 0, px = 0, py = 0;
  city.addEventListener('pointermove', function (e) {
    if (e.pointerType !== 'mouse') return;
    px = e.clientX; py = e.clientY;
    if (!raf) raf = requestAnimationFrame(function () { raf = 0; setHot(pick(px, py)); });
  });
  city.addEventListener('pointerleave', function () { setHot(-1); });
  var focusCell = function (k) {
    cells.forEach(function (c, n) { c.tabIndex = n === k ? 0 : -1; });
    cells[k].focus({ preventScroll: true });
    setHot(k);
  };
  city.addEventListener('click', function (e) {
    var cell = e.target.closest('.bcell');
    var k = e.detail === 0 && cell ? Number(cell.dataset.k) : pick(e.clientX, e.clientY);
    if (k < 0) return;
    cells.forEach(function (c, n) { c.tabIndex = n === k ? 0 : -1; });
    useCell(k);
  });
  city.addEventListener('focusin', function (e) { var cell = e.target.closest('.bcell'); if (cell && cell.matches(':focus-visible')) setHot(Number(cell.dataset.k)); });
  city.addEventListener('focusout', function () { setHot(-1); });
  city.addEventListener('keydown', function (e) {
    var cell = e.target.closest('.bcell');
    if (!cell) return;
    var k = Number(cell.dataset.k), i = k % N, j = Math.floor(k / N);
    if (e.key === 'Delete' || e.key === 'Backspace') { e.preventDefault(); var t = tool; tool = 'erase'; useCell(k); tool = t; return; }
    var d = { ArrowRight: [1, 0], ArrowLeft: [-1, 0], ArrowDown: [0, 1], ArrowUp: [0, -1] }[e.key];
    if (!d) return;
    e.preventDefault();
    focusCell(Math.min(N - 1, Math.max(0, j + d[1])) * N + Math.min(N - 1, Math.max(0, i + d[0])));
  });

  // ---------- Palette tabs (one per world) ----------
  var tabs = all('.pal-tab');
  var selectTab = function (tab, focus) {
    tabs.forEach(function (t) {
      var on = t === tab;
      t.setAttribute('aria-selected', String(on));
      t.tabIndex = on ? 0 : -1;
      document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
    });
    if (focus) tab.focus();
  };
  tabs.forEach(function (t, n) {
    t.addEventListener('click', function () { selectTab(t); });
    t.addEventListener('keydown', function (e) {
      var d = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
      if (d) { e.preventDefault(); selectTab(tabs[(n + d + tabs.length) % tabs.length], true); }
    });
  });
  var tabWorld = function () {
    var t = tabs.filter(function (x) { return x.getAttribute('aria-selected') === 'true'; })[0];
    return t ? t.id.replace('pal-tab-', '') : 'modern';
  };

  // ---------- Actions ----------
  // A random city from the world shown in the palette: one building for each need first, then more.
  var randomCity = function () {
    var w = tabWorld();
    var mine = Object.keys(pieces).map(function (c) { return pieces[c]; }).filter(function (p) { return p.world === w; });
    var buildings = shuffle(mine.filter(function (p) { return p.kind === 'b'; }));
    var tree = mine.filter(function (p) { return p.kind === 't'; })[0];
    remember();
    state = { base: w, cells: blank() };
    var free = shuffle(state.cells.map(function (c, k) { return k; }));
    var used = {};
    var put = function (p) { used[p.code] = 1; state.cells[free.pop()].b = p.code; };
    needEls.forEach(function (li) {
      var need = li.dataset.need;
      if (buildings.some(function (p) { return used[p.code] && p.needs.indexOf(need) > -1; })) return;
      var p = buildings.filter(function (b) { return !used[b.code] && b.needs.indexOf(need) > -1; })[0];
      if (p) put(p);
    });
    buildings.forEach(function (p) { if (!used[p.code] && free.length > 11) put(p); });
    while (free.length > 7) state.cells[free.pop()].b = tree.code;
    state.cells[free.pop()].g = w.charAt(0) + '~water';
    state.cells[free.pop()].g = w.charAt(0) + '~grass';
    setBase(w); drawAll(); save();
    say('A random city in ' + WORLD[w] + '. Change anything you like.');
  };
  var loadImg = function (src) {
    return new Promise(function (ok) {
      var im = new Image();
      im.onload = function () { ok(im); };
      im.onerror = function () { ok(null); };
      im.src = src;
    });
  };
  // Draws the city on a canvas with the same geometry as the CSS map, and saves it as a PNG file.
  var picture = function () {
    say('Making your picture\u2026');
    // Units are the map's (1 = 1% of its width), with a margin on each side; the empty sky is cut off below.
    var W = 1600, M = 3, k = W / (100 + 2 * M), PAD = 8, H = Math.round((66 + PAD) * k);
    var base = bases[state.base];
    var srcs = [base.tex, base.road];
    state.cells.forEach(function (c) { [c.g, c.b].forEach(function (code) { if (code && srcs.indexOf(pieces[code].src) < 0) srcs.push(pieces[code].src); }); });
    Promise.all(srcs.map(loadImg)).then(function (imgs) {
      var im = {};
      srcs.forEach(function (s, n) { im[s] = imgs[n]; });
      var cv = document.createElement('canvas');
      cv.width = W; cv.height = H;
      var ctx = cv.getContext('2d');
      var sky = ctx.createLinearGradient(0, 0, 0, H);
      sky.addColorStop(0, '#e8eff7'); sky.addColorStop(1, '#f7f5f0');
      ctx.fillStyle = sky; ctx.fillRect(0, 0, W, H);
      var cs = getComputedStyle(city);
      var road = cs.getPropertyValue('--road').trim() || '#6b6e73', curb = cs.getPropertyValue('--curb').trim() || '#d9d6cf';
      var L = 70.71 * k, cell = L / N, rw = cell * 0.32;
      var pattern = function (img, x, y) {
        if (!img) return '#cfc8ba';
        var p = ctx.createPattern(img, 'repeat');
        if (p.setTransform && window.DOMMatrix) p.setTransform(new DOMMatrix().translateSelf(x, y).scaleSelf(cell / img.naturalWidth));
        return p;
      };
      // Ground, in the map's tilted plane: a square turned 45 degrees and squashed to half height.
      ctx.save();
      ctx.translate((M + 50) * k, (PAD + Y0 + 25) * k);
      ctx.scale(1, 0.5);
      ctx.rotate(Math.PI / 4);
      ctx.translate(-L / 2, -L / 2);
      ctx.shadowColor = 'rgba(0,0,0,.25)'; ctx.shadowBlur = 3 * k; ctx.shadowOffsetY = 1.5 * k;
      ctx.fillStyle = curb; ctx.fillRect(-rw / 2 - 0.5 * k, -rw / 2 - 0.5 * k, L + rw + k, L + rw + k);
      ctx.shadowColor = 'transparent';
      ctx.fillStyle = road; ctx.fillRect(-rw / 2, -rw / 2, L + rw, L + rw);
      ctx.fillStyle = pattern(im[base.tex], 0, 0); ctx.fillRect(0, 0, L, L);
      ctx.fillStyle = pattern(im[base.road], -cell / 2, -cell / 2);
      for (var q = 0; q <= N; q++) { ctx.fillRect(q * cell - rw / 2, -rw / 2, rw, L + rw); ctx.fillRect(-rw / 2, q * cell - rw / 2, L + rw, rw); }
      state.cells.forEach(function (c, n) {
        if (!c.g) return;
        var x = (n % N) * cell + rw / 2, y = Math.floor(n / N) * cell + rw / 2;
        ctx.fillStyle = pattern(im[pieces[c.g].src], x, y);
        ctx.fillRect(x, y, cell - rw, cell - rw);
      });
      ctx.restore();
      // Buildings, from the back row to the front.
      var order = [];
      var top = (PAD + Y0 - 1) * k;
      state.cells.forEach(function (c, n) { if (c.b) order.push(n); });
      order.sort(function (a, b) { return (a % N + Math.floor(a / N)) - (b % N + Math.floor(b / N)) || a - b; });
      order.forEach(function (n) {
        var p = pieces[state.cells[n].b], img = im[p.src];
        if (!img) return;
        var i = n % N, j = Math.floor(n / N), s = p.kind === 't' ? 0.62 : 0.7;
        var w = s * 96 / N * k, h = w * img.naturalHeight / img.naturalWidth;
        var x = (M + 50 + (i - j) * 50 / N - s * 48 / N) * k;
        var y = (PAD + Y0 + (i + j + 1 + s) * 25 / N + s * 4.8 / N) * k - h;
        ctx.drawImage(img, x, y, w, h);
        top = Math.min(top, y);
      });
      var cut = Math.max(0, Math.floor(top - 3 * k));
      var out = document.createElement('canvas');
      out.width = W; out.height = H - cut;
      var o = out.getContext('2d');
      o.drawImage(cv, 0, -cut);
      o.fillStyle = '#17202b';
      o.font = 'bold ' + Math.round(2.4 * k) + 'px Georgia, serif';
      o.fillText('My city', 2.2 * k, out.height - 2.2 * k);
      o.fillStyle = '#536072';
      o.font = Math.round(1.3 * k) + 'px Georgia, serif';
      o.textAlign = 'right';
      o.fillText('Made with The Atlas of Cities', W - 2.2 * k, out.height - 2.2 * k);
      out.toBlob(function (blob) {
        if (!blob) { say('Sorry, the picture could not be made.'); return; }
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'my-city.png';
        document.body.appendChild(a);
        a.click();
        a.remove();
        setTimeout(function () { URL.revokeObjectURL(a.href); }, 5000);
        say('Saved as my-city.png in your downloads.');
      }, 'image/png');
    });
  };
  var copyLink = function () {
    save();
    var link = location.href;
    var fallback = function () { window.prompt('Copy this link to share your city:', link); };
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(link).then(function () { say('Link copied. Anyone who opens it sees your city.'); }, fallback);
    } else fallback();
  };
  var actions = {
    undo: function () {
      if (!past.length) return;
      state = JSON.parse(past.pop());
      setBase(state.base); drawAll(); save();
      say('Undone.');
    },
    clear: function () {
      if (state.cells.every(isEmpty)) { say('The city is already empty.'); return; }
      remember();
      state.cells = blank();
      drawAll(); save();
      say('Cleared. Press Undo to bring it back.');
    },
    random: randomCity,
    picture: picture,
    link: copyLink,
    print: function () { window.print(); }
  };
  root.addEventListener('click', function (e) {
    var p = e.target.closest('.piece');
    if (p) { setTool(tool === p.dataset.code ? 'look' : p.dataset.code); return; }
    var t = e.target.closest('.b-tool');
    if (t) { setTool(t.dataset.tool); return; }
    var b = e.target.closest('[data-base]');
    if (b) { if (b.dataset.base !== state.base) { remember(); setBase(b.dataset.base); save(); } return; }
    var a = e.target.closest('[data-act]');
    if (a && actions[a.dataset.act]) actions[a.dataset.act]();
  });

  // ---------- Start: a shared link first, then the city saved in this browser ----------
  var fromLink = function () { var h = /#city=([^&]*)/.exec(location.hash); return h ? decodeURIComponent(h[1]) : ''; };
  var load = function () {
    var linked = fromLink(), saved = store.get(KEY, '');
    var st = decode(linked || saved);
    if (st) state = st;
    setBase(state.base);
    drawAll();
    if (!state.cells.every(isEmpty)) say(linked && linked !== saved ? 'Here is a shared city. Change anything you like.' : 'Welcome back. Your city is just as you left it.');
  };
  load();
  window.addEventListener('hashchange', function () { var linked = fromLink(); if (linked && linked !== encode()) { past = []; load(); } });
})();
