# Ampy — Eljour "Är något fel med elen?" symptom-block

A **web-block** for the top of every **eljour landing page** — the first thing a worried person meets on
scroll. Tryck på det du märker → ärligt, severity-calibrated besked om vad det kan betyda och vad du gör nu →
**Ring oss** (010-265 79 79). Konverteringen är samtalet, inget formulär.

**Live preview (välj upplägg):** https://julius447.github.io/Eljour-block/ — open a variant and resize the
window for mobile/desktop.

This is the **v2 redesign** after v1 was scrapped (too dark/compact/gradient-heavy, weak copy). Three
buildable directions to choose between:

| Variant | Idé | Live |
|---|---|---|
| **C · Dragspels-lista** *(rekommendation)* | ren lista, raden fälls ut på plats; mobil-native, mest scanbar | `/c/` |
| **A · Lista + lugnt svar** | meny vänster, svar höger på desktop; stackar på mobil | `/a/` |
| **B · Ett stort tydligt svar** | liten väljare + ett luftigt fokussvar i taget | `/b/` |

Each `*/index.html` is a self-contained prototype (real Ampy tokens inline). v1 is archived in `archive/v1/`.
Full v1 pipeline record: [`docs/pipeline-record.md`](docs/pipeline-record.md).

## The symptom set (researched + simplified)
Cross-checked ampy.se against five independent Swedish eljour firms. Short noun labels, three honest
severity levels — not six red alarms (that calibration is what makes the akut ones believable):

| Symptom | Allvar |
|---|---|
| Brännlukt eller rök | Akut · 112 vid rök |
| Gnistor eller smäll | Akut · 112 |
| Elstöt | Akut |
| Vatten nära elen | Akut |
| Varmt eller missfärgat uttag | Akut |
| Säkring eller jordfelsbrytare löser ut | Ring snart |
| Flimrande ljus | Ring snart |
| Strömavbrott | Kan ofta vänta |

## Design + candour rules baked in
- **Light surface, dark text, Ampy-teal only on the Ring button** (the v1 dark/green surface is gone).
- **Severity = a small high-contrast tag**, never a gradient panel wash (that was v1's readability killer).
- **One heading, no eyebrow, no paragraph.** Short noun labels, not sentences.
- **112 before us** on brännlukt/gnistor; honest talk-down on strömavbrott (often the grid, not your fault).
- **No invented price** (jour = inställelse + timtaxa, sagt innan vi åker); no "1000+/5.0/hela Sverige";
  no em-dashes, no "!", Outfit only (brand font).

## Owner / dev gates before go-live (once a variant is chosen)
- [ ] Pick the variant → I build the production Bricks-paste version (CSS/JS/shell).
- [ ] **Footprint** — don't let "i hela Sverige" show if the lead lands outside the 27-kommun live set.
- [ ] **Eljour price** — inställelseavgift/jour-timtaxa figure, or confirm "quote-only".
- [ ] **Electrician sign-off** on the eight symptom → risk → action mappings (esp. akut/112).
- [ ] **Analytics** — wire `ampy_ej_*` behind Consent Mode v2.
