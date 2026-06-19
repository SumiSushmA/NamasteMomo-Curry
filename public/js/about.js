(function () {
  'use strict';

  if (!('IntersectionObserver' in window)) {
    document.querySelectorAll('.abt-chapter, .abt-value, .abt-team-card').forEach(function (el) {
      el.classList.add('is-visible');
    });
    return;
  }

  var observer = new IntersectionObserver(function (entries, obs) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('is-visible');
      obs.unobserve(entry.target);
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });

  document.querySelectorAll('.abt-chapter, .abt-value, .abt-team-card').forEach(function (el) {
    observer.observe(el);
  });
})();
