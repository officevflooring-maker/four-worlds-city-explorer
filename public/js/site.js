// Small progressive enhancements. Every page works without this file.
(function () {
  'use strict';

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
