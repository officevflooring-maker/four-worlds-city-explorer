// Small progressive enhancements. Every page works without this file.
(function () {
  'use strict';

  // Kept in this browser only (passport stamps): never sent anywhere.
  var store = {
    get: function (k, d) { try { var v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set: function (k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }
  };
  var NAMES = { roman: 'Ancient Rome', modern: 'the Modern Town', elven: 'the Elven Green World', future: 'the Robotic Future' };
  var norm = function (s) { return String(s).normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().replace(/[^a-z0-9]+/g, ' ').trim(); };
  var make = function (tag, cls, text) { var e = document.createElement(tag); if (cls) e.className = cls; if (text) e.textContent = text; return e; };

  // Phone menu: on small screens the navigation folds behind a Menu button.
  var header = document.querySelector('.site-header');
  var menuBtn = header && header.querySelector('.menu-btn');
  if (menuBtn) {
    menuBtn.hidden = false;
    header.classList.add('has-menu');
    var setMenu = function (open) { header.classList.toggle('menu-open', open); menuBtn.setAttribute('aria-expanded', String(open)); };
    menuBtn.addEventListener('click', function () { setMenu(!header.classList.contains('menu-open')); });
    header.addEventListener('keydown', function (e) { if (e.key === 'Escape' && header.classList.contains('menu-open')) { setMenu(false); menuBtn.focus(); } });
  }

  // ---------- Search: a box over the page (header button or the / key), using /data/search.json ----------
  var index = null;
  var loadIndex = function () {
    if (!index) index = fetch('/data/search.json').then(function (r) { if (!r.ok) throw new Error(r.status); return r.json(); });
    index.catch(function () { index = null; });
    return index;
  };
  // Every word typed must start a word somewhere; matches in the name count most.
  var findAll = function (data, q) {
    var words = norm(q).split(' ').filter(Boolean);
    var out = [];
    if (!words.length) return out;
    data.items.forEach(function (it) {
      if (it._n === undefined) { it._n = ' ' + norm(it.n); it._k = ' ' + norm(it.y + ' ' + (it.w ? data.worlds[it.w] : '') + ' ' + it.k); it._d = ' ' + norm(it.d); }
      var score = 0;
      for (var i = 0; i < words.length; i++) {
        var t = ' ' + words[i];
        if (it._n.indexOf(t) === 0) score += 12;
        else if (it._n.indexOf(t) > -1) score += 8;
        else if (it._k.indexOf(t) > -1) score += 3;
        else if (it._d.indexOf(t) > -1) score += 1;
        else return;
      }
      if (it.y === 'Place' || it.y === 'Vehicle' || it.y === 'World') score += 1;
      out.push([score, it]);
    });
    out.sort(function (a, b) { return b[0] - a[0] || a[1].n.localeCompare(b[1].n); });
    return out.map(function (x) { return x[1]; });
  };
  var surprise = function () {
    loadIndex().then(function (data) {
      var pool = data.items.filter(function (it) { return it.y === 'Place' || it.y === 'Vehicle'; });
      location.href = pool[Math.floor(Math.random() * pool.length)].u;
    }).catch(function () { location.href = '/search/'; });
  };
  document.querySelectorAll('[data-surprise]').forEach(function (b) { b.hidden = false; b.addEventListener('click', surprise); });

  var dlg = null;
  var buildSearch = function () {
    var d = make('dialog', 'search-dlg');
    d.setAttribute('aria-label', 'Search the site');
    d.innerHTML = '<div class="sd-box"><div class="sd-top"><svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5" fill="none" stroke="currentColor" stroke-width="2.4"/><path d="m15.5 15.5 5 5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/></svg>'
      + '<label class="sr-only" for="sd-q">Search the site</label><input id="sd-q" type="search" placeholder="Search buildings, people, tours\u2026" autocomplete="off" spellcheck="false">'
      + '<button type="button" class="sd-close">Close</button></div><p class="sr-only sd-status" aria-live="polite"></p><ul class="sd-results"></ul>'
      + '<div class="sd-foot"><button type="button" class="linkish sd-surprise">Surprise me</button><a href="/search/">Everything from A to Z</a></div></div>';
    document.body.appendChild(d);
    var input = d.querySelector('input'), list = d.querySelector('.sd-results'), status = d.querySelector('.sd-status');
    var draw = function () {
      loadIndex().then(function (data) {
        var q = input.value;
        var found = q.trim() ? findAll(data, q) : data.items.filter(function (it) { return it.y === 'World' || it.y === 'Activity'; });
        list.innerHTML = '';
        if (!q.trim()) list.appendChild(make('li', 'sd-label', 'Start with a world or an activity'));
        found.slice(0, 12).forEach(function (it) {
          var a = make('a'); a.href = it.u;
          if (it.w) a.className = 'world-' + it.w;
          var art = make('span', 'sd-art');
          if (it.t) { var im = make('img'); im.src = it.t; im.alt = ''; art.appendChild(im); } else { art.classList.add('sd-icon'); art.textContent = it.y.charAt(0); }
          var tx = make('span', 'sd-text');
          tx.append(make('span', 'sd-name', it.n), make('span', 'sd-meta', it.y + (it.w ? ' \u00b7 ' + data.worlds[it.w] : '')), make('span', 'sd-desc', it.d));
          a.append(art, tx);
          var li = make('li'); li.appendChild(a); list.appendChild(li);
        });
        if (q.trim() && !found.length) {
          var none = make('li', 'sd-none', 'Nothing found for \u201c' + q.trim() + '\u201d. Try another word, or ');
          var all = make('a', '', 'see everything from A to Z'); all.href = '/search/?q=' + encodeURIComponent(q.trim());
          none.append(all, '.'); list.appendChild(none);
        }
        status.textContent = q.trim() ? (found.length ? found.length + ' found' : 'Nothing found') : '';
      }).catch(function () {
        list.innerHTML = '';
        var li = make('li', 'sd-none', 'Search could not load. ');
        var all = make('a', '', 'See every page from A to Z'); all.href = '/search/';
        li.appendChild(all); list.appendChild(li);
      });
    };
    input.addEventListener('input', draw);
    var links = function () { return Array.prototype.slice.call(list.querySelectorAll('a')); };
    d.addEventListener('keydown', function (e) {
      var ls = links(), at = ls.indexOf(document.activeElement);
      if (e.key === 'ArrowDown') { e.preventDefault(); if (ls.length) ls[Math.min(ls.length - 1, at + 1)].focus(); }
      else if (e.key === 'ArrowUp') { e.preventDefault(); if (at <= 0) input.focus(); else ls[at - 1].focus(); }
      else if (e.key === 'Enter' && document.activeElement === input && ls.length) { e.preventDefault(); ls[0].click(); }
    });
    list.addEventListener('click', function (e) { if (e.target.closest('a')) d.close(); });
    d.addEventListener('click', function (e) { if (e.target === d) d.close(); });
    d.querySelector('.sd-close').addEventListener('click', function () { d.close(); });
    d.querySelector('.sd-surprise').addEventListener('click', surprise);
    d._draw = draw;
    return d;
  };
  var openSearch = function () {
    var box = document.getElementById('sp-q');
    if (box) { box.focus(); box.select(); return; }
    if (!dlg) dlg = buildSearch();
    if (!dlg.open) dlg.showModal();
    var input = dlg.querySelector('input');
    input.focus(); input.select();
    dlg._draw();
  };
  if (typeof HTMLDialogElement === 'function') {
    document.querySelectorAll('.hdr-search').forEach(function (a) {
      a.addEventListener('click', function (e) { if (e.ctrlKey || e.metaKey || e.shiftKey) return; e.preventDefault(); openSearch(); });
    });
    document.addEventListener('keydown', function (e) {
      var t = document.activeElement;
      if (e.key !== '/' || e.ctrlKey || e.metaKey || e.altKey || (t && (/^(INPUT|TEXTAREA|SELECT)$/.test(t.tagName) || t.isContentEditable))) return;
      if (document.querySelector('dialog[open]')) return;
      e.preventDefault(); openSearch();
    });
  }

  // Search page: filter the A to Z list as you type (?q= fills the box).
  var spq = document.getElementById('sp-q');
  if (spq) {
    spq.disabled = false;
    var rows = Array.prototype.slice.call(document.querySelectorAll('.az li[data-s]'));
    rows.forEach(function (li) { li._s = ' ' + li.getAttribute('data-s'); });
    var secs = Array.prototype.slice.call(document.querySelectorAll('.az-sec'));
    var jumps = Array.prototype.slice.call(document.querySelectorAll('.az-jump a'));
    var spCount = document.querySelector('.sp-count');
    var filter = function () {
      var words = norm(spq.value).split(' ').filter(Boolean);
      var n = 0;
      rows.forEach(function (li) {
        var on = words.every(function (w) { return li._s.indexOf(' ' + w) > -1; });
        li.hidden = !on;
        if (on) n++;
      });
      secs.forEach(function (s) { s.hidden = !s.querySelector('li:not([hidden])'); });
      jumps.forEach(function (a) { a.parentNode.hidden = document.getElementById(a.getAttribute('href').slice(1)).hidden; });
      spCount.textContent = words.length ? (n ? n + (n === 1 ? ' page' : ' pages') + ' found' : 'Nothing found. Try another word.') : '';
      try { history.replaceState(null, '', words.length ? '?q=' + encodeURIComponent(spq.value.trim()) : location.pathname); } catch (e) {}
    };
    spq.addEventListener('input', filter);
    var q0 = new URLSearchParams(location.search).get('q');
    if (q0) { spq.value = q0; filter(); }
  }

  // ---------- Passport: a stamp for every place page opened ----------
  var PP = 'atlas.passport';
  var stamps = store.get(PP, {});
  if (!stamps || typeof stamps !== 'object') stamps = {};
  var totals = {};
  (document.documentElement.getAttribute('data-pp-totals') || '').split(' ').forEach(function (p) { var kv = p.split(':'); if (kv[1]) totals[kv[0]] = Number(kv[1]); });
  var visited = function (w) { var n = 0; for (var k in stamps) if (k.indexOf(w + '/') === 0) n++; return Math.min(n, totals[w] || n); };
  var bar = function (n, t) { var b = make('span', 'pp-mini'), f = make('span'); f.style.width = Math.round(n / t * 100) + '%'; b.appendChild(f); return b; };
  var here = location.pathname.match(/^\/worlds\/(roman|modern|elven|future)\/([a-z0-9-]+)\/$/);
  if (here && document.body.classList.contains('building')) {
    var hw = here[1], key = hw + '/' + here[2], isNew = !stamps[key];
    stamps[key] = Date.now();
    store.set(PP, stamps);
    var got = visited(hw), all = totals[hw];
    var note = make('p', 'pp-note');
    var check = make('span', 'pp-check', '\u2713'); check.setAttribute('aria-hidden', 'true');
    var msg = got >= all ? (isNew ? ' New stamp! You have visited every place in ' : ' You have visited every place in ') + NAMES[hw] + '. '
      : (isNew ? ' New passport stamp: ' : ' Passport stamp: ') + got + ' of ' + all + ' places in ' + NAMES[hw] + '. ';
    var ppLink = make('a', '', 'Your passport'); ppLink.href = '/play/passport/';
    note.append(check, msg, ppLink);
    var facts = document.querySelector('.b-intro .facts');
    if (facts) facts.after(note);
  }
  // Mark visited places on cards, then show progress where it helps.
  document.querySelectorAll('[data-pp]').forEach(function (el) {
    if (!stamps[el.getAttribute('data-pp')]) return;
    el.classList.add('got');
    var a = el.querySelector('a');
    if (a) a.appendChild(make('span', 'sr-only', ' (visited)'));
  });
  var worldHere = location.pathname.match(/^\/worlds\/(roman|modern|elven|future)\/$/);
  var dirH = document.getElementById('dir-h');
  if (worldHere && dirH && visited(worldHere[1])) {
    var ww = worldHere[1], p = make('p', 'pp-progress');
    var pl = make('a', '', 'See your passport'); pl.href = '/play/passport/';
    p.append(bar(visited(ww), totals[ww]), 'You have visited ' + visited(ww) + ' of ' + totals[ww] + ' places. ', pl);
    dirH.after(p);
  }
  document.querySelectorAll('.wcard[data-world]').forEach(function (card) {
    var w = card.getAttribute('data-world'), n = visited(w);
    if (!n) return;
    var p = make('p', 'wcard-pp');
    p.append(bar(n, totals[w]), n + ' of ' + totals[w] + ' visited');
    card.querySelector('.wcard-go').before(p);
  });
  var ppAll = document.querySelector('.pp-all');
  if (ppAll) {
    var sum = 0;
    ppAll.querySelectorAll('.pp-world').forEach(function (sec) {
      var items = sec.querySelectorAll('[data-pp]').length, g = sec.querySelectorAll('[data-pp].got').length;
      sum += g;
      sec.querySelector('.pp-n').textContent = g;
      sec.querySelector('.pp-count').textContent = g;
      sec.querySelector('.pp-bar span').style.width = (g / items * 100) + '%';
      sec.classList.toggle('complete', g === items);
    });
    document.querySelector('.pp-total strong').textContent = sum;
    var clear = document.querySelector('.pp-clear');
    clear.hidden = !sum;
    clear.addEventListener('click', function () {
      if (!window.confirm('Clear all your passport stamps? This cannot be undone.')) return;
      store.set(PP, {});
      location.reload();
    });
  }

  // Print buttons (Compare page).
  document.querySelectorAll('.js-print').forEach(function (b) {
    b.addEventListener('click', function () { window.print(); });
  });

  // "Show building names" toggle on the city map.
  var city = document.querySelector('.city');
  var toggle = document.getElementById('show-labels');
  if (city && toggle) {
    toggle.addEventListener('change', function () { city.classList.toggle('show-labels', toggle.checked); });
  }

  // City map: zoom, drag to pan, full screen, highlight a group, and an info strip.
  document.querySelectorAll('[data-map]').forEach(function (shell) {
    var view = shell.querySelector('.map-view');
    var map = shell.querySelector('.city');
    var info = shell.querySelector('.map-info');
    var empty = info.innerHTML;
    var tiles = Array.prototype.slice.call(map.querySelectorAll('.tile[data-name]'));
    var levels = [1, 1.5, 2, 2.75];
    var z = 0;

    var setZoom = function (n) {
      var cx = (view.scrollLeft + view.clientWidth / 2) / view.scrollWidth;
      var cy = (view.scrollTop + view.clientHeight / 2) / view.scrollHeight;
      z = Math.max(0, Math.min(levels.length - 1, n));
      map.style.setProperty('--zoom', levels[z]);
      view.classList.toggle('zoomed', z > 0);
      view.classList.toggle('can-drag', z > 0);
      view.scrollLeft = cx * view.scrollWidth - view.clientWidth / 2;
      view.scrollTop = cy * view.scrollHeight - view.clientHeight / 2;
    };
    var zoomBox = shell.querySelector('.zoom');
    zoomBox.hidden = false;
    zoomBox.addEventListener('click', function (e) {
      var b = e.target.closest('[data-zoom]');
      if (!b) return;
      var d = Number(b.dataset.zoom);
      setZoom(d === 0 ? 0 : z + d);
    });
    // Phones start a little zoomed in, centered, so buildings are big enough to tap.
    if (view.clientWidth < 640) setZoom(1);

    // Drag to pan with a mouse (touch screens scroll natively).
    var drag = null;
    var moved = false;
    view.addEventListener('pointerdown', function (e) {
      if (e.pointerType !== 'mouse' || z === 0 || e.button !== 0) return;
      drag = { x: e.clientX, y: e.clientY, l: view.scrollLeft, t: view.scrollTop };
      moved = false;
    });
    window.addEventListener('pointermove', function (e) {
      if (!drag) return;
      var dx = e.clientX - drag.x, dy = e.clientY - drag.y;
      if (!moved && Math.abs(dx) + Math.abs(dy) < 6) return;
      moved = true;
      view.classList.add('dragging');
      view.scrollLeft = drag.l - dx;
      view.scrollTop = drag.t - dy;
    });
    window.addEventListener('pointerup', function () { drag = null; view.classList.remove('dragging'); });
    view.addEventListener('click', function (e) { if (moved) { e.preventDefault(); moved = false; } }, true);

    // Full screen.
    var fs = shell.querySelector('.map-full');
    if (shell.requestFullscreen) {
      fs.hidden = false;
      fs.addEventListener('click', function () {
        if (document.fullscreenElement) document.exitFullscreen();
        else shell.requestFullscreen().catch(function () {});
      });
      document.addEventListener('fullscreenchange', function () {
        fs.textContent = document.fullscreenElement === shell ? 'Exit full screen' : 'Full screen';
      });
    }

    // Info strip: shows what the pointer or keyboard focus is on.
    var describe = function (tile) {
      var a = tile.querySelector('a');
      var src = tile.querySelector('img').currentSrc;
      info.innerHTML = '';
      var img = document.createElement('img');
      img.src = src; img.alt = '';
      var box = document.createElement('div');
      var cat = document.createElement('p'); cat.className = 'mi-cat'; cat.textContent = tile.dataset.catname;
      var name = document.createElement('p'); name.className = 'mi-name'; name.textContent = tile.dataset.name;
      var sum = document.createElement('p'); sum.textContent = tile.dataset.sum + ' ';
      var link = document.createElement('a'); link.href = a.href; link.textContent = 'Open page';
      sum.appendChild(link);
      box.append(cat, name, sum);
      info.append(img, box);
    };
    tiles.forEach(function (t) {
      t.addEventListener('mouseenter', function () { describe(t); });
      t.addEventListener('focusin', function () { describe(t); });
    });

    // Highlight one group.
    var chips = shell.querySelectorAll('.chip');
    chips.forEach(function (c) {
      c.addEventListener('click', function () {
        var f = c.dataset.filter;
        chips.forEach(function (o) { o.setAttribute('aria-pressed', String(o === c)); });
        map.classList.toggle('filtering', !!f);
        var n = 0;
        tiles.forEach(function (t) { var on = !f || t.dataset.cat === f; t.classList.toggle('on', on && !!f); if (on && f) n++; });
        if (f) { info.innerHTML = ''; var p = document.createElement('p'); p.className = 'map-info-empty'; p.textContent = c.textContent + ': ' + n + ' highlighted on the map.'; info.append(p); }
        else info.innerHTML = empty;
      });
    });
  });

  // Print a single image: fill the hidden print sheet, then print only that.
  var sheet = document.querySelector('.print-sheet');
  function printImage(src, title) {
    if (!sheet) return;
    var img = sheet.querySelector('img');
    sheet.querySelector('p').textContent = title || '';
    document.body.classList.add('print-one');
    var go = function () { window.print(); };
    if (img.getAttribute('src') === src && img.complete) go();
    else { img.onload = go; img.src = src; }
  }
  window.addEventListener('afterprint', function () { document.body.classList.remove('print-one'); });
  document.querySelectorAll('.js-print-art').forEach(function (b) {
    b.addEventListener('click', function () { printImage(b.dataset.full, b.dataset.title); });
  });

  // Lightbox: any .lb button opens its image full size, with Save, Print and Full screen.
  var lb = document.querySelector('.lightbox');
  var items = Array.prototype.slice.call(document.querySelectorAll('.lb'));
  if (lb && items.length && typeof lb.showModal === 'function') {
    var lbImg = lb.querySelector('.lb-img');
    var stage = lb.querySelector('.lb-stage');
    var save = lb.querySelector('.lb-save');
    var full = lb.querySelector('.lb-full');
    var at = 0;
    var opener = null;
    if (!stage.requestFullscreen) full.hidden = true;
    lb.querySelectorAll('.lb-step').forEach(function (b) { b.hidden = items.length < 2; });

    var show = function (i) {
      at = (i + items.length) % items.length;
      var it = items[at];
      lbImg.src = it.dataset.full;
      lbImg.alt = it.dataset.title || '';
      lb.querySelector('.lb-title').textContent = it.dataset.title || '';
      lb.querySelector('.lb-credit').textContent = it.dataset.credit || '';
      save.href = it.dataset.full;
      save.setAttribute('download', it.dataset.download || '');
    };
    items.forEach(function (it, i) {
      it.addEventListener('click', function () {
        opener = it;
        show(i);
        lb.showModal();
        lb.querySelector('.lb-close').focus();
      });
    });
    lb.querySelector('.lb-close').addEventListener('click', function () { lb.close(); });
    lb.querySelector('.lb-prev').addEventListener('click', function () { show(at - 1); });
    lb.querySelector('.lb-next').addEventListener('click', function () { show(at + 1); });
    lb.querySelector('.lb-print').addEventListener('click', function () { printImage(items[at].dataset.full, items[at].dataset.title); });
    full.addEventListener('click', function () { stage.requestFullscreen().catch(function () {}); });
    lb.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowRight') show(at + 1);
      if (e.key === 'ArrowLeft') show(at - 1);
    });
    lb.addEventListener('close', function () {
      if (document.fullscreenElement) document.exitFullscreen();
      lbImg.removeAttribute('src');
      if (opener) opener.focus();
    });
  }

})();
