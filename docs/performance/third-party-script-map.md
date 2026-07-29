# Third-party script map

Theme integrations were classified without changing their identifiers or event
payloads. Required early integrations remain present in `header.php`.

| Integration | Source / identifier | Schedule | Theme action |
| --- | --- | --- | --- |
| Top.Mail.Ru | `3554245`, `top-fwz1.mail.ru/js/code.js` | early async | Preserved |
| Top100 | `7731957`, `st.top100.ru/top100/top100.js` | early async | Preserved |
| Marquiz | `689b95fd327d1700199c7e16` | early async | Preserved |
| Yandex Metrika | `97235179` | early async | Preserved |
| Google Analytics | `G-765QHYK81H` | early async | Preserved |
| YourGood widget | `2d1a307b-05ec-4aec-b06e-76e872366ef5` | early defer | Preserved |
| Callibri | `cdn.callibri.ru/callibri.js` | early defer | Preserved |
| Artfut / Admitad | `af79c4ac45` | early async | Preserved with its fallback |
| DMP sync | `892d597ee76ed81ab1fbfb7f2b444b43` | interaction or idle | Scheduled by `third-party-loader.js` |
| Jivo | `oZ6zFKOOCS` | disabled | Existing commented integration remains commented |
| Chaty / plugin chat | plugin-owned | WP Rocket follow-up | Not changed by the theme |

The DMP request starts on the first pointer, keyboard, or touch interaction, or
during browser idle time with a five-second maximum delay. The loader is
idempotent, so simultaneous triggers cannot insert the integration twice.
