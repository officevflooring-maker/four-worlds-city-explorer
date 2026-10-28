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
