# Theme performance results — 2026-07-29

## Scope

This phase changes only the `platejka` theme. WP Rocket settings, WordPress
core, WebP Express configuration, analytics identifiers, call tracking, and
plugin-owned chat were not changed.

## Implemented

- Conditional, file-versioned theme CSS and JavaScript loading.
- `defer` for eligible local scripts.
- Inter 400/500/600 converted from 310–316 KB TTF files to 29–32 KB WOFF2
  subsets; only Inter Regular is preloaded.
- Front-page ACF images rendered through the WordPress responsive-image API.
- Static front-page images now reserve intrinsic layout space.
- Hero video changed from autoplay/preload-auto to poster-first,
  `preload="none"` loading. Mobile and reduced-motion users load it only after
  interaction.
- Infinite mobile tap-hint animation disabled and recurring hover interval
  replaced by one cancellable timeout.
- Required Header integrations preserved. The DMP sync request alone is
  scheduled on interaction or browser idle; see `third-party-script-map.md`.
- The 8,950,029-byte `coin.svg` source is preserved. The front page now uses a
  visually checked 14,468-byte WebP presentation copy at its actual display
  size. The unreferenced 2,184,046-byte `v-globe-mobile.svg` remains unchanged.
- Calculator exchange-rate HTTP calls removed from the page-render path.
  WordPress Cron refreshes the same three endpoints hourly and the calculator
  reads the last stored values.
- Two browser-observed JavaScript initialization errors were guarded.

## Local measurements

| Metric | Before | After |
| --- | ---: | ---: |
| Uncached front-page TTFB | about 10.64 s | 3.36–3.55 s |
| Warm WP Rocket TTFB | 33–36 ms | 32–35 ms |
| Images with intrinsic width and height | 6 of 95 | 87 of 96 |
| Responsive `srcset` images | 0 observed | 15 |
| Lazy images | 0 observed | 86 |
| Hero MP4 on initial HTML load | preload auto | no `src`, preload none |
| Inter font files | about 942 KB total | 93,884 bytes total |
| Coin presentation asset | 8,950,029 bytes | 14,468 bytes |

The completed HTML smoke returned HTTP 200 for the front page, company,
services, international payments, and search templates.

## Verification evidence

- 9 of 9 theme contract tests passed.
- PHP syntax check passed for every PHP file in the theme.
- Node syntax check passed for `main.js`, `navigation.js`,
  `hero-media.js`, and `third-party-loader.js`.
- Active local theme: `platejka-pagespeed`.
- The exchange-rate Cron event is registered hourly and a manual refresh
  completed with valid stored values.

## Deferred / deployment checks

- Production PageSpeed Insights could not be recorded from this environment
  because the public API returned HTTP 429. Run three mobile and three desktop
  tests after staging/production deployment and cache warm-up.
- The in-app browser screenshot command timed out, so the required 390/768/1440
  visual comparisons must be completed on staging before merge.
- A complete analytics, Callibri, Admitad, chat, CF7 submission, calculator,
  slider, modal, and conversion-event dashboard check requires staging or
  production access.
- `main.css` and `main.js` are compiled monoliths without their original
  Sass/JavaScript module sources or source maps. They were not mechanically
  split because that would make regression-safe ownership of component blocks
  unverifiable. Restore the original frontend source project before a bundle
  split.

## WP Rocket follow-up boundary

- Delay JavaScript execution candidates and exclusions.
- Remove Unused CSS eligibility and safelist.
- Cache preload and font preload reconciliation.
- WebP Express compatibility after production cache generation.
- Required exclusions for analytics, chat, Callibri, and Admitad.
