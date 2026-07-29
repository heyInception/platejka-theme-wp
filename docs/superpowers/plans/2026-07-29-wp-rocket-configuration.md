# WP Rocket Configuration Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Apply a reproducible WP Rocket configuration that reduces unused CSS and delays noncritical plugin JavaScript without delaying the theme-owned integration scheduler.

**Architecture:** A guarded WP-CLI configuration script updates only the documented WP Rocket option keys while preserving licence and unrelated values. A separate contract test verifies the effective configuration through WordPress. The complete original option is backed up outside the uploaded site before the update.

**Tech Stack:** WordPress 7.0.2, PHP 8.4, WP Rocket 3.16.2.1, WordPress Studio CLI, PowerShell, PageSpeed Insights.

## Global Constraints

- Keep all required Header identifiers, queues, initialization payloads, Callibri, and Artfut/Admitad.
- Keep the theme's three-second general-vendor fallback unchanged.
- Keep WebP generation and delivery owned by WebP Express.
- Do not enable asynchronous CSS alongside Remove Unused CSS.
- Use only concrete dynamic selectors found in the theme or rendered markup.
- Run one final PageSpeed report with mobile and desktop results.
- Do not update plugins, clean the database, or add unrelated optimizations.

---

### Task 1: Reproducible WP Rocket configuration

**Files:**
- Create: `tools/configure-wp-rocket.php`
- Create: `tests/wp-rocket-settings.php`

**Interfaces:**
- Consumes: WordPress option `wp_rocket_settings`.
- Produces: the same complete option array with only the approved keys changed.

- [ ] **Step 1: Write the failing configuration contract**

Create `tests/wp-rocket-settings.php` as a WP-CLI-only contract. Read
`wp_rocket_settings` and assert:

```php
assert( 1 === (int) $settings['remove_unused_css'] );
assert( 0 === (int) $settings['async_css'] );
assert( 1 === (int) $settings['cache_mobile'] );
assert( 1 === (int) $settings['do_caching_mobile_files'] );
assert( in_array( 'platejka-pagespeed/js/modules/third-party-loader.js', $settings['delay_js_exclusions'], true ) );
assert( in_array( '(.*)swiper-(.*)', $settings['remove_unused_css_safelist'], true ) );
assert( ! in_array( 'recaptcha', $settings['delay_js_exclusions_selected_exclusions'], true ) );
assert( ! in_array( 'yandex.ru', $settings['delay_js_exclusions_selected_exclusions'], true ) );
```

The file must begin with `defined( 'WP_CLI' ) || exit;` and print
`WP Rocket settings contract: OK` on success.

- [ ] **Step 2: Run the contract to verify RED**

Run:

```powershell
studio wp eval-file wp-content/themes/platejka-pagespeed/tests/wp-rocket-settings.php --path C:\Users\Inception\Studio\platejka
```

Expected: FAIL because `remove_unused_css` and mobile cache are `0`.

- [ ] **Step 3: Implement the guarded configurator**

Create `tools/configure-wp-rocket.php` with
`defined( 'WP_CLI' ) || exit;`. Read the existing option and stop with a
`RuntimeException` if it is not an array or its `version` is not `3.16.2.1`.

Set these scalar values:

```php
$settings['minify_css']             = 1;
$settings['minify_js']              = 1;
$settings['defer_all_js']           = 1;
$settings['delay_js']               = 1;
$settings['remove_unused_css']      = 1;
$settings['async_css']              = 0;
$settings['cache_mobile']           = 1;
$settings['do_caching_mobile_files'] = 1;
```

Set `delay_js_exclusions` to this exact narrow list:

```php
[
    'platejka-pagespeed/js/modules/third-party-loader.js',
    'cdn.callibri.ru/callibri.js',
    'artfut.com/static/tagtag.min.js',
    'platejkaMarquizOptions',
    '_tmr',
    '_top100q',
    'ym\\(',
    'dataLayer',
    'platejkaYourGoodId',
]
```

Remove values containing `recaptcha`, `yandex.ru`, or `window.yaContextCb`
from `delay_js_exclusions_selected_exclusions`, preserving every unrelated
existing value.

Pass this concrete safelist through
`rocket_sanitize_textarea_field( 'remove_unused_css_safelist', $safelist )`
before storing it, so WP Rocket converts the supported `*` wildcards to its
stored `(.*)` form:

```php
[
    '*swiper-*',
    '*wpcf7-*',
    '*fancybox*',
    '*chaty*',
    '*cht-*',
    'search_open',
    'header__wrap_active',
    'burger__active',
    'calculate__button_active',
    'calculate__column_active',
    'slider-progress',
    'calc__button_active',
    'tabs__nav-btn--active',
    'tabs__panel--active',
    'request__title_show',
    'request__btn_show',
    'faq__item_active',
    'faq__text_active',
    'footer__bottom_show',
    'footer__social_show',
    'is-visible',
]
```

Call `update_option( 'wp_rocket_settings', $settings )`, fail if it returns
false and the stored value differs, then call `rocket_clean_domain()` when
available. Print a JSON object containing only the changed non-secret keys.

- [ ] **Step 4: Run PHP syntax checks**

Run:

```powershell
studio wp eval 'echo \"runtime OK\n\";' --path C:\Users\Inception\Studio\platejka
$studioPhp = 'C:\Users\Inception\AppData\Local\studio_app\app-1.17.0\resources\php-bin\8.4.23-studio-1\php.exe'
& $studioPhp -l tools/configure-wp-rocket.php
& $studioPhp -l tests/wp-rocket-settings.php
```

Expected: runtime output and `No syntax errors detected` for both files.

- [ ] **Step 5: Commit the reproducible configuration**

```powershell
git add tools/configure-wp-rocket.php tests/wp-rocket-settings.php docs/superpowers/specs/2026-07-29-wp-rocket-configuration-design.md
git commit -m "Add guarded WP Rocket configuration"
```

### Task 2: Backup and apply local settings

**Files:**
- Create outside site: `C:\Users\Inception\.codex\visualizations\2026\07\29\019fad5b-b2cd-7430-856b-935544d1311d\platejka-staging\wp-rocket-settings-before.json`
- Modify through WordPress API: option `wp_rocket_settings`

**Interfaces:**
- Consumes: configurator from Task 1.
- Produces: recoverable local settings and cleared WP Rocket cache.

- [ ] **Step 1: Export the complete original option**

Run `studio wp option get wp_rocket_settings --format=json` and save its exact
stdout to the external backup path. Confirm the file parses as JSON and is not
inside `C:\Users\Inception\Studio\platejka`.

- [ ] **Step 2: Apply the configuration**

Run:

```powershell
studio wp eval-file wp-content/themes/platejka-pagespeed/tools/configure-wp-rocket.php --path C:\Users\Inception\Studio\platejka
```

Expected: JSON containing the approved non-secret settings only.

- [ ] **Step 3: Verify GREEN**

Run the contract from Task 1.

Expected: `WP Rocket settings contract: OK`.

- [ ] **Step 4: Confirm cache regeneration**

Request the homepage twice with a unique query value. Confirm HTTP 200, footer
markup, `platejka-third-party-loader-js`, and the two inert
`data-platejka-recaptcha-src` placeholders.

### Task 3: Mandatory functional smoke

**Files:**
- Modify: `docs/performance/2026-07-29-theme-results.md`

**Interfaces:**
- Consumes: locally generated WP Rocket output.
- Produces: concise verification evidence and any rollback decision.

- [ ] **Step 1: Verify initial loading contract**

At mobile width, load a fresh query URL and confirm before interaction:

```text
footer present
third-party-loader.js direct and unique
gtmpx.com absent
reCAPTCHA external script count = 0
reCAPTCHA placeholder count = 2
```

- [ ] **Step 2: Verify the minimum interactions**

Check one instance of each: mobile navigation, calculator recalculation,
transaction-request modal, and Contact Form 7 form focus. The form focus must
activate reCAPTCHA no more than once.

- [ ] **Step 3: Verify desktop styling**

At desktop width, confirm the hero/header, calculator, slider, modal, and footer
retain layout and visible styling. If generated used CSS is unavailable on
localhost, record that staging is the authoritative RUCSS visual check.

- [ ] **Step 4: Record evidence**

Update the results document with the exact configuration, contract result,
functional smoke outcome, and whether RUCSS generated locally.

### Task 4: Preview and one PageSpeed report

**Files:**
- Modify: `docs/performance/2026-07-29-theme-results.md`

**Interfaces:**
- Consumes: verified local site and saved settings.
- Produces: updated WordPress.com preview, one PSI mobile/desktop result, and updated draft PR.

- [ ] **Step 1: Update the existing preview**

```powershell
studio preview update inceptionhack-amipe-studio.wp.build --path C:\Users\Inception\Studio\platejka
```

- [ ] **Step 2: Warm and verify the preview**

Use one fresh cache-bypass URL. Confirm HTTP 200, footer, active
`platejka-pagespeed` assets, no `gtmpx.com`, direct unique theme loader, and no
initial external reCAPTCHA.

- [ ] **Step 3: Run one PageSpeed report**

Run one PageSpeed analysis against the warmed cache-bypass URL. Record mobile
and desktop Performance, FCP, LCP, TBT, CLS, and Speed Index from that single
report.

- [ ] **Step 4: Final mandatory verification**

Run:

```powershell
studio wp eval-file wp-content/themes/platejka-pagespeed/tests/wp-rocket-settings.php --path C:\Users\Inception\Studio\platejka
studio wp eval-file wp-content/themes/platejka-pagespeed/tests/third-party-loader.php --path C:\Users\Inception\Studio\platejka
studio wp eval-file wp-content/themes/platejka-pagespeed/tests/recaptcha-loader.php --path C:\Users\Inception\Studio\platejka
node --check wp-content/themes/platejka-pagespeed/js/modules/third-party-loader.js
git diff --check
```

Expected: three contract `OK` messages, Node exit code `0`, and no diff-check
errors.

- [ ] **Step 5: Commit and push**

```powershell
git add docs/performance/2026-07-29-theme-results.md
git commit -m "Document WP Rocket performance"
git push origin agent/pagespeed-theme
```

Keep the existing draft PR and isolated worktree for review.
