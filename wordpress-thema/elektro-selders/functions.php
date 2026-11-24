<?php
/**
 * Elektro Selders – thema v2 (Weblotus).
 * - Bedrijfsgegevens: één instellingenpagina, overal gebruikt (inc/bedrijfsgegevens.php)
 * - Rol "Klant": pagina's en media bewerken, verder niets (inc/rol-klant.php)
 * - Vaste paginasjablonen met vergrendelde blokken (inc/sjablonen.php)
 * - SEO-basis en schema.org (inc/seo.php)
 */

define( 'ES_THEME_VERSION', '2.0' );


function es_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'primary' => 'Hoofdmenu' ) );
	add_theme_support( 'editor-color-palette', array(
		array( 'name' => 'Donkerblauw', 'slug' => 'es-dark',  'color' => '#0F2F5C' ),
		array( 'name' => 'Blauw',       'slug' => 'es-blue',  'color' => '#1E5AA8' ),
		array( 'name' => 'Lichtblauw',  'slug' => 'es-light', 'color' => '#E8F0FA' ),
		array( 'name' => 'Wit',         'slug' => 'es-white', 'color' => '#FFFFFF' ),
		array( 'name' => 'Tekst',       'slug' => 'es-text',  'color' => '#1A1A1A' ),
	) );
	// De klant kiest geen eigen kleuren of lettergroottes; de huisstijl blijft bewaard.
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'disable-custom-font-sizes' );
}
add_action( 'after_setup_theme', 'es_setup' );

function es_scripts() {
	wp_enqueue_style( 'es-style', get_stylesheet_uri(), array(), ES_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'es_scripts' );

/** Vast menu als er geen WordPress-menu is toegewezen. */
function es_fallback_menu() {
	$items = array(
		'Diensten'  => '/diensten/',
		'Over ons'  => '/over-ons/',
		'Contact'   => '/contact/',
	);
	$current = trailingslashit( wp_parse_url( home_url( add_query_arg( array() ) ), PHP_URL_PATH ) );
	echo '<ul>';
	foreach ( $items as $label => $path ) {
		$cls = ( $current === $path ) ? ' class="is-current"' : '';
		echo '<li' . $cls . '><a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '<li class="es-nav__cta"><a href="' . esc_url( home_url( '/contact/' ) ) . '">Gratis offerte</a></li>';
	echo '</ul>';
}


/* ====================== inc/bedrijfsgegevens.php ====================== */
/**
 * Bedrijfsgegevens: één formulier in het dashboard, overal op de site gebruikt.
 * Opslag: optie 'es_bedrijf' (array). Lezen: es_info( 'naam' ) enz.
 */

function es_bedrijf_velden() {
	return array(
		'naam'       => array( 'Bedrijfsnaam',            'text',     'Elektro Selders' ),
		'slogan'     => array( 'Slogan (onder de naam)',  'text',     'Elektricien in Achel en omgeving' ),
		'tel'        => array( 'Telefoon (zoals getoond)','text',     '011 00 00 00' ),
		'tel_link'   => array( 'Telefoon (om te bellen, bv. +3211000000)', 'text', '+3211000000' ),
		'email'      => array( 'E-mail',                  'email',    'info@lotusflow.net' ),
		'adres'      => array( 'Adres',                   'text',     'Hamontstraat 1, 3930 Achel' ),
		'btw'        => array( 'Btw-nummer',              'text',     'BE 0000.000.000' ),
		'uren'       => array( 'Openingsuren',            'text',     'Ma–vr 8:00–18:00 · Spoed 24/7' ),
		'werkgebied' => array( 'Werkgebied (gemeenten, komma\'s)', 'text', 'Achel, Hamont-Achel, Pelt, Lommel, Bocholt, Peer' ),
	);
}

function es_info( $key ) {
	static $opt = null;
	if ( null === $opt ) {
		$opt = (array) get_option( 'es_bedrijf', array() );
	}
	if ( isset( $opt[ $key ] ) && '' !== $opt[ $key ] ) {
		return $opt[ $key ];
	}
	$velden = es_bedrijf_velden();
	return isset( $velden[ $key ] ) ? $velden[ $key ][2] : '';
}

function es_bedrijf_menu() {
	add_menu_page(
		'Bedrijfsgegevens', 'Bedrijfsgegevens', 'es_bedrijfsgegevens', 'es-bedrijfsgegevens',
		'es_bedrijf_pagina', 'dashicons-store', 25
	);
}
add_action( 'admin_menu', 'es_bedrijf_menu' );

function es_bedrijf_register() {
	register_setting( 'es_bedrijf_groep', 'es_bedrijf', array(
		'type' => 'array',
		'sanitize_callback' => 'es_bedrijf_sanitize',
		'default' => array(),
	) );
}
add_action( 'admin_init', 'es_bedrijf_register' );

function es_bedrijf_sanitize( $in ) {
	$out = array();
	foreach ( es_bedrijf_velden() as $key => $v ) {
		$val = isset( $in[ $key ] ) ? trim( (string) $in[ $key ] ) : '';
		$out[ $key ] = ( 'email' === $v[1] ) ? sanitize_email( $val ) : sanitize_text_field( $val );
	}
	return $out;
}

// De instellingenpagina mag ook door de rol Klant bewaard worden.
add_filter( 'option_page_capability_es_bedrijf_groep', function () { return 'es_bedrijfsgegevens'; } );

function es_bedrijf_pagina() {
	if ( ! current_user_can( 'es_bedrijfsgegevens' ) ) { return; }
	$opt = (array) get_option( 'es_bedrijf', array() );
	?>
	<div class="wrap">
		<h1>Bedrijfsgegevens</h1>
		<?php if ( isset( $_GET['settings-updated'] ) ) : ?><div class="notice notice-success is-dismissible"><p>Opgeslagen. De gegevens staan nu overal op de site.</p></div><?php endif; ?>
		<p>Deze gegevens staan in de kop- en voettekst, op de contactpagina en in de informatie voor Google. Wijzig ze hier één keer; ze veranderen overal mee.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'es_bedrijf_groep' ); ?>
			<table class="form-table" role="presentation">
				<?php foreach ( es_bedrijf_velden() as $key => $v ) : ?>
				<tr>
					<th scope="row"><label for="es_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $v[0] ); ?></label></th>
					<td><input class="regular-text" type="<?php echo esc_attr( $v[1] ); ?>" id="es_<?php echo esc_attr( $key ); ?>" name="es_bedrijf[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( isset( $opt[ $key ] ) ? $opt[ $key ] : $v[2] ); ?>"></td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button( 'Bedrijfsgegevens opslaan' ); ?>
		</form>
	</div>
	<?php
}


/* ====================== inc/rol-klant.php ====================== */
/**
 * Rol "Klant": pagina's en media bewerken, Bedrijfsgegevens aanpassen. Verder niets.
 * Beheerders (Weblotus) zien alles zoals gewoonlijk.
 */

function es_rol_klant_aanmaken() {
	$caps = array(
		'read'                   => true,
		'upload_files'           => true,
		'edit_pages'             => true,
		'edit_others_pages'      => true,
		'edit_published_pages'   => true,
		'publish_pages'          => true,
		'edit_posts'             => true,   // nodig voor de mediabibliotheek in de editor
		'es_bedrijfsgegevens'    => true,
	);
	remove_role( 'es_klant' );
	add_role( 'es_klant', 'Klant', $caps );
	$admin = get_role( 'administrator' );
	if ( $admin ) { $admin->add_cap( 'es_bedrijfsgegevens' ); }
}
add_action( 'after_switch_theme', 'es_rol_klant_aanmaken' );
add_action( 'init', function () {
	if ( ! get_role( 'es_klant' ) ) { es_rol_klant_aanmaken(); }
	$admin = get_role( 'administrator' );
	if ( $admin && ! $admin->has_cap( 'es_bedrijfsgegevens' ) ) { $admin->add_cap( 'es_bedrijfsgegevens' ); }
} );

function es_is_klant() {
	$u = wp_get_current_user();
	return $u && in_array( 'es_klant', (array) $u->roles, true ) && ! current_user_can( 'manage_options' );
}

/** Dashboardmenu: alleen Dashboard, Pagina's, Media, Bedrijfsgegevens. */
function es_klant_menu() {
	if ( ! es_is_klant() ) { return; }
	global $menu;
	$toegelaten = array( 'index.php', 'edit.php?post_type=page', 'upload.php', 'es-bedrijfsgegevens' );
	foreach ( (array) $menu as $item ) {
		if ( isset( $item[2] ) && ! in_array( $item[2], $toegelaten, true ) ) {
			remove_menu_page( $item[2] );
		}
	}
	// Onder Pagina's geen 'Nieuwe pagina' via het menu (wel mogelijk via de knop bovenaan de lijst als Weblotus dat toelaat).
}
add_action( 'admin_menu', 'es_klant_menu', 999 );

/** Dashboard: alleen een welkomstkader. */
function es_klant_dashboard() {
	if ( ! es_is_klant() ) { return; }
	global $wp_meta_boxes;
	$wp_meta_boxes['dashboard'] = array();
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
	wp_add_dashboard_widget( 'es_welkom', 'Uw website beheren', function () {
		echo '<p>Welkom. U kunt hier drie dingen doen:</p><ul style="list-style:disc;margin-left:1.2em">';
		echo '<li><a href="' . esc_url( admin_url( 'edit.php?post_type=page' ) ) . '"><strong>Pagina\'s</strong></a>: teksten en foto\'s op de pagina\'s aanpassen.</li>';
		echo '<li><a href="' . esc_url( admin_url( 'upload.php' ) ) . '"><strong>Media</strong></a>: foto\'s uploaden.</li>';
		echo '<li><a href="' . esc_url( admin_url( 'admin.php?page=es-bedrijfsgegevens' ) ) . '"><strong>Bedrijfsgegevens</strong></a>: telefoon, adres, uren.</li></ul>';
		echo '<p>Na een wijziging op een pagina klikt u rechtsboven op <strong>Bijwerken</strong>. De wijziging staat meteen op de site.</p>';
		echo '<p>Vragen of iets anders nodig (layout, nieuwe pagina, functies)? Mail <a href="mailto:info@weblotus.be">info@weblotus.be</a>.</p>';
	} );
}
add_action( 'wp_dashboard_setup', 'es_klant_dashboard', 999 );

/** Admin-balk opschonen voor de klant. */
function es_klant_adminbar( $bar ) {
	if ( ! es_is_klant() ) { return; }
	foreach ( array( 'wp-logo', 'comments', 'new-content', 'updates', 'customize', 'themes', 'widgets', 'menus', 'wpseo-menu', 'search' ) as $id ) {
		$bar->remove_node( $id );
	}
}
add_action( 'admin_bar_menu', 'es_klant_adminbar', 999 );

/** Geen meldingen van plugins/WordPress voor de klant; geen hulp-tab; geen scherminstellingen. */
add_action( 'admin_head', function () {
	if ( ! es_is_klant() ) { return; }
	remove_all_actions( 'admin_notices' );
	remove_all_actions( 'all_admin_notices' );
	$screen = get_current_screen();
	if ( $screen ) { $screen->remove_help_tabs(); }
	echo '<style>#screen-options-link-wrap,#contextual-help-link-wrap,.update-nudge,#wp-admin-bar-wp-logo,.editor-document-tools__inserter-toggle,.editor-document-tools__document-overview-toggle{display:none!important}</style>';
}, 1 );

/** Editor voor de klant: geen welkomstgids, geen code-weergave. */
add_action( 'enqueue_block_editor_assets', function () {
	if ( ! es_is_klant() ) { return; }
	wp_add_inline_script( 'wp-edit-post', "wp.domReady(function(){ try { wp.data.dispatch('core/preferences').set('core/edit-post','welcomeGuide',false); } catch(e){} });" );
} );

/** Klant altijd naar het dashboard na inloggen. */
add_filter( 'login_redirect', function ( $url, $req, $user ) {
	if ( $user instanceof WP_User && in_array( 'es_klant', (array) $user->roles, true ) ) {
		return admin_url();
	}
	return $url;
}, 10, 3 );


/* ====================== inc/sjablonen.php ====================== */
/**
 * Vaste paginasjablonen (blokpatronen) en vergrendeling voor de rol Klant.
 * - Weblotus zet bij de oplevering per pagina het juiste patroon (Home, Diensten, Over ons, Contact).
 * - De klant werkt in de editor in "alleen inhoud"-modus: tekst en foto's wijzigen, niets verplaatsen of toevoegen.
 */

/** Editor voor de klant: alleen inhoud bewerken, geen blokken toevoegen/verplaatsen/wissen, geen code-weergave. */
add_filter( 'block_editor_settings_all', function ( $settings, $context ) {
	if ( es_is_klant() ) {
		$settings['templateLock']          = 'contentOnly';
		$settings['allowedBlockTypes']     = false; // geen nieuwe blokken invoegen
		$settings['codeEditingEnabled']    = false;
		$settings['canLockBlocks']         = false;
		$settings['__experimentalBlockPatterns'] = array();
	}
	return $settings;
}, 10, 2 );

/** Blokpatronen voor Weblotus (zichtbaar in de editor onder "Elektro Selders"). */
add_action( 'init', function () {
	register_block_pattern_category( 'elektro-selders', array( 'label' => 'Elektro Selders' ) );

	$lock = '"lock":{"move":true,"remove":true}';
	$img  = get_template_directory_uri() . '/logo.png';

	$hero = '<!-- wp:group {"align":"full","backgroundColor":"es-dark","textColor":"es-white","className":"es-hero",' . $lock . ',"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull es-hero has-es-white-color has-es-dark-background-color has-text-color has-background"><!-- wp:heading {"level":1,"textColor":"es-white",' . $lock . '} -->
<h1 class="wp-block-heading has-es-white-color has-text-color">Uw elektricien in Achel en omgeving</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {' . $lock . '} -->
<p>Installatie, storingen en keuring. Vaste prijzen, 18 jaar ervaring, 24/7 bereikbaar.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {' . $lock . '} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"es-blue",' . $lock . '} -->
<div class="wp-block-button"><a class="wp-block-button__link has-es-blue-background-color has-background wp-element-button" href="/contact/">Gratis offerte</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline",' . $lock . '} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:+3211000000">Bel nu</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->';

	$kaart = function ( $titel, $tekst, $link ) use ( $lock, $img ) {
		return '<!-- wp:column {' . $lock . '} -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large",' . $lock . '} -->
<figure class="wp-block-image size-large"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( $titel ) . '"/></figure>
<!-- /wp:image -->

<!-- wp:group {"backgroundColor":"es-light",' . $lock . ',"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-es-light-background-color has-background"><!-- wp:heading {"level":3,' . $lock . '} -->
<h3 class="wp-block-heading">' . esc_html( $titel ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {' . $lock . '} -->
<p>' . esc_html( $tekst ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {' . $lock . '} -->
<p><a href="' . esc_attr( $link ) . '">Meer info ›</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->';
	};

	$home = $hero . '

<!-- wp:heading {"textAlign":"center",' . $lock . '} -->
<h2 class="wp-block-heading has-text-align-center">Onze diensten</h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide",' . $lock . '} -->
<div class="wp-block-columns alignwide">' . $kaart( 'Installatie', 'Nieuwbouw, renovatie en het vervangen van uw zekeringkast. Volledig volgens het AREI.', '/diensten/' ) . $kaart( 'Storingen', '24/7 spoeddienst, kortsluiting opsporen en herstellen, elektrische keuring.', '/diensten/' ) . $kaart( 'Energie', 'Laadpaal voor uw elektrische wagen, zonnepanelen aansluiten, domotica.', '/diensten/' ) . '</div>
<!-- /wp:columns -->

<!-- wp:group {"align":"full","backgroundColor":"es-light",' . $lock . ',"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-es-light-background-color has-background"><!-- wp:heading {' . $lock . '} -->
<h2 class="wp-block-heading">Een offerte nodig?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {' . $lock . '} -->
<p>Gratis en vrijblijvend, binnen 2 werkdagen in uw mailbox.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {' . $lock . '} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"es-blue",' . $lock . '} -->
<div class="wp-block-button"><a class="wp-block-button__link has-es-blue-background-color has-background wp-element-button" href="/contact/">Offerte aanvragen</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->';

	$dienst = function ( $titel, $tekst, $items ) use ( $lock ) {
		$li = '';
		foreach ( $items as $i ) { $li .= '<!-- wp:list-item {' . $lock . '} --><li>' . esc_html( $i ) . '</li><!-- /wp:list-item -->'; }
		return '<!-- wp:heading {' . $lock . '} -->
<h2 class="wp-block-heading">' . esc_html( $titel ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {' . $lock . '} -->
<p>' . esc_html( $tekst ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:list {' . $lock . '} -->
<ul class="wp-block-list">' . $li . '</ul>
<!-- /wp:list -->';
	};
	$diensten = '<!-- wp:paragraph {' . $lock . '} -->
<p>Van een nieuwe stopcontact tot een volledige installatie: we doen het allemaal, met vaste prijzen en een keuringsattest na afloop.</p>
<!-- /wp:paragraph -->
' . $dienst( 'Installatie', 'Nieuwbouw, renovatie, zekeringkast vervangen. Volgens het AREI, met schema en keuring.', array( 'Volledige installatie bij nieuwbouw', 'Renovatie van bestaande installaties', 'Zekeringkast en differentieel vervangen', 'Extra stopcontacten en verlichting' ) )
 . $dienst( 'Storingen en spoed', 'Dag en nacht bereikbaar, meestal binnen het uur ter plaatse.', array( '24/7 spoeddienst', 'Stroompanne, afspringende differentieel', 'Kortsluiting opsporen', 'Keuring en herstel van opmerkingen' ) )
 . $dienst( 'Energie', 'Laadpaal, zonnepanelen, thuisbatterij, domotica.', array( 'Laadpaal plaatsen en aanmelden bij Fluvius', 'Aansluiting omvormer en batterij', 'Domotica: verlichting, verwarming, rolluiken' ) ) . '

<!-- wp:buttons {' . $lock . '} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"es-blue",' . $lock . '} -->
<div class="wp-block-button"><a class="wp-block-button__link has-es-blue-background-color has-background wp-element-button" href="/contact/">Gratis offerte aanvragen</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->';

	$overons = '<!-- wp:columns {"align":"wide",' . $lock . '} -->
<div class="wp-block-columns alignwide"><!-- wp:column {' . $lock . '} -->
<div class="wp-block-column"><!-- wp:paragraph {' . $lock . '} -->
<p>Elektro Selders is het bedrijf van Jan Selders, elektricien in Achel sinds 2008. Wat begon als eenmanszaak is uitgegroeid tot een kleine ploeg die alle elektriciteitswerken aankan.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {' . $lock . '} -->
<p>Wij werken met vaste prijzen. U weet vooraf wat het kost, en dat blijft zo. Op onze installaties geven we 5 jaar garantie.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {' . $lock . '} -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large",' . $lock . '} -->
<figure class="wp-block-image size-large"><img src="' . esc_url( $img ) . '" alt="Ons team"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->';

	$contact = '<!-- wp:paragraph {' . $lock . '} -->
<p>Bel ons, mail ons of vul het formulier in. Voor spoedgevallen zijn we 24/7 bereikbaar.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode {' . $lock . '} -->
[es_contactgegevens]
<!-- /wp:shortcode -->';

	register_block_pattern( 'elektro-selders/home',     array( 'title' => 'Sjabloon: Home',      'categories' => array( 'elektro-selders' ), 'content' => $home ) );
	register_block_pattern( 'elektro-selders/diensten', array( 'title' => 'Sjabloon: Diensten',  'categories' => array( 'elektro-selders' ), 'content' => $diensten ) );
	register_block_pattern( 'elektro-selders/over-ons', array( 'title' => 'Sjabloon: Over ons',  'categories' => array( 'elektro-selders' ), 'content' => $overons ) );
	register_block_pattern( 'elektro-selders/contact',  array( 'title' => 'Sjabloon: Contact',   'categories' => array( 'elektro-selders' ), 'content' => $contact ) );
} );

/** Contactgegevens uit Bedrijfsgegevens, als blok op de contactpagina (shortcode). */
add_shortcode( 'es_contactgegevens', function () {
	return '<div class="es-contactinfo">'
		. '<p><strong>Telefoon:</strong> <a href="tel:' . esc_attr( es_info( 'tel_link' ) ) . '">' . esc_html( es_info( 'tel' ) ) . '</a></p>'
		. '<p><strong>E-mail:</strong> <a href="mailto:' . esc_attr( es_info( 'email' ) ) . '">' . esc_html( es_info( 'email' ) ) . '</a></p>'
		. '<p><strong>Adres:</strong> ' . esc_html( es_info( 'adres' ) ) . '</p>'
		. '<p><strong>Openingsuren:</strong> ' . esc_html( es_info( 'uren' ) ) . '</p>'
		. '<p><strong>Werkgebied:</strong> ' . esc_html( es_info( 'werkgebied' ) ) . '</p>'
		. '</div>';
} );


/* ====================== inc/seo.php ====================== */
/**
 * SEO-basis. Werkt zonder plugin; als Yoast SEO actief is, laat dit bestand titel en meta aan Yoast.
 */

function es_yoast_actief() { return defined( 'WPSEO_VERSION' ); }

/** Meta description uit de samenvatting van de pagina (als Yoast niet actief is). */
add_action( 'wp_head', function () {
	if ( es_yoast_actief() ) { return; }
	if ( is_singular() ) {
		$desc = get_the_excerpt();
		if ( ! $desc ) { $desc = wp_trim_words( wp_strip_all_tags( get_post()->post_content ), 28, '…' ); }
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
		echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";
		echo '<meta property="og:type" content="website">' . "\n";
	}
}, 1 );

/** schema.org Electrician uit Bedrijfsgegevens, op elke pagina. */
add_action( 'wp_head', function () {
	$gebied = array_filter( array_map( 'trim', explode( ',', es_info( 'werkgebied' ) ) ) );
	$adres  = es_info( 'adres' );
	$straat = $adres; $postcode = ''; $plaats = '';
	if ( preg_match( '/^(.*?),\s*(\d{4})\s+(.+)$/u', $adres, $m ) ) { $straat = $m[1]; $postcode = $m[2]; $plaats = $m[3]; }
	$data = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'Electrician',
		'name'       => es_info( 'naam' ),
		'url'        => home_url( '/' ),
		'telephone'  => es_info( 'tel_link' ),
		'email'      => es_info( 'email' ),
		'image'      => get_template_directory_uri() . '/logo.png',
		'priceRange' => '€€',
		'address'    => array( '@type' => 'PostalAddress', 'streetAddress' => $straat, 'postalCode' => $postcode, 'addressLocality' => $plaats, 'addressCountry' => 'BE' ),
		'areaServed' => array_values( $gebied ),
		'openingHours' => es_info( 'uren' ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 2 );

/** Titel: "Paginatitel | Bedrijfsnaam Plaats" als Yoast niet actief is. */
add_filter( 'document_title_separator', function () { return '|'; } );
add_filter( 'document_title_parts', function ( $parts ) {
	if ( es_yoast_actief() ) { return $parts; }
	$parts['site'] = es_info( 'naam' );
	if ( is_front_page() ) { $parts['title'] = es_info( 'slogan' ); }
	return $parts;
} );
