(() => {
  const video = document.querySelector('.js-hero-video');

  if (!video) {
    return;
  }

  const loadVideo = () => {
    if (video.src) {
      return;
    }

    video.src = video.dataset.src;
    video.load();
  };

  const playVideo = () => {
    loadVideo();
    video.play().catch(() => {});
  };

  const requiresInteraction =
    window.matchMedia('(max-width: 767px)').matches ||
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (requiresInteraction) {
    video.addEventListener('click', playVideo, { once: true });
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      if (!entries[0].isIntersecting) {
        return;
      }

      observer.disconnect();
      playVideo();
    },
    { rootMargin: '200px 0px' }
  );

  observer.observe(video);
})();
