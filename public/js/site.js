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

  // City map: selecting a building opens a detail dialog built from its directory card.
  var dlg = document.querySelector('.place-dialog');
  if (!dlg || typeof dlg.showModal !== 'function') return;

  var buttons = Array.prototype.slice.call(document.querySelectorAll('.tile-btn'));
  var ids = buttons.map(function (b) { return b.dataset.place; });
  var current = 0;
  var opener = null;

  function fill(index) {
    current = (index + ids.length) % ids.length;
    var card = document.getElementById('place-' + ids[current]);
    var img = card.querySelector('.place-art img').cloneNode();
    img.removeAttribute('loading');
    img.sizes = '(min-width: 760px) 440px, 90vw';
    var art = dlg.querySelector('.dlg-art');
    art.replaceChildren(img);
    dlg.querySelector('#dlg-title').textContent = card.querySelector('h3').textContent;
    dlg.querySelector('.what').textContent = card.querySelector('.what').textContent;
    dlg.querySelector('.dlg-body').replaceChildren(card.querySelector('.place-body').cloneNode(true));
    dlg.querySelector('.dlg-text').scrollTop = 0;
    dlg.scrollTop = 0;
  }

  buttons.forEach(function (b, i) {
    b.addEventListener('click', function () {
      opener = b;
      fill(i);
      dlg.showModal();
      dlg.querySelector('.dlg-close').focus();
    });
  });

  dlg.querySelector('.dlg-close').addEventListener('click', function () { dlg.close(); });
  dlg.querySelectorAll('[data-step]').forEach(function (b) {
    b.addEventListener('click', function () {
      fill(current + Number(b.dataset.step));
      opener = buttons[current];
    });
  });
  // Close when clicking the dark backdrop.
  dlg.addEventListener('click', function (e) { if (e.target === dlg) dlg.close(); });
  dlg.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowRight') { fill(current + 1); opener = buttons[current]; }
    if (e.key === 'ArrowLeft') { fill(current - 1); opener = buttons[current]; }
  });
  dlg.addEventListener('close', function () { if (opener) opener.focus(); });
})();
