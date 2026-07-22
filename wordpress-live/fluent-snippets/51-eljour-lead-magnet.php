<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Eljour Lead magnet
* @type: js
* @status: published
* @created_by: 13
* @created_at: 2026-06-28 23:53:32
* @updated_at: 2026-07-09 10:30:41
* @is_valid: 1
* @updated_by: 13
* @priority: 10
* @run_at: wp_footer
* @load_as_file: yes
* @load_in_block_editor: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
/* =============================================================================
   Ampy — Eljour block  ·  JavaScript  (Fluent Snippets: type = JS, location = Footer)
   -----------------------------------------------------------------------------
   INTERACTIONS ONLY. The markup + all 13 symptoms are rendered server-side by the
   PHP snippet, so this file does NOT build any HTML — it only wires up:
     · accordion open/close (none-open by default, single-open, click-open-row-to-close)
     · `inert` on every closed panel (keeps its tel: links out of the tab order / SR tree)
     · the "Se fler tecken" disclosure
     · the vendor-agnostic ampy_ej_* dataLayer funnel
   Behaviour is 1-to-1 with the reference build. Scoped per `.eb` block (supports >1 on a page).
   ============================================================================= */
(function () {
  function track(ev, d) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(Object.assign({ event: "ampy_ej_" + ev }, d || {}));
  }

  function initBlock(block) {
    if (block.dataset.ebReady) return;      // guard against double-init
    block.dataset.ebReady = "1";

    var listEl = block.querySelector(".eb__list");

    // "Se fler" label toggle. The collapsed label ("Se fler tecken (N)") is owned by the PHP
    // and read from the DOM here; the expanded label is the static string — exactly as the
    // reference build. No data-* attributes on the button (kept 1-to-1 with the reference DOM).
    var moreTxtEl      = block.querySelector(".eb__more .eb__more-txt");
    var labelCollapsed = moreTxtEl ? moreTxtEl.textContent : "";
    var labelExpanded  = "Visa färre";

    // Closed panels get `inert` so their links stay out of tab order / a11y tree.
    function syncInert() {
      Array.prototype.forEach.call(block.querySelectorAll(".eb__row"), function (r) {
        var panel = r.nextElementSibling;
        if (panel) panel.toggleAttribute("inert", r.getAttribute("aria-expanded") !== "true");
      });
    }

    function toggleRow(row) {
      var wasOpen = row.getAttribute("aria-expanded") === "true";
      Array.prototype.forEach.call(block.querySelectorAll(".eb__row"), function (r) {
        r.setAttribute("aria-expanded", "false");
      });
      if (!wasOpen) {
        row.setAttribute("aria-expanded", "true");
        track("symptom_select", { symptom: row.id.replace("row-", "") });
      }
      syncInert();
    }

    function toggleMore(more) {
      if (!listEl) return;
      var open = listEl.classList.toggle("is-open");
      more.setAttribute("aria-expanded", open ? "true" : "false");
      if (moreTxtEl) moreTxtEl.textContent = open ? labelExpanded : labelCollapsed;
      if (open) {
        var first = block.querySelector(".eb__item--more .eb__row");
        if (first) first.focus();
      }
      track("see_more", { open: open });
    }

    block.addEventListener("click", function (e) {
      if (e.target.closest('a[href="tel:112"]'))  { track("cta_112_click", {}); return; }
      if (e.target.closest('a[href="tel:1177"]')) { track("cta_1177_click", {}); return; }
      var call = e.target.closest("[data-call]");
      if (call) { track("cta_call_click", { symptom: call.getAttribute("data-call") }); return; }
      var more = e.target.closest(".eb__more");
      if (more) { toggleMore(more); return; }
      var row = e.target.closest(".eb__row");
      if (row) { toggleRow(row); return; }
    });

    syncInert();
    track("view", {});
  }

  function init() {
    Array.prototype.forEach.call(document.querySelectorAll(".eb"), initBlock);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();