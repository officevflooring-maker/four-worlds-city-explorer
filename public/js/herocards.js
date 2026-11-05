// Hero Cards (/play/hero-cards/): a five-round card duel against the computer, with the Life RPG game's 56
// cards from #hc-data. Each round names a stat and a home world (+2 for its cards); the higher number wins the round.
// Win the duel and keep one of the computer's cards. The album is kept in this browser only (localStorage).
(function () {
  'use strict';
  var root = document.querySelector('[data-herocards]');
  var dataEl = document.getElementById('hc-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var CARDS = data.cards, FRAMES = data.frames, WORLDS = data.worlds, STATS = Object.keys(data.stats);
  var BY = {};
  CARDS.forEach(function (c) { BY[c.i] = c; });
  var HAND = 5, ROUNDS = 5, BONUS = 2, SHINY = 0.05, KEY = 'atlas.herocards';
  var RARITY = { common: 'Common', gold: 'Gold', emerald: 'Emerald' };
  var WEIGHT = { common: 4, gold: 2, emerald: 1 };   // how often each rarity is dealt, per card
  var TOTAL = ('00' + CARDS.length).slice(-3);
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var store = {
    get: function () { try { var v = JSON.parse(localStorage.getItem(KEY)); return v && v.have ? v : null; } catch (e) { return null; } },
    set: function (v) { try { localStorage.setItem(KEY, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var $$ = function (sel) { return Array.prototype.slice.call(root.querySelectorAll(sel)); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var pick = function (a) { return a[Math.floor(Math.random() * a.length)]; };
  var no = function (c) { return ('00' + c.no).slice(-3) + '/' + TOTAL; };
  var statName = function (s) { return data.stats[s]; };
  var icon = function (s) {
    var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg'), p = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('aria-hidden', 'true'); p.setAttribute('d', data.icons[s]); svg.appendChild(p);
    return svg;
  };
  var says = function (c) {
    return c.n + ', ' + WORLDS[c.w] + ', ' + RARITY[c.r].toLowerCase() + ': ' + STATS.map(function (s, k) { return statName(s) + ' ' + c.s[k]; }).join(', ');
  };

  // The album: how many of each card, and which ones are shiny. A first visit starts it with three commons.
  var saved = store.get(), welcome = false;
  if (!saved) {
    saved = { have: {}, shiny: {}, wins: 0, played: 0, level: 'easy' };
    shuffle(CARDS.filter(function (c) { return c.r === 'common'; })).slice(0, 3).forEach(function (c) { saved.have[c.i] = 1; });
    welcome = true;
    store.set(saved);
  }
  var found = function () { return CARDS.filter(function (c) { return saved.have[c.i]; }).length; };
  var inWorld = function (w) { return CARDS.filter(function (c) { return c.w === w; }); };
  var foundIn = function (w) { return inWorld(w).filter(function (c) { return saved.have[c.i]; }).length; };

  // One card, the way the Life RPG game draws it: the picture in the frame's window, the frame over it, the name on
  // the top plate and the number on the bottom one. o.back shows the stats side; o.stat lights up one stat.
  function card(c, o) {
    o = o || {};
    var f = c.r === 'common' ? 'frame-' + c.w : 'frame-' + c.r, win = FRAMES[f];
    var el = make('span', 'hc r-' + c.r + (f === 'frame-heaven' ? ' hc-light' : '') + (o.shiny ? ' holo' : '') + (o.back ? ' hc-back' : ''));
    el.style.cssText = 'aspect-ratio:' + win[4] + '/' + win[5] + ';--ft:' + win[0] + '%;--fr:' + win[1] + '%;--fb:' + win[2] + '%;--fl:' + win[3] + '%;--frame:url(/assets/cards/' + f + '.webp)';
    var w = make('span', 'hc-win');
    if (o.back) {
      w.appendChild(make('span', 'hc-line', c.l));
      STATS.forEach(function (s, k) {
        var row = make('span', 'hc-bar st-' + s), lab = make('span', 'hc-bar-l');
        lab.appendChild(icon(s)); lab.appendChild(document.createTextNode(statName(s)));
        var bar = make('span', 'hc-bar-t'), fill = make('i');
        fill.style.width = c.s[k] * 10 + '%'; bar.appendChild(fill);
        row.appendChild(lab); row.appendChild(make('b', '', String(c.s[k]))); row.appendChild(bar);
        w.appendChild(row);
      });
      w.appendChild(make('span', 'hc-kind', data.kinds[c.k] + ' · ' + RARITY[c.r]));
    } else {
      var pic = make('img', 'hc-pic'); pic.src = c.p; pic.alt = ''; pic.loading = 'lazy'; pic.decoding = 'async';
      w.appendChild(pic);
      var st = make('span', 'hc-stats');
      STATS.forEach(function (s, k) {
        var chip = make('span', 'hc-st st-' + s + (o.stat === s ? ' on' : ''));
        chip.appendChild(icon(s)); chip.appendChild(document.createTextNode(String(c.s[k])));
        st.appendChild(chip);
      });
      w.appendChild(st);
    }
    el.appendChild(w);
    var fr = make('img', 'hc-frame'); fr.src = '/assets/cards/' + f + '.webp'; fr.alt = '';
    el.appendChild(fr);
    el.appendChild(make('span', 'hc-name', c.n));
    el.appendChild(make('span', 'hc-no', no(c)));
    if (o.home) el.appendChild(make('span', 'hc-tag', '+' + BONUS));
    return el;
  }
  var cardBack = function () { var b = make('span', 'hc hc-down'); var i = make('img'); i.src = '/favicon.svg'; i.alt = ''; b.appendChild(i); return b; };

  // ---------- Screens ----------
  var screens = ['.hcg-start', '.hcg-duel', '.hcg-end', '.hcg-album'];
  function show(sel, focus) {
    screens.forEach(function (s) { $(s).hidden = s !== sel; });
    if (focus) { var f = $(focus); if (f) f.focus(); }
    root.scrollIntoView({ block: 'start', behavior: reduced ? 'auto' : 'smooth' });
  }
  function counts() { $$('.hcg-count').forEach(function (e) { e.textContent = '(' + found() + ' of ' + CARDS.length + ')'; }); }

  // ---------- The duel ----------
  var G = null;
  function deal(n, not) {
    var out = [], bag = CARDS.filter(function (c) { return not.indexOf(c.i) < 0; });
    while (out.length < n) {
      var sum = 0; bag.forEach(function (c) { sum += WEIGHT[c.r]; });
      var r = Math.random() * sum, k = 0;
      for (; k < bag.length - 1; k++) { r -= WEIGHT[bag[k].r]; if (r < 0) break; }
      out.push(bag.splice(k, 1)[0]);
    }
    return out;
  }
  function start() {
    var lv = root.querySelector('input[name="hc-level"]:checked');
    saved.level = lv ? lv.value : 'easy';
    var you = deal(HAND, []), cpu = deal(HAND, you.map(function (c) { return c.i; }));
    // Every stat comes up at least once; the home world is any of the seven.
    var stats = shuffle(STATS.slice()).concat([pick(STATS), pick(STATS)]);
    G = {
      you: you, cpu: cpu, shiny: cpu.map(function () { return Math.random() < SHINY; }), all: cpu.slice(),
      rounds: stats.slice(0, ROUNDS).map(function (s) { return { stat: s, home: pick(data.order) }; }),
      at: 0, score: [0, 0], busy: false
    };
    show('.hcg-duel');
    round();
  }
  var value = function (c, r) { return c.s[STATS.indexOf(r.stat)] + (c.w === r.home ? BONUS : 0); };
  function round() {
    var r = G.rounds[G.at];
    $('.hcg-round').textContent = 'Round ' + (G.at + 1) + ' of ' + ROUNDS;
    $('.hcg-score').textContent = 'You ' + G.score[0] + ' · Computer ' + G.score[1];
    var call = $('.hcg-call'); call.textContent = '';
    var s = make('span', 'hcg-stat st-' + r.stat); s.appendChild(icon(r.stat)); s.appendChild(document.createTextNode(statName(r.stat)));
    call.appendChild(document.createTextNode('This round: '));
    call.appendChild(s);
    call.appendChild(document.createTextNode(' Home world: '));
    call.appendChild(make('strong', 'world-' + r.home, WORLDS[r.home]));
    call.appendChild(document.createTextNode(' (its cards get +' + BONUS + ')'));
    $('.hcg-you').textContent = ''; $('.hcg-cpu').textContent = '';
    $('.hcg-you').appendChild(make('span', 'hc hc-empty'));
    $('.hcg-cpu').appendChild(cardBack());
    $('.hcg-you-sum').textContent = ''; $('.hcg-cpu-sum').textContent = '';
    $('.hcg-next').hidden = true;
    $('.hcg-status').textContent = 'Pick one of your cards.';
    hand(true);
  }
  function hand(open) {
    var r = G.rounds[G.at], ul = $('.hcg-hand');
    ul.textContent = '';
    G.you.forEach(function (c, k) {
      var li = make('li'), b = make('button', 'hcg-pick');
      b.type = 'button'; b.disabled = !open;
      b.setAttribute('aria-label', 'Play ' + says(c) + (c.w === r.home ? ', home world, +' + BONUS : ''));
      b.appendChild(card(c, { stat: r.stat, home: c.w === r.home }));
      b.addEventListener('click', function () { play(k); });
      li.appendChild(b); ul.appendChild(li);
    });
    $('.hcg-hand-h').hidden = !G.you.length;
  }
  // The computer never sees your card. Easy plays any card; Hard plays the card that is best this round compared
  // with what it could do later.
  function cpuPick(r) {
    if (saved.level !== 'hard') return Math.floor(Math.random() * G.cpu.length);
    var best = 0, bestScore = -99;
    G.cpu.forEach(function (c, k) {
      var later = 0;
      STATS.forEach(function (s, j) { if (s !== r.stat) later += c.s[j]; });
      var sc = value(c, r) - 0.5 * later / 2 + Math.random() * 0.5;
      if (sc > bestScore) { bestScore = sc; best = k; }
    });
    return best;
  }
  function play(k) {
    if (G.busy) return;
    G.busy = true;
    var r = G.rounds[G.at], mine = G.you.splice(k, 1)[0], j = cpuPick(r), theirs = G.cpu.splice(j, 1)[0];
    var a = value(mine, r), b = value(theirs, r);
    hand(false);
    $('.hcg-you').textContent = ''; $('.hcg-cpu').textContent = '';
    $('.hcg-you').appendChild(card(mine, { stat: r.stat, home: mine.w === r.home }));
    var them = card(theirs, { stat: r.stat, home: theirs.w === r.home, shiny: G.shiny[G.all.indexOf(theirs)] });
    if (!reduced) them.classList.add('hc-reveal');
    $('.hcg-cpu').appendChild(them);
    var sum = function (c) { return statName(r.stat) + ' ' + c.s[STATS.indexOf(r.stat)] + (c.w === r.home ? ' + ' + BONUS + ' = ' + value(c, r) : ''); };
    $('.hcg-you-sum').textContent = sum(mine);
    $('.hcg-cpu-sum').textContent = sum(theirs);
    var text;
    if (a > b) { G.score[0]++; text = 'Your ' + mine.n + ' wins the round, ' + a + ' to ' + b + '.'; }
    else if (b > a) { G.score[1]++; text = 'The computer\'s ' + theirs.n + ' wins the round, ' + b + ' to ' + a + '.'; }
    else text = 'A tie at ' + a + '. Nobody scores.';
    $('.hcg-seat:first-child').className = 'hcg-seat' + (a > b ? ' won' : '');
    $('.hcg-seat:last-child').className = 'hcg-seat' + (b > a ? ' won' : '');
    $('.hcg-score').textContent = 'You ' + G.score[0] + ' · Computer ' + G.score[1];
    $('.hcg-status').textContent = text;
    var next = $('.hcg-next');
    next.textContent = G.at + 1 < ROUNDS ? 'Next round' : 'See who won';
    next.hidden = false;
    next.focus();
  }
  function next() {
    $$('.hcg-seat').forEach(function (s) { s.className = 'hcg-seat'; });
    G.busy = false;
    G.at++;
    if (G.at >= ROUNDS) return end();
    round();
    // On a phone the round's stat and the hand are above the table: bring them back into view, and the keyboard
    // to the first card.
    var first = $('.hcg-pick');
    if (first) first.focus({ preventScroll: true });
    $('.q-top').scrollIntoView({ block: 'nearest', behavior: reduced ? 'auto' : 'smooth' });
  }
  function end() {
    var a = G.score[0], b = G.score[1], won = a > b, ul = $('.hcg-prize');
    saved.played++; if (won) saved.wins++;
    store.set(saved);
    ul.textContent = '';
    $('.hcg-end-h').textContent = won ? 'You won, ' + a + ' to ' + b + '!' : b > a ? 'The computer won, ' + b + ' to ' + a + '.' : 'A draw, ' + a + ' to ' + b + '.';
    $('.hcg-end-text').textContent = won ? 'Pick one of the computer\'s cards to keep for your album.' : 'Play again to win a card for your album.';
    if (won) G.all.forEach(function (c, k) {
      var li = make('li'), b2 = make('button', 'hcg-pick'), shiny = G.shiny[k], had = saved.have[c.i];
      b2.type = 'button';
      b2.setAttribute('aria-label', 'Keep ' + says(c) + (shiny ? ', shiny' : '') + (had ? '. You have this card.' : '. New for your album.'));
      b2.appendChild(card(c, { shiny: shiny }));
      b2.appendChild(make('span', 'hcg-note' + (had ? '' : ' new'), had ? 'You have it' : 'New!'));
      b2.addEventListener('click', function () { keep(c, shiny); });
      li.appendChild(b2); ul.appendChild(li);
    });
    show('.hcg-end', '.hcg-end-h');
  }
  function keep(c, shiny) {
    saved.have[c.i] = (saved.have[c.i] || 0) + 1;
    if (shiny) saved.shiny[c.i] = 1;
    store.set(saved);
    counts();
    var done = foundIn(c.w) === 8;
    $('.hcg-prize').textContent = '';
    $('.hcg-end-text').textContent = (saved.have[c.i] > 1 ? 'Another ' + c.n + ': you have ' + saved.have[c.i] + ' now.' : c.n + ' is in your album now.') + (done ? ' That is every card from ' + WORLDS[c.w] + '!' : '')
      + (found() === CARDS.length ? ' You have all ' + CARDS.length + ' cards!' : '');
    $('.hcg-again').focus();
  }

  // ---------- The album ----------
  var albumWorld = '';
  function album() {
    $('.hcg-album-count').textContent = found() + ' of ' + CARDS.length + ' cards found. Find all 8 from a world to finish it.';
    var tabs = $('.hcg-tabs'); tabs.textContent = '';
    [''].concat(data.order).forEach(function (w) {
      var b = make('button', 'chip', w ? WORLDS[w] + ' ' + foundIn(w) + '/8' : 'All');
      b.type = 'button'; b.setAttribute('aria-pressed', String(w === albumWorld));
      b.addEventListener('click', function () { albumWorld = w; album(); });
      tabs.appendChild(b);
    });
    var sets = $('.hcg-sets'); sets.textContent = '';
    (albumWorld ? [albumWorld] : data.order).forEach(function (w) {
      var h = make('h3', 'world-' + w, WORLDS[w] + ' ');
      h.appendChild(make('span', 'hcg-of' + (foundIn(w) === 8 ? ' done' : ''), foundIn(w) === 8 ? 'All 8 found!' : foundIn(w) + ' of 8'));
      var ul = make('ul', 'hcg-grid');
      inWorld(w).forEach(function (c) {
        var li = make('li');
        if (saved.have[c.i]) {
          var b = make('button', 'hcg-pick'); b.type = 'button';
          b.setAttribute('aria-label', says(c) + (saved.shiny[c.i] ? ', shiny' : '') + '. Open the card.');
          b.appendChild(card(c, { shiny: saved.shiny[c.i] }));
          if (saved.have[c.i] > 1) b.appendChild(make('span', 'hcg-note', '×' + saved.have[c.i]));
          b.addEventListener('click', function () { big(c); });
          li.appendChild(b);
        } else {
          var e = make('span', 'hc hc-missing'); e.setAttribute('role', 'img'); e.setAttribute('aria-label', 'Card ' + no(c) + ', not found yet');
          e.appendChild(make('span', 'hc-q', '?')); e.appendChild(make('span', 'hc-no', no(c)));
          li.appendChild(e);
        }
        ul.appendChild(li);
      });
      sets.appendChild(h); sets.appendChild(ul);
    });
  }
  function openAlbum() { album(); show('.hcg-album', '.hcg-album-h'); }

  // One card, big, that turns over to its stats.
  var dlg = $('.hcg-dlg');
  function big(c) {
    var inner = $('.hcg-flip-in');
    inner.textContent = '';
    inner.appendChild(card(c, { shiny: saved.shiny[c.i] }));
    inner.appendChild(card(c, { back: true }));
    $('.hcg-flip').classList.remove('on');
    $('.hcg-dlg-h').textContent = c.n;
    $('.hcg-dlg-meta').textContent = data.kinds[c.k] + ' from ' + WORLDS[c.w] + ' · ' + RARITY[c.r] + (saved.shiny[c.i] ? ' · Shiny' : '')
      + ' · You have ' + saved.have[c.i] + (c.v ? ' · ' + c.v : '');
    var read = $('.hcg-read');
    read.hidden = !c.u; if (c.u) read.href = c.u;
    $('.hcg-turn').textContent = 'Turn over';
    if (dlg.showModal) dlg.showModal(); else dlg.setAttribute('open', '');
  }
  $('.hcg-turn').addEventListener('click', function () {
    var on = $('.hcg-flip').classList.toggle('on');
    this.textContent = on ? 'Turn back' : 'Turn over';
  });
  $('.hcg-close').addEventListener('click', function () { if (dlg.close) dlg.close(); else dlg.removeAttribute('open'); });
  dlg.addEventListener('click', function (e) { if (e.target === dlg && dlg.close) dlg.close(); });

  // ---------- Wiring ----------
  $$('.hcg-play').forEach(function (b) { b.addEventListener('click', start); });
  $('.hcg-again').addEventListener('click', start);
  $('.hcg-next').addEventListener('click', next);
  $$('.hcg-open-album').forEach(function (b) { b.addEventListener('click', openAlbum); });
  $('.hcg-back').addEventListener('click', function () { show('.hcg-start'); });
  var lv = root.querySelector('input[name="hc-level"][value="' + saved.level + '"]');
  if (lv) lv.checked = true;
  if (welcome) { var wel = $('.hcg-welcome'); wel.textContent = 'Welcome! Three cards are waiting in your album to start your collection.'; wel.hidden = false; }
  counts();
})();
