/* =====================================================================
   Ampy — Eljour symptom -> risk-reveal block (behaviour)
   Pairs with eljour-block.css and the eljour-block.html shell.
   Drop into a Bricks Code element (JS) on the eljour landing pages, or
   enqueue site-wide. Pure data + render; no framework, no network.

   5-layer split (foretagsdata §4.4): SYMPTOMS = data, render* = pure view,
   no hardcoded copy outside the data array. In production the strings can be
   ACF/editor-driven — swap the SYMPTOMS source, keep the renderer.

   CANDOUR RULES (do not weaken): severity is calibrated honestly — not every
   symptom is akut. 'akut' (flames possible) shows the "Ring 112 först" line
   BEFORE the Ampy CTA. We never inflate urgency to sell a callout.
   Every fact is sourced in research/builds/eljour-symptom-block-v1.md.
   ===================================================================== */
(function () {
  "use strict";

  var PHONE_DISPLAY = "010-265 79 79";
  var PHONE_TEL = "+46102657979";

  // ---- DATA: the six symptoms -> honest, calibrated risk ----
  // severity: 'akut' (genuinely acute) | 'snart' (call today) | 'vanta' (often can wait)
  // emergency112: true only where flames/smoke are a live possibility.
  var SYMPTOMS = [
    {
      id: "sakring",
      chip: "Säkringarna löser ut",
      severity: "snart", sevLabel: "Ring oss idag",
      seen: "En säkring eller jordfelsbrytare som löser ut",
      means: "Löser den ut en enstaka gång är det oftast överbelastning, för mycket på samma grupp. Men löser den ut direkt, eller gång på gång, kan det vara en kortslutning eller ett jordfel i en fast installation.",
      danger: "Att tvinga tillbaka en säkring som löser om och om igen kan dölja ett fel som värmer en kabel du inte ser.",
      action: "Två återställningar är taket. Löser den ut en tredje gång, lämna den avslagen och ring oss.",
      emergency112: false
    },
    {
      id: "branlukt",
      chip: "Det luktar bränt",
      severity: "akut", sevLabel: "Akut: agera nu",
      seen: "Brännlukt eller lukt av smält plast",
      means: "Lukt av het eller smält plast vid elcentral eller uttag betyder nästan alltid en glappkontakt som hettats upp. Plasten kan redan vara på väg mot sin tändpunkt.",
      danger: "Det här är ett av få tecken som alltid bör kontrolleras av en elektriker, oavsett vad annat verkar normalt.",
      action: "Slå av huvudbrytaren. Rör inte centralen mer än så.",
      emergency112: true
    },
    {
      id: "stromlost",
      chip: "Strömmen är borta",
      severity: "vanta", sevLabel: "Kolla först: ofta ofarligt",
      seen: "Strömmen är helt borta",
      means: "Är det mörkt hos grannarna också är det elnätet. Då är felet inte ditt, och inte farligt. Är det bara hos dig kan en huvudsäkring eller jordfelsbrytare ha löst ut, eller så är det ett fel i din egen anläggning.",
      danger: "Går strömmen samtidigt som det luktar bränt eller låter konstigt är det inte ett vanligt avbrott. Då behandlar du det som akut.",
      action: "Kolla om grannarna har ström. Prova att återställa jordfelsbrytaren en gång. Löser det sig inte, ring oss.",
      emergency112: false
    },
    {
      id: "varmt-uttag",
      chip: "Uttaget är varmt",
      severity: "snart", sevLabel: "Ring oss idag",
      seen: "Ett uttag som känns varmt",
      means: "Ett uttag ska aldrig vara varmt när inget drar mycket ström. Värme betyder oftast en glappkontakt eller en överbelastad punkt. Kontaktmotstånd som bygger värme bakom väggen.",
      danger: "Ytorna i en elcentral bör aldrig passera 78 grader. Ett varmt uttag är samma sak en bit ut i väggen. Det kan vara på väg mot samma punkt.",
      action: "Dra ur det som sitter i och använd inte uttaget. Är det missfärgat eller luktar, slå av gruppen direkt och ring oss.",
      emergency112: false
    },
    {
      id: "flimmer",
      chip: "Lamporna flimrar",
      severity: "snart", sevLabel: "Ring oss idag",
      seen: "Ljus som flimrar eller dippar",
      means: "Flimrar ljuset när spisen, tvättmaskinen eller värmepumpen drar igång kan det vara en lös huvudanslutning eller ett glapp i nollskenan.",
      danger: "40 procent av alla surrande centraler vi rycker ut på har glapp i noll- eller fasskena. Ett nollfel kan skicka överspänning rakt in i din elektronik.",
      action: "Notera vid vilken apparat det flimrar. Det hjälper oss hitta felet snabbt. Ring oss så tittar vi på det.",
      emergency112: false
    },
    {
      id: "gnistor",
      chip: "Det gnistrar eller smäller",
      severity: "akut", sevLabel: "Akut: agera nu",
      seen: "Gnistor, ett smäll eller ett sprakande ljud",
      means: "Gnistor, ett smäll eller ett sprakande ljud i el är en ljusbåge. Den kan bli tusentals grader het på ett ögonblick och smälta metall och plast.",
      danger: "En ljusbåge kan starta en brand. Det här väntar man inte ut.",
      action: "Slå av huvudbrytaren direkt.",
      emergency112: true
    }
  ];

  var PHONE_SVG = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.2.4 2.4.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.4c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.3 1z"/></svg>';
  var WARN_SVG  = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2 2 22h20L12 2zm0 6 6.5 12h-13L12 8zm-1 4v4h2v-4h-2zm0 6v2h2v-2h-2z"/></svg>';

  function init(root) {
    var card    = root.querySelector('.ampy-eljour__card');
    var chipsEl = root.querySelector('.ampy-eljour__chips');
    var reveal  = root.querySelector('.ampy-eljour__reveal');
    var slide   = root.querySelector('.ampy-eljour__slide');
    if (!card || !chipsEl || !reveal || !slide) return;

    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var current = null;
    var swapTimer = null;

    // ---- enter-view fade (runOnce) ----
    if (reduce || !('IntersectionObserver' in window)) {
      card.classList.add('is-visible');
    } else {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { card.classList.add('is-visible'); io.disconnect(); } });
      }, { threshold: 0.2 });
      io.observe(card);
    }

    // ---- analytics shim — consent-gate in production (Consent Mode v2) ----
    function track(event, detail) {
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push(Object.assign({ event: 'ampy_ej_' + event }, detail || {}));
    }

    // ---- render the chip row ----
    SYMPTOMS.forEach(function (s, i) {
      var b = document.createElement('button');
      b.type = 'button';
      b.className = 'ampy-eljour__chip';
      b.id = 'ejChip-' + s.id;
      b.setAttribute('aria-pressed', 'false');
      b.setAttribute('aria-controls', reveal.id || 'ejReveal');
      b.textContent = s.chip;
      b.addEventListener('click', function () { select(s.id); });
      b.addEventListener('keydown', function (e) { arrow(e, i); });
      chipsEl.appendChild(b);
    });

    function callBlock(isEmergency) {
      var emerg = isEmergency
        ? '<p class="ampy-eljour__emerg"><span><b>Ser du lågor eller rök?</b> Ring <a href="tel:112">112</a> först. Sedan oss.</span></p>'
        : '';
      return emerg +
        '<div class="ampy-eljour__cta">' +
          '<a class="ampy-eljour__call" href="tel:' + PHONE_TEL + '" data-ej-call>' + PHONE_SVG + 'Ring ' + PHONE_DISPLAY + '</a>' +
          '<p class="ampy-eljour__trust">Jour dygnet runt, året om. Vi har som mål att en jourmontör är ' +
          'på plats <b>inom en timme</b>. Inställelseavgift plus timtaxa, sagt innan vi åker. Inga dolda avgifter.</p>' +
        '</div>';
    }

    function renderEmpty() {
      reveal.setAttribute('data-severity', '');
      reveal.setAttribute('data-emergency', 'false');
      slide.innerHTML =
        '<p class="ampy-eljour__seen">En elcentral varnar nästan alltid innan något allvarligt händer.</p>' +
        '<p class="ampy-eljour__body">Tryck på det du märker ovan, så säger vi vad det kan betyda och ' +
        'vad du gör nu. Är du osäker på säkerheten, vänta aldrig: ring oss.</p>' +
        callBlock(false);
    }

    function renderSlide(s) {
      reveal.setAttribute('data-severity', s.severity);
      reveal.setAttribute('data-emergency', s.emergency112 ? 'true' : 'false');
      slide.innerHTML =
        '<div class="ampy-eljour__sevrow">' +
          '<span class="ampy-eljour__sev">' + s.sevLabel + '</span>' +
          '<p class="ampy-eljour__seen">' + s.seen + '</p>' +
        '</div>' +
        '<div class="ampy-eljour__block">' +
          '<p class="ampy-eljour__label">Vad det kan betyda</p>' +
          '<p class="ampy-eljour__body">' + s.means + '</p>' +
        '</div>' +
        '<div class="ampy-eljour__block">' +
          '<p class="ampy-eljour__label">Faran du kanske inte tänkt på</p>' +
          '<p class="ampy-eljour__body">' + s.danger + '</p>' +
        '</div>' +
        '<div class="ampy-eljour__action">' + WARN_SVG +
          '<div><p class="ampy-eljour__label" style="color:var(--appure-white,#fff)">Gör så här nu</p>' +
          '<p class="ampy-eljour__body">' + s.action + '</p></div>' +
        '</div>' +
        callBlock(s.emergency112);
    }

    function select(id) {
      var s = SYMPTOMS.filter(function (x) { return x.id === id; })[0];
      if (!s) return;
      Array.prototype.forEach.call(chipsEl.children, function (c) {
        c.setAttribute('aria-pressed', c.id === 'ejChip-' + id ? 'true' : 'false');
      });
      current = id;
      swap(function () { renderSlide(s); });
      track('symptom_select', { symptom: id, severity: s.severity });
    }

    // cancel any pending swap so only the latest selection paints (no stale flash)
    function swap(paint) {
      if (reduce) { paint(); return; }
      if (swapTimer) window.clearTimeout(swapTimer);
      slide.classList.add('is-swapping');
      swapTimer = window.setTimeout(function () {
        paint(); slide.classList.remove('is-swapping'); swapTimer = null;
      }, 140);
    }

    function arrow(e, i) {
      var k = e.key, n = SYMPTOMS.length, j = null;
      if (k === 'ArrowRight' || k === 'ArrowDown') j = (i + 1) % n;
      else if (k === 'ArrowLeft' || k === 'ArrowUp') j = (i - 1 + n) % n;
      if (j === null) return;
      e.preventDefault();
      chipsEl.children[j].focus();
    }

    reveal.addEventListener('click', function (e) {
      if (e.target.closest('[data-ej-call]')) track('cta_call_click', { symptom: current });
      if (e.target.closest('a[href="tel:112"]')) track('cta_112_click', { symptom: current });
    });

    renderEmpty();
    track('view', {});
  }

  function boot() {
    var roots = document.querySelectorAll('.ampy-eljour');
    Array.prototype.forEach.call(roots, init);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
  else boot();
})();
