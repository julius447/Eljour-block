<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Eljour Lead magnet
* @type: css
* @status: published
* @created_by: 13
* @created_at: 2026-06-28 23:53:03
* @updated_at: 2026-07-16 13:54:17
* @is_valid: 1
* @updated_by: 13
* @priority: 10
* @run_at: wp_head
* @load_as_file: yes
* @load_in_block_editor: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
/* =============================================================================
   Ampy — Eljour "Är något fel med elen?" block  ·  CSS  (Fluent Snippets: type = CSS)
   -----------------------------------------------------------------------------
   1-to-1 with the reference build. Values are byte-identical to the original;
   the ONLY change vs the standalone is that the 6 page-global rules
   (html / :root font / * / body / a / [inert]) are SCOPED to `.eb` so this
   snippet cannot restyle the rest of the WordPress page. No visual change.

   REQUIRES 1rem = 10px. The block is sized in rem on a 62.5% root (1rem = 10px).
   Ampy's Bricks theme already sets `html{font-size:62.5%}`. The line below
   guarantees it; if your theme already sets it (same value) it is a harmless
   no-op. Do NOT remove it unless you are certain the root font-size is 62.5%.
   ============================================================================= */

html { font-size: 62.5%; }

:root {
  --bg:#f5f9ff; --surface:#ffffff; --ink:#090b32; --ink-body:#3b3f59; --ink-soft:#5f6480;
  --teal:#00a991; --teal-dark:#0a8f7c; --teal-pill:#0a6e58; --teal-tint:#e3f6f1; --line:#e6ecf6;
  --akut-bg:#fdeceb; --akut-ink:#b3261e; --akut-dot:#e24b4a; --akut-line:#f0b9b3;
  --varn-bg:#fff4e0; --varn-ink:#8a5800; --varn-dot:#e3a008;
  --cta-grad:linear-gradient(146deg,#055a4b 0%,#08735f 52%,#0a8169 100%);
  --cta-ink:#ffffff; --cta-shadow:0 1rem 2.4rem rgba(4,110,90,.32);
  --r:1.4rem; --r-l:2rem; --r-s:1rem; --m:.3s;
  --eb-max:128rem; --col-l:minmax(0,4fr); --col-r:minmax(0,6fr); --col-gap:clamp(2rem,3vw,4rem);
  --shadow-card:0 1rem 3rem rgba(9,11,50,.07);
}

/* box-sizing scoped to the block only (was a global `*` reset) */
.eb, .eb *, .eb *::before, .eb *::after { box-sizing:border-box; }

/* block root — carries what `body` carried in the standalone (font, colour, smoothing, bg) */
.eb{ font-family:"Outfit",system-ui,-apple-system,"Segoe UI",sans-serif;
  background:var(--bg); color:var(--ink-body); -webkit-font-smoothing:antialiased;
  /* Was a full-page gutter (the prototype owned the page). Zeroed so the block
     fills its Bricks container; put spacing on the Bricks section instead. */
  padding:0; }
/* :where() keeps this reset at the SAME (0,0,1) specificity as the standalone's global `a{}`,
   so component colours (.eb__cta = white, .eb__safety a = red) still win. A plain `.eb a` would
   be (0,1,1) and wrongly override .eb__cta, turning the green CTA's text dark. */
:where(.eb) a{ color:inherit; }
.eb [inert]{ pointer-events:none; }
.eb__wrap{ max-width:none; margin-inline:0; } /* fill container, no centered cap */

/* ---- headline (centered, both viewports) ---- */
.eb__head{ margin:0 0 clamp(2.4rem,3vw,3.6rem); }
.eb__title{ margin:0 auto; max-width:none; text-wrap:balance; color:var(--ink); font-size:clamp(2.6rem,3.3vw,3.6rem); font-weight:500;
  line-height:1.15; letter-spacing:-0.015em; text-align:center; }
.eb__title-a, .eb__title-b{ display:block; }

/* ---- global green call CTA ---- */
.eb__cta{ position:relative; display:flex; align-items:center; justify-content:space-between; gap:1.4rem; width:100%;
  padding:1.5rem 2rem; min-height:5.8rem; border-radius:var(--r); background:var(--cta-grad);
  border:1px solid rgba(255,255,255,.12); box-shadow:var(--cta-shadow), inset 0 1px 0 rgba(255,255,255,.22);
  color:var(--cta-ink); font-size:clamp(1.5rem,1.4vw,1.75rem); font-weight:600; text-decoration:none;
  line-height:1.1; transition:transform var(--m) ease, box-shadow var(--m) ease; }
.eb__cta:hover{ transform:translateY(-1px);
  box-shadow:0 1.4rem 3.2rem rgba(4,110,90,.40), inset 0 1px 0 rgba(255,255,255,.22); }
.eb__cta:focus-visible{ outline:2px solid var(--teal-dark); outline-offset:3px; }
.eb__cta-txt{ display:inline-flex; align-items:baseline; gap:.6rem; white-space:nowrap; min-width:0; }
.eb__cta-txt b{ font-weight:600; }
.eb__cta-ic{ display:inline-flex; align-items:center; justify-content:center; flex:none; width:2.4rem; height:2.4rem; }
.eb__cta-ic svg{ width:2.4rem; height:2.4rem; }
/* green "live" bubble pulse on the call CTAs — MOBILE ONLY (hidden on desktop where the CTA already
   dominates and a 2nd green pulse next to "Jour öppen just nu" reads busy). In neon-mint, straddling the bottom edge. */
.eb__cta-dot{ display:none; position:absolute; left:50%; bottom:0; transform:translate(-50%,50%); pointer-events:none;
  width:1rem; height:1rem; border-radius:50%; background:#55ff9a; }
.eb__cta-dot::after{ content:""; position:absolute; inset:0; border-radius:50%; background:#55ff9a;
  animation:eb-cta-pulse 2s ease-out infinite; }
@keyframes eb-cta-pulse{ 0%{ transform:scale(1); opacity:.6 } 100%{ transform:scale(2.6); opacity:0 } }

/* ---- two-pane ---- */
.eb__grid{ display:grid; grid-template-columns:var(--col-l) var(--col-r); align-items:start; column-gap:var(--col-gap); }
.eb__aside{ display:flex; flex-direction:column; gap:1.6rem; }

.eb__call{ background:var(--surface); border:1px solid var(--line); border-radius:var(--r-l);
  box-shadow:var(--shadow-card); padding:clamp(2rem,2.4vw,2.8rem); display:flex; flex-direction:column; gap:1.6rem; }
.eb__status{ display:inline-flex; align-items:center; gap:.8rem; align-self:flex-start;
  font-size:1.3rem; font-weight:600; color:var(--teal-pill); background:var(--teal-tint);
  padding:.5rem 1.1rem; border-radius:99rem; }
.eb__status .pulse{ width:.9rem; height:.9rem; border-radius:50%; background:var(--teal); position:relative; }
.eb__status .pulse::after{ content:""; position:absolute; inset:0; border-radius:50%; background:var(--teal);
  animation:eb-pulse 2s ease-out infinite; }
@keyframes eb-pulse{ 0%{ transform:scale(1); opacity:.55 } 100%{ transform:scale(2); opacity:0 } }
.eb__call-lead{ margin:0; font-size:1.55rem; line-height:1.5; color:var(--ink-body); }
.eb__call-lead b{ color:var(--ink); font-weight:600; }

.eb__trust{ list-style:none; margin:0; padding:1.8rem 0; border-top:1px solid var(--line);
  border-bottom:1px solid var(--line); display:flex; flex-direction:column; gap:1.6rem; }
.eb__trust li{ display:grid; grid-template-columns:2.6rem 1fr; column-gap:1.3rem; align-items:start;
  font-size:1.5rem; line-height:1.4; color:var(--ink-body); }
.eb__trust-ic{ width:2.6rem; height:2.2rem; display:flex; align-items:center; justify-content:center; color:var(--teal); }
.eb__trust-ic svg{ width:2.1rem; height:2.1rem; }

.eb__ground{ margin:0; font-size:1.3rem; line-height:1.55; color:var(--ink-soft); padding:0; }
.eb__ground b{ color:var(--ink-body); font-weight:600; }
.eb__ground--d{ margin-top:.6rem; }
.eb__ground--m{ display:none; }

/* ---- accordion ---- */
.eb__list{ list-style:none; margin:0; padding:0; background:var(--surface); border:1px solid var(--line);
  border-radius:var(--r-l); box-shadow:var(--shadow-card); overflow:hidden; }
.eb__item + .eb__item, .eb__more-li{ border-top:1px solid var(--line); }
.eb__row{ appearance:none; width:100%; cursor:pointer; background:transparent; border:0; text-align:left;
  display:flex; align-items:center; gap:1.3rem; padding:clamp(1.8rem,2vw,2.2rem) clamp(1.8rem,2.4vw,2.6rem);
  font-family:inherit; color:var(--ink); font-size:clamp(1.7rem,1.9vw,1.9rem); font-weight:500;
  transition:background var(--m) ease; }
.eb__row:hover{ background:#fafcff; }
.eb__row:focus-visible{ outline:2px solid var(--teal); outline-offset:-2px; }
.eb__row[aria-expanded="true"]{ background:#fbfdff; }
.eb__dot{ width:1rem; height:1rem; border-radius:50%; flex:none; }
.eb__label{ flex:1; }
.eb__tag{ font-size:1.2rem; font-weight:600; padding:.45rem 1.1rem; border-radius:99rem; white-space:nowrap; }
.eb__chev{ flex:none; width:2.2rem; height:2.2rem; color:var(--ink-soft); transition:transform var(--m) ease; }
.eb__row[aria-expanded="true"] .eb__chev{ transform:rotate(180deg); }
.d-akut{ background:var(--akut-dot); } .t-akut{ background:var(--akut-bg); color:var(--akut-ink); }
.d-varn{ background:var(--varn-dot); } .t-varn{ background:var(--varn-bg); color:var(--varn-ink); }

.eb__panel{ display:grid; grid-template-rows:0fr; transition:grid-template-rows var(--m) ease; }
.eb__row[aria-expanded="true"] + .eb__panel{ grid-template-rows:1fr; }
.eb__panel-in{ overflow:hidden; }
.eb__panel-pad{ padding:.4rem clamp(1.8rem,2.4vw,2.6rem) clamp(2rem,2.4vw,2.6rem);
  display:flex; flex-direction:column; gap:1.4rem; }
.eb__risk{ margin:0; font-size:1.7rem; line-height:1.6; color:var(--ink-body); max-width:62ch; }
.eb__risk b{ color:var(--ink); font-weight:600; }
.eb__safety{ display:flex; gap:1.1rem; align-items:flex-start; margin:0; font-size:1.5rem; line-height:1.5;
  color:var(--akut-ink); background:var(--akut-bg); border:1px solid var(--akut-line);
  border-radius:var(--r-s); padding:1.2rem 1.4rem; max-width:62ch; }
.eb__safety svg{ flex:none; width:2rem; height:2rem; margin-top:.1rem; }
.eb__safety a{ color:var(--akut-ink); font-weight:600; text-decoration:underline; text-underline-offset:2px; }
.eb__safety a:focus-visible{ outline:2px solid var(--akut-ink); outline-offset:2px; border-radius:2px; }
.eb__act{ margin-top:.2rem; }
.eb__act .eb__cta{ max-width:34rem; }

/* ---- "se fler" (length control, both viewports) ---- */
.eb__item--more{ display:none; }
.eb__list.is-open .eb__item--more{ display:block; }
.eb__more{ appearance:none; width:100%; cursor:pointer; background:transparent; border:0; font-family:inherit;
  display:flex; align-items:center; justify-content:center; gap:.8rem; padding:1.8rem 1.6rem;
  font-size:1.5rem; font-weight:600; color:var(--teal-pill); transition:background var(--m) ease; }
.eb__more:hover{ background:#fafcff; }
.eb__more:focus-visible{ outline:2px solid var(--teal); outline-offset:-2px; }
.eb__more svg{ width:1.8rem; height:1.8rem; transition:transform var(--m) ease; }
.eb__list.is-open .eb__more svg{ transform:rotate(180deg); }

/* ---- responsive (992 / 480) ---- */
@media (max-width:992px){
  .eb__grid{ display:block; }
  .eb__status{ align-self:center; }
  .eb__list{ margin:2rem 0; }
  .eb__ground--d{ display:none; }
  .eb__ground--m{ display:block; }
  .eb__act .eb__cta{ max-width:none; }
  .eb__cta-dot{ display:block; }
}
@media (max-width:480px){
  .eb__cta{ font-size:1.5rem; padding:1.4rem 1.6rem; }
}
@media (prefers-reduced-motion:reduce){
  .eb__panel,.eb__chev,.eb__cta,.eb__more svg{ transition:none; }
  .eb__status .pulse::after, .eb__cta-dot::after{ animation:none; display:none; }
}


/* ── Transitional: [ampy_eljour view="calculator"] ───────────────────────────
   Only used by the old Bricks layout, where the left column is built in Bricks
   and the shortcode contributes the symptom list alone. Scoped to .eb--calc, so
   it cannot touch the full block above. Delete once the page uses [ampy_eljour]. */
.eb--calc{padding:0; background:transparent;}