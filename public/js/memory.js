// Memory match (/play/memory/): turn over two cards at a time and find six pairs. Cards come from the
// page data in #memory-data; the best score (fewest moves) is kept in this browser only.
(function () {
  'use strict';
  var root = document.querySelector('[data-memory]');
  var dataEl = document.getElementById('memory-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var items = data.items, jobs = data.jobs, worlds = data.worlds;
  var PAIRS = 6, KEY = 'atlas.memory';
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var shares = function (a, b) { return a.some(function (x) { return b.indexOf(x) > -1; }); };
  var words = function (s) { return s.toLowerCase().replace(/\(.*?\)/g, '').split(/[^a-z]+/).filter(function (w) { return w.length > 3; }); };
  var start = $('.mem-start'), play = $('.mem-play'), grid = $('.mem-grid');
  var mode = null, pairs = [], cards = [], open = [], busy = false, found = 0, moves = 0;

  var makers = {
    // Two buildings from different worlds that do the same job. No card may fit a second pair.
    job: function () {
      var out = [], used = [];
      shuffle(Object.keys(jobs)).forEach(function (g) {
        if (out.length >= PAIRS) return;
        var members = shuffle(items.filter(function (it) { return it.g.indexOf(g) > -1 && it.t; }));
        for (var i = 0; i < members.length; i++) {
          for (var j = i + 1; j < members.length; j++) {
            var a = members[i], b = members[j];
            if (a.w === b.w || shares(words(a.n), words(b.n))) continue;
            if (used.some(function (u) { return shares(u.g, a.g) || shares(u.g, b.g); })) continue;
            out.push({ a: a, b: b, why: a.n + ' and ' + b.n + ': both ' + jobs[g] + '.' });
            used.push(a, b);
            return;
          }
        }
      });
      return out;
    },
    // A picture and its name.
    name: function () {
      var seen = {};
      return shuffle(items.filter(function (it) { return it.t; })).filter(function (it) {
        if (seen[it.n]) return false;
        seen[it.n] = 1;
        return true;
      }).slice(0, PAIRS).map(function (it) { return { a: it, b: it, why: it.n + '.' }; });
    }
  };

  var faceDown = function (c) { return 'Card ' + (c.n + 1) + ', face down'; };
  var faceUp = function (c) {
    if (c.face === 'pic') return 'Picture of the ' + c.it.n;
    if (c.face === 'name') return 'The name ' + c.it.n;
    return c.it.n + ', ' + worlds[c.it.w];
  };
  var say = function (text) { $('.mem-status').textContent = text; };
  var counts = function () {
    $('.mem-pairs').textContent = 'Pairs: ' + found + ' of ' + pairs.length;
    $('.mem-moves').textContent = 'Moves: ' + moves;
  };
  var deal = function () {
    pairs = makers[mode]();
    cards = [];
    pairs.forEach(function (pr, p) {
      cards.push({ p: p, it: pr.a, face: mode === 'name' ? 'pic' : 'both' }, { p: p, it: pr.b, face: mode === 'name' ? 'name' : 'both' });
    });
    shuffle(cards);
    grid.innerHTML = '';
    open = []; busy = false; found = 0; moves = 0;
    cards.forEach(function (c, n) {
      c.n = n;
      var b = make('button', 'mem-card');
      b.type = 'button';
      b.setAttribute('aria-label', faceDown(c));
      var inner = make('span', 'mem-inner');
      var back = make('span', 'mem-face mem-back'), logo = make('img');
      logo.src = '/favicon.svg'; logo.alt = ''; logo.width = 48; logo.height = 48;
      back.appendChild(logo);
      var front = make('span', 'mem-face mem-front world-' + c.it.w + ' face-' + c.face);
      if (c.face !== 'name') { var im = make('img'); im.src = c.it.t; im.alt = ''; front.appendChild(im); }
      if (c.face !== 'pic') front.appendChild(make('span', 'mem-name', c.it.n));
      if (c.face === 'both') front.appendChild(make('span', 'mem-world', worlds[c.it.w]));
      inner.append(back, front);
      b.appendChild(inner);
      b.addEventListener('click', function () { flip(c); });
      c.btn = b;
      var li = make('li');
      li.appendChild(b);
      grid.appendChild(li);
    });
    counts();
    say('Turn over two cards.');
  };
  var flip = function (c) {
    if (busy || c.done || open.indexOf(c) > -1) return;
    c.btn.classList.add('open');
    c.btn.setAttribute('aria-label', faceUp(c));
    open.push(c);
    if (open.length < 2) { say(faceUp(c) + '. Now turn over another card.'); return; }
    moves++;
    var x = open[0], y = open[1];
    if (x.p === y.p) {
      x.done = y.done = true;
      found++;
      [x, y].forEach(function (d) { d.btn.classList.add('done'); d.btn.setAttribute('aria-disabled', 'true'); });
      open = [];
      say('A pair! ' + pairs[x.p].why);
      counts();
      if (found === pairs.length) finish();
      return;
    }
    busy = true;
    say(faceUp(y) + '. Not a pair.');
    counts();
    setTimeout(function () {
      [x, y].forEach(function (d) { d.btn.classList.remove('open'); d.btn.setAttribute('aria-label', faceDown(d)); });
      open = [];
      busy = false;
    }, 1100);
  };
  var finish = function () {
    var best = store.get(KEY, {}) || {};
    var prev = best[mode];
    if (!prev || moves < prev) { best[mode] = moves; store.set(KEY, best); }
    var done = store.get('atlas.done', {}) || {};
    if (!done.memory) { done.memory = 1; store.set('atlas.done', done); }
    if (window.atlasBadges) window.atlasBadges();
    say('You found all ' + pairs.length + ' pairs in ' + moves + ' moves!' + (prev && moves < prev ? ' That is your best yet.' : ''));
    $('.mem-again').focus({ preventScroll: true });
  };
  var drawBest = function () {
    var best = store.get(KEY, {}) || {};
    root.querySelectorAll('[data-best]').forEach(function (s) { var v = best[s.getAttribute('data-best')]; s.textContent = v ? 'Your best: ' + v + ' moves' : ''; });
  };
  var begin = function (m) {
    mode = m;
    start.hidden = true;
    play.hidden = false;
    deal();
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
    grid.querySelector('.mem-card').focus({ preventScroll: true });
  };
  root.querySelectorAll('.qmode').forEach(function (b) { b.addEventListener('click', function () { begin(b.getAttribute('data-mode')); }); });
  $('.mem-again').addEventListener('click', function () { deal(); grid.querySelector('.mem-card').focus({ preventScroll: true }); });
  $('.mem-other').addEventListener('click', function () { play.hidden = true; start.hidden = false; drawBest(); root.querySelector('.qmode').focus(); });
  drawBest();
})();
