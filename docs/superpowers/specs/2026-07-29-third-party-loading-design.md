# Deferred third-party loading design

Date: 2026-07-29  
Status: approved approach, pending written-spec review

## Context

The first staging PageSpeed run showed that theme image work improved the
mobile rendering path, but repeated runs were dominated by variable
third-party JavaScript execution. One measured mobile run attributed main-thread
work to Yandex Metrica (1,121 ms), Google reCAPTCHA (510 ms), Marquiz (419 ms),
Google tag (313 ms), and Top100 (226 ms).

All required Header integrations, identifiers, attribution data, call tracking,
chat, quiz, and form behavior must remain. This design changes only when vendor
libraries are downloaded and executed.

## Goals

- Preserve every existing integration and identifier.
- Keep analytics command queues available from the start of the document.
- Reduce work performed before the page becomes interactive.
- Load lead-generation tools before the visitor reaches or uses them.
- Prevent duplicate script insertion when several triggers fire together.
- Keep Callibri number replacement and Artfut/Admitad attribution early.

## Non-goals

- Removing or replacing analytics, counters, chat, Callibri, Admitad, Marquiz,
  or reCAPTCHA.
- Changing vendor account settings, event names, conversion payloads, or IDs.
- Changing WP Rocket settings in this theme phase.
- Refactoring plugin-owned scripts that are unrelated to the loading boundary.

## Chosen schedule

### Immediate queue and configuration layer

The small inline configuration layer remains in `header.php` and executes
immediately:

- `window.dataLayer` and the `gtag()` queue;
- the `ym()` queue and Metrica initialization command;
- `_tmr` and `_top100q` counter queues;
- Marquiz configuration data;
- attribution-cookie setup required by Admitad.

This allows calls made before a vendor library arrives to be replayed by that
library after it loads.

### Early business-critical libraries

The existing Callibri and Artfut/Admitad scripts remain early because delaying
them can break phone-number replacement or first-page attribution. Their
existing identifiers and fallback behavior remain unchanged.

### General deferred integrations

`third-party-loader.js` loads the following libraries once after the first
`pointerdown`, `keydown`, or `touchstart`, with a three-second fallback:

- Top.Mail.Ru;
- Top100;
- Yandex Metrica;
- Google tag;
- YourGood widget;
- the existing DMP sync request.

The fallback preserves tracking for visitors who read without interacting.
Interaction and fallback triggers share one idempotent start function.

### Context-triggered Marquiz

Marquiz loads when any of these conditions occurs:

- its inline container approaches the viewport, using an IntersectionObserver
  root margin of approximately 1,200 px;
- a quiz or calculation CTA is activated;
- the general three-second fallback fires on desktop.

On mobile, viewport proximity or direct interaction is preferred so the
2+ MiB quiz application does not compete with above-the-fold rendering.
Existing quiz ID, options, and inline placement remain unchanged.

### Context-triggered reCAPTCHA

Contact Form 7 reCAPTCHA assets load when a contact form approaches the
viewport or receives pointer/keyboard focus. The observer starts approximately
1,200 px before the form enters the viewport so normal scrolling provides time
for initialization.

The form must not submit until the existing Contact Form 7/reCAPTCHA
initialization path is ready. Failure continues through the plugin's standard
error handling; the theme does not bypass verification.

## Components

### `header.php`

- Retains all integration IDs and queue/configuration code.
- Stops inserting the deferred vendor network scripts directly.
- Keeps Callibri and Artfut/Admitad early.
- Exposes only the minimum configuration needed by the loader.

### `js/modules/third-party-loader.js`

- Keeps `platejkaLoadExternalScript()` as the single idempotent insertion API.
- Adds a registry of vendor sources and initialization callbacks.
- Owns interaction, timeout, and IntersectionObserver triggers.
- Removes completed event listeners and observers.
- Treats a failed optional vendor request as isolated; one failure must not
  prevent the other integrations from starting.

### WordPress enqueue/filter boundary

The theme identifies Contact Form 7 reCAPTCHA assets using registered WordPress
handles or exact official Google reCAPTCHA sources. Only those assets are moved
behind the form-proximity loader. Other Contact Form 7 scripts and styles remain
under plugin control.

## Error handling and compatibility

- Every external source is inserted at most once.
- A pre-existing matching vendor script is reused.
- Script-load failures are caught and do not create unhandled promise
  rejections.
- Queue objects remain valid if WP Rocket delays or reorders eligible scripts.
- Reduced-motion behavior is unrelated and remains unchanged.
- Required scripts are not hidden from consent, security, or attribution logic.

## Verification

Automated contract checks:

- all current IDs remain present;
- Callibri and Artfut/Admitad remain early;
- deferred vendor source URLs move to the loader;
- interaction and three-second fallback triggers exist;
- Marquiz and reCAPTCHA proximity triggers exist;
- script insertion remains idempotent.

Runtime staging checks:

- no deferred vendor library appears twice;
- queued GA and Metrica calls survive delayed library loading;
- Callibri number replacement still works;
- Admitad attribution cookie still records the source;
- Marquiz opens from its CTA and renders inline;
- the Contact Form 7 form submits successfully with reCAPTCHA;
- the chat/widget starts after interaction or fallback;
- no new console errors are introduced.

Performance checks:

- run one mobile and one desktop PageSpeed test on one warmed URL;
- report Performance, FCP, LCP, TBT, CLS, and Speed Index;
- compare third-party main-thread time with the recorded staging baseline.

## Rollback

The change is isolated to Header insertion points, the existing loader module,
and its enqueue/filter boundary. Rollback restores direct vendor insertion
without changing IDs, account settings, form markup, or stored content.
