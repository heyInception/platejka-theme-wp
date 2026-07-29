# Deferred Third-Party Loading Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Preserve all required tracking and lead-generation integrations while moving non-critical vendor execution out of the initial rendering window.

**Architecture:** `header.php` keeps synchronous queue/configuration stubs and the two business-critical early integrations. The existing `third-party-loader.js` becomes the single idempotent scheduler for general, Marquiz, and Contact Form 7 reCAPTCHA libraries. WordPress converts the two reCAPTCHA script handles into inert placeholders; the loader activates them in dependency order when a form approaches or receives interaction.

**Tech Stack:** WordPress 7.0.2, PHP 8.x, vanilla JavaScript, Contact Form 7 6.1.4, WordPress script enqueue/filter APIs, browser IntersectionObserver.

## Global Constraints

- Do not remove or change any existing integration identifier, event name, conversion payload, or attribution cookie.
- Keep Callibri and Artfut/Admitad early in `header.php`.
- General integrations start once on first pointer, keyboard, or touch interaction, with a 3,000 ms fallback.
- Marquiz loads on proximity or CTA interaction; desktop also uses the 3,000 ms fallback.
- Contact Form 7 reCAPTCHA loads approximately 1,200 px before a form reaches the viewport or on form interaction.
- Do not change WP Rocket settings in this phase.
- Every external source must be inserted at most once and one vendor failure must not block the others.

---

## File map

- Modify `header.php`: retain queue/configuration stubs; remove direct insertion of deferred vendor libraries.
- Modify `js/modules/third-party-loader.js`: own all deferred script insertion, triggers, Marquiz initialization, and reCAPTCHA activation.
- Modify `inc/performance.php`: turn `google-recaptcha` and `wpcf7-recaptcha` script tags into inert loader placeholders on the front end.
- Modify `tests/third-party-loader.php`: contract coverage for preserved IDs, early integrations, deferred sources, and triggers.
- Create `tests/recaptcha-loader.php`: contract coverage for the WordPress handles, placeholders, and form-proximity loader.
- Modify `docs/performance/third-party-script-map.md`: record the implemented schedule.
- Modify `docs/performance/2026-07-29-theme-results.md`: record runtime verification and one warmed mobile/desktop PageSpeed result.

---

### Task 1: General analytics and widget scheduler

**Files:**
- Modify: `header.php:31-158`
- Modify: `js/modules/third-party-loader.js`
- Modify: `tests/third-party-loader.php`

**Interfaces:**
- Consumes: existing global queues `_tmr`, `_top100q`, `ym`, and `dataLayer`.
- Produces: `window.platejkaLoadExternalScript(src, attributes): Promise<HTMLScriptElement>` and an idempotent `startGeneralIntegrations()` scheduler.

- [ ] **Step 1: Extend the contract test for queue-only Header markup**

Add assertions to `tests/third-party-loader.php` that retain identifiers but reject direct deferred vendor insertion:

```php
assert( str_contains( $header, '3554245' ) );
assert( str_contains( $header, '7731957' ) );
assert( str_contains( $header, '97235179' ) );
assert( str_contains( $header, 'G-765QHYK81H' ) );
assert( str_contains( $header, '2d1a307b-05ec-4aec-b06e-76e872366ef5' ) );

assert( ! str_contains( $header, 'ts.src = "https://top-fwz1.mail.ru/js/code.js"' ) );
assert( ! str_contains( $header, '//st.top100.ru/top100/top100.js' ) );
assert( ! str_contains( $header, '"https://mc.yandex.ru/metrika/tag.js"' ) );
assert( ! str_contains( $header, '<script async src="https://www.googletagmanager.com/' ) );
assert( ! str_contains( $header, "widget.src = 'https://widget.yourgood.app/" ) );

assert( str_contains( $header, '//cdn.callibri.ru/callibri.js' ) );
assert( str_contains( $header, 'campaign_code=af79c4ac45' ) );
```

Add loader assertions:

```php
assert( str_contains( $loader_source, 'top-fwz1.mail.ru/js/code.js' ) );
assert( str_contains( $loader_source, 'st.top100.ru/top100/top100.js' ) );
assert( str_contains( $loader_source, 'mc.yandex.ru/metrika/tag.js' ) );
assert( str_contains( $loader_source, 'www.googletagmanager.com/gtag/js?id=G-765QHYK81H' ) );
assert( str_contains( $loader_source, 'widget.yourgood.app/script/widget.js' ) );
assert( str_contains( $loader_source, 'GENERAL_FALLBACK_MS = 3000' ) );
```

- [ ] **Step 2: Run the test and verify RED**

Run:

```powershell
studio wp eval-file "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\tests\third-party-loader.php" --path "C:\Users\Inception\Studio\platejka"
```

Expected: FAIL on the first assertion that rejects a direct Header vendor source.

- [ ] **Step 3: Convert Header integrations to queue/configuration stubs**

In `header.php`:

- keep the `_tmr.push({ id: "3554245", ... })` call and remove only the function that inserts `top-fwz1.mail.ru/js/code.js`;
- keep `_top100q.push()` and its project `7731957` initializer, and remove only the `script` insertion block;
- keep the `ym()` queue function and `ym(97235179, "init", ...)`, but remove the code that inserts `mc.yandex.ru/metrika/tag.js`;
- keep `window.dataLayer`, `gtag()`, `gtag('js', ...)`, and `gtag('config', 'G-765QHYK81H')`, but remove the external Google tag element;
- replace the immediate YourGood insertion with configuration:

```html
<script>
  window.platejkaYourGoodId = '2d1a307b-05ec-4aec-b06e-76e872366ef5';
</script>
```

Do not edit the Callibri or Artfut/Admitad blocks.

- [ ] **Step 4: Implement the general scheduler**

In `js/modules/third-party-loader.js`, keep the existing script insertion helper and add:

```js
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
```

Register `pointerdown`, `keydown`, and `touchstart` once and add:

```js
window.setTimeout(startGeneralIntegrations, GENERAL_FALLBACK_MS);
```

Remove the old `requestIdleCallback` branch so the fallback is exactly 3,000 ms.

- [ ] **Step 5: Run the contract and syntax tests**

Run:

```powershell
studio wp eval-file "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\tests\third-party-loader.php" --path "C:\Users\Inception\Studio\platejka"
node --check "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\js\modules\third-party-loader.js"
```

Expected: the PHP contract prints `third-party loader contract: OK`; Node exits 0.

- [ ] **Step 6: Commit**

```powershell
git add header.php js/modules/third-party-loader.js tests/third-party-loader.php
git commit -m "Defer general third-party integrations"
```

---

### Task 2: Context-triggered Marquiz

**Files:**
- Modify: `header.php:88-111`
- Modify: `js/modules/third-party-loader.js`
- Modify: `tests/third-party-loader.php`

**Interfaces:**
- Consumes: `window.platejkaMarquizOptions: object` and `window.platejkaLoadExternalScript()`.
- Produces: idempotent `startMarquiz(): Promise<void>` triggered by proximity, quiz CTA interaction, and desktop fallback.

- [ ] **Step 1: Add failing Marquiz assertions**

Add to `tests/third-party-loader.php`:

```php
assert( str_contains( $header, 'platejkaMarquizOptions' ) );
assert( str_contains( $header, "id: '689b95fd327d1700199c7e16'" ) );
assert( ! str_contains( $header, "j.src = '//script.marquiz.ru/v2.js'" ) );
assert( str_contains( $loader_source, 'script.marquiz.ru/v2.js' ) );
assert( str_contains( $loader_source, "rootMargin: '1200px 0px'" ) );
assert( str_contains( $loader_source, 'matchMedia' ) );
```

- [ ] **Step 2: Run the test and verify RED**

Run the same `studio wp eval-file` command for `tests/third-party-loader.php`.

Expected: FAIL because Header still inserts `script.marquiz.ru/v2.js`.

- [ ] **Step 3: Replace immediate Marquiz insertion with configuration**

Replace the current Marquiz loader block in `header.php` with:

```html
<script>
  window.platejkaMarquizOptions = {
    host: '//quiz.marquiz.ru',
    region: 'ru',
    id: '689b95fd327d1700199c7e16',
    autoOpen: 10,
    autoOpenFreq: 'once',
    openOnExit: false,
    disableOnMobile: false
  };
</script>
```

- [ ] **Step 4: Implement Marquiz loading and triggers**

Add to `third-party-loader.js`:

```js
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
}

document.addEventListener(
  'click',
  (event) => {
    if (
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
```

If IntersectionObserver is unavailable, call `startMarquiz()` immediately only
when a Marquiz container exists.

- [ ] **Step 5: Run the contract and syntax tests**

Run the PHP contract and `node --check` commands from Task 1.

Expected: both exit 0.

- [ ] **Step 6: Commit**

```powershell
git add header.php js/modules/third-party-loader.js tests/third-party-loader.php
git commit -m "Load Marquiz near its conversion block"
```

---

### Task 3: Contact Form 7 reCAPTCHA proximity loader

**Files:**
- Modify: `inc/performance.php`
- Modify: `js/modules/third-party-loader.js`
- Create: `tests/recaptcha-loader.php`

**Interfaces:**
- Consumes: WordPress script handles `google-recaptcha` and `wpcf7-recaptcha`.
- Produces: inert tags with `data-platejka-recaptcha-src`, plus `startRecaptcha(): Promise<void>` that activates them in DOM order.

- [ ] **Step 1: Create the failing PHP contract**

Create `tests/recaptcha-loader.php`:

```php
<?php

defined( 'ABSPATH' ) || exit;

$theme_dir   = get_template_directory();
$performance = file_get_contents( $theme_dir . '/inc/performance.php' );
$loader      = file_get_contents( $theme_dir . '/js/modules/third-party-loader.js' );

assert( str_contains( $performance, "'google-recaptcha'" ) );
assert( str_contains( $performance, "'wpcf7-recaptcha'" ) );
assert( str_contains( $performance, 'data-platejka-recaptcha-src' ) );
assert( str_contains( $performance, 'script_loader_tag' ) );

assert( str_contains( $loader, "querySelectorAll('script[data-platejka-recaptcha-src]')" ) );
assert( str_contains( $loader, "querySelectorAll('.wpcf7 form')" ) );
assert( str_contains( $loader, "rootMargin: '1200px 0px'" ) );
assert( str_contains( $loader, 'requestSubmit' ) );

echo "reCAPTCHA loader contract: OK\n";
```

- [ ] **Step 2: Run the new test and verify RED**

Run:

```powershell
studio wp eval-file "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\tests\recaptcha-loader.php" --path "C:\Users\Inception\Studio\platejka"
```

Expected: FAIL because `inc/performance.php` does not yet filter the handles.

- [ ] **Step 3: Add inert placeholder output for the two handles**

Add to `inc/performance.php`:

```php
function platejka_defer_recaptcha_script_tag(
	string $tag,
	string $handle,
	string $src
): string {
	if ( is_admin() || ! in_array( $handle, array( 'google-recaptcha', 'wpcf7-recaptcha' ), true ) ) {
		return $tag;
	}

	return sprintf(
		'<script type="application/json" id="%1$s-js" data-platejka-recaptcha-src="%2$s"></script>' . "\n",
		esc_attr( $handle ),
		esc_url( $src )
	);
}
add_filter( 'script_loader_tag', 'platejka_defer_recaptcha_script_tag', 20, 3 );
```

Do not modify the plugin or its registered dependencies. WordPress must still
print the plugin's `wpcf7_recaptcha` inline configuration before the inert
`wpcf7-recaptcha` placeholder.

- [ ] **Step 4: Implement sequential placeholder activation**

Add to `third-party-loader.js`:

```js
let recaptchaPromise;
let recaptchaReady = false;

const startRecaptcha = () => {
  if (recaptchaPromise) {
    return recaptchaPromise;
  }

  const placeholders = [
    ...document.querySelectorAll(
      'script[data-platejka-recaptcha-src]'
    ),
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
```

The catch marks the loading attempt complete so the form can continue into
Contact Form 7's normal validation/error path instead of becoming permanently
blocked.

- [ ] **Step 5: Add proximity, interaction, and submit guards**

Continue in `third-party-loader.js`:

```js
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
```

If IntersectionObserver is unavailable, call `startRecaptcha()` immediately
when at least one `.wpcf7 form` exists.

- [ ] **Step 6: Run focused and full tests**

Run:

```powershell
studio wp eval-file "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\tests\recaptcha-loader.php" --path "C:\Users\Inception\Studio\platejka"
studio wp eval-file "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\tests\third-party-loader.php" --path "C:\Users\Inception\Studio\platejka"
node --check "C:\Users\Inception\Studio\platejka\wp-content\themes\platejka-pagespeed\js\modules\third-party-loader.js"
```

Expected: both PHP contracts print `OK`; Node exits 0.

- [ ] **Step 7: Commit**

```powershell
git add inc/performance.php js/modules/third-party-loader.js tests/recaptcha-loader.php
git commit -m "Load reCAPTCHA near contact forms"
```

---

### Task 4: Mandatory verification and staging measurement

**Files:**
- Modify: `docs/performance/third-party-script-map.md`
- Modify: `docs/performance/2026-07-29-theme-results.md`

**Interfaces:**
- Consumes: the completed loader, Header queues, and reCAPTCHA placeholders.
- Produces: focused local/staging evidence and one warmed PageSpeed result.

- [ ] **Step 1: Run the two affected contract tests**

Run:

```powershell
studio wp eval-file tests/third-party-loader.php --path "C:\Users\Inception\Studio\platejka"
studio wp eval-file tests/recaptcha-loader.php --path "C:\Users\Inception\Studio\platejka"
node --check js/modules/third-party-loader.js
```

Expected: both contracts print `OK`; Node exits 0.

- [ ] **Step 2: Verify raw local HTML before interaction**

Request `http://localhost:8883/?third-party-verification=<timestamp>` and
assert:

- HTTP 200;
- optimized theme asset paths are present;
- direct `src` values for Mail.ru, Top100, Metrica, Google tag, Marquiz, and
  reCAPTCHA are absent;
- reCAPTCHA inert placeholders are present;
- Callibri and Artfut/Admitad remain present;
- no `gtmpx.com` value is present.

- [ ] **Step 3: Verify browser triggers locally**

In the in-app browser:

- before interaction, confirm deferred vendor source counts are zero;
- perform one pointer interaction and wait up to five seconds;
- confirm each general vendor source appears exactly once;
- scroll toward the Marquiz block and confirm it initializes;
- scroll toward the Contact Form 7 form and confirm Google reCAPTCHA loads
  before submission;
- enter non-sensitive test values and verify the form reaches Contact Form 7
  validation without a JavaScript exception;
- inspect console logs for new errors.

- [ ] **Step 4: Update the WordPress.com preview**

Run:

```powershell
studio preview update inceptionhack-amipe-studio.wp.build --path "C:\Users\Inception\Studio\platejka"
```

Store upload logs outside the site directory. Use a cache-bypass query because
the bare preview root previously retained a stale WordPress.com edge response.

- [ ] **Step 5: Repeat the focused browser checks on staging**

Repeat Step 4 against the fresh preview URL. Do not submit a real lead unless
the user explicitly authorizes it; validation-only checks are sufficient for
the draft PR.

- [ ] **Step 6: Run one warmed PageSpeed measurement**

Run PageSpeed Insights once on one warmed cache-bypass URL. Record mobile and
desktop:

- Performance;
- FCP;
- LCP;
- TBT;
- CLS;
- Speed Index;
- third-party main-thread time.

- [ ] **Step 7: Update documentation**

Update `third-party-script-map.md` with the exact implemented schedules and
update `2026-07-29-theme-results.md` with browser evidence and the warmed
mobile/desktop run. Clearly separate staging laboratory data from production
field data.

- [ ] **Step 8: Run final verification**

Re-run the two affected contracts, the loader syntax check, `git diff --check`,
and the local HTTP smoke check after documentation changes.

Expected: all commands exit 0 and the worktree contains only intentional
documentation/code/test changes.

- [ ] **Step 9: Commit and push**

```powershell
git add docs/performance/third-party-script-map.md docs/performance/2026-07-29-theme-results.md
git commit -m "Document deferred integration performance"
git push origin agent/pagespeed-theme
```

The existing draft PR updates automatically.
