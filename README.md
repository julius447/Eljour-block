# Ampy — Eljour "Något känns fel med elen?" symptom-block

A **web-block** (not a standalone tool) for the top of every **eljour landing page** — the first thing a
worried person meets on scroll. Six symptom-chips → an honest, **severity-calibrated** risk-reveal → a
**"Ring oss"** call CTA (010-265 79 79). The conversion is the **phone call**, not a form. Toggle directly
between symptoms — no wizard.

**Live preview:** https://julius447.github.io/Eljour-block/ (works on mobile + desktop — resize the window).

Built by `/ampy`. Full pipeline record + provenance for every fact: [`docs/pipeline-record.md`](docs/pipeline-record.md).

## Files
| File | What it is |
|---|---|
| `index.html` | **Standalone prototype** — token-mirrored, self-contained, verifiable in a browser/Claude Preview. The source of truth for look + behaviour. |
| `eljour-block.css` | **Bricks-paste CSS** — binds to the global production `ap*` tokens (already defined site-wide). Paste into the section's custom CSS or Settings → Custom CSS. |
| `eljour-block.js` | **Behaviour** — the `SYMPTOMS` data + the renderer. Drop into a Bricks Code element (JS) or enqueue. Renders into any `.ampy-eljour` shell on the page. |
| `eljour-block.html` | **The static shell** (eyebrow, hook, sub, empty containers, methodology). Paste as a Bricks Code element (HTML). |

## Install (Bricks)
1. Add a **Code element** high on the eljour page; paste `eljour-block.html`.
2. Load `eljour-block.css` (Settings → Custom CSS, or the section's custom CSS).
3. Load `eljour-block.js` (the Code element's JS field, or enqueue site-wide). It auto-mounts into every
   `.ampy-eljour` on the page.

## The candour rules baked in (do NOT weaken)
- **Severity is calibrated honestly** — not every symptom is akut (2 akut · 3 "ring idag" · 1 "kan vänta").
  The honesty that *some can wait* is what makes the akut ones believable. We never inflate urgency to sell
  a callout.
- **112 before us.** Genuinely acute symptoms (brännlukt, gnistor) show **"Ring 112 först. Sedan oss."** +
  a `tel:112` link *before* the Ampy CTA.
- **No invented numbers.** The eljour price is shown as *structure* (inställelseavgift + timtaxa, sagt innan
  vi åker), never a fabricated figure. Stats are sourced (Elsäkerhetsverket 45 bränder 2023; 40 % glapp; 78 °C).
- **No "1000+ kunder", "5.0", or present "hela Sverige" coverage** — none are usable facts.
- **No em-dashes, no "!", no superlatives** (ampy-rost §8.1). Outfit only (the brand font — single-font is correct).

## Owner / dev gates before go-live
- [ ] **Footprint** — how does eljour coverage read per page? Don't let "i hela Sverige" appear if the lead
      lands outside the **27-kommun** live Stockholm-region set (national rollout = FUTURE, owner-confirmed).
- [ ] **Eljour price** — provide the inställelseavgift/jour-timtaxa figure, or confirm "quote-only".
- [ ] **Electrician sign-off** on the six symptom → risk → action mappings (especially the akut/112 calls).
- [ ] **Verify** the Elsäkerhetsverket "45 bostadsbränder 2023" stat is current/attributable before ship.
- [ ] **Analytics** — wire the `ampy_ej_*` dataLayer events behind Consent Mode v2 (consent-gated).
- [ ] (Optional) make the copy **ACF/editor-driven** — swap the `SYMPTOMS` source, keep the renderer.

## Verified (Claude Preview, desktop + mobile)
Renders clean (no console errors); akut path shows the 112-first line + the call; "vänta" path correctly
hides the 112 line; single-select; mobile re-layouts to full-width stacked chips; `prefers-reduced-motion`
honoured.
