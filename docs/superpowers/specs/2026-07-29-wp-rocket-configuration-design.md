# WP Rocket configuration design

## Goal

Improve the mobile PageSpeed result after the theme optimization phase without
removing required Header integrations or changing their identifiers, queues,
and event payloads.

The configuration targets the active `platejka-pagespeed` theme and WP Rocket
3.16.2.1. WebP generation and delivery remain owned by WebP Express.

## Current state

WP Rocket already enables CSS and JavaScript minification, JavaScript defer and
delay, image and iframe lazy-loading, CSS background lazy-loading, and missing
image dimensions. Remove Unused CSS is disabled. The delay configuration still
contains broad legacy exclusions for reCAPTCHA and Yandex.

The theme now owns the timing of its required integrations:

- Callibri and Artfut/Admitad remain early.
- `third-party-loader.js` starts the general vendor group on first interaction
  or the three-second fallback.
- Marquiz uses block/CTA proximity with a desktop fallback.
- Contact Form 7 reCAPTCHA uses form proximity or form intent.

WP Rocket must not delay the theme loader a second time.

## Configuration

### JavaScript

Keep JavaScript minification, defer, and delay enabled.

Add narrow Delay JavaScript exclusions for:

- the theme `third-party-loader.js`;
- Callibri;
- Artfut/Admitad.

Remove the broad legacy reCAPTCHA and Yandex delay exclusions. Their network
timing is already controlled by the theme, so the old exclusions no longer
protect a required direct script and can make unrelated scripts execute early.

The agreed three-second theme fallback remains unchanged.

### CSS

Enable Remove Unused CSS. Build the safelist from dynamic selectors that are
present in the theme and rendered homepage markup, covering:

- open/active menu states;
- visible modal and popup states;
- calculator and slider state classes;
- Contact Form 7 validation and submission states;
- Marquiz, Chaty, and other plugin containers whose markup appears after page
  load.

Only concrete selector fragments found in the code or rendered DOM may be
added. Generic catch-all patterns are not allowed because they would negate the
unused-CSS reduction.

Keep CSS minification enabled. Do not enable a second asynchronous CSS method
alongside Remove Unused CSS.

### Cache, media, and preload

Keep the existing lazy-load, CSS-background lazy-load, iframe lazy-load, image
dimension, and WebP Express behavior.

Enable caching for mobile visitors and keep separate mobile cache files
disabled because the theme is responsive and serves the same markup. Keep the
theme-owned Inter preload and do not duplicate it in WP Rocket.

After applying the settings, clear WP Rocket cache and generated CSS so the
next requests rebuild from the new configuration.

## Safety and rollback

Before changing the option, export the complete `wp_rocket_settings` value to a
file outside the uploaded site. Apply the new settings through WordPress APIs,
not a direct database edit.

If Remove Unused CSS is unavailable locally or fails to generate on preview,
retain the JavaScript changes and restore only the CSS optimization fields.
If a required interaction loses styling or functionality, restore the saved
option, clear caches, and investigate before retrying.

## Mandatory verification

Keep verification intentionally small:

1. Confirm the front page returns HTTP 200 and contains the footer.
2. Confirm the navigation, calculator, transaction modal, and one Contact Form
   7 form remain operable.
3. Confirm the theme loader is direct, required integrations are not duplicated,
   and reCAPTCHA is absent before form proximity.
4. Inspect the homepage at mobile and desktop widths for missing critical
   styling.
5. Update the existing WordPress.com preview and run one PageSpeed report,
   recording mobile and desktop metrics from that report.

No repeated Lighthouse samples, full regression suite, database cleanup, plugin
updates, or WebP conversion work belongs to this phase.
