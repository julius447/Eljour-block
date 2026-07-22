<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Eljour lead magnet
* @type: PHP
* @status: published
* @created_by: 13
* @created_at: 2026-06-28 23:52:30
* @updated_at: 2026-07-09 10:29:58
* @is_valid: 1
* @updated_by: 13
* @priority: 10
* @run_at: all
* @load_as_file: 
* @load_in_block_editor: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
<?php

/**
 * =============================================================================
 * Ampy - Eljour block  ·  PHP / HTML   (Fluent Snippets: PHP, run Everywhere)
 * -----------------------------------------------------------------------------
 * 1:1 with the approved prototype, rendered SERVER-SIDE, with every string of
 * copy read from Secure Custom Fields so it can be edited in wp-admin without
 * touching this file.
 *
 * WHAT CHANGED vs the previous snippet
 *   - The block is the prototype's exact DOM again (the paired CSS applies 1:1).
 *   - The 13 symptoms render in PHP, not in JS. The JS snippet now only wires
 *     interactions, which is what the prototype's JS does.
 *   - Copy is field-driven. Existing field names and keys are untouched, so the
 *     values already saved on post 59306 continue to be used. Four new optional
 *     fields were added (heading line 2, CTA label, phone label, phone URL);
 *     each falls back to the prototype default when empty.
 *
 * SHORTCODES
 *   [ampy_eljour]                    the whole block (use this in Bricks)
 *   [ampy_eljour view="calculator"]  symptom list only (the old Bricks layout)
 *   [ampy_eljour_block]              alias of [ampy_eljour], prototype's name
 *   [ampy_eljour_pill]               the standalone status pill
 *
 * The 13 symptoms stay in PHP on purpose: they are safety copy that an
 * authorised electrician signs off. Filter `ampy_eljour_symptoms` to change them.
 * =============================================================================
 */

defined( 'ABSPATH' ) || exit;

define( 'AMPY_EJ_SOURCE_ID', 59306 ); // Eljour lead-magnet post = single source of truth

/** Editable copy: name, label, type, default, [extra].
 *  One source feeds the SCF field group AND the Bricks tag list, so they never drift.
 *  The defaults ARE the prototype's strings: an empty field renders the prototype. */
function ampy_eljour_fields() {
    return array(
        array( 'eljour_heading',      'Heading (line 1)', 'text',    'Är något fel med elen?' ),
        array( 'eljour_heading_b',    'Heading (line 2)', 'text',    'Tryck på det du upplever.' ),
        array( 'eljour_pill',         'Pill text',        'text',    'Jour öppen just nu' ),
        array( 'eljour_lead',         'Paragraph',        'wysiwyg', '<b>Akut elfel? Ring oss direkt.</b> Då slipper du felsöka själv, och vi gör elen trygg att använda igen.', array( 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 0 ) ),
        array( 'eljour_bullet_1',     'Icon text 1',      'text',    'Jour dygnet runt, året om.' ),
        array( 'eljour_bullet_2',     'Icon text 2',      'text',    'Målsättning att vara på plats inom en timme.' ),
        array( 'eljour_bullet_3',     'Icon text 3',      'text',    'Prata med en av våra behöriga elektriker, inte en växel.' ),
        array( 'eljour_bullet_4',     'Icon text 4',      'text',    'Tydligt pris innan vi rycker ut, inga dolda avgifter.' ),
        array( 'eljour_cta_text',     'Button label',     'text',    'Ring eljouren' ),
        array( 'eljour_phone_label',  'Phone (shown)',    'text',    '010-265 79 79' ),
        array( 'eljour_phone_url',    'Phone (tel: link)','text',    'tel:+46102657979' ),
        array( 'eljour_source',       'Subtext',          'wysiwyg', 'Varje år rycker räddningstjänsten ut till omkring <b>1 800 elrelaterade bränder</b> i svenska bostäder. En vanlig orsak är en glappkontakt som hettas upp. Källa: Elsäkerhetsverket.', array( 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 0 ) ),
    );
}

/** Read a copy field from the source post. Falls back to post meta, then to the
 *  prototype default declared above. Never returns an empty string. */
function ampy_eljour_value( $name ) {
    $pid = AMPY_EJ_SOURCE_ID;
    $val = function_exists( 'get_field' ) ? get_field( $name, $pid ) : '';
    if ( $val === null || $val === false || $val === '' ) {
        $val = get_post_meta( $pid, $name, true );
    }
    if ( $val === null || $val === false || $val === '' ) {
        foreach ( ampy_eljour_fields() as $r ) {
            if ( $r[0] === $name ) { $val = $r[3]; break; }
        }
    }
    return is_scalar( $val ) ? (string) $val : '';
}

/** A rich-text field, sanitised, with a single wrapping <p> removed so it can sit
 *  inside the prototype's own <p>/<span>. */
function ampy_eljour_rich( $name ) {
    $html = trim( ampy_eljour_value( $name ) );
    if ( $html === '' ) return '';
    $html = wp_kses_post( $html );
    if ( preg_match( '#^<p[^>]*>(.*)</p>$#is', $html, $m ) && stripos( $m[1], '<p' ) === false ) {
        $html = $m[1];
    }
    /* The design styles the ELEMENT, not a class: `.eb__call-lead b`, `.eb__ground b`,
       `.eb__cta-txt b`, `.eb__risk b`. TinyMCE's bold button emits <strong>, which
       would match none of those rules and silently render unstyled. Normalise the
       semantic tags to the presentational ones the stylesheet targets. Same for
       <em>/<i>. This is the only reason the block is not a byte-for-byte echo of
       whatever the editor typed. */
    $html = str_ireplace(
        array( '<strong>', '</strong>', '<em>', '</em>' ),
        array( '<b>',      '</b>',      '<i>',  '</i>'  ),
        $html
    );
    return $html;
}

/** The heading is two spans in the prototype. Older installs stored both lines in
 *  `eljour_heading`; split on the first question mark so those values still work. */
function ampy_eljour_heading() {
    $a = trim( ampy_eljour_value( 'eljour_heading' ) );
    $b = trim( ampy_eljour_value( 'eljour_heading_b' ) );
    if ( $b === '' && ( $pos = mb_strpos( $a, '?' ) ) !== false && $pos < mb_strlen( $a ) - 1 ) {
        $b = trim( mb_substr( $a, $pos + 1 ) );
        $a = trim( mb_substr( $a, 0, $pos + 1 ) );
    }
    return array( $a, $b );
}

/* ---- 1. Register the copy fields on the source post ---- */
add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return; // Secure Custom Fields / ACF not active
    }
    $fields = array();
    foreach ( ampy_eljour_fields() as $r ) {
        $fields[] = array_merge( array(
            'key'           => 'field_' . $r[0],
            'label'         => $r[1],
            'name'          => $r[0],
            'type'          => $r[2],
            'default_value' => $r[3],
        ), isset( $r[4] ) ? $r[4] : array() );
    }
    acf_add_local_field_group( array(
        'key'             => 'group_ampy_eljour_copy',
        'title'           => 'Eljour - block copy',
        'description'     => 'Copy for the Eljour block. Edit it here; the block and every {eljour_*} dynamic tag read from this post.',
        'fields'          => $fields,
        'location'        => array( array( array( 'param' => 'post', 'operator' => '==', 'value' => (string) AMPY_EJ_SOURCE_ID ) ) ),
        'menu_order'      => 0,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
        'active'          => true,
    ) );
} );

/* ---- 2. Bricks dynamic-data tags {eljour_*}, always read from the source post ---- */
add_filter( 'bricks/dynamic_tags_list', function ( $tags ) {
    foreach ( ampy_eljour_fields() as $r ) {
        $tags[] = array( 'name' => '{' . $r[0] . '}', 'label' => 'Eljour: ' . $r[1], 'group' => 'Eljour' );
    }
    return $tags;
} );

add_filter( 'bricks/dynamic_data/render_tag', function ( $tag, $post = null, $context = 'text' ) {
    $name = is_string( $tag ) ? trim( $tag, '{}' ) : '';
    if ( strpos( $name, 'eljour_' ) === 0 ) {
        foreach ( ampy_eljour_fields() as $r ) {
            if ( $r[0] === $name ) {
                return ampy_eljour_value( $name );
            }
        }
    }
    return $tag;
}, 20, 3 );

function ampy_eljour_replace_tags( $content, $post = null, $context = 'text' ) {
    if ( ! is_string( $content ) || strpos( $content, '{eljour_' ) === false ) {
        return $content;
    }
    foreach ( ampy_eljour_fields() as $r ) {
        $needle = '{' . $r[0] . '}';
        if ( strpos( $content, $needle ) !== false ) {
            $content = str_replace( $needle, ampy_eljour_value( $r[0] ), $content );
        }
    }
    return $content;
}
add_filter( 'bricks/dynamic_data/render_content', 'ampy_eljour_replace_tags', 20, 3 );
add_filter( 'bricks/frontend/render_data', 'ampy_eljour_replace_tags', 20, 2 );

/* ---- 3. Status pill (self-contained CSS, unchanged) ---- */
add_shortcode( 'ampy_eljour_pill', function (): string {
    $text = ampy_eljour_value( 'eljour_pill' );
    if ( $text === '' ) {
        return '';
    }
    static $css_printed = false;
    $css = '';
    if ( ! $css_printed ) {
        $css_printed = true;
        $css = '<style>.ampy-jour-pill{display:inline-flex;align-items:center;gap:8px;font-family:"Outfit",system-ui,-apple-system,"Segoe UI",sans-serif;font-size:13px;font-weight:600;line-height:1;color:#0a6e58;background:#e3f6f1;padding:5px 11px;border-radius:999px}.ampy-jour-pill__dot{position:relative;flex:none;width:9px;height:9px;border-radius:50%;background:#00a991}.ampy-jour-pill__dot::after{content:"";position:absolute;inset:0;border-radius:50%;background:#00a991;animation:ampy-jour-pulse 2s ease-out infinite}@keyframes ampy-jour-pulse{0%{transform:scale(1);opacity:.55}100%{transform:scale(2);opacity:0}}@media (prefers-reduced-motion:reduce){.ampy-jour-pill__dot::after{animation:none}}</style>';
    }
    return $css . '<span class="ampy-jour-pill"><span class="ampy-jour-pill__dot"></span> ' . esc_html( $text ) . '</span>';
} );


/* ==========================================================================
   4. The block itself - the prototype's DOM, server-rendered
   ========================================================================== */
if ( ! function_exists( 'ampy_eljour_block_render' ) ) :

function ampy_eljour_block_render( bool $list_only = false ) {

	/* ---- config -------------------------------------------------------- */
	/* Copy is read from the SCF fields on the Eljour lead-magnet post (59306).
	   Every read falls back to the prototype's own string, so an empty field can
	   never produce an empty block and nothing already typed in wp-admin is lost. */
	$phone_display = ampy_eljour_value( 'eljour_phone_label' );
	$phone_tel     = ampy_eljour_value( 'eljour_phone_url' );
	$cta_text      = ampy_eljour_value( 'eljour_cta_text' );
	$pill_text     = ampy_eljour_value( 'eljour_pill' );
	$lead_html     = ampy_eljour_rich( 'eljour_lead' );
	$title         = ampy_eljour_heading();
	$visible       = 7;   // first N symptoms shown; the rest collapse under "Se fler"

	/* ---- inline SVGs (static, trusted markup) --------------------------- */
	$svg_chev  = '<svg class="eb__chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
	$svg_more  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
	$svg_fire  = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2c1 3-1 5-2 6-1.4 1.4-3 3-3 5.5A5.5 5.5 0 0 0 17.5 13c0-2-1-3.5-2-4.5.2 1.2-.3 2.2-1 2.6.6-3-1.5-6-2.5-9.1z"/></svg>';
	$svg_phone = '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.2.4 2.4.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.4c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.3 1z"/><path fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" d="M15.8 2.6a6.4 6.4 0 0 1 5.6 5.6M15.2 6.1a3 3 0 0 1 2.7 2.7"/></svg>';

	$trust = array(
		array( 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7.4V12l3 1.8" stroke-linecap="round"/></svg>',
		       'text' => ampy_eljour_value( 'eljour_bullet_1' ) ),
		array( 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="13.5" r="7.5"/><path d="M12 13.5l3-2.2" stroke-linecap="round"/><path d="M9.5 2.5h5M12 2.5V5.4" stroke-linecap="round"/></svg>',
		       'text' => ampy_eljour_value( 'eljour_bullet_2' ) ),
		array( 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		       'text' => ampy_eljour_value( 'eljour_bullet_3' ) ),
		array( 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3.6 12.4l8-8a2 2 0 0 1 1.4-.6H19a1.5 1.5 0 0 1 1.5 1.5v6a2 2 0 0 1-.6 1.4l-8 8a1.5 1.5 0 0 1-2.1 0l-6.6-6.6a1.5 1.5 0 0 1 0-2.1z" stroke-linejoin="round"/><circle cx="15.8" cy="8.2" r="1.3"/></svg>',
		       'text' => ampy_eljour_value( 'eljour_bullet_4' ) ),
	);

	$ground = ampy_eljour_rich( 'eljour_source' );

	/* ---- severity tiers: [ dot-class, tag-class, tag-label ] ------------ */
	$sev = array(
		'akut' => array( 'd-akut', 't-akut', 'Akut' ),
		'varn' => array( 'd-varn', 't-varn', 'Varning' ),
	);

	/* ---- the 13 symptoms (order = display order) ----------------------- */
	$symptoms = array(
		array( 'id' => 'sakring', 'label' => 'Säkring löser ut', 'sev' => 'varn',
			'risk'   => 'Löser en säkring ut en enstaka gång är det oftast bara överbelastning, för mycket på samma grupp. Men löser samma säkring ut gång på gång, eller direkt när du slår på den, är det en <b>kortslutning eller ett glapp</b> som kan värma en kabel du inte ser. Tvinga inte tillbaka den om och om igen. Ring oss så hittar vi felet.',
			'safety' => '' ),
		array( 'id' => 'stromavbrott', 'label' => 'Strömavbrott', 'sev' => 'varn',
			'risk'   => 'Är det mörkt hos grannarna också ligger felet i <b>elnätet</b>, inte hos dig. Är det bara hos dig sitter felet i din egen anläggning och bör felsökas av en elektriker.',
			'safety' => '' ),
		array( 'id' => 'jordfel', 'label' => 'Jordfelsbrytare löser ut', 'sev' => 'varn',
			'risk'   => 'Jordfelsbrytaren bryter så fort den känner <b>läckström</b>, oftast en trasig apparat eller fukt i ett uttag eller utomhus. Slår den ifrån gång på gång, även efter att du dragit ur apparater, sitter felet i den fasta installationen. Den bryter för att skydda dig, så strunta inte i den. Ring oss så spårar vi det.',
			'safety' => '' ),
		array( 'id' => 'laddbox', 'label' => 'Laddboxen blir varm', 'sev' => 'akut',
			'risk'   => 'En laddbox eller ett uttag som blir varmt när bilen laddar är en <b>glappkontakt</b> som blir allt hetare under timmar av hög ström. Det kan bli så varmt att plasten smälter, och fortsatt laddning kan leda till brand.',
			'safety' => 'Avbryt laddningen och använd inte uttaget tills en elektriker sett på det.' ),
		array( 'id' => 'flimmer', 'label' => 'Flimrande ljus', 'sev' => 'varn',
			'risk'   => 'Flimrar flera lampor samtidigt, eller en kraftigt, är det oftast ett glapp eller en lös nollanslutning i installationen. Ett <b>nollfel</b> kan skicka överspänning rakt in i din elektronik.',
			'safety' => '' ),
		array( 'id' => 'surr', 'label' => 'Surrar eller knäpper i elcentralen', 'sev' => 'akut',
			'risk'   => 'Ett surrande eller knäppande ljud från elcentralen eller ett uttag är ofta en <b>glappkontakt</b>, en lös skruv som långsamt blir het. Ljudet betyder att uppvärmningen redan pågår.',
			'safety' => 'Bryt strömmen på huvudbrytaren om du kan, och rör inte elcentralen. Känner du brännlukt eller ser rök, gå ut och ring <a href="tel:112">112</a>.' ),
		array( 'id' => 'branlukt', 'label' => 'Brännlukt eller rök', 'sev' => 'akut',
			'risk'   => 'Brännlukt eller lukt av smält plast betyder att det <b>redan blivit hett</b> någonstans i elen. Värmen kan sitta dold bakom en vägg, och det är så elbränder börjar.',
			'safety' => 'Slå av huvudbrytaren. Ser du rök eller lågor, gå ut direkt och ring <a href="tel:112">112</a>.' ),
		array( 'id' => 'aska', 'label' => 'Efter åska eller överspänning', 'sev' => 'varn',
			'risk'   => 'Ett åsknedslag i närheten kan skicka en <b>överspänning</b> genom elen som kan skada elektronik och den fasta installationen, även om allt verkar fungera. Elsäkerhetsverket rekommenderar en koll efter åska.',
			'safety' => '' ),
		array( 'id' => 'varmt-uttag', 'label' => 'Varmt eller missfärgat uttag', 'sev' => 'akut',
			'risk'   => 'Ett uttag ska aldrig vara varmt. Värme, missfärgning eller svarta märken är en <b>glappkontakt</b> som byggt hetta, ofta dolt inne i väggen.',
			'safety' => 'Dra ur det som sitter i och använd inte uttaget.' ),
		array( 'id' => 'vitvara', 'label' => 'Vitvara ryker eller luktar bränt', 'sev' => 'akut',
			'risk'   => 'Rök eller brännlukt från en tvättmaskin, diskmaskin eller torktumlare kan vara ett skadat värmeelement eller en kortslutning som tänder plasten. Vitvaror hör till de <b>vanligaste brandkällorna</b> i hemmet.',
			'safety' => 'Dra ur maskinen och slå av dess säkring. Ser du rök eller lågor, gå ut direkt och ring <a href="tel:112">112</a>.' ),
		array( 'id' => 'gnistor', 'label' => 'Gnistor eller smäll', 'sev' => 'akut',
			'risk'   => 'Gnistor, en smäll eller ett sprakande ljud är en <b>ljusbåge</b>. Den blir tusentals grader på ett ögonblick och kan tända det som finns runt omkring.',
			'safety' => 'Slå av huvudbrytaren. Ser du rök eller lågor, gå ut direkt och ring <a href="tel:112">112</a>.' ),
		array( 'id' => 'elstot', 'label' => 'Elstöt', 'sev' => 'akut',
			'risk'   => 'Att känna ström i en apparat, ett uttag eller en kran beror oftast på ett <b>jordfel</b>, ström som läcker dit den inte ska. Ström genom kroppen kan ge skador, ibland först en stund efteråt.',
			'safety' => 'Andas du tungt, känns hjärtat oregelbundet eller har du pacemaker, ring <a href="tel:112">112</a>. Annars, använd inte det som gav stöt och ring <a href="tel:1177">1177</a> och beskriv att du fått ström genom kroppen. De avgör om du behöver vård.' ),
		array( 'id' => 'vatten', 'label' => 'Vatten nära elen', 'sev' => 'akut',
			'risk'   => 'Vatten vid uttag, elcentral eller ledning kan göra metall <b>strömförande</b>. Då är risken framför allt elstöt, och vanligt kranvatten leder ström förvånansvärt bra.',
			'safety' => 'Rör inget vått nära elen. Kan du bryta strömmen säkert, gör det. Har du fått ström genom kroppen och andas tungt eller känner hjärtat slå oregelbundet, ring <a href="tel:112">112</a>. Annars ring <a href="tel:1177">1177</a>.' ),
	);

	/* ---- allow only <b> and tel: <a> inside risk/safety copy ----------- */
	$kses = array( 'b' => array(), 'a' => array( 'href' => true ) );

	/* ---- CTA helper (in-list order: txt, icon, dot) -------------------- */
	$cta = function ( $href, $data_call ) use ( $phone_display, $cta_text, $svg_phone ) {
		return '<a class="eb__cta" href="' . esc_attr( $href ) . '" data-call="' . esc_attr( $data_call ) . '">'
			. '<span class="eb__cta-txt">' . esc_html( $cta_text ) . ' <b>' . esc_html( $phone_display ) . '</b></span>'
			. '<span class="eb__cta-ic">' . $svg_phone . '</span>'
			. '<span class="eb__cta-dot" aria-hidden="true"></span>'
			. '</a>';
	};

	/** Safety copy. Filterable so it can be changed without editing this snippet. */
	$symptoms = apply_filters( 'ampy_eljour_symptoms', $symptoms );

	$hidden     = max( 0, count( $symptoms ) - $visible );
	$more_label = 'Se fler tecken (' . $hidden . ')';

	if ( $list_only ) {
		/* Transitional view used by the old Bricks layout: the symptom list only.
		   Server-rendered now, same DOM as inside the full block. */
		ob_start();
		?>
		<section class="eb eb--calc" aria-label="Vanliga tecken på elfel">
		  <ul class="eb__list" id="ebList">
		  <?php foreach ( $symptoms as $i => $s ) :
		    $sv  = $sev[ $s['sev'] ];
		    $cls = 'eb__item' . ( $i >= $visible ? ' eb__item--more' : '' );
		  ?>
		    <li class="<?php echo esc_attr( $cls ); ?>">
		      <button class="eb__row" id="row-<?php echo esc_attr( $s['id'] ); ?>" aria-expanded="false" aria-controls="pan-<?php echo esc_attr( $s['id'] ); ?>"><span class="eb__dot <?php echo esc_attr( $sv[0] ); ?>"></span><span class="eb__label"><?php echo esc_html( $s['label'] ); ?></span><span class="eb__tag <?php echo esc_attr( $sv[1] ); ?>"><?php echo esc_html( $sv[2] ); ?></span><?php echo $svg_chev; ?></button>
		      <div class="eb__panel" id="pan-<?php echo esc_attr( $s['id'] ); ?>" role="region" aria-labelledby="row-<?php echo esc_attr( $s['id'] ); ?>" hidden>
		        <div class="eb__panel-in"><div class="eb__panel-pad">
		          <p class="eb__risk"><?php echo wp_kses( $s['risk'], $kses ); ?></p>
		          <?php if ( ! empty( $s['safety'] ) ) : ?><p class="eb__safety"><span class="eb__safety-ic"><?php echo $svg_fire; ?></span><span><?php echo wp_kses( $s['safety'], $kses ); ?></span></p><?php endif; ?>
		          <div class="eb__act"><?php echo $cta( $phone_tel, 'row-' . $s['id'] ); ?></div>
		        </div></div>
		      </div>
		    </li>
		  <?php endforeach; ?>
		  <?php if ( $hidden > 0 ) : ?>
		    <li class="eb__more-li"><button class="eb__more" type="button" aria-expanded="false"><span class="eb__more-txt"><?php echo esc_html( $more_label ); ?></span><?php echo $svg_more; ?></button></li>
		  <?php endif; ?>
		  </ul>
		</section>
		<?php
		return ob_get_clean();
	}

	ob_start();
	?>
	<section class="eb" aria-labelledby="ebTitle">
	  <div class="eb__wrap">
	    <header class="eb__head">
	      <h2 class="eb__title" id="ebTitle"><span class="eb__title-a"><?php echo esc_html( $title[0] ); ?></span><span class="eb__title-b"><?php echo esc_html( $title[1] ); ?></span></h2>
	    </header>

	    <div class="eb__grid">
	      <aside class="eb__aside">
	        <div class="eb__call">
	          <span class="eb__status"><span class="pulse"></span> <?php echo esc_html( $pill_text ); ?></span>
	          <p class="eb__call-lead"><?php echo $lead_html; ?></p>
	          <ul class="eb__trust">
	          <?php foreach ( $trust as $t ) : ?>
	            <li><span class="eb__trust-ic"><?php echo $t['svg']; ?></span> <?php echo esc_html( $t['text'] ); ?></li>
	          <?php endforeach; ?>
	          </ul>
	          <a class="eb__cta" href="<?php echo esc_attr( $phone_tel ); ?>" data-call="aside"><span class="eb__cta-txt"><?php echo esc_html( $cta_text ); ?> <b><?php echo esc_html( $phone_display ); ?></b></span><span class="eb__cta-dot" aria-hidden="true"></span><span class="eb__cta-ic"><?php echo $svg_phone; ?></span></a>
	        </div>
	        <p class="eb__ground eb__ground--d"><?php echo $ground; ?></p>
	      </aside>

	      <ul class="eb__list" id="ebList">
	      <?php foreach ( $symptoms as $i => $s ) :
	        $sv  = $sev[ $s['sev'] ];
	        $cls = 'eb__item' . ( $i >= $visible ? ' eb__item--more' : '' );
	        $rid = 'row-' . $s['id'];
	        $pid = 'pan-' . $s['id'];
	      ?>
	        <li class="<?php echo esc_attr( $cls ); ?>">
	          <button class="eb__row" id="<?php echo esc_attr( $rid ); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr( $pid ); ?>"><span class="eb__dot <?php echo esc_attr( $sv[0] ); ?>"></span><span class="eb__label"><?php echo esc_html( $s['label'] ); ?></span><span class="eb__tag <?php echo esc_attr( $sv[1] ); ?>"><?php echo esc_html( $sv[2] ); ?></span><?php echo $svg_chev; ?></button>
	          <div class="eb__panel"><div class="eb__panel-in"><div class="eb__panel-pad" id="<?php echo esc_attr( $pid ); ?>" role="region" aria-labelledby="<?php echo esc_attr( $rid ); ?>">
	            <p class="eb__risk"><?php echo wp_kses( $s['risk'], $kses ); ?></p>
	            <?php if ( $s['safety'] !== '' ) : ?>
	            <p class="eb__safety"><?php echo $svg_fire; ?><span><?php echo wp_kses( $s['safety'], $kses ); ?></span></p>
	            <?php endif; ?>
	            <div class="eb__act"><?php echo $cta( $phone_tel, $s['id'] ); ?></div>
	          </div></div></div>
	        </li>
	      <?php endforeach; ?>
	      <?php if ( $hidden > 0 ) : ?>
	        <li class="eb__more-li"><button class="eb__more" type="button" aria-expanded="false" aria-controls="ebList"><span class="eb__more-txt"><?php echo esc_html( $more_label ); ?></span><?php echo $svg_more; ?></button></li>
	      <?php endif; ?>
	      </ul>

	      <p class="eb__ground eb__ground--m"><?php echo $ground; ?></p>
	    </div>
	  </div>
	</section>
	<?php
	return ob_get_clean();
}


add_shortcode( 'ampy_eljour', function ( $atts = array() ): string {
    $atts = shortcode_atts( array( 'view' => 'full' ), $atts, 'ampy_eljour' );
    return ampy_eljour_block_render( 'calculator' === $atts['view'] );
} );

// The prototype's own shortcode name, kept as an alias.
add_shortcode( 'ampy_eljour_block', function (): string {
    return ampy_eljour_block_render( false );
} );

endif;