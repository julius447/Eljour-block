# Ampy — Eljour "Är något fel med elen?" symptom-block

A **web-block** for the top of every **eljour landing page** on ampy.se. A worried visitor taps the symptom
they notice → an honest, short explanation of the real risk → a call to the jour line (010-265 79 79).
**The conversion is the phone call. There is no form.** Plain HTML/CSS/JS — no framework, no build, no
external requests. Built to paste into **Bricks / WordPress**.

**Live reference:** https://julius447.github.io/Eljour-block/ (resize for mobile/desktop, click the symptoms —
that rendered page is the spec).

---

## 📦 Implementing it? Start here

| You are… | Read |
|---|---|
| **Chris (developer)** | **[`docs/HANDOVER.md`](docs/HANDOVER.md)** — complete Bricks/WP guide: two implementation paths, token mapping, the data model, analytics, a11y, go-live + QA checklists. |
| **An AI coding agent** | **[`CLAUDE.md`](CLAUDE.md)** — the rules: source of truth, what not to break, how to edit symptoms/copy safely. |
| **Anyone — "why does it say that?"** | [`docs/pipeline-record.md`](docs/pipeline-record.md) — every fact/number with its source. |

## Files

```
index.html              ← canonical source of truth (self-contained, paste-ready)
bricks/eljour-block.css ← extracted styles      (for the enqueue path)
bricks/eljour-block.js  ← extracted script: symptom data + render + analytics
bricks/eljour-block.html← extracted markup (the shell; JS renders the symptom list)
docs/HANDOVER.md        ← developer handover (Bricks/WP)
docs/pipeline-record.md ← provenance / build rationale
CLAUDE.md               ← AI-agent guide
archive/                ← v1 + the early A/B/C wireframes (history, ignore for implementation)
```

## At a glance

- **13 symptoms**, two tiers: **Akut** (red) / **Varning** (amber). Both lead to the call.
- **7 shown** + **"Se fler tecken (6)"** (desktop and mobile).
- Green **Ring eljouren** CTA in every panel + the call card; **112/1177 before us** at real fire/injury.
- Centered headline; mobile-only "live" pulse dot on the CTAs; container width 1280px (Hero-2).
- Built-in: `inert`-on-closed-panels a11y, `prefers-reduced-motion`, a vendor-agnostic `ampy_ej_*` dataLayer.

## Voice / fact rules (do not break — see CLAUDE.md / HANDOVER §7)

du-tilltal · **no "!" · no superlatives · no em-dashes** · `kan`/`bör` on safety & promises · 112 before us ·
every number sourced · honest two-tier calibration · Outfit (self-hosted, no Google Fonts request).

## Before go-live (owner + dev) — full list in HANDOVER §12

Electrician/clinical sign-off on the 13 mappings · confirm the "Se fler" order hides gnistor/vitvara/elstöt/
vatten (the 112/1177 panels) acceptably · "Jour öppen just nu" only if staffed 24/7 · footprint · eljour price ·
wire `ampy_ej_*` behind Consent Mode v2.
