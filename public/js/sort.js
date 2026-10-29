// World sort (/play/world-sort/): pictures pop up one at a time, and the player sends each to its world (or to
// long ago, today, a possible future or an imagined world) before the minute is up. Pictures come from the page
// data in #sort-data; best scores stay in this browser only.
(function () {
  'use strict';
  var root = document.querySelector('[data-sort]');
  var dataEl = document.getElementById('sort-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var ORDER = ['egypt', 'roman', 'modern', 'green', 'future', 'heaven'];
  var TIME = 60, KEY = 'atlas.sort', NEED = 15;   // seconds in a game; right answers that earn the badge
  // The buttons for each game: [label, the worlds it takes, class for its color].
  var BINS = {
    world: ORDER.map(function (w) { return [data.worlds[w][0], [w], 'world-' + w]; }),
    time: [['Long ago', ['egypt', 'roman'], 'bin-past'], ['Today', ['modern'], 'bin-today'], ['Possible future', ['future'], 'bin-future'], ['Imagined', ['green', 'heaven'], 'bin-imagined']]
  };
  var calm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var theWorld = function (w) { return (w === 'roman' || w === 'egypt' ? '' : 'the ') + data.worlds[w][0]; };
  var start = $('.sort-start'), play = $('.sort-play'), end = $('.sort-end'), card = $('.sort-card'), bins = $('.sort-bins');
  var mode = null, deck = [], cur = null, right = 0, streak = 0, bestStreak = 0, left = 0, last = 0, timer = 0, busy = false, missed = [];

  var binOf = function (w) {
    var at = -1;
    BINS[mode].forEach(function (b, n) { if (b[1].indexOf(w) > -1) at = n; });
    return at;
  };
  var say = function (text) { $('.sort-say').textContent = text; };
  var drawBins = function () {
    bins.innerHTML = '';
    bins.className = 'sort-bins bins-' + BINS[mode].length;
    BINS[mode].forEach(function (b, n) {
      var btn = make('button', 'sort-bin ' + b[2]);
      btn.type = 'button';
      var key = make('span', 'sort-key', String(n + 1));
      key.setAttribute('aria-hidden', 'true');
      btn.append(key, make('span', 'sort-label', b[0]));
      btn.addEventListener('click', function () { drop(n); });
      bins.appendChild(btn);
    });
  };
  var deal = function () {
    if (!deck.length) deck = shuffle(data.items.slice());
    cur = deck.pop();
    var img = make('img');
    img.src = cur.t; img.alt = ''; img.width = 200; img.height = 200;
    card.innerHTML = '';
    card.className = 'sort-card';
    void card.offsetWidth;
    card.classList.add('sort-in');
    card.append(img, make('figcaption', '', cur.n));
    if (deck.length) new Image().src = deck[deck.length - 1].t;
    say('Where does the ' + cur.n + ' belong?');
    busy = false;
  };
  var flash = function (el, cls, ms) { el.classList.add(cls); setTimeout(function () { el.classList.remove(cls); }, ms); };
  var drop = function (n) {
    if (busy || left <= 0 || !cur) return;
    busy = true;
    var good = binOf(cur.w), btn = bins.children[n];
    if (n === good) {
      right++; streak++;
      if (streak > bestStreak) bestStreak = streak;
      flash(btn, 'hit', 350);
      // The card flies to the button it was sent to.
      if (!calm) {
        var a = card.getBoundingClientRect(), b = btn.getBoundingClientRect();
        card.style.setProperty('--fx', (b.left + b.width / 2 - a.left - a.width / 2) + 'px');
        card.style.setProperty('--fy', (b.top + b.height / 2 - a.top - a.height / 2) + 'px');
      }
      card.classList.add('sort-fly');
      var cheer = streak >= 3 && streak % 3 === 0 ? streak + ' in a row!' : '';
      $('.sort-streak').textContent = cheer;
      if (cheer) flash($('.sort-streak'), 'pop', 900);
      say('Right!' + (cheer ? ' ' + cheer : ''));
      setTimeout(deal, calm ? 150 : 280);
    } else {
      streak = 0;
      $('.sort-streak').textContent = '';
      if (missed.indexOf(cur) < 0) missed.push(cur);
      card.classList.add('sort-no');
      flash(bins.children[good], 'show', 900);
      card.querySelector('figcaption').textContent = cur.n + ': ' + BINS[mode][good][0];
      say('No, the ' + cur.n + ' is from ' + theWorld(cur.w) + '.');
      setTimeout(deal, 950);
    }
    $('.sort-score').textContent = 'Sorted: ' + right;
  };
  var tick = function () {
    var now = Date.now();
    if (!document.hidden) left -= (now - last) / 1000;
    last = now;
    var s = Math.max(0, Math.ceil(left));
    $('.sort-time').textContent = s + (s === 1 ? ' second' : ' seconds');
    $('.sort-bar span').style.width = Math.max(0, left / TIME * 100) + '%';
    play.classList.toggle('hurry', left <= 10);
    if (left <= 0) finish();
  };
  var keys = function (e) {
    if (play.hidden || e.altKey || e.ctrlKey || e.metaKey) return;
    var n = parseInt(e.key, 10);
    if (n >= 1 && n <= BINS[mode].length) { e.preventDefault(); drop(n - 1); }
  };
  var finish = function () {
    clearInterval(timer);
    document.removeEventListener('keydown', keys);
    play.hidden = true;
    end.hidden = false;
    var best = store.get(KEY, {}) || {};
    var prev = best[mode] || 0;
    if (right > prev) { best[mode] = right; store.set(KEY, best); }
    if (right >= NEED) {
      var done = store.get('atlas.done', {}) || {};
      if (!done.sort) { done.sort = 1; store.set('atlas.done', done); }
      if (window.atlasBadges) window.atlasBadges();
    }
    $('.q-result').textContent = 'You sorted ' + right + (right === 1 ? ' picture' : ' pictures') + '!';
    var msg = right >= 25 ? 'Lightning fast!' : right >= NEED ? 'Great sorting!' : right >= 8 ? 'Good going. Play again to beat your score.' : 'Explore the worlds a little, then try again.';
    if (bestStreak >= 3) msg += ' Your longest run was ' + bestStreak + ' in a row.';
    if (prev && right > prev) msg += ' That is your best score yet.';
    $('.q-msg').textContent = msg;
    var ul = $('.sort-missed');
    ul.innerHTML = '';
    missed.slice(0, 8).forEach(function (it) {
      var li = make('li', 'no'), a = make('a', 'world-' + it.w);
      a.href = it.u;
      var im = make('img'); im.src = it.t; im.alt = '';
      a.append(im, make('span', '', it.n));
      li.append(a, make('span', 'what', 'is from ' + theWorld(it.w) + '.'));
      ul.appendChild(li);
    });
    $('.sort-missed-box').hidden = !missed.length;
    $('.q-result').focus({ preventScroll: true });
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
  };
  var begin = function (m) {
    mode = m;
    right = 0; streak = 0; bestStreak = 0; missed = []; left = TIME; last = Date.now();
    deck = shuffle(data.items.slice());
    start.hidden = true; end.hidden = true; play.hidden = false;
    play.classList.remove('hurry');
    $('.sort-score').textContent = 'Sorted: 0';
    $('.sort-streak').textContent = '';
    drawBins();
    deal();
    tick();
    clearInterval(timer);
    timer = setInterval(tick, 200);
    document.addEventListener('keydown', keys);
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
    bins.querySelector('.sort-bin').focus({ preventScroll: true });
  };
  var drawBest = function () {
    var best = store.get(KEY, {}) || {};
    root.querySelectorAll('[data-best]').forEach(function (s) { var v = best[s.getAttribute('data-best')]; s.textContent = v ? 'Your best: ' + v + ' sorted' : ''; });
  };

  root.querySelectorAll('.qmode').forEach(function (b) { b.addEventListener('click', function () { begin(b.getAttribute('data-mode')); }); });
  $('.sort-again').addEventListener('click', function () { begin(mode); });
  $('.sort-other').addEventListener('click', function () { end.hidden = true; start.hidden = false; drawBest(); root.querySelector('.qmode').focus(); });
  drawBest();
})();
