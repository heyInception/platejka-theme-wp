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

const GENERAL_FALLBACK_MS = 3000;

const generalSources = [
  ['https://top-fwz1.mail.ru/js/code.js', { id: 'tmr-code' }],
  ['https://st.top100.ru/top100/top100.js'],
  ['https://mc.yandex.ru/metrika/tag.js'],
  ['https://www.googletagmanager.com/gtag/js?id=G-765QHYK81H'],
];

let generalIntegrationsStarted = false;

const startGeneralIntegrations = () => {
  if (generalIntegrationsStarted) {
    return;
  }

  generalIntegrationsStarted = true;

  generalSources.forEach(([src, attributes = {}]) => {
    window.platejkaLoadExternalScript(src, attributes).catch(() => {});
  });

  if (window.platejkaYourGoodId) {
    window
      .platejkaLoadExternalScript(
        `https://widget.yourgood.app/script/widget.js?id=${encodeURIComponent(
          window.platejkaYourGoodId
        )}`
      )
      .catch(() => {});
  }

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
  window.addEventListener(eventName, startGeneralIntegrations, {
    once: true,
    passive: true,
  });
});

window.setTimeout(startGeneralIntegrations, GENERAL_FALLBACK_MS);

let marquizPromise;

const startMarquiz = () => {
  if (marquizPromise) {
    return marquizPromise;
  }

  marquizPromise = window
    .platejkaLoadExternalScript('https://script.marquiz.ru/v2.js')
    .then(() => {
      if (window.Marquiz && window.platejkaMarquizOptions) {
        window.Marquiz.init(window.platejkaMarquizOptions);
      }
    })
    .catch(() => {});

  return marquizPromise;
};

const marquizContainer = document.querySelector('[data-marquiz-id]');

if (marquizContainer && 'IntersectionObserver' in window) {
  const marquizObserver = new IntersectionObserver(
    (entries, observer) => {
      if (entries.some((entry) => entry.isIntersecting)) {
        observer.disconnect();
        startMarquiz();
      }
    },
    { rootMargin: '1200px 0px' }
  );

  marquizObserver.observe(marquizContainer);
} else if (marquizContainer) {
  startMarquiz();
}

document.addEventListener(
  'click',
  (event) => {
    if (
      event.target instanceof Element &&
      event.target.closest(
        '[data-marquiz-id], a[href*="fancyboxID"], .js-marquiz-trigger'
      )
    ) {
      startMarquiz();
    }
  },
  { passive: true }
);

if (!window.matchMedia('(max-width: 767px)').matches) {
  window.setTimeout(startMarquiz, GENERAL_FALLBACK_MS);
}

let recaptchaPromise;
let recaptchaReady = false;

const startRecaptcha = () => {
  if (recaptchaPromise) {
    return recaptchaPromise;
  }

  const placeholders = [
    ...document.querySelectorAll('script[data-platejka-recaptcha-src]'),
  ];

  recaptchaPromise = placeholders
    .reduce(
      (promise, placeholder) =>
        promise.then(() =>
          window.platejkaLoadExternalScript(
            placeholder.dataset.platejkaRecaptchaSrc
          )
        ),
      Promise.resolve()
    )
    .then(() => {
      recaptchaReady = true;
    })
    .catch(() => {
      recaptchaReady = true;
    });

  return recaptchaPromise;
};

const recaptchaForms = [...document.querySelectorAll('.wpcf7 form')];

if (recaptchaForms.length && 'IntersectionObserver' in window) {
  const recaptchaObserver = new IntersectionObserver(
    (entries, observer) => {
      if (entries.some((entry) => entry.isIntersecting)) {
        observer.disconnect();
        startRecaptcha();
      }
    },
    { rootMargin: '1200px 0px' }
  );

  recaptchaForms.forEach((form) => recaptchaObserver.observe(form));
} else if (recaptchaForms.length) {
  startRecaptcha();
}

recaptchaForms.forEach((form) => {
  ['focusin', 'pointerdown', 'touchstart'].forEach((eventName) => {
    form.addEventListener(eventName, startRecaptcha, {
      once: true,
      passive: true,
    });
  });

  form.addEventListener(
    'submit',
    (event) => {
      if (recaptchaReady) {
        return;
      }

      event.preventDefault();
      event.stopImmediatePropagation();
      const submitter = event.submitter;

      startRecaptcha().finally(() => {
        if (typeof form.requestSubmit === 'function') {
          form.requestSubmit(submitter || undefined);
        } else {
          form.dispatchEvent(
            new Event('submit', { bubbles: true, cancelable: true })
          );
        }
      });
    },
    true
  );
});
