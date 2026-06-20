# CLAUDE.md — agent guide for the Ampy eljour symptom-block

You are editing a **self-contained HTML/CSS/JS web-block** that sits at the top of Ampy's eljour landing
pages and converts worried visitors into a phone call. Read this before changing anything.

## Source of truth
- **`index.html`** is canonical — the whole block (markup + `<style>` + `<script>`), self-contained, the file
  QA renders. Edit this.
- `bricks/eljour-block.{css,js,html}` are **generated** from `index.html`. After editing `index.html`,
  regenerate them with the one-liner in `docs/HANDOVER.md` §9. Never let them drift.
- Full implementation details: `docs/HANDOVER.md`. Provenance for every fact: `docs/pipeline-record.md`.

## What this block is (don't redesign it)
- 13 symptoms in an accordion. Tap → honest risk text → green **Ring eljouren** CTA (`tel:`). **No form.**
- Two tiers: `sev:"akut"` (red `Akut` tag + red safety box) / `sev:"varn"` (amber `Varning` tag).
- `VISIBLE=7` → first 7 shown, the rest under "Se fler tecken (6)" (desktop + mobile).
- Conversion = the call. 112/1177 come *before* us at real fire/injury.

## Where things are (in `index.html`'s `<script>`)
- `var PHONE_DISPLAY` / `PHONE_TEL` — the jour number, change in one place.
- `var VISIBLE` — how many symptoms show before "Se fler".
- `var SYMPTOMS = [ {id, label, sev, risk, safety}, … ]` — the data. Order = display order.
  - `risk`/`safety` allow only `<b>…</b>` and `<a href="tel:112|1177">…</a>`.
  - `safety:""` = no red box. The flame icon + the row/panel/CTA/dot/tag/`inert`/analytics are auto-generated.
- `var SEV` — the tier dot-class / tag-class / **tag label** ("Akut" / "Varning").

## Hard rules — do NOT violate (this is why the block converts)

**Voice / candour** (canonical: ampy-rost):
- du-tilltal. ZERO exclamation marks. ZERO superlatives. ZERO em-dashes in visible strings (use . , :).
- `kan`/`bör` on safety, outcome, and delivery claims — never a flat guarantee.
- 112/1177 routing in the safety boxes is clinically reviewed — never remove or soften it.
- No invented numbers. Every figure must be sourceable (pipeline-record.md). Never add "1000+ kunder",
  "5.0", or present national coverage as fact.
- Keep the two tiers honestly calibrated — do not relabel common symptoms "Akut" to push urgency.

**Structure / behaviour** (intentional — don't "fix"):
- Headline is centered (a split-across-columns version was tried and rejected). Both viewports.
- The green CTA "live" pulse dot (`.eb__cta-dot`) is **mobile-only** (hidden ≥992px). Owner-confirmed.
- Accordion: none-open by default; clicking an open row closes it. Keep it.
- Severity colours (`--akut-*`, `--varn-*`, `--cta-grad`) are **block-scoped**, never global `--state-*`.
- Breakpoints are 992 / 480 only. Container `--eb-max:128rem` (Hero-2 width). Outfit font, self-hosted (no
  Google Fonts request).

**Accessibility** (keep):
- Closed panels carry `inert`; rows are `<button>` with `aria-expanded`+`aria-controls`; panels `role="region"`.
- All motion off under `prefers-reduced-motion`. Touch targets ≥44px. Severity = dot **and** word, not colour alone.

## Common tasks
- **Edit a symptom's wording:** change its `risk`/`safety` string in `SYMPTOMS`, obey the voice rules above.
- **Add a symptom:** push `{id (unique), label (short), sev, risk, safety}`. Everything else is generated.
- **Reorder:** move array items. **Change how many show:** `VISIBLE`. The "Se fler (N)" count is automatic.
- **Change the phone number:** `PHONE_DISPLAY` + `PHONE_TEL`.
- **Grounding stat** appears twice (`.eb__ground--d` desktop, `.eb__ground--m` mobile) — keep them identical.

## After any change
1. Re-sync `bricks/*` from `index.html` (HANDOVER §9).
2. Verify: 13 rows in order; "Se fler tecken (6)"; a symptom opens then closes; `tel:` links dial; Tab reaches
   only the open CTA; pulse dot mobile-only; reduced-motion stops animation; no console errors.
3. Grep for em-dashes (`—`) and `!` in visible strings — there must be none.

## Bricks/WordPress
Ships into Bricks as plain HTML/CSS/JS. Fast path: one Code element (Execute code) with the `<style>` +
`<section>` + `<script>`. Production path: enqueue `bricks/eljour-block.css|js` in the child theme + place the
markup. Token map + global-rule scoping in `docs/HANDOVER.md` §4–§5.
