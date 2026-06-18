# Ampy — Eljour "Är något fel med elen?" symptom-block

A **web-block** for the top of every **eljour landing page**. A worried visitor taps the symptom they
notice → an honest, grounded explanation of the **real risk** → **call the eljour** (010-265 79 79). The
conversion is the phone call — no form. The block leads the customer **to us** (we come out and fix it), it
does not teach them to DIY-fix.

**Live preview:** https://julius447.github.io/Eljour-block/ — resize the window for mobile/desktop.

`index.html` is the self-contained prototype (real Ampy tokens inline). v1 and the three exploratory
wireframes (A/B/C) are kept in `archive/`. Full v1 pipeline record: [`docs/pipeline-record.md`](docs/pipeline-record.md).

## This is v2 (the chosen direction C, rebuilt on owner feedback)
- **Full site-container width** (`--eb-max: 128rem` / 1280px, matches Hero-2) — no longer a thin centered list.
- **Two-pane desktop:** a sticky left value+call panel (always-visible number, `Ring eljouren`, trust
  signals) beside the symptom accordion. Collapses to a stack on mobile **with a fixed bottom call bar**.
- **Leads to the call, not DIY.** Removed the self-troubleshooting steps. Every expanded answer is
  risk-forward and ends in `Ring eljouren`; the call is repeated in the sticky panel and the mobile bar.
- **Recalibrated to two tiers that both call us:** `Akut` (red) and `Ring oss` (amber). Dropped the
  "kan ofta vänta" tier that sold the call away (strömavbrott is now `Ring oss`, not dismissed).
- **Premium + warm + light:** white surfaces, generous space, Ampy-teal only on the call actions, severity as
  a small tag (no gradient wash), the top symptom open by default so the wide canvas looks populated.

## Symptom set (researched across 5 SV eljour firms + Elsäkerhetsverket)
10 symptoms, short labels, risk grounded in how electricians/authorities describe each.

| Symptom | Tier |
|---|---|
| Brännlukt eller rök | Akut (112 vid rök/lågor) |
| Gnistor eller smäll | Akut (112) |
| En maskin ryker eller luktar bränt | Akut (112 vid brand) |
| Elstöt | Akut (112 vid andnings-/hjärtbesvär/pacemaker) |
| Vatten nära elen | Akut |
| Varmt eller missfärgat uttag | Akut |
| Säkring eller jordfelsbrytare löser ut | Ring oss |
| Det surrar eller knäpper i elcentralen | Ring oss |
| Flimrande ljus | Ring oss |
| Strömavbrott | Ring oss |

Grounding stat (cited): ~1 800 elrelaterade bostadsbränder/år, most starting from a glappkontakt
(Elsäkerhetsverket). Added vs v1: rykande vitvara, surrande/knäppande central; elstöt + vatten kept.

## Candour rules baked in (do NOT weaken)
- 112 before us on fire/injury; honest grid-vs-you framing on strömavbrott; no invented eljour price
  (inställelse + timtaxa, sagt innan vi åker); no "1000+/5.0/hela Sverige"; no em-dashes/"!"; Outfit only.

## Owner / dev gates before go-live
- [ ] **Footprint** — don't show national reach if the lead is outside the 27-kommun live set.
- [ ] **Electrician sign-off** on the 10 symptom → risk → safety mappings (esp. the akut/112 ones + elstöt 1177/112 cut).
- [ ] **Eljour price** — inställelseavgift/jour-timtaxa figure, or confirm "quote-only".
- [ ] **Trust signals** — confirm "inom en timme" + "behörig elektriker, inte en växel" as live claims.
- [ ] **Analytics** — wire `ampy_ej_*` behind Consent Mode v2.
- [ ] On approval → build the production Bricks-paste version (CSS/JS/shell).
