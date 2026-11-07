// Artwork page (/artwork/): shows one world at a time. Each visit opens a random world, unless the address names one
// (/artwork/#roman). The world menu sticks under the header while you scroll and gets smaller once it is stuck;
// picking a world from it shows that world from its first picture. Without this script every world shows, one
// after another, and the menu links jump to them.
(function () {
  'use strict';
  var menu = document.querySelector('.art-menu');
  var secs = Array.prototype.slice.call(document.querySelectorAll('.art-world'));
  if (!menu || !secs.length) return;
  var links = Array.prototype.slice.call(menu.querySelectorAll('a[href^="#"]'));
  var ids = secs.map(function (s) { return s.id; });
  var head = document.querySelector('.site-header');
  var top = 0;

  // The menu sits right under the header where the header stays on screen (wide screens), else at the very top.
  var setTop = function () {
    top = head && getComputedStyle(head).position === 'sticky' ? head.offsetHeight : 0;
    document.documentElement.style.setProperty('--art-top', top + 'px');
  };
  var stuck = function () {
    menu.classList.toggle('stuck', menu.getBoundingClientRect().top <= top + 1 && window.scrollY > 0);
  };

  var show = function (id, jump) {
    secs.forEach(function (s) { s.hidden = s.id !== id; });
    links.forEach(function (a) {
      if (a.getAttribute('href') === '#' + id) a.setAttribute('aria-current', 'true'); else a.removeAttribute('aria-current');
    });
    // Keep the picked world's button in view when the menu is one line that scrolls sideways (phones, or stuck).
    var cur = menu.querySelector('[aria-current]'), row = cur && cur.closest('ul');
    if (row && row.scrollWidth > row.clientWidth) row.scrollLeft = cur.offsetLeft - row.offsetLeft - (row.clientWidth - cur.offsetWidth) / 2;
    if (jump) {
      // Already scrolled into the pictures: go back up to the start of the new world, just under the menu.
      var start = secs[0].parentNode.getBoundingClientRect().top + window.scrollY - top - menu.offsetHeight;
      if (window.scrollY > start) window.scrollTo(0, start);
    }
    stuck();
  };

  links.forEach(function (a) {
    a.addEventListener('click', function (e) {
      var id = a.getAttribute('href').slice(1);
      if (ids.indexOf(id) < 0) return;
      e.preventDefault();
      if (history.replaceState) history.replaceState(null, '', '#' + id);
      show(id, true);
    });
  });
  window.addEventListener('hashchange', function () {
    var id = location.hash.slice(1);
    if (ids.indexOf(id) >= 0) show(id, true);
  });

  var raf = 0;
  window.addEventListener('scroll', function () {
    if (!raf) raf = requestAnimationFrame(function () { raf = 0; stuck(); });
  }, {passive: true});
  window.addEventListener('resize', function () { setTop(); stuck(); });

  setTop();
  var first = location.hash.slice(1);
  show(ids.indexOf(first) >= 0 ? first : ids[Math.floor(Math.random() * ids.length)], false);
})();
