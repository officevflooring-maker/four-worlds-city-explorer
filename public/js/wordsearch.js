// Word search (/play/word-search/): puzzles from #ws-data (made by build/play.php). Tap or click the
// first and last letter of a word, or drag across it. Keyboard: arrow keys move, Enter picks a letter.
(function () {
  'use strict';
  var root = document.querySelector('[data-wsearch]');
  var dataEl = document.getElementById('ws-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var grid = root.querySelector('.ws-grid'), list = root.querySelector('.ws-words'), count = root.querySelector('.ws-count');
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var set = 'roman', last = {}, puzzle = null, cells = [], N = 12, found = {}, nFound = 0, first = null, preview = [];

  var say = function (text) { count.textContent = text; };
  var tally = function () { return 'Found ' + nFound + ' of ' + puzzle.w.length + ' words.'; };
  var cellAt = function (r, c) { return cells[r * N + c]; };
  var pos = function (cell) { return [Number(cell.getAttribute('data-r')), Number(cell.getAttribute('data-c'))]; };
  // The cells from a to b along a row, a column or a diagonal; null if they are not in a straight line.
  var line = function (a, b) {
    var p = pos(a), q = pos(b), dr = q[0] - p[0], dc = q[1] - p[1];
    if (dr && dc && Math.abs(dr) !== Math.abs(dc)) return null;
    var len = Math.max(Math.abs(dr), Math.abs(dc)) + 1, sr = Math.sign(dr), sc = Math.sign(dc), out = [];
    for (var i = 0; i < len; i++) out.push(cellAt(p[0] + sr * i, p[1] + sc * i));
    return out;
  };
  var showPreview = function (path) {
    preview.forEach(function (c) { c.classList.remove('sel'); });
    preview = path || [];
    preview.forEach(function (c) { c.classList.add('sel'); });
  };
  var check = function (a, b) {
    var path = line(a, b);
    if (!path || path.length < 2) return false;
    var text = path.map(function (c) { return c.textContent; }).join('');
    var back = text.split('').reverse().join('');
    var hit = puzzle.w.filter(function (w) { return !found[w[0]] && (w[0] === text || w[0] === back); })[0];
    if (!hit) return false;
    nFound++;
    found[hit[0]] = 'f' + ((nFound - 1) % 6 + 1);
    path.forEach(function (c) { c.classList.remove('f1', 'f2', 'f3', 'f4', 'f5', 'f6'); c.classList.add('got', found[hit[0]]); });
    var li = list.querySelector('[data-word="' + hit[0] + '"]');
    li.classList.add('got', found[hit[0]]);
    li.querySelector('.ws-word').appendChild(make('span', 'sr-only', ' (found)'));
    if (nFound === puzzle.w.length) {
      say('You found all ' + puzzle.w.length + ' words! Read what they mean, then try a new puzzle.');
      var done = store.get('atlas.done', {}) || {};
      if (!done.words) { done.words = 1; store.set('atlas.done', done); }
      if (window.atlasBadges) window.atlasBadges();
    } else say('Found ' + hit[0].toLowerCase() + '! ' + tally());
    return true;
  };
  var tap = function (cell) {
    if (!first) { first = cell; showPreview([cell]); say('First letter picked. Now pick the last letter.'); return; }
    if (cell === first) { first = null; showPreview(null); say(tally()); return; }
    if (!check(first, cell)) say('That is not one of the words. ' + tally());
    first = null;
    showPreview(null);
  };

  var render = function () {
    var ps = data.p[set], n;
    do { n = Math.floor(Math.random() * ps.length); } while (ps.length > 1 && n === last[set]);
    last[set] = n;
    puzzle = ps[n];
    N = puzzle.g.length;
    found = {}; nFound = 0; first = null; preview = []; cells = [];
    grid.innerHTML = '';
    grid.style.setProperty('--n', N);
    puzzle.g.forEach(function (row, r) {
      var rowEl = make('div', 'ws-row');
      rowEl.setAttribute('role', 'row');
      row.split('').forEach(function (ch, c) {
        var cell = make('span', 'ws-cell', ch);
        cell.setAttribute('role', 'gridcell');
        cell.setAttribute('data-r', r);
        cell.setAttribute('data-c', c);
        cell.tabIndex = r || c ? -1 : 0;
        rowEl.appendChild(cell);
        cells.push(cell);
      });
      grid.appendChild(rowEl);
    });
    list.innerHTML = '';
    puzzle.w.forEach(function (w) {
      var li = make('li');
      li.setAttribute('data-word', w[0]);
      var mean = make('span', 'ws-mean', w[5] + ' ');
      var a = make('a', 'world-' + w[7], 'Read more');
      a.href = w[6];
      mean.appendChild(a);
      li.append(make('span', 'ws-word', w[0].charAt(0) + w[0].slice(1).toLowerCase()), mean);
      list.appendChild(li);
    });
    say(tally());
  };

  // Pointer: drag across a word, or tap its first and last letters.
  var from = null, moved = false;
  var cellFrom = function (e) { var el = document.elementFromPoint(e.clientX, e.clientY); return el && el.closest ? el.closest('.ws-cell') : null; };
  grid.addEventListener('pointerdown', function (e) {
    var cell = e.target.closest('.ws-cell');
    if (!cell || e.button > 0) return;
    e.preventDefault();
    from = cell;
    moved = false;
  });
  grid.addEventListener('pointermove', function (e) {
    if (!from) return;
    var cell = cellFrom(e);
    if (!cell || (cell === from && !moved)) return;
    moved = true;
    showPreview(line(from, cell) || [from]);
  });
  window.addEventListener('pointerup', function (e) {
    if (!from) return;
    var start = from, cell = cellFrom(e);
    from = null;
    if (moved && cell && cell !== start) {
      if (!check(start, cell)) say('That is not one of the words. ' + tally());
      first = null;
      showPreview(null);
      return;
    }
    showPreview(null);
    tap(start);
  });
  grid.addEventListener('keydown', function (e) {
    var cell = e.target.closest('.ws-cell');
    if (!cell) return;
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); tap(cell); return; }
    var d = { ArrowRight: [0, 1], ArrowLeft: [0, -1], ArrowDown: [1, 0], ArrowUp: [-1, 0] }[e.key];
    if (!d) return;
    e.preventDefault();
    var p = pos(cell), r = Math.min(N - 1, Math.max(0, p[0] + d[0])), c = Math.min(N - 1, Math.max(0, p[1] + d[1]));
    cells.forEach(function (x) { x.tabIndex = -1; });
    var to = cellAt(r, c);
    to.tabIndex = 0;
    to.focus();
    if (first) showPreview(line(first, to) || [first]);
  });

  root.querySelectorAll('[data-set]').forEach(function (b) {
    b.addEventListener('click', function () {
      set = b.getAttribute('data-set');
      root.querySelectorAll('[data-set]').forEach(function (o) { o.setAttribute('aria-pressed', String(o === b)); });
      render();
    });
  });
  root.querySelector('[data-ws="new"]').addEventListener('click', render);
  root.querySelector('[data-ws="print"]').addEventListener('click', function () { window.print(); });
  render();
})();
