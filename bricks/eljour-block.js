    var PHONE_DISPLAY="010-265 79 79", PHONE_TEL="+46102657979", VISIBLE=7;
    var CTA_ICON='<span class="eb__cta-ic"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.2.4 2.4.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.4c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.3 1z"/><path fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M15.8 2.6a6.4 6.4 0 0 1 5.6 5.6M15.2 6.1a3 3 0 0 1 2.7 2.7"/></svg></span>';
    var CHEV='<svg class="eb__chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
    var FIRE='<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2c1 3-1 5-2 6-1.4 1.4-3 3-3 5.5A5.5 5.5 0 0 0 17.5 13c0-2-1-3.5-2-4.5.2 1.2-.3 2.2-1 2.6.6-3-1.5-6-2.5-9.1z"/></svg>';
    // Order + visibility are owner-specified (2026-06-19): VISIBLE=7 -> "Se fler tecken (6)".
    // CANDOUR FLAG for sign-off: this order puts akut symptoms whose panels hold the only emergency-number
    // guidance (gnistor 112, vitvara 112, elstöt 112/1177, vatten 1177) under "Se fler". sev: akut | varn
    var SYMPTOMS=[
      {id:"sakring",label:"Säkring löser ut",sev:"varn",
        risk:"Löser en säkring ut en enstaka gång är det oftast bara överbelastning, för mycket på samma grupp. Men löser samma säkring ut gång på gång, eller direkt när du slår på den, är det en <b>kortslutning eller ett glapp</b> som kan värma en kabel du inte ser. Tvinga inte tillbaka den om och om igen. Ring oss så hittar vi felet.",safety:""},
      {id:"stromavbrott",label:"Strömavbrott",sev:"varn",
        risk:"Är det mörkt hos grannarna också ligger felet i <b>elnätet</b>, inte hos dig. Är det bara hos dig sitter felet i din egen anläggning och bör felsökas av en elektriker.",safety:""},
      {id:"jordfel",label:"Jordfelsbrytare löser ut",sev:"varn",
        risk:"Jordfelsbrytaren bryter så fort den känner <b>läckström</b>, oftast en trasig apparat eller fukt i ett uttag eller utomhus. Slår den ifrån gång på gång, även efter att du dragit ur apparater, sitter felet i den fasta installationen. Den bryter för att skydda dig, så strunta inte i den. Ring oss så spårar vi det.",safety:""},
      {id:"laddbox",label:"Laddboxen blir varm",sev:"akut",
        risk:"En laddbox eller ett uttag som blir varmt när bilen laddar är en <b>glappkontakt</b> som blir allt hetare under timmar av hög ström. Det kan bli så varmt att plasten smälter, och fortsatt laddning kan leda till brand.",
        safety:"Avbryt laddningen och använd inte uttaget tills en elektriker sett på det."},
      {id:"flimmer",label:"Flimrande ljus",sev:"varn",
        risk:"Flimrar flera lampor samtidigt, eller en kraftigt, är det oftast ett glapp eller en lös nollanslutning i installationen. Ett <b>nollfel</b> kan skicka överspänning rakt in i din elektronik.",safety:""},
      {id:"surr",label:"Surrar eller knäpper i elcentralen",sev:"akut",
        risk:"Ett surrande eller knäppande ljud från elcentralen eller ett uttag är ofta en <b>glappkontakt</b>, en lös skruv som långsamt blir het. Ljudet betyder att uppvärmningen redan pågår.",
        safety:"Bryt strömmen på huvudbrytaren om du kan, och rör inte elcentralen. Känner du brännlukt eller ser rök, gå ut och ring <a href=\"tel:112\">112</a>."},
      {id:"branlukt",label:"Brännlukt eller rök",sev:"akut",
        risk:"Brännlukt eller lukt av smält plast betyder att det <b>redan blivit hett</b> någonstans i elen. Värmen kan sitta dold bakom en vägg, och det är så elbränder börjar.",
        safety:"Slå av huvudbrytaren. Ser du rök eller lågor, gå ut direkt och ring <a href=\"tel:112\">112</a>."},
      {id:"aska",label:"Efter åska eller överspänning",sev:"varn",
        risk:"Ett åsknedslag i närheten kan skicka en <b>överspänning</b> genom elen som kan skada elektronik och den fasta installationen, även om allt verkar fungera. Elsäkerhetsverket rekommenderar en koll efter åska.",safety:""},
      {id:"varmt-uttag",label:"Varmt eller missfärgat uttag",sev:"akut",
        risk:"Ett uttag ska aldrig vara varmt. Värme, missfärgning eller svarta märken är en <b>glappkontakt</b> som byggt hetta, ofta dolt inne i väggen.",
        safety:"Dra ur det som sitter i och använd inte uttaget."},
      {id:"vitvara",label:"Vitvara ryker eller luktar bränt",sev:"akut",
        risk:"Rök eller brännlukt från en tvättmaskin, diskmaskin eller torktumlare kan vara ett skadat värmeelement eller en kortslutning som tänder plasten. Vitvaror hör till de <b>vanligaste brandkällorna</b> i hemmet.",
        safety:"Dra ur maskinen och slå av dess säkring. Ser du rök eller lågor, gå ut direkt och ring <a href=\"tel:112\">112</a>."},
      {id:"gnistor",label:"Gnistor eller smäll",sev:"akut",
        risk:"Gnistor, en smäll eller ett sprakande ljud är en <b>ljusbåge</b>. Den blir tusentals grader på ett ögonblick och kan tända det som finns runt omkring.",
        safety:"Slå av huvudbrytaren. Ser du rök eller lågor, gå ut direkt och ring <a href=\"tel:112\">112</a>."},
      {id:"elstot",label:"Elstöt",sev:"akut",
        risk:"Att känna ström i en apparat, ett uttag eller en kran beror oftast på ett <b>jordfel</b>, ström som läcker dit den inte ska. Ström genom kroppen kan ge skador, ibland först en stund efteråt.",
        safety:"Andas du tungt, känns hjärtat oregelbundet eller har du pacemaker, ring <a href=\"tel:112\">112</a>. Annars, använd inte det som gav stöt och ring <a href=\"tel:1177\">1177</a> och beskriv att du fått ström genom kroppen. De avgör om du behöver vård."},
      {id:"vatten",label:"Vatten nära elen",sev:"akut",
        risk:"Vatten vid uttag, elcentral eller ledning kan göra metall <b>strömförande</b>. Då är risken framför allt elstöt, och vanligt kranvatten leder ström förvånansvärt bra.",
        safety:"Rör inget vått nära elen. Kan du bryta strömmen säkert, gör det. Har du fått ström genom kroppen och andas tungt eller känner hjärtat slå oregelbundet, ring <a href=\"tel:112\">112</a>. Annars ring <a href=\"tel:1177\">1177</a>."}
    ];
    var SEV={akut:["d-akut","t-akut","Akut"],varn:["d-varn","t-varn","Varning"]};

    function track(ev,d){ window.dataLayer=window.dataLayer||[]; window.dataLayer.push(Object.assign({event:"ampy_ej_"+ev},d||{})); }

    var list=document.getElementById("ebList");
    SYMPTOMS.forEach(function(s,i){
      var sev=SEV[s.sev];
      var li=document.createElement("li"); li.className="eb__item"+(i>=VISIBLE?" eb__item--more":"");
      var safety=s.safety?'<p class="eb__safety">'+FIRE+'<span>'+s.safety+'</span></p>':'';
      li.innerHTML=
        '<button class="eb__row" id="row-'+s.id+'" aria-expanded="false" aria-controls="pan-'+s.id+'">'+
          '<span class="eb__dot '+sev[0]+'"></span>'+
          '<span class="eb__label">'+s.label+'</span>'+
          '<span class="eb__tag '+sev[1]+'">'+sev[2]+'</span>'+CHEV+
        '</button>'+
        '<div class="eb__panel"><div class="eb__panel-in"><div class="eb__panel-pad" id="pan-'+s.id+'" role="region" aria-labelledby="row-'+s.id+'">'+
          '<p class="eb__risk">'+s.risk+'</p>'+
          safety+
          '<div class="eb__act"><a class="eb__cta" href="tel:'+PHONE_TEL+'" data-call="'+s.id+'">'+
            '<span class="eb__cta-txt">Ring eljouren <b>'+PHONE_DISPLAY+'</b></span>'+CTA_ICON+'<span class="eb__cta-dot" aria-hidden="true"></span>'+
          '</a></div>'+
        '</div></div></div>';
      list.appendChild(li);
    });

    // "se fler" — same on desktop and mobile
    var hidden=SYMPTOMS.length-VISIBLE;
    if(hidden>0){
      var moreLi=document.createElement("li"); moreLi.className="eb__more-li";
      moreLi.innerHTML='<button class="eb__more" type="button" aria-expanded="false" aria-controls="ebList">'+
        '<span class="eb__more-txt">Se fler tecken ('+hidden+')</span>'+
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg></button>';
      list.appendChild(moreLi);
      var moreBtn=moreLi.querySelector(".eb__more");
      moreBtn.addEventListener("click",function(){
        var open=list.classList.toggle("is-open");
        moreBtn.setAttribute("aria-expanded",open?"true":"false");
        moreBtn.querySelector(".eb__more-txt").textContent=open?"Visa färre":"Se fler tecken ("+hidden+")";
        if(open){ var first=list.querySelector(".eb__item--more .eb__row"); if(first) first.focus(); }
        track("see_more",{open:open});
      });
    }

    function syncInert(){
      Array.prototype.forEach.call(list.querySelectorAll(".eb__row"),function(r){
        r.nextElementSibling.toggleAttribute("inert", r.getAttribute("aria-expanded")!=="true");
      });
    }
    syncInert();

    list.addEventListener("click",function(e){
      var c112=e.target.closest('a[href="tel:112"]'); if(c112){ track("cta_112_click",{}); return; }
      var c1177=e.target.closest('a[href="tel:1177"]'); if(c1177){ track("cta_1177_click",{}); return; }
      var call=e.target.closest("[data-call]"); if(call){ track("cta_call_click",{symptom:call.getAttribute("data-call")}); return; }
      var row=e.target.closest(".eb__row"); if(!row) return;
      var wasOpen=row.getAttribute("aria-expanded")==="true";
      Array.prototype.forEach.call(list.querySelectorAll(".eb__row"),function(r){ r.setAttribute("aria-expanded","false"); });
      if(!wasOpen){ row.setAttribute("aria-expanded","true"); track("symptom_select",{symptom:row.id.replace("row-","")}); }
      syncInert();
    });
    document.querySelector('.eb__call').addEventListener("click",function(e){ if(e.target.closest("[data-call]")) track("cta_call_click",{symptom:"aside"}); });
    track("view",{});
