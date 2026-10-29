// Map hunt (/worlds/{world}/#hunt): read a clue about a place, then find it on the city map.
// Eight clues a round. Best scores are kept in this browser only.
(function () {
  'use strict';
  var shell = document.querySelector('[data-map]');
  var startBtn = shell && shell.querySelector('.hunt-start');
  if (!startBtn) return;
  var map = shell.querySelector('.city'), bar = shell.querySelector('.hunt-bar'), info = shell.querySelector('.map-info');
  var labels = document.getElementById('show-labels');
  var world = (document.body.className.match(/\bworld-(egypt|roman|modern|green|future|heaven)\b/) || [])[1];
  var KEY = 'atlas.hunt', ROUND = 8;
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var button = function (text, cls, fn) { var b = make('button', cls, text); b.type = 'button'; b.addEventListener('click', fn); return b; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var tiles = Array.prototype.slice.call(map.querySelectorAll('.tile[data-name]:not(.decor)'));
  var round = [], at = 0, firstTry = 0, tries = 0, solved = false, active = false;

  // The clue is the place's one-line summary, with the words of its name hidden.
  var clueFor = function (tile) {
    var text = tile.getAttribute('data-sum');
    tile.getAttribute('data-name').toLowerCase().replace(/\(.*?\)/g, ' ').split(/[^a-z]+/).forEach(function (w) {
      if (w.length > 3) text = text.replace(new RegExp('\\b' + w + '[a-z]*', 'gi'), '\u2026');
    });
    return text;
  };
  var reset = function () {
    tiles.forEach(function (t) { t.classList.remove('hunt-ok', 'hunt-no', 'hunt-show', 'on'); });
    map.classList.remove('filtering');
  };
  var hint = function () {
    var cat = round[at].getAttribute('data-cat');
    map.classList.add('filtering');
    tiles.forEach(function (t) { t.classList.toggle('on', t.getAttribute('data-cat') === cat); });
  };
  var say = function (text, cls) { var m = bar.querySelector('.hunt-msg'); m.className = 'hunt-msg' + (cls ? ' ' + cls : ''); m.textContent = text; return m; };
  var showClue = function () {
    reset();
    tries = 0;
    solved = false;
    bar.innerHTML = '';
    var top = make('p', 'hunt-top', 'Clue ' + (at + 1) + ' of ' + round.length + ' \u00b7 Found on the first try: ' + firstTry);
    var clue = make('p', 'hunt-clue', clueFor(round[at]));
    var msg = make('p', 'hunt-msg', 'Find this place on the map.');
    msg.setAttribute('aria-live', 'polite');
    var acts = make('p', 'hunt-acts');
    acts.append(button('Hint', 'ctrl', function () { hint(); say('Hint: it is one of the bright places.'); }),
      ' ', button('Skip', 'ctrl', function () { reveal(false); }), ' ', button('Stop', 'ctrl', stop));
    bar.append(top, clue, msg, acts);
    clue.setAttribute('tabindex', '-1');
    clue.focus({ preventScroll: true });
  };
  var next = function () {
    at++;
    if (at < round.length) showClue(); else finish();
  };
  var reveal = function (found) {
    var tile = round[at];
    solved = true;
    reset();
    tile.classList.add(found ? 'hunt-ok' : 'hunt-show');
    var name = tile.getAttribute('data-name');
    var m = say(found ? (tries ? 'Found it: ' : 'Found it on the first try: ') + name + '. ' : 'It was the ' + name + '. ', found ? 'ok' : '');
    var link = make('a', '', 'Read about it');
    link.href = tile.querySelector('a').href;
    m.appendChild(link);
    var acts = bar.querySelector('.hunt-acts');
    acts.innerHTML = '';
    var go = button(at + 1 < round.length ? 'Next clue' : 'See your score', 'btn', next);
    acts.append(go, ' ', button('Stop', 'ctrl', stop));
    go.focus({ preventScroll: true });
  };
  var finish = function () {
    reset();
    var best = store.get(KEY, {}) || {};
    var prev = best[world] || 0;
    if (firstTry > prev) { best[world] = firstTry; store.set(KEY, best); }
    var done = store.get('atlas.done', {}) || {};
    if (!done.hunt) { done.hunt = 1; store.set('atlas.done', done); }
    if (window.atlasBadges) window.atlasBadges();
    bar.innerHTML = '';
    var head = make('p', 'hunt-clue', 'You found ' + firstTry + ' of ' + round.length + ' places on the first try!');
    head.setAttribute('tabindex', '-1');
    var msg = make('p', 'hunt-msg', firstTry === round.length ? 'A perfect hunt. You know this city well.' : (prev && firstTry > prev ? 'That is your best score in this city.' : 'Play again for new clues.'));
    var acts = make('p', 'hunt-acts');
    acts.append(button('Play again', 'btn', start), ' ', button('Back to exploring', 'ctrl', stop));
    var others = make('p', 'hunt-others');
    var more = make('a', '', 'Hunt in another city');
    more.href = '/play/map-hunt/';
    others.appendChild(more);
    bar.append(head, msg, acts, others);
    head.focus({ preventScroll: true });
  };
  var start = function () {
    active = true;
    map.classList.add('hunting');
    if (labels) { labels.checked = false; labels.disabled = true; map.classList.remove('show-labels'); }
    info.hidden = true;
    bar.hidden = false;
    // The clue stays in view below the header while you look around the map.
    var hdr = document.querySelector('.site-header');
    bar.style.top = (hdr && getComputedStyle(hdr).position === 'sticky' ? hdr.offsetHeight + 8 : 8) + 'px';
    startBtn.hidden = true;
    round = shuffle(tiles.slice()).slice(0, ROUND);
    at = 0;
    firstTry = 0;
    showClue();
    shell.scrollIntoView({ block: 'start' });
  };
  var stop = function () {
    active = false;
    map.classList.remove('hunting');
    reset();
    if (labels) labels.disabled = false;
    info.hidden = false;
    bar.hidden = true;
    bar.innerHTML = '';
    startBtn.hidden = false;
    startBtn.focus({ preventScroll: true });
  };

  // While hunting, choosing a building answers the clue instead of opening its page.
  map.addEventListener('click', function (e) {
    if (!active) return;
    var tile = e.target.closest('.tile');
    if (!tile) return;
    e.preventDefault();
    e.stopPropagation();
    if (at >= round.length || solved) return;
    if (tiles.indexOf(tile) < 0) { say('Look for a building or a place, not a person, vehicle or tree.'); return; }
    if (tile === round[at]) {
      if (!tries) firstTry++;
      reveal(true);
      return;
    }
    tries++;
    tile.classList.add('hunt-no');
    setTimeout(function () { tile.classList.remove('hunt-no'); }, 800);
    if (tries >= 2) hint();
    say('That is the ' + tile.getAttribute('data-name') + '. ' + (tries >= 2 ? 'Hint: it is one of the bright places.' : 'Try again!'), 'no');
  }, true);

  startBtn.hidden = false;
  startBtn.addEventListener('click', start);
  if (location.hash === '#hunt') start();
})();
