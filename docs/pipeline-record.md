# Eljour · "Något känns fel med elen?" symptom → risk-reveal BLOCK — build v1

> Produced by the `/ampy` conductor running the full pipeline IN ORDER:
> `ampy-marknadsanalys → ampy-wireframe-ux → ampy-webb-playbook → BUILD (ampy-design-system +
> ampy-rost + ampy-foretagsdata) → ampy-granskning → ampy-ux-polish → ampy-slutaudit`.
> **Asset type:** a **web-BLOCK** (not a standalone tool, not a calculator, not a full diagnostic) that
> sits HIGH on the eljour landing pages — the first thing a worried person meets on scroll.
> **Mechanic:** symptom-chips → an honest, severity-calibrated risk-reveal → "Ring oss"-CTA. The
> conversion is the **phone call**, not a form. **Commercial priority:** eljour is part of the **#1
> vertical** (service > laddbox > battery — foretagsdata strategic spine).
> **Built + verified** in `eljour-block/` (prototype `index.html` driven in Claude Preview; production
> paste files `eljour-block.css` / `.js` / `.html`). Every fact carries its tag + `src:`.

---

## 0. GROUNDING PROOF (blocking gate — CLAUDE.md §0 rule 0; ampy-marknadsanalys §0)

**Live URLs fetched (via WebFetch, this run, 2026-06-18):**
- `https://ampy.se/eljour/` — the emergency/akut page (hero, response-time promise, price structure, symptom list)
- `https://ampy.se/elcentral-varningssignaler/` — the symptom→cause→danger→action source article (the
  one the §8.3 gold-voice samples are pulled from)

**Real assets opened / observed-read this run:**
- `ampy-foretagsdata.md` §1–§11 (the data layer; the canonical §11 design blocks)
- `research/builds/service-eljour-precedent-v1.md` (the sibling service/eljour precedent — the direct
  ancestor; its device is the two-state response strip, a *different* device from this block's)
- `visste-du-att/` (`index.html` + `.css`) — the closest shipped **web-block** delivery pattern
  (token-mirrored standalone prototype + a Bricks-paste scoped CSS); this build copies that pattern

**What I actually observed (one paragraph).** The eljour vertical is live: `/eljour/` leads with
**"Eljour dygnet runt i hela Sverige!"** and the sub **"Strömlöst, luktar det bränt eller har en säkring
gått som inte går att återställa? Vi finns här när du behöver oss som mest."** It lists exactly the symptom
set the brief names — *Totalt strömavbrott · Lukt av bränd plast · Sprakande ljud i väggar · Säkring som
löser ut konstant · Fladdrande belysning · Uttag som känns varma vid beröring* — and makes two true,
ownable promises: **"en jourmontör inom el ska vara på plats hos dig inom en timme efter ditt samtal"**,
**"dygnet runt, året om"**, plus the price-candour line **"Vi redovisar alltid våra priser tydligt så att
du tryggt kan anlita en elektriker akut utan dolda avgifter"** (structure = inställelseavgift + timtaxa för
jourtid). It does **not** carry an explicit 112 protocol. The `elcentral-varningssignaler` article supplies
the technically-correct mapping for each symptom — burnt smell = loose connection near ignition ("Slå av
huvudbrytaren direkt"; 112 if smoke); arc/spark = ljusbåge at thousands of degrees; flicker = neutral fault
(**"40 procent av alla surrande centraler vi rycker ut på har glapp i noll- eller fasskena"**); warm
surfaces should never pass **78°C**; fuses = overload (delay) vs short (immediate, **"Lämna säkringen
avslagen"**, **"Två återställningar är taket"**); and the grounding stat **"Elsäkerhetsverket registrerade
45 bostadsbränder med elcentral som startobjekt under 2023."** **What's usable:** the inom-en-timme /
dygnet-runt / price-honesty claims are true and ownable; the symptom→risk content is real and sourced.
**What's fragile:** the live "i hela Sverige" is the roadmap claim, not today's reach (national rollout =
FUTURE; live coverage = the 27-kommun Stockholm-region set — owner-confirmed, foretagsdata §1.2/§3.7); and
the live page leans on the unverified "1000+/5.0" scaffolding the candour gate forbids asserting.

> **Avviker medvetet från live (stated divergence — webb-playbook §3):** (1) we do **not** assert "i hela
> Sverige" present coverage, "1000+ kunder", or "5.0" — none are usable facts; (2) we add the explicit
> **"vid lågor/rök, ring 112 först"** safety line the live page omits; (3) we phrase inom-en-timme as a
> **mål/target** ("vi har som mål"), not a guarantee, per the "kan"-on-promises rule (§8.1).

---

## 1. `ampy-marknadsanalys` — verdict + archetype (real artifact, not a tick)

**ASSET (one-line restatement):** a high-on-page **web-block** that matches what an anxious eljour visitor
*sees* (six familiar symptoms) with what it *can really mean*, honestly calibrated by severity, converting
to a phone call (010-265 79 79). Lighter spine than a calculator: hook + chip → risk-reveal + one CTA.

**ASSUMED QUERY/INTENT SHAPE:** the visitor is **already on an eljour landing page** in a moment of worry
(transactional/akut intent, not a SERP-discovery query). The block is **not** the page's SEO engine — it is
the **conversion device** at the top of an already-ranking page. Archetype = a **diagnostic-lite web-block**
(a relative of Arketyp B — a *verdict/severity*, no number), but trimmed to a block, not a wizard tool.
[FACT, src: foretagsdata §4.1 archetype taxonomy + diagnostic family]

| Lens | Score | Reason (cites real data) |
|---|---|---|
| **IMPACT** ×3 | **5/5 → 15** | Eljour is part of the **#1 commercial vertical** (service) and this catches the **hottest possible intent** — a person in the second of worry, ready to call. The block branches *behaviour* by real situation (akut → 112-then-call; vänta → talk-down). The conversion is the highest-value action Ampy has (an akut utryckning). [FACT, src: foretagsdata strategic spine; §3.7 eljour] |
| **SEO·E-E-A-T** ×3 | **4/5 → 12** | As a block it doesn't win a SERP itself, but it adds genuine **E-E-A-T depth** to the eljour page: real field authority ("vi rycker ut på"), the Elsäkerhetsverket 45-bränder anchor, the 40%-glapp stat, technically-correct mechanism. Can carry FAQPage/HowTo-flavoured content honestly. Held off 5 because the SEO lift is the host page's, not the block's. [FACT, src: §1.4 byline system; article crawl] |
| **SHAREABILITY** ×2 | **4/5 → 8** | Strongly forwardable for a tradesperson (audience B): an honest, severity-calibrated "here's what your symptom can mean and when it's NOT an emergency" block is exactly the *underlag that does his explaining* and survives peer scrutiny — it tells the customer the truth so he doesn't have to argue. The "allt är inte akut" talk-down is the elporr-clean honesty he can post. [INFERENCE, src: §7.2 forward mechanic] |
| **AD-POTENTIAL** ×2 | **4/5 → 8** | A durable **Problem-Solution** opener (akut symptom → "en jourmontör inom en timme, fast pris, inga dolda avgifter") sustained by an **Explainer** (when is it 112 vs eljour vs can-wait). Sits on the durable white-space corners: candour-as-OS + no urgency-inflation. Not a 5 only because it's a block, not a campaign. [src: §2.5 ad spine] |
| **TOTAL** | **43/50** | |

**VERDICT: SHIP.** Top-priority vertical, hottest intent, the candour calibration is a category-of-one
move (no competitor tells a panicking visitor "this one can wait"). No adjacent build replaces it.

**HIGHEST-LEVERAGE CHANGE vs the live page:** make the **severity calibration the visible spine** — refuse
to scream "EMERGENCY" at every symptom. The honesty that *some symptoms can wait* is exactly what makes the
*akut* ones believable, and it is the one thing a competitor (and the live page) won't do.

**GAPS the score is provisional on:** eljour timtaxa/inställelseavgift figure = `[GAP]` (show structure,
never invent); footprint = 27-kommun set, not "hela Sverige" (owner-confirmed); no rights-cleared social
proof (use the Elsäkerhetsverket stat, never "1000+/5.0").

---

## 2. `ampy-wireframe-ux` — REGISTER FIRST, then structure (real artifact)

### REGISTER (named before any layout)
**High-stakes → serious-careful, but warm where the truth is good (foretagsdata §8.1c).** This is a
safety/akut surface, so the serious register governs: calm, concrete, "kan" on safety, no urgency theatre.
But the calibration itself delivers **relief**: "allt är inte en nödsituation, men en del är" and the
talk-downs ("ofta ofarligt", "kan oftast vänta") are warm, grounded good-news beats (§8.1b). The visual
register is the midnight/serious surface (the akut card colour from the service precedent §6).

### DIVERGENCE BEFORE CONVERGENCE — ≥3 genuinely different directions (the blocking artifact)

**Direction A — "Faro-kalibreringen" (the severity-calibrated reveal).** Each chip reveals a risk-slide
carrying an **honest severity verdict** — *Akut: agera nu* / *Ring oss idag* / *Kolla först: ofta ofarligt*
— so the device's whole reason to exist is that it tells you *which* symptom is the house-fire one and which
can wait. The candour gate made visible: it talks you DOWN where the truth is calm, up only where it's real.
*Remembered:* "it told me honestly whether to panic."

**Direction B — "Det du ser ↔ det det kan vara" (the see/mean split).** A literal appearance-vs-reality
reveal: left = the plain symptom, right = the hidden mechanism + the danger you'd dismiss ("a warm outlet
looks harmless; it's a connection heating toward ignition"). Mechanism-forward, educational (§8 "mechanism
explained, not asserted"). *Remembered:* "the thing I'd have ignored was the dangerous one."

**Direction C — "Akut-trappan" (symptom → one action → call).** Minimal: each chip surfaces the single most
important ACTION (slå av huvudbrytaren / lämna säkringen av / 112 vid rök) then Ring oss. Action-first,
least text, fastest for a panicking person. *Remembered:* "I knew exactly what to do in the next 5 seconds."

**PICK — A as the spine, B's mechanism inside each slide, C's one-action as the closing beat (and WHY).**
A wins because it is the only direction that implements the brief's explicit constraint — *"vi överdriver
aldrig brådskan för att sälja ett utryck"* — as the **central device**: an honest severity verdict is the
opposite of urgency-inflation, and it's the category-of-one move. B supplies the educational mechanism (what
it really means — the §8 honesty), and C supplies the one concrete action and the 112-first rule. The
strongest asset is all three layered: **severity verdict → what it can mean → the danger → do this now →
Ring (112 first if acute).** This also satisfies quality-bar point 1 (segment changes the LOGIC): the chip
changes the severity, the action, AND whether a 112-first line precedes the CTA — branching behaviour, not
a relabel.

### TASTE-PROBE (written answers — the design pre-flight, anti-theatre evidence)
- **The one thing the visitor remembers:** "Ampy told me honestly whether to panic — and exactly what to do."
- **The anti-pattern we refuse:** a red "EMERGENCY — CALL NOW" screamer on every symptom (urgency theatre to
  sell a callout). Banned by the brief and the candour gate. Calibration replaces it.
- **The reference/feeling:** the calm senior electrician at the door — "okej, det här kan vänta; men *det
  här* slår vi av huvudbrytaren på direkt." Serious, never panicky.
- **The signature device (one only):** the symptom-chip → **severity-calibrated risk-reveal**. No second
  hero device; ornament stays in the bolt glyph (§9.6).
- **What would make a sharp electrician call it slop — and how we dodge it:** inventing a jour price; calling
  a single tripped fuse an emergency; saying "försäkringen gäller inte" flatly; a generic red alert box on
  everything. We dodge all four: price = structure only (`[GAP]` not faked); fuse = "vänta/snart" with the
  "två återställningar är taket" rule; insurance left out (only "kan" if used); severity is calibrated.

### Slot order (the block spine — hook → match → reveal → act; serious register)
```
[EYEBROW] bolt glyph · "Eljour · dygnet runt"
[HOOK H2] "Något med elen känns fel? Tryck på det du märker."
[SUB]     "Vi matchar det du ser med vad det faktiskt kan betyda, ärligt.
           Allt är inte en nödsituation, men en del är. Ser du lågor eller rök: ring 112 först."
[CHIPS]   6 symptom pills — toggle directly, single-select, NO wizard
[REVEAL]  ← the ONE signature device (severity-calibrated)
          severity verdict pill  →  Vad det kan betyda  →  Faran  →  Gör så här nu (one action)
          → [if akut] "Ser du lågor eller rök? Ring 112 först. Sedan oss."  → Ring 010-265 79 79
          → trust micro-line (dygnet runt · mål inom en timme · inställelse+timtaxa, inga dolda avgifter)
[FOOT]    <details> "Så bedömer vi det här" — vägledning ej besiktning; 45-bränder anchor; 112 före oss
```

---

## 3. `ampy-webb-playbook` — composition: profile, ONE device, friction, instrumentation (real artifact)

**PROFILE:** a **routing web-block** (webb-playbook §3) — top-of-page, value-first, routes to a channel
(the phone). Unlike the service geo *page*, this block carries **no lead form at all**: the conversion is
the call (the brief: "Konverteringen är samtalet, inte ett formulär"). Lowest possible friction for a
person mid-worry.

**THE ONE SIGNATURE DEVICE — the symptom → severity-calibrated risk-reveal.** It dramatises the real pain:
*"I'm seeing something scary and I don't know if it's about to start a fire or if it can wait."* It resolves
it with an honest verdict + mechanism + one action. It is **not a computed number** (correct — this
archetype has no payback). One device only; ornament = the bolt glyph (§9.6). **No urgency theatre.**

> **This is a NEW signature-device precedent** (the canonical §11.2 table holds calculator/diagnostic
> devices + the service two-state strip). Registering it: **vertical = service/eljour · device = symptom-chip
> → severity-calibrated risk-reveal (akut/snart/vänta verdict + mechanism + one action + 112-first gate) ·
> pain = "is this the one that burns the house down, or can it wait?"** Sibling to (not the same as) the
> service two-state response strip. Feed back to foretagsdata §11.2 if adopted.

**FRICTION (calibrated):** whole value renders on load, no gate; the only action is a **`tel:` link** (no
form); akut symptoms surface a **`tel:112`** link BEFORE the Ampy number — Ampy never asks to be called
ahead of the fire service. Exactly one Ampy CTA per reveal; the talk-down states carry no hard sell.

**INSTRUMENTATION (instrument to learn, honestly):** vendor-agnostic `dataLayer`, prefix `ampy_ej_*`. Funnel:
`view → symptom_select{which,severity} → cta_call_click → cta_112_click`. The `symptom`+`severity` of the
converters is the key learn (which worry drives akut calls). **Consent-gate** every non-essential event
(Consent Mode v2). Candour is the moat, never an A/B variable (you may test the hook verb; you may NEVER
test an urgency-inflated variant). Close the funnel to **calls / akut bookings**, not chip-clicks.

---

## 4. BUILD — ampy-design-system × ampy-rost × ampy-foretagsdata (real strings + tokens)

### 4.1 Surface (real production tokens)
- Midnight `#090b32` card (serious/akut register) · teal `#00a991` action · page bg `#f5f9ff` · white text.
  Scoped severity hues (NEVER global `--state-*`, per §11.2 LED rule): akut coral `#ff6f61`, snart amber
  `#ffc24b`, vänta emerald `--apemerald-flow #39c281`. [FACT, src: §9.2]
- Outfit, fluid `aptext-*` on `html{font-size:62.5%}` (1rem=10px); H2 = `--aptext-2xl`. **Single font is
  correct** — Outfit is canonical (§9.4); a second display face would break the system. [FACT, src: §9.4]
- Token defects handled (§11.4): explicit shadow supplied (no `--shadow-primary`→`#bebebe` fallback); no
  `--apspace-4xs`; breakpoints 992/768/480 (never 380).
- **Severity = environmental tint**, not a side-stripe (the lone colored left-border is the AI-UI tell —
  removed; the hue washes the whole panel, reinforcing the labelled pill).
- **Mobile (structural):** chips go full-width and stack; reveal min-height drops; brand-glow re-anchored
  top-centre (a desktop glow stretched edge-to-edge becomes a muddy wash). [src: §11.3 mobile re-tune]

### 4.2 Voice (ampy-rost — serious register, warm on the good news; zero "!", no superlatives, NO em-dashes)
Hook + sub, the six symptom slides, the trust line, and the methodology `<details>` are authored in the
candour voice — see `eljour-block/eljour-block.js` (SYMPTOMS array) and `.html` for the verbatim strings.
Voice load-bearing choices: **"Allt är inte en nödsituation, men en del är"** (calibration as relief);
**"Två återställningar är taket"** [§8.2]; **"Slå av huvudbrytaren"** [§8.3]; **"vi har som mål att en
jourmontör är på plats inom en timme"** ("kan/mål" on the promise, not a guarantee); **"Ser du lågor eller
rök? Ring 112 först. Sedan oss."** (112 before us — the brief's explicit honesty). **No em-dashes in UI**
(§8.1) — verified: every UI string uses period/comma/colon.

### 4.3 Facts (every number tagged; all grounded this run)
- Phone 010-265 79 79 / `tel:+46102657979` [FACT §1.2] · eljour inom en timme (mål), dygnet runt året om
  [FACT url:/eljour/] · inställelseavgift + timtaxa, "inga dolda avgifter" [FACT url:/eljour/] · "Två
  återställningar är taket" [FACT §8.2 + article] · "Slå av huvudbrytaren" [FACT §8.3 + article] · 40 %
  surrande centraler glapp i noll-/fasskena [FACT article] · ytor i central aldrig > 78 °C [FACT article] ·
  ljusbåge = tusentals grader [FACT article] · Elsäkerhetsverket 45 bostadsbränder med elcentral som
  startobjekt 2023 [FACT article].
- **Never asserted:** "1000+ kunder", "5.0", "i hela Sverige" present coverage (roadmap/`rights:unclear`,
  §5/§1.2). Eljour timtaxa = `[GAP]` (structure only, not invented).

---

## 5. `ampy-granskning` — adversarial review (severity-ranked findings on THIS build)

| # | Sev | Lens | Finding | Resolution in this build |
|---|---|---|---|---|
| 1 | **Blocker** | TRUTH/RED-TEAM | Urgency-inflation: treating every symptom as a 112 emergency to drive callouts — the exact move the brief forbids. | **Designed out.** Severity is honestly calibrated (2 akut, 3 snart, 1 vänta) with explicit talk-downs ("ofta ofarligt", "kan oftast vänta"). The calibration IS the device. |
| 2 | **Blocker** | TRUTH | At a real fire the block must not put Ampy ahead of the fire service. | Akut slides render **"Ring 112 först. Sedan oss."** + a `tel:112` link *before* the Ampy CTA. Verified in preview (emergency path). |
| 3 | **Major** | TRUTH | Inventing an eljour timtaxa/utryckning price = fabrication (`[GAP]`). | Price shown as **structure** ("inställelseavgift plus timtaxa, sagt innan vi åker"); no number. |
| 4 | **Major** | TRUTH | Asserting "i hela Sverige" / "1000+ kunder" / "5.0" — roadmap/`rights:unclear`. | None asserted. Authority = the Elsäkerhetsverket 45-bränder anchor + real field stats only. Footprint flagged as an owner gate. |
| 5 | **Major** | VOICE | Em-dashes in UI (banned, §8.1); homepage exclamatory drift leaking in. | All em-dashes stripped (verified grep — only code comments retain them); zero "!"; warmth carried by the true claim. |
| 6 | **Minor** | VOICE | A flat "försäkringen gäller inte" reverses burden of proof (marknadsföringslagen). | Insurance claim omitted entirely; safety stated as action ("slå av huvudbrytaren"), not a threat. |
| 7 | **Minor** | DESIGN | Lone colored left-border on the reveal = generic AI-UI tell (impeccable hook flagged). | Replaced with an **environmental severity tint** across the panel (carries meaning, reinforces the pill). |
| 8 | **Minor** | CONVERSION | A stale fade-timer could flash the wrong slide on rapid chip-mashing. | `swap()` clears any pending timer — only the latest selection paints. |

**Granskning verdict:** the two TRUTH blockers are *designed out* (the calibration + the 112-first gate ARE
the build, not flags on it). No remaining blocker.

---

## 6. `ampy-ux-polish` — craft pass (the small honesties + motion)
- **Motion:** card `fadeIn` on enter-view (runOnce, ≤300ms, IntersectionObserver, `prefers-reduced-motion`
  honoured); slide swap = a single 140ms cross-fade, cancelled on re-select. No count-up (no computed number).
- **No layout shift:** reveal carries a `min-height` so toggling between symptoms never jumps the page.
- **Register legible at a glance:** the severity hue (coral/amber/emerald) tints the panel + the pill, so
  "this can wait" vs "agera nu" reads pre-attentively, not just in words.
- **Touch targets ≥44px** on chips and the call button; chips go full-width on mobile.
- **Honesty that must match:** the methodology `<details>` (vägledning, ej besiktning; 112 före oss) states
  the same severity discipline the chips enact — no drift between the device and its disclosure.

## 7. `ampy-slutaudit` — go / no-go gate (real verdict)

**5-point quality bar (BINARY — foretagsdata §11.1):**
1. **Leads with who it's for (logic, not copy)** — **PASS.** The chip branches severity, the action, AND the
   112-first gate — behaviour, not a relabel.
2. **ONE signature device dramatising the real pain** — **PASS.** The severity-calibrated risk-reveal; one
   device, no computed-number imposter, dramatises "is this the house-fire one or can it wait?".
3. **Honest, specific copy, real nouns + numbers, 2026-current** — **PASS.** 40 %, 78 °C, 45 bränder, "två
   återställningar", phone — all `[FACT]`; no superlatives, no "!", no em-dashes; jour price = structure
   (`[GAP]` not faked).
4. **Form friction calibrated** — **PASS.** Value free on load; no form at all; the only action is `tel:`;
   112 before the Ampy CTA on akut; one CTA per reveal; talk-downs carry no sell.
5. **Instrumented to learn, honestly** — **PASS (spec'd).** `ampy_ej_*` funnel, consent-gated, symptom +
   severity carried, closed to calls.

**LAUNCH-GATE conditionals (owner/dev before a real page ships — not blockers for the build):**
- [ ] **Footprint** — confirm how eljour coverage reads per landing page; do not let "i hela Sverige" leak
      onto a page if the lead lands outside the 27-kommun live set (owner-confirmed national = FUTURE).
- [ ] **Eljour price** — provide the inställelseavgift/jour-timtaxa figure or confirm "quote-only" (fills `[GAP]`).
- [ ] **Verify the Elsäkerhetsverket 45-bränder stat** is current/attributable before it ships as the anchor.
- [ ] **Electrician sign-off** on the six symptom→risk→action mappings (esp. the akut/112 calls) — the
      Elcentral-kollen lesson: a behörig elektriker signs the truth table.
- [ ] **Analytics** container + consent wiring (`ampy_ej_*`, Consent Mode v2).
- [ ] **OG/social** unaffected (block, not a page) — n/a.

**VERDICT: GO (as a built, verified BLOCK).** All five quality-bar points pass; both TRUTH blockers are
designed out; the prototype is verified working in Claude Preview (akut path shows the 112-first line + the
call; vänta path correctly hides it; mobile re-layouts cleanly). The launch-gate conditionals above are
real owner/dev config, not build defects.

---

## 8. Precedent line (register alongside the service two-state strip)

**vertical = service / eljour · asset = high-on-page web-block (not a tool/calculator/wizard) · device =
symptom-chip → severity-calibrated risk-reveal (honest akut/snart/vänta verdict + mechanism + one action +
112-first gate) · conversion = the phone call, no form · the pain it dramatises = "is this the one that
burns the house down, or can it wait?"**

**The one durable lesson:** at the eljour anxiety moment the conversion move is **honest calibration, not
urgency** — telling a worried person that *some* symptoms can wait is exactly what makes the akut ones
believable, and it's the category-of-one move no competitor (or even the live Ampy page) makes. Candour
sells the callout precisely because it refuses to oversell it.
