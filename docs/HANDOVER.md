# Eljour symptom-block — developer handover (Bricks / WordPress)

**For:** Chris (+ AI agent). **Goal:** drop this block at the top of the eljour landing pages on ampy.se.
**Stack:** plain semantic **HTML + CSS + vanilla JS** — no framework, no build step, no dependencies, no
external requests. It is designed to paste straight into Bricks.

**Live reference (what it must look like):** https://julius447.github.io/Eljour-block/
(open it, resize to mobile/desktop, click the symptoms — that rendered page is the spec.)

---

## 1. What the block does (30 seconds)

A worried visitor on an eljour page taps the symptom they notice in an accordion → gets an honest, short
explanation of what it can really mean → calls the jour line. **The conversion is the phone call
(`tel:010-265 79 79`). There is no form.** Two severity tiers (`Akut` red / `Varning` amber); every panel
ends in the green **Ring eljouren** CTA. On real fire/injury the copy says 112/1177 *before* us — that
honesty is the point, do not weaken it.

---

## 2. Files in this folder

| File | What it is |
|---|---|
| `../index.html` | **Canonical source of truth** — the whole block, self-contained, paste-ready. If in doubt, this file wins. |
| `bricks/eljour-block.html` | Just the markup (`<section class="eb">…`) — the static shell. The symptom list is rendered by the JS. |
| `bricks/eljour-block.css` | Just the styles (extracted from `index.html`). |
| `bricks/eljour-block.js` | Just the script — the symptom **data + render + interactions + analytics**. |
| `docs/pipeline-record.md` | Provenance: every fact/number with its source. Read if you need to know *why* a line says what it says. |
| `../README.md` | One-screen overview. | `../CLAUDE.md` | Rules for the AI agent editing this. |

> The three `bricks/*` files are generated from `index.html`. If you change `index.html`, re-split it (see §9).
> If you edit the `bricks/*` files directly, keep `index.html` in sync — it's the file QA renders.

---

## 3. Fastest path to live — one Bricks Code element

1. Edit the eljour page (or its Bricks template). Add a **Code** element where the block should sit (top).
2. Enable **Execute code** on the element (Bricks gates this to allowed roles — *Bricks → Settings →
   Custom code* must permit code execution for your user).
3. Paste, in this order, into the Code field:
   - `<style>` … contents of `bricks/eljour-block.css` … `</style>`
   - contents of `bricks/eljour-block.html`
   - `<script>` … contents of `bricks/eljour-block.js` … `</script>`
   (or simply paste everything inside `<body>` from `index.html` — same thing.)
4. Save → preview on desktop and a real phone. Done.

This works immediately because the block is self-contained (it ships its own tokens). See §5 for the cleaner
production option.

---

## 4. Recommended production path — enqueue assets + markup

More maintainable and cache-friendly:

1. **Assets:** copy `bricks/eljour-block.css` and `bricks/eljour-block.js` into the child theme (e.g.
   `/wp-content/themes/<child>/assets/eljour/`). Enqueue them **only on eljour pages**:
   ```php
   add_action('wp_enqueue_scripts', function () {
     if (! is_eljour_page()) return; // your own condition (template, slug, or a body class)
     $u = get_stylesheet_directory_uri() . '/assets/eljour/';
     wp_enqueue_style('ampy-eljour-block', $u.'eljour-block.css', [], '1.0.0');
     wp_enqueue_script('ampy-eljour-block', $u.'eljour-block.js', [], '1.0.0', true); // in footer
   });
   ```
2. **Markup:** place `bricks/eljour-block.html` via a Bricks **Code** element (Execute code), a shortcode,
   or a reusable Bricks template. The JS finds `<ul id="ebList">` and renders the symptom list into it.
3. **Scope the global rules out of the enqueued CSS** (see §5) so it doesn't touch the rest of the page.

---

## 5. Design tokens (and how to make it theme-native)

The block defines its own tokens in a `:root{}` block at the top of the CSS. **The hex values already match
Ampy's production palette**, so it is on-brand as-is. The mapping, if you want to bind to the global `--ap*`
variables instead:

| Block token | Value | Ampy production token |
|---|---|---|
| `--bg` | `#f5f9ff` | `--apsky-mist` (site background) |
| `--surface` | `#ffffff` | white / card surface |
| `--ink` | `#090b32` | `--apmidnight-blue` (headings/text) |
| `--ink-body` / `--ink-soft` | `#3b3f59` / `#5f6480` | body / muted text |
| `--teal` / `--teal-dark` / `--teal-pill` | `#00a991` / `#0a8f7c` / `#0a6e58` | `--apteal-core` family |
| `--line` | `#e6ecf6` | hairline border |
| font | `"Outfit"` | brand font (self-hosted — **do not add a Google Fonts request**) |
| `--r` / `--r-l` / `--r-s` | 1.4 / 2 / 1rem | `--apradius-m` / `-l` / `-s` |
| `--eb-max` | `128rem` (1280px) | `--apmax-screen-width` (matches the Hero-2 container) |

**Scoped, intentional, NOT global tokens** (leave them as block-local — they are device-specific per the
design system): `--akut-*` (red tier), `--varn-*` (amber tier), `--cta-grad` (the green CTA gradient).
A severity colour must never become a global `--state-*` token.

**Global rules to handle for the enqueue path.** The first lines of the CSS are page-global:
- `html { font-size: 62.5%; }` — sets `1rem = 10px`. Ampy's theme already does this (same value) → safe to
  keep, or delete if enqueuing site-wide.
- `*,*::before,*::after { box-sizing:border-box; }` — standard reset; keep or rely on the theme.
- `body { margin:0; background:var(--bg); … }` — in the standalone this paints the section background. For
  production, **delete the `body{}` rule and add `background:var(--bg);` to the `.eb` rule** so the block
  carries its own background and touches nothing else. (Ampy's page bg is already `#f5f9ff`, so even without
  this the block blends in.)
- Everything from `.eb {` onward is already scoped to `.eb*` — safe.

---

## 6. The symptom data model (this is what you'll edit most)

All symptoms live in one array in `eljour-block.js`:

```js
var SYMPTOMS = [
  { id:"sakring", label:"Säkring löser ut", sev:"varn",
    risk:"… <b>bold key term</b> …",          // HTML allowed: <b>, and <a href="tel:112">112</a>
    safety:"" },                                // "" = no red box (varn). akut ones get a red safety box.
  …13 in total…
];
var VISIBLE = 7;   // first 7 show; the rest collapse under "Se fler tecken (N)"
```

- **Order = display order.** Reorder by moving array items.
- **`sev`** is `"akut"` (red dot + `Akut` tag) or `"varn"` (amber dot + `Varning` tag). Tier labels live in
  `var SEV = { akut:[…,"Akut"], varn:[…,"Varning"] }`.
- **`VISIBLE`** controls the split: with 13 symptoms and `VISIBLE=7`, the disclosure reads "Se fler tecken (6)".
  Same on desktop and mobile.
- **`risk`** = the "what it can mean" text. You may use `<b>…</b>` for the one key term and
  `<a href="tel:112">112</a>` / `<a href="tel:1177">1177</a>` for emergency numbers.
- **`safety`** (akut symptoms) = the red box content (protective action + emergency number). Empty string =
  no box. The flame icon is added automatically.
- **Add a symptom:** add an object with a unique `id`, a short label, `sev`, `risk`, and `safety`. That's it —
  the row, panel, CTA, severity dot/tag, `inert`, and analytics are generated for you.

**Phone number** lives once: `var PHONE_DISPLAY="010-265 79 79", PHONE_TEL="+46102657979";` — change both if
the jour number ever changes.

**Grounding stat** appears **twice** in the HTML (`.eb__ground--d` for desktop in the call column,
`.eb__ground--m` for mobile after the list). **Keep the two copies identical.**

---

## 7. Editing copy without breaking the brand voice

This block is written in Ampy's candour voice. If you or the agent edit any string, keep these
**non-negotiables** (full doctrine: `ampy-rost` / `ampy-foretagsdata`):

- du-tilltal. **No exclamation marks. No superlatives** ("bäst", "marknadens…", "otroligt").
- **No em-dashes** in any visible string (use period / comma / colon).
- **"kan" / "bör"** on safety, outcome and delivery claims — never a flat guarantee
  (e.g. "vi gör elen *trygg att använda* igen", not "vi gör den säker").
- **112 before us at real fire/injury.** The 112/1177 routing in the safety boxes is deliberate and
  clinically reviewed — do not remove or soften it.
- **No invented numbers.** Every figure is sourced (see `pipeline-record.md`). Don't add "1000+ kunder",
  "5.0", or "i hela Sverige".
- The two severity tiers must stay honestly calibrated — don't relabel everything "Akut".

---

## 8. Analytics & consent (wire before launch)

The block already pushes a vendor-agnostic `dataLayer` funnel — you just need to consume it and gate it:

| Event (`dataLayer.event`) | Fires when | Payload |
|---|---|---|
| `ampy_ej_view` | block loads | — |
| `ampy_ej_symptom_select` | a symptom opens | `{ symptom, severity }` |
| `ampy_ej_see_more` | "Se fler tecken" toggled | `{ open }` |
| `ampy_ej_cta_call_click` | a "Ring eljouren" tap | `{ symptom }` (or `"aside"`) |
| `ampy_ej_cta_112_click` | a 112 link tap | — |
| `ampy_ej_cta_1177_click` | a 1177 link tap | — |

- Map these to GA4/GTM. **The KPI is calls per 1000 views**, not raw events.
- **Consent Mode v2:** the call/112/1177 links are essential (tel:), but the analytics pushes are not — gate
  non-essential events behind consent. Keep this analytics consent separate from any marketing consent.

---

## 9. Build / sync helper

`index.html` is the source. To regenerate the three `bricks/*` files after editing it:

```bash
node -e 'const fs=require("fs"),h=fs.readFileSync("index.html","utf8");
fs.mkdirSync("bricks",{recursive:true});
fs.writeFileSync("bricks/eljour-block.css",h.match(/<style>([\s\S]*?)<\/style>/)[1].trim()+"\n");
fs.writeFileSync("bricks/eljour-block.js",h.match(/<script>([\s\S]*?)<\/script>/)[1].trim()+"\n");
fs.writeFileSync("bricks/eljour-block.html",h.match(/<section class="eb"[\s\S]*?<\/section>/)[0]+"\n");'
```

To preview locally: any static server pointed at this folder (the repo's `index.html`), or just open it.

---

## 10. Accessibility (already built in — keep it)

- Closed accordion panels get the `inert` attribute → their `tel:` links stay out of the tab order and the
  screen-reader tree (keyboard reaches exactly the open panel's CTA, not all 13).
- Rows are real `<button>`s with `aria-expanded` + `aria-controls`; panels are `role="region"`.
- All motion (accordion, chevron, status pulse, CTA pulse) is disabled under `prefers-reduced-motion`.
- Touch targets ≥ 44px. Severity is encoded by **dot + word tag**, never colour alone.

---

## 11. Responsive behaviour (don't "fix" these — they're intentional)

- Breakpoints **992px** (two-pane → single column) and **480px** (CTA padding). No other breakpoints.
- **Mobile-only CTA pulse:** the small green "live" dot on the CTAs shows **only ≤ 992px** (deliberate —
  desktop stays calm; owner-confirmed).
- **"Se fler tecken"** works on both desktop and mobile (7 shown, 6 collapsed).
- Headline is **centered** on both viewports; "Jour öppen just nu" is centered on mobile.
- Container width is **1280px** (`--eb-max`) to match the Hero-2 container.

---

## 12. Go-live checklist (owner + dev gates)

- [ ] **Electrician / clinical sign-off** on the 13 symptom → risk → safety mappings — especially the akut
      112 lines, the elstöt 112-vs-1177 cut, and the vatten 112/1177 routing.
- [ ] **Candour note:** the current owner order puts gnistor / vitvara / elstöt / vatten (the panels that
      carry 112/1177) **under "Se fler"**. Confirm that's acceptable, or surface those higher.
- [ ] **"Jour öppen just nu"** pulses unconditionally — only true if the line is genuinely staffed 24/7;
      otherwise time-gate it to a neutral "Ring dygnet runt" off-hours.
- [ ] **Footprint:** don't present national coverage if the lead is outside the live service area.
- [ ] **Eljour price:** confirm "tydligt pris innan vi rycker ut" / inställelse + jourtimtaxa wording is correct.
- [ ] **Analytics:** wire `ampy_ej_*` to GA4/GTM behind Consent Mode v2 (§8).
- [ ] **Outfit** is self-hosted in the theme (no Google Fonts request added by the block).
- [ ] QA pass (§13) on desktop + a real phone.

## 13. QA checklist

- [ ] Block sits full-container-width on desktop, stacks cleanly on mobile, no horizontal scroll.
- [ ] All 13 symptoms render in the owner order; "Se fler tecken (6)" reveals the last 6 on both viewports.
- [ ] Opening a symptom shows its risk text; akut ones show the red box; tapping an open row closes it
      (none-open is a valid state).
- [ ] Every "Ring eljouren" and the 112/1177 links dial `tel:` correctly on a phone.
- [ ] Tab key reaches the open panel's CTA and the aside CTA — not links inside collapsed panels.
- [ ] Green CTA pulse dot shows on mobile, hidden on desktop.
- [ ] `prefers-reduced-motion` (OS setting) stops all animation.
- [ ] `dataLayer` shows `ampy_ej_view` on load and the right events on interaction.

---

Questions on intent or wording → `docs/pipeline-record.md` (the full build rationale) or ping the owner.
The voice/fact rules are not stylistic preferences; they're the reason this block converts.
