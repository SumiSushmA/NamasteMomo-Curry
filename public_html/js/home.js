(function () {
  'use strict';

  var revealNodes = document.querySelectorAll('[data-reveal]');
  var sectionNodes = document.querySelectorAll('.gem-section');
  var parallaxNode = document.querySelector('[data-parallax]');
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if ('IntersectionObserver' in window) {
    var revealObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.2, rootMargin: '0px 0px -10% 0px' });

    revealNodes.forEach(function (node) { revealObserver.observe(node); });
    sectionNodes.forEach(function (node) { revealObserver.observe(node); });
  } else {
    revealNodes.forEach(function (node) { node.classList.add('is-visible'); });
    sectionNodes.forEach(function (node) { node.classList.add('is-visible'); });
  }

  var header = document.getElementById('cust-header');
  var parallaxTicking = false;

  function updateParallax() {
    parallaxTicking = false;
    if (!parallaxNode || prefersReducedMotion) return;
    var y = Math.min(window.scrollY * 0.12, 72);
    parallaxNode.style.transform = 'scale(1.02) translate3d(0, ' + y + 'px, 0)';
  }

  function onScroll() {
    if (!parallaxTicking) {
      parallaxTicking = true;
      window.requestAnimationFrame(updateParallax);
    }
  }

  updateParallax();
  window.addEventListener('scroll', onScroll, { passive: true });

  if (header) {
    header.classList.add('is-ready');
  }

  var sigTrack = document.getElementById('gem-signatures-track');
  var sigFadeRight = document.getElementById('gem-signatures-fade-right');
  var sigHint = document.getElementById('gem-signatures-hint');

  function updateSignatureScroll() {
    if (!sigTrack) return;
    var maxScroll = sigTrack.scrollWidth - sigTrack.clientWidth;
    var atEnd = maxScroll <= 8 || sigTrack.scrollLeft >= maxScroll - 8;
    var canScroll = maxScroll > 8;

    sigFadeRight?.classList.toggle('is-hidden', atEnd || !canScroll);
    sigHint?.classList.toggle('is-hidden', !canScroll || atEnd);
  }

  sigTrack?.addEventListener('scroll', updateSignatureScroll, { passive: true });
  window.addEventListener('resize', updateSignatureScroll, { passive: true });
  updateSignatureScroll();
})();
