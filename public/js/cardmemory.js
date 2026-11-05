// Card memory (/play/card-memory/): fourteen painted trading cards, two of each world, turned over two at a time.
// The cards come from the page data in #cardmemory-data; the best score (fewest moves) is kept in this browser only.
(function () {
  'use strict';
  var root = document.querySelector('[data-cardmemory]');
  var dataEl = document.getElementById('cardmemory-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var KEY = 'atlas.cardmemory', ART = '/assets/card-memory/';
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var pic = function (src, cls) { var im = make('img', cls); im.src = src; im.alt = ''; im.decoding = 'async'; return im; };
  var grid = $('.cm-grid');
  var cards = [], open = [], busy = false, found = 0, moves = 0;

  // A framed card: the painting (or the back's logo) in the frame's window, the frame over it, words on its plates.
  var framed = function (cls, style, frame, inner, top, bottom) {
    var f = make('span', 'cm-face ' + cls);
    f.setAttribute('style', style);
    var win = make('span', 'cm-win');
    win.appendChild(inner);
    f.append(win, pic(ART + 'frame-' + frame + '.webp', 'cm-frame'));
    if (top) f.appendChild(make('span', 'cm-top' + (top.length > 15 ? ' cm-long' : ''), top));   // "Medieval Kingdom" needs a smaller size to fit
    if (bottom) f.appendChild(make('span', 'cm-bot', bottom));
    return f;
  };
  var say = function (text) { $('.cm-status').textContent = text; };
  var counts = function () {
    $('.cm-pairs').textContent = 'Pairs: ' + found + ' of ' + data.cards.length;
    $('.cm-moves').textContent = 'Moves: ' + moves;
    var best = store.get(KEY, null);
    $('.cm-best').textContent = best ? 'Your best: ' + best + ' moves' : '';
  };
  var deal = function () {
    cards = [];
    data.cards.forEach(function (c) { cards.push({ c: c }, { c: c }); });
    shuffle(cards);
    grid.innerHTML = '';
    open = []; busy = false; found = 0; moves = 0;
    cards.forEach(function (d, n) {
      d.n = n;
      var b = make('button', 'cm-card');
      b.type = 'button';
      b.setAttribute('aria-label', 'Card ' + (n + 1) + ', face down');
      var inner = make('span', 'cm-inner');
      var back = make('span', 'cm-logo');
      back.appendChild(pic('/favicon.svg'));
      inner.append(framed('cm-back', data.back, 'gold', back, 'Atlas of Cities', ''),
        framed('cm-front world-' + d.c.w, d.c.style, d.c.w, pic(ART + d.c.w + '.webp', 'cm-art'), d.c.name, d.c.no));
      b.appendChild(inner);
      b.addEventListener('click', function () { flip(d); });
      d.btn = b;
      var li = make('li');
      li.appendChild(b);
      grid.appendChild(li);
    });
    counts();
    say('Turn over two cards.');
  };
  var flip = function (d) {
    if (busy || d.done || open.indexOf(d) > -1) return;
    d.btn.classList.add('open');
    d.btn.setAttribute('aria-label', d.c.name + ' card');
    open.push(d);
    if (open.length < 2) { say(d.c.name + '. Now turn over another card.'); return; }
    moves++;
    var x = open[0], y = open[1];
    open = [];
    if (x.c === y.c) {
      x.done = y.done = true;
      found++;
      [x, y].forEach(function (e) { e.btn.classList.add('done'); e.btn.setAttribute('aria-disabled', 'true'); });
      say('A pair! ' + x.c.line);
      counts();
      if (found === data.cards.length) finish(x.c.line);
      return;
    }
    busy = true;
    say(y.c.name + '. Not a pair.');
    counts();
    setTimeout(function () {
      [x, y].forEach(function (e) { e.btn.classList.remove('open'); e.btn.setAttribute('aria-label', 'Card ' + (e.n + 1) + ', face down'); });
      busy = false;
    }, 1100);
  };
  var finish = function (line) {
    var prev = store.get(KEY, null);
    if (!prev || moves < prev) store.set(KEY, moves);
    say(line + ' You found all seven pairs in ' + moves + ' moves!' + (prev && moves < prev ? ' That is your best yet.' : ''));
    counts();
    $('.cm-again').focus({ preventScroll: true });
  };
  $('.cm-again').addEventListener('click', function () { deal(); grid.querySelector('.cm-card').focus({ preventScroll: true }); });
  deal();
})();
