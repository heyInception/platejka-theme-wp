# Third-party script map

Theme integrations were classified without changing their identifiers or event
payloads. Required early integrations remain present in `header.php`.

| Integration | Source / identifier | Schedule | Theme action |
| --- | --- | --- | --- |
| Top.Mail.Ru | `3554245`, `top-fwz1.mail.ru/js/code.js` | first interaction or 3 s | Queue and identifier preserved |
| Top100 | `7731957`, `st.top100.ru/top100/top100.js` | first interaction or 3 s | Queue and project preserved |
| Marquiz | `689b95fd327d1700199c7e16` | near block/CTA; desktop 3 s fallback | Options and identifier preserved |
| Yandex Metrika | `97235179` | first interaction or 3 s | Queue and init preserved |
| Google Analytics | `G-765QHYK81H` | first interaction or 3 s | `dataLayer`, function, and config preserved |
| YourGood widget | `2d1a307b-05ec-4aec-b06e-76e872366ef5` | first interaction or 3 s | Identifier preserved |
| Callibri | `cdn.callibri.ru/callibri.js` | early defer | Preserved |
| Artfut / Admitad | `af79c4ac45` | early async | Preserved with its fallback |
| DMP sync | `892d597ee76ed81ab1fbfb7f2b444b43` | first interaction or 3 s | Scheduled by `third-party-loader.js` |
| Contact Form 7 reCAPTCHA | plugin-owned handles | near form or form interaction | External tags replaced with inert placeholders and activated once |
| Jivo | `oZ6zFKOOCS` | disabled | Existing commented integration remains commented |
| Chaty / plugin chat | plugin-owned | WP Rocket follow-up | Not changed by the theme |

General vendor requests start on the first pointer, keyboard, or touch
interaction, with a three-second fallback. Marquiz and reCAPTCHA additionally
use proximity and form/CTA intent. The loader is idempotent, so simultaneous
triggers cannot insert an integration twice.
