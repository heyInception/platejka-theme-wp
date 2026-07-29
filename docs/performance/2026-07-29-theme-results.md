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
- Required Header queues, identifiers, and initialization payloads preserved.
  General vendor libraries now load on first interaction or the three-second
  fallback. Marquiz and Contact Form 7 reCAPTCHA use proximity and intent; see
  `third-party-script-map.md`.
- The 8,950,029-byte `coin.svg` source is preserved. The front page now uses a
  visually checked 14,468-byte WebP presentation copy at its actual display
  size. The unreferenced 2,184,046-byte `v-globe-mobile.svg` remains unchanged.
- Calculator exchange-rate HTTP calls removed from the page-render path.
  WordPress Cron refreshes the same three endpoints hourly and the calculator
  reads the last stored values.
- Two browser-observed JavaScript initialization errors were guarded.
- Four CSS backgrounds now use existing WebP copies instead of PNG/JPEG:
  `teams/before`, `international`, `hero-mob`, and `notice`. Their combined
  source size drops from 822,423 bytes to 51,778 bytes.

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

## WordPress.com preview

Preview URL: `https://inceptionhack-amipe-studio.wp.build`

- The database contained 60 unexpected blocking script tags referencing
  `gtmpx.com` across 13 `posts`/`postmeta` rows. No matching theme or plugin
  files existed. A full SQLite backup was made outside the uploaded site and
  only those exact script tags were removed. Required Header integrations were
  not changed.
- Fresh preview HTML completes loading, contains the footer, uses the
  `platejka-pagespeed` theme, and contains no `gtmpx.com` scripts.
- The calculator recalculated 10,000 EUR successfully and the transaction
  request modal opened.
- The original preview root still served a stale WordPress.com edge-cache
  response after the update. PageSpeed and functional checks therefore used a
  cache-bypass query URL. This preview-only cache must expire or be purged
  before validating the bare preview root.

### PageSpeed Insights laboratory result

One final mobile/desktop report was recorded against the warmed cache-bypass
preview after the CSS WebP and deferred-integration changes on 2026-07-29.

| Strategy | Performance | FCP | LCP | TBT | CLS | Speed Index |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| Mobile | 56 | 5.3 s | 7.8 s | 0 ms | 0.098 | 7.8 s |
| Desktop | 73 | 0.6 s | 1.1 s | 440 ms | 0.036 | 2.5 s |

Compared with the earlier staging baseline, mobile improved from 52 to 56,
FCP from 9.2 to 5.3 seconds, LCP from 21.1 to 7.8 seconds, and TBT from 100 to
0 ms. Desktop FCP and LCP remain fast, but the agreed three-second vendor
fallback enters the desktop Lighthouse measurement window and increases TBT.
Further score work belongs to the WP Rocket delay/exclusion phase and the
remaining compiled/plugin assets.

## Deferred / deployment checks

- Recheck production once after deployment and cache warm-up; no repeated
  laboratory runs are required for this theme phase.
- Complete analytics, Callibri, Admitad, chat, CF7 submission, and conversion
  event dashboard checks in the production deployment workflow.
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
