window.platejkaLoadExternalScript = (src, attributes = {}) =>
  new Promise((resolve, reject) => {
    const existing = document.querySelector(
      `script[data-platejka-src="${src}"]`
    );

    if (existing) {
      resolve(existing);
      return;
    }

    const script = document.createElement('script');
    script.src = src;
    script.async = true;
    script.dataset.platejkaSrc = src;

    Object.entries(attributes).forEach(([name, value]) => {
      script.setAttribute(name, value);
    });

    script.addEventListener('load', () => resolve(script), { once: true });
    script.addEventListener('error', reject, { once: true });
    document.head.appendChild(script);
  });

let deferredIntegrationsStarted = false;

const startDeferredIntegrations = () => {
  if (deferredIntegrationsStarted) {
    return;
  }

  deferredIntegrationsStarted = true;

  window
    .platejkaLoadExternalScript(
      'https://p.dmp.one/sync?stock_key=892d597ee76ed81ab1fbfb7f2b444b43',
      {
        referrerpolicy: 'no-referrer-when-downgrade',
        charset: 'UTF-8',
      }
    )
    .catch(() => {});
};

['pointerdown', 'keydown', 'touchstart'].forEach((eventName) => {
  window.addEventListener(eventName, startDeferredIntegrations, {
    once: true,
    passive: true,
  });
});

if ('requestIdleCallback' in window) {
  window.requestIdleCallback(startDeferredIntegrations, { timeout: 5000 });
} else {
  window.setTimeout(startDeferredIntegrations, 3500);
}
