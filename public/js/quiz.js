// Picture games on one engine: the City quiz (/play/quiz/), Shadow match (/play/shadows/), Zoom detective
// (/play/zoom/) and Odd one out (/play/odd-one-out/). Each is ten questions of one kind, made from the page data in
// #quiz-data. The page says where best scores are kept (data-key), which badge it earns (data-done) and the score
// that earns it (data-need, or every answer right). Scores stay in this browser only.
(function () {
  'use strict';
  var root = document.querySelector('[data-quiz]');
  var dataEl = document.getElementById('quiz-data');
  if (!root || !dataEl) return;
  var data = JSON.parse(dataEl.textContent);
  var items = data.items, worlds = data.worlds, jobs = data.jobs || {};
  var ORDER = ['egypt', 'roman', 'modern', 'elven', 'future', 'heaven'];
  var ROUND = 10;
  var KEY = root.getAttribute('data-key') || 'atlas.quiz', DONE = root.getAttribute('data-done') || 'quiz', NEED = +root.getAttribute('data-need') || 0;
  var ZOOM_TIME = 12;   // seconds a close-up takes to zoom all the way out
  var calm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var $ = function (sel) { return root.querySelector(sel); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };
  var shuffle = function (a) { for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = a[i]; a[i] = a[j]; a[j] = t; } return a; };
  var shares = function (a, b) { return a.some(function (x) { return b.indexOf(x) > -1; }); };
  var inWorld = function (w) { return (w === 'roman' || w === 'egypt' ? 'in ' : 'in the ') + worlds[w][0]; };
  var theWorld = function (w) { return (w === 'roman' || w === 'egypt' ? '' : 'the ') + worlds[w][0]; };
  var list = function (names) { return names.slice(0, -1).join(', ') + ' and ' + names[names.length - 1]; };
  var isPlace = function (it) { return it.c !== 'vehicles'; };
  // Names that share a word ("Tower crane", "Treadwheel crane") would give an answer away.
  var words = function (s) { return s.toLowerCase().replace(/\(.*?\)/g, '').split(/[^a-z]+/).filter(function (w) { return w.length > 3; }); };
  // n other answers for a question about it: from its own world (same), or each from a different other world.
  var others = function (pool, it, same, n) {
    var out = [], ws = {};
    shuffle(pool.filter(function (o) { return o.n !== it.n && (same ? o.w === it.w : o.w !== it.w); })).forEach(function (o) {
      if (out.length < n && (same || !ws[o.w])) { ws[o.w] = 1; out.push(o); }
    });
    return out;
  };
  var start = $('.quiz-start'), play = $('.quiz-play'), end = $('.quiz-end');
  var mode = null, qs = [], at = 0, score = 0, zoomTimer = 0;

  // Whose shadow? A black shape, and four pictures in color of the same kind (people with people).
  var shadows = function (pool, same) {
    return shuffle(pool.slice()).slice(0, ROUND).map(function (it) {
      return { pic: it, alt: 'A mystery shadow', shadow: true, ask: 'Whose shadow is this?', right: it.n, why: it.r ? it.n + ': ' + it.x : it.d,
        links: [it], layout: 'cards', options: shuffle([it].concat(others(pool, it, same, 3))).map(function (o) { return { text: o.n, img: o.t, ok: o === it }; }) };
    });
  };
  // A close-up that zooms out, starting from a point near the middle, where the building is.
  var zooms = function (same) {
    var pool = items.filter(isPlace);
    return shuffle(pool.slice()).slice(0, ROUND).map(function (it) {
      return { pic: it, big: it.i.replace('-480.webp', '-960.webp'), alt: 'A close-up of a mystery building', zoom: [40 + Math.random() * 20, 42 + Math.random() * 18],
        ask: 'What is this a close-up of?', right: it.n, why: it.d, links: [it], points: 3,
        options: shuffle([it].concat(others(pool, it, same, 3))).map(function (o) { return { text: o.n, ok: o === it }; }) };
    });
  };

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
      var out = [], seen = {};
      shuffle(pool).forEach(function (p) {
        if (out.length >= ROUND || seen[p.a.k] || seen[p.g]) return;
        var fair = p.right.filter(function (b) { return !shares(words(p.a.n), words(b.n)); });
        if (!fair.length) return;
        var b = fair[Math.floor(Math.random() * fair.length)];
        var wrong = shuffle(items.filter(function (d) { return d.w === p.w && !shares(d.g, p.a.g) && !shares(d.nd, p.a.nd); })).slice(0, 3);
        if (wrong.length < 3) return;
        seen[p.a.k] = seen[p.g] = 1;
        out.push({ pic: p.a, alt: p.a.n, caption: p.a.n + ' · ' + worlds[p.a.w][0], ask: 'Which one does the same job ' + inWorld(p.w) + '?',
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
        out.push({ tag: worlds[wd.w][0], ask: 'Which word means “' + wd.d.replace(/\.$/, '') + '”?', right: wd.t,
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
        out.push({ pic: { i: pp.i, w: pp.w }, alt: pp.n, caption: pp.n + ' · ' + pp.r, ask: 'Where would you find this person?', right: b.n, why: pp.x,
          links: [{ n: pp.n, u: pp.u, t: pp.t, w: pp.w }, b],
          options: shuffle([b].concat(wrong)).map(function (o) { return { text: o.n, img: o.t, ok: o === b }; }) });
      });
      return out;
    },
    shadow: function () { return shadows(items.filter(isPlace), false); },
    'shadow-hard': function () { return shadows(items.filter(isPlace), true); },
    // Half vehicles, half people.
    'shadow-pv': function () {
      var vehicles = items.filter(function (it) { return !isPlace(it); });
      return shuffle(shadows(vehicles, false).slice(0, ROUND / 2).concat(shadows(data.people, false).slice(0, ROUND / 2)));
    },
    zoom: function () { return zooms(false); },
    'zoom-hard': function () { return zooms(true); },
    // Three from one world and one from another, with a different pair of worlds each time.
    'odd-world': function () {
      var out = [], used = {}, pairs = [];
      ORDER.forEach(function (a) { ORDER.forEach(function (b) { if (a !== b) pairs.push([a, b]); }); });
      shuffle(pairs).forEach(function (pr) {
        if (out.length >= ROUND || used[pr[0]] > 3 || used[pr[1]] > 3) return;
        var fresh = function (w) { return shuffle(items.filter(function (o) { return o.w === w && o.t && !used[o.k]; })); };
        var three = fresh(pr[0]).slice(0, 3), odd = fresh(pr[1])[0];
        if (three.length < 3 || !odd) return;
        three.concat(odd).forEach(function (o) { used[o.k] = 1; });
        used[pr[0]] = (used[pr[0]] || 0) + 1;
        used[pr[1]] = (used[pr[1]] || 0) + 1;
        out.push({ ask: 'Which one is from a different world?', right: odd.n, layout: 'cards', links: [odd].concat(three),
          why: 'Three are from ' + theWorld(pr[0]) + ': ' + list(three.map(function (o) { return o.n; })) + '. The odd one out, ' + odd.n + ', is from ' + theWorld(pr[1]) + '.',
          options: shuffle(three.concat(odd)).map(function (o) { return { text: o.n, img: o.t, ok: o === odd }; }) });
      });
      return out;
    },
    // Three that do the same job in three worlds, and one from a fourth world that does something else.
    'odd-job': function () {
      var out = [], used = {};
      shuffle(Object.keys(jobs)).forEach(function (g) {
        if (out.length >= ROUND) return;
        var three = [], ws = {};
        shuffle(items.filter(function (o) { return o.g.indexOf(g) > -1 && o.t && !used[o.k]; })).forEach(function (o) {
          if (three.length < 3 && !ws[o.w] && !three.some(function (t) { return shares(words(t.n), words(o.n)); })) { ws[o.w] = 1; three.push(o); }
        });
        if (three.length < 3) return;
        // The odd one is a place with a clear job of its own (vehicles have none listed).
        var odd = shuffle(items.filter(function (o) {
          return o.t && o.nd.length && !used[o.k] && !ws[o.w] && o.g.indexOf(g) < 0 && !three.some(function (t) { return shares(t.nd, o.nd) || shares(t.g, o.g); });
        }))[0];
        if (!odd) return;
        three.concat(odd).forEach(function (o) { used[o.k] = 1; });
        out.push({ ask: 'Which one does a different job?', right: odd.n, layout: 'cards', links: three.concat(odd),
          why: 'Three of them ' + jobs[g] + ': ' + list(three.map(function (o) { return o.n; })) + '. The odd one out is ' + odd.n + '.',
          options: shuffle(three.concat(odd)).map(function (o) { return { text: o.n, img: o.t, ok: o === odd }; }) });
      });
      return out;
    }
  };

  var maxScore = function () { return qs.reduce(function (s, q) { return s + (q.points || 1); }, 0); };
  // Zoom: 3 points in the first third of the zoom, 2 in the second, then 1.
  var zoomPoints = function (q) {
    var t = (Date.now() - q.t0) / 1000;
    return t < ZOOM_TIME / 3 ? 3 : t < ZOOM_TIME * 2 / 3 ? 2 : 1;
  };
  var setZoom = function (img, scale, secs) {
    img.style.transition = secs ? 'transform ' + secs + 's linear' : 'none';
    img.style.transform = 'scale(' + scale + ')';
  };
  var startZoom = function (img, q) {
    img.style.transformOrigin = q.zoom[0] + '% ' + q.zoom[1] + '%';
    setZoom(img, 4, 0);
    q.t0 = Date.now();
    clearInterval(zoomTimer);
    if (calm) {
      // No smooth motion: the picture steps out a few times instead.
      var steps = [2.6, 1.7, 1], n = 0;
      zoomTimer = setInterval(function () { setZoom(img, steps[n++], 0); if (n >= steps.length) clearInterval(zoomTimer); }, ZOOM_TIME / 4 * 1000);
    } else {
      // Wait for the picture, so the clock and the zoom start together.
      var go = function () { q.t0 = Date.now(); void img.offsetWidth; setZoom(img, 1, ZOOM_TIME); };
      if (img.complete) requestAnimationFrame(go); else img.addEventListener('load', go, { once: true });
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
      var fig = make('figure', q.shadow ? 'q-sil' : q.zoom ? 'q-close' : ''), img = make('img');
      img.src = q.big || q.pic.i; img.alt = q.alt;
      if (q.zoom) { var box = make('span', 'q-close-box'); box.appendChild(img); fig.appendChild(box); }
      else fig.appendChild(img);
      if (q.caption) fig.appendChild(make('figcaption', '', q.caption));
      pic.appendChild(fig);
      if (q.zoom) startZoom(img, q);
    }
    var opts = $('.q-options');
    opts.innerHTML = '';
    opts.className = 'q-options q-' + mode + (q.layout ? ' q-' + q.layout : '');
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
    var next = qs[at + 1];
    if (next && next.pic) new Image().src = next.big || next.pic.i;
    $('.q-ask').focus({ preventScroll: true });
  };
  var answer = function (o, btn) {
    var q = qs[at];
    if (q.done) return;
    q.done = true;
    q.ok = o.ok;
    var pts = o.ok ? (q.zoom ? zoomPoints(q) : 1) : 0;
    score += pts;
    clearInterval(zoomTimer);
    var fig = $('.q-pic figure');
    if (fig && q.shadow) fig.classList.add('lit');
    if (fig && q.zoom) setZoom(fig.querySelector('img'), 1, calm ? 0 : .6);
    $('.q-options').querySelectorAll('.q-opt').forEach(function (b, n) {
      b.disabled = true;
      if (q.options[n].ok) b.classList.add('right');
      else if (b === btn) b.classList.add('wrong');
    });
    var fb = $('.q-feedback');
    fb.innerHTML = '';
    var verdict = o.ok ? 'Right!' + (q.points ? ' +' + pts + (pts === 1 ? ' point.' : ' points.') : '') : 'Not quite. The answer is ' + q.right + '.';
    fb.append(make('p', o.ok ? 'fb-ok' : 'fb-no', verdict), make('p', '', q.why));
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
    var max = maxScore();
    var best = store.get(KEY, {}) || {};
    var prev = best[mode] || 0;
    if (score > prev) { best[mode] = score; store.set(KEY, best); }
    if (NEED ? score >= NEED : score === max) {
      var done = store.get('atlas.done', {}) || {};
      if (!done[DONE]) { done[DONE] = 1; store.set('atlas.done', done); }
      if (window.atlasBadges) window.atlasBadges();
    }
    $('.q-result').textContent = 'You got ' + score + ' out of ' + max + (max > qs.length ? ' points' : '') + '!';
    var part = score / max;
    var msg = score === max ? 'A perfect score. You really know your cities!' : part >= .7 ? 'Great work!' : part >= .4 ? 'Good try. Explore a few more places, then play again.' : 'Keep exploring the worlds, then try again.';
    if (prev && score > prev) msg += ' That is your best score yet.';
    $('.q-msg').textContent = msg;
    var ul = $('.q-review');
    ul.innerHTML = '';
    qs.forEach(function (q) {
      var li = make('li', q.ok ? 'ok' : 'no');
      var mark = make('span', 'q-mark', q.ok ? '✓' : '✗');
      mark.setAttribute('aria-hidden', 'true');
      li.append(mark, make('span', 'sr-only', q.ok ? 'Right: ' : 'Missed: '));
      q.links.forEach(function (it) {
        var a = make('a', 'world-' + it.w);
        a.href = it.u;
        if (it.t) { var im = make('img'); im.src = it.t; im.alt = ''; a.appendChild(im); }
        a.appendChild(make('span', '', it.n));
        li.appendChild(a);
      });
      ul.appendChild(li);
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
    root.querySelectorAll('[data-best]').forEach(function (s) {
      var m = s.getAttribute('data-best'), v = best[m];
      s.textContent = v ? 'Your best: ' + v + ' of ' + (m.indexOf('zoom') === 0 ? ROUND * 3 + ' points' : ROUND) : '';
    });
  };

  root.querySelectorAll('.qmode').forEach(function (b) { b.addEventListener('click', function () { begin(b.getAttribute('data-mode')); }); });
  $('.q-next').addEventListener('click', function () { at++; if (at < qs.length) show(); else finish(); });
  $('.q-again').addEventListener('click', function () { begin(mode); });
  $('.q-other').addEventListener('click', function () { clearInterval(zoomTimer); end.hidden = true; play.hidden = true; start.hidden = false; drawBest(); root.querySelector('.qmode').focus(); });
  drawBest();
})();
