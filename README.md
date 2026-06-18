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

## Layout / interaction (v5 — owner feedback)
- Call card order: status → lead → 4 trust bullets → **CTA at the bottom**.
- Call CTA is the **premium green gradient** (deep→medium green, white text, WCAG-AA across every stop).
- Accordion: **none open by default**, click to open, click again to close (real toggle).
- 112 lives **inside the red safety box** ("…gå ut direkt och ring 112"), not a separate button.
- Severity tags: **Akut** (red) / **Varning** (amber).
- Desktop shows 8 symptoms + **"Se fler tecken (4)"**; mobile shows all 12 (button hidden). Mobile headline centered.
- 12 symptoms now — added "Laddboxen blir varm" and "Efter åska eller överspänning".

## Production-polish passes (multi-specialist audits + ampy-syn)
Two 5–6-lens specialist audits + the ampy-syn self-seeing loop. Verdict: production-ready efter småfix. Applied:
- `inert` on collapsed panels (keyboard reached ~17 hidden tel: links → now 2); 1177 "get checked" follow-up on
  elstöt + vatten; responsive stack at 992px.
- **Safety > frequency for default visibility:** the visible 8 keep every 112/1177 symptom on screen
  (brännlukt, gnistor, elstöt, vatten); only generic-/no-emergency-number ones (surr, vitvara, laddbox, åska)
  sit under "Se fler". **"Det surrar/knäpper" promoted to Akut** + safety box (its copy calls it the #1 fire cause).
- **Green CTA darkened to pass AA** (white text was failing on the light half); dropped the hover-brightness.
- Dropped the unsourced "100 grader" on laddbox; softened elstöt's 1177 routing; tightened soft phrasings;
  pulse-ring + safety-link focus + stat contrast.

## Owner copy decisions I made (override if you disagree)
- **"inom 1 timme" softened to a goal** — kept once in the bullet ("Målsättning…inom en timme"), removed the
  duplicate from the lead. If jour genuinely guarantees one hour, say so and I'll restore the firm wording.
- **"Fast pris uppskattning" → "Tydligt pris innan vi rycker ut, inga dolda avgifter"** — eljour is inställelse +
  timtaxa (no fixed total before we see the job). If you offer a fixed jour-pris, I'll use "fast pris".
- **Overrode two crew suggestions to respect your calls:** symptoms-above-call-card on mobile (you approved the
  mobile layout) and a sub-instruction under the H2 (you said "kör bara rubriken"). Flagging, not forcing.

## Owner / dev gates before go-live
- [ ] **"Jour öppen just nu"** pulses unconditionally — fine IF the line is genuinely staffed 24/7; otherwise
  time-gate it to a neutral "Ring dygnet runt" when unstaffed.
- [ ] **Footprint** — don't show national reach if the lead is outside the 27-kommun live set.
- [ ] **Electrician / clinical sign-off** on the 12 symptom → risk → safety mappings — especially: the
  akut/112 ones, the **elstöt 112-vs-1177 cut**, the **"surrar/knäpper" = Akut** re-tier, and the **laddbox**
  framing (number was dropped pending a sourced figure).
- [ ] **Eljour price** — inställelseavgift/jour-timtaxa figure, or confirm "quote-only".
- [ ] **Trust signals** — confirm the "målsättning inom en timme" + "behörig elektriker, inte en växel" claims.
- [ ] **Analytics** — wire `ampy_ej_*` (view / symptom_select / see_more / cta_call_click / cta_112_click / cta_1177_click) behind Consent Mode v2.
- [ ] On approval → build the production Bricks-paste version (CSS/JS/shell).
