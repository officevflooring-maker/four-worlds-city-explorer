// City quiz (/play/quiz/): ten picture questions of one kind. Questions are made from the page data
// in #quiz-data; best scores are kept in this browser only.
(function () {
  'use strict';
  var root = document.querySelector('[data-quiz]');
  var dataEl = document.getElementById('quiz-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var items = data.items, worlds = data.worlds, jobs = data.jobs;
  var ORDER = ['egypt', 'roman', 'modern', 'elven', 'future', 'heaven'];
  var ROUND = 10, KEY = 'atlas.quiz';
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var shares = function (a, b) { return a.some(function (x) { return b.indexOf(x) > -1; }); };
  var inWorld = function (w) { return (w === 'roman' || w === 'egypt' ? 'in ' : 'in the ') + worlds[w][0]; };
  var start = $('.quiz-start'), play = $('.quiz-play'), end = $('.quiz-end');
  var mode = null, qs = [], at = 0, score = 0;

  var makers = {
    // A picture and four names from the same world.
    name: function () {
      return shuffle(items.slice()).slice(0, ROUND).map(function (it) {
        var others = shuffle(items.filter(function (o) { return o.w === it.w && o.n !== it.n; })).slice(0, 3);
        return { pic: it, alt: 'A mystery building', ask: 'What is this called?', right: it.n, why: it.d, links: [it],
          options: shuffle([it].concat(others)).map(function (o) { return { text: o.n, ok: o === it }; }) };
      });
    },
    // A picture and every world.
    world: function () {
      return shuffle(items.slice()).slice(0, ROUND).map(function (it) {
        return { pic: it, alt: it.n, ask: 'Which world is this from?', right: worlds[it.w][0], why: it.n + ': ' + it.d, links: [it],
          options: ORDER.map(function (w) { return { text: worlds[w][0], world: w, ok: w === it.w }; }) };
      });
    },
    // A building, and four from another world: only one shares its job (a cross-link group).
    job: function () {
      var pool = [];
      items.forEach(function (a) {
        a.g.forEach(function (g) {
          if (!jobs[g]) return;
          ORDER.forEach(function (w) {
            if (w === a.w) return;
            var right = items.filter(function (b) { return b.w === w && b.g.indexOf(g) > -1; });
            if (right.length) pool.push({ a: a, g: g, w: w, right: right });
          });
        });
      });
      // Names that share a word ("Tower crane", "Treadwheel crane") would give the answer away.
      var words = function (s) { return s.toLowerCase().replace(/\(.*?\)/g, '').split(/[^a-z]+/).filter(function (w) { return w.length > 3; }); };
      var out = [], seen = {};
      shuffle(pool).forEach(function (p) {
        if (out.length >= ROUND || seen[p.a.k] || seen[p.g]) return;
        var fair = p.right.filter(function (b) { return !shares(words(p.a.n), words(b.n)); });
        if (!fair.length) return;
        var b = fair[Math.floor(Math.random() * fair.length)];
        var wrong = shuffle(items.filter(function (d) { return d.w === p.w && !shares(d.g, p.a.g) && !shares(d.nd, p.a.nd); })).slice(0, 3);
        if (wrong.length < 3) return;
        seen[p.a.k] = seen[p.g] = 1;
        out.push({ pic: p.a, alt: p.a.n, caption: p.a.n + ' \u00b7 ' + worlds[p.a.w][0], ask: 'Which one does the same job ' + inWorld(p.w) + '?',
          right: b.n, why: 'Both ' + jobs[p.g] + '.', links: [p.a, b],
          options: shuffle([b].concat(wrong)).map(function (o) { return { text: o.n, img: o.t, ok: o === b }; }) });
      });
      return out;
    },
    // A key word's meaning, and four words from the same world.
    words: function () {
      var out = [], seen = {};
      shuffle(data.words.slice()).forEach(function (wd) {
        var key = wd.t.toLowerCase();
        if (out.length >= ROUND || seen[key]) return;
        var others = [], names = {};
        names[key] = 1;
        shuffle(data.words.filter(function (o) { return o.w === wd.w && o.d !== wd.d; })).forEach(function (o) {
          if (others.length < 3 && !names[o.t.toLowerCase()]) { names[o.t.toLowerCase()] = 1; others.push(o); }
        });
        if (others.length < 3) return;
        seen[key] = 1;
        out.push({ tag: worlds[wd.w][0], ask: 'Which word means \u201c' + wd.d.replace(/\.$/, '') + '\u201d?', right: wd.t,
          why: 'Read about it on the ' + wd.n + ' page.', links: [{ n: wd.n, u: wd.u, t: wd.p, w: wd.w }],
          options: shuffle([wd].concat(others)).map(function (o) { return { text: o.t, ok: o === wd }; }) });
      });
      return out;
    },
    // A person, and four places in their world: one is where you would find them.
    people: function () {
      var out = [];
      shuffle(data.people.slice()).forEach(function (pp) {
        if (out.length >= ROUND) return;
        var slug = function (it) { return it.k.split('/')[1]; };
        var right = items.filter(function (it) { return it.w === pp.w && pp.pl.indexOf(slug(it)) > -1; });
        if (!right.length) return;
        var b = right[Math.floor(Math.random() * right.length)];
        var cats = right.map(function (it) { return it.c; });
        var wrong = shuffle(items.filter(function (it) { return it.w === pp.w && pp.pl.indexOf(slug(it)) < 0 && cats.indexOf(it.c) < 0; })).slice(0, 3);
        if (wrong.length < 3) return;
        out.push({ pic: { i: pp.i, w: pp.w }, alt: pp.n, caption: pp.n + ' \u00b7 ' + pp.r, ask: 'Where would you find this person?', right: b.n, why: pp.x,
          links: [{ n: pp.n, u: pp.u, t: pp.t, w: pp.w }, b],
          options: shuffle([b].concat(wrong)).map(function (o) { return { text: o.n, img: o.t, ok: o === b }; }) });
      });
      return out;
    }
  };

  var show = function () {
    var q = qs[at];
    $('.q-count').textContent = 'Question ' + (at + 1) + ' of ' + qs.length;
    $('.q-score').textContent = 'Score: ' + score;
    $('.q-bar span').style.width = (at / qs.length * 100) + '%';
    $('.q-ask').textContent = q.ask;
    var pic = $('.q-pic');
    pic.innerHTML = '';
    if (q.tag) pic.appendChild(make('p', 'tag', q.tag));
    if (q.pic) {
      var fig = make('figure'), img = make('img');
      img.src = q.pic.i; img.alt = q.alt;
      fig.appendChild(img);
      if (q.caption) fig.appendChild(make('figcaption', '', q.caption));
      pic.appendChild(fig);
    }
    var opts = $('.q-options');
    opts.innerHTML = '';
    opts.className = 'q-options q-' + mode;
    q.options.forEach(function (o) {
      var b = make('button', 'q-opt' + (o.world ? ' world-' + o.world : ''));
      b.type = 'button';
      if (o.img) { var im = make('img'); im.src = o.img; im.alt = ''; b.appendChild(im); }
      b.appendChild(make('span', '', o.text));
      b.addEventListener('click', function () { answer(o, b); });
      opts.appendChild(b);
    });
    $('.q-feedback').innerHTML = '';
    $('.q-next').hidden = true;
    if (qs[at + 1] && qs[at + 1].pic) new Image().src = qs[at + 1].pic.i;
    $('.q-ask').focus({ preventScroll: true });
  };
  var answer = function (o, btn) {
    var q = qs[at];
    if (q.done) return;
    q.done = true;
    q.ok = o.ok;
    if (o.ok) score++;
    $('.q-options').querySelectorAll('.q-opt').forEach(function (b, n) {
      b.disabled = true;
      if (q.options[n].ok) b.classList.add('right');
      else if (b === btn) b.classList.add('wrong');
    });
    var fb = $('.q-feedback');
    fb.innerHTML = '';
    fb.append(make('p', o.ok ? 'fb-ok' : 'fb-no', o.ok ? 'Right!' : 'Not quite. The answer is ' + q.right + '.'), make('p', '', q.why));
    $('.q-score').textContent = 'Score: ' + score;
    $('.q-bar span').style.width = ((at + 1) / qs.length * 100) + '%';
    var next = $('.q-next');
    next.hidden = false;
    next.textContent = at + 1 < qs.length ? 'Next question' : 'See your score';
    next.focus({ preventScroll: true });
  };
  var finish = function () {
    play.hidden = true;
    end.hidden = false;
    var best = store.get(KEY, {}) || {};
    var prev = best[mode] || 0;
    if (score > prev) { best[mode] = score; store.set(KEY, best); }
    if (score === qs.length) {
      var done = store.get('atlas.done', {}) || {};
      if (!done.quiz) { done.quiz = 1; store.set('atlas.done', done); }
      if (window.atlasBadges) window.atlasBadges();
    }
    $('.q-result').textContent = 'You got ' + score + ' out of ' + qs.length + '!';
    var msg = score === qs.length ? 'A perfect score. You really know your cities!' : score >= 7 ? 'Great work!' : score >= 4 ? 'Good try. Explore a few more places, then play again.' : 'Keep exploring the worlds, then try again.';
    if (prev && score > prev) msg += ' That is your best score yet.';
    $('.q-msg').textContent = msg;
    var list = $('.q-review');
    list.innerHTML = '';
    qs.forEach(function (q) {
      var li = make('li', q.ok ? 'ok' : 'no');
      var mark = make('span', 'q-mark', q.ok ? '\u2713' : '\u2717');
      mark.setAttribute('aria-hidden', 'true');
      li.append(mark, make('span', 'sr-only', q.ok ? 'Right: ' : 'Missed: '));
      q.links.forEach(function (it) {
        var a = make('a', 'world-' + it.w);
        a.href = it.u;
        if (it.t) { var im = make('img'); im.src = it.t; im.alt = ''; a.appendChild(im); }
        a.appendChild(make('span', '', it.n));
        li.appendChild(a);
      });
      list.appendChild(li);
    });
    $('.q-result').focus({ preventScroll: true });
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
  };
  var begin = function (m) {
    mode = m;
    qs = makers[m]();
    at = 0; score = 0;
    start.hidden = true; end.hidden = true; play.hidden = false;
    show();
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
  };
  var drawBest = function () {
    var best = store.get(KEY, {}) || {};
    root.querySelectorAll('[data-best]').forEach(function (s) { var v = best[s.getAttribute('data-best')]; s.textContent = v ? 'Your best: ' + v + ' of ' + ROUND : ''; });
  };

  root.querySelectorAll('.qmode').forEach(function (b) { b.addEventListener('click', function () { begin(b.getAttribute('data-mode')); }); });
  $('.q-next').addEventListener('click', function () { at++; if (at < qs.length) show(); else finish(); });
  $('.q-again').addEventListener('click', function () { begin(mode); });
  $('.q-other').addEventListener('click', function () { end.hidden = true; start.hidden = false; drawBest(); root.querySelector('.qmode').focus(); });
  drawBest();
})();
