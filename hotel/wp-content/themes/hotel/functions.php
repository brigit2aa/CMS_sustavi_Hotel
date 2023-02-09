<?php
if ( ! function_exists( 'inicijaliziraj_temu' ) )
{
	function inicijaliziraj_temu()
	{
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		register_nav_menus( array(
			'glavni-menu'	=> "Glavni navigacijski izbornik",
			'sporedni-menu' => "Izbornik u podnožju",
		) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-background', apply_filters(
				'test_custom_background_args', array
				(
					'default-color' => 'f4f4f4',
					'default-image' => '',
				)
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
add_action( 'after_setup_theme', 'inicijaliziraj_temu' );

//Učitavanje css datoteka
function hotel_theme_css() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/vendor/fontawesome-free/css/all.min.css' );
	wp_enqueue_style( 'glavni-css', get_template_directory_uri() . '/style.css' );
}
add_action('wp_enqueue_scripts', 'hotel_theme_css');

//Učitavanje js datoteka
function hotel_theme_js() {		
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), true);
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), true);
	wp_enqueue_script('fontawesome-js', get_template_directory_uri().'/vendor/fontawesome-free/js/all.min.js', array('jquery'), true);
	wp_enqueue_script('jquery-js', get_template_directory_uri().'/vendor/jquery/jquery.min.js', array('jquery'), true);
	wp_enqueue_script('glavni-js', get_template_directory_uri().'/js/script.js', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'hotel_theme_js');

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

function aktiviraj_sidebar() {
    register_sidebar(
		array (
			'name' => "Footer sidebar 1",
			'id' => 'footer-sidebar1',
			'description' => "Footer sidebar 1",
			'before_widget' => '<div class="Footer-sidebar">',
			'after_widget' => "</div>",
			'before_title' => '<h4 class="footer-sidebar-title">',
			'after_title' => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'aktiviraj_sidebar' );


//--->CPT HOTELI
function registriraj_hotel_cpt() {
    $labels = array(
        'name' => _x( 'Hoteli', 'Post Type General Name', 'vuv' ),
        'singular_name' => _x( 'Hotel', 'Post Type Singular Name', 'vuv' ),
        'menu_name' => __( 'Hoteli', 'vuv' ),
        'name_admin_bar' => __( 'Hoteli', 'vuv' ),
        'archives' => __( 'Hoteli arhiva', 'vuv' ),
        'attributes' => __( 'Atributi', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski element', 'vuv' ),
        'all_items' => __( 'Svi hoteli', 'vuv' ),
        'add_new_item' => __( 'Dodaj novi hotel', 'vuv' ),
        'add_new' => __( 'Dodaj novi', 'vuv' ),
        'new_item' => __( 'Novi hotel', 'vuv' ),
        'edit_item' => __( 'Uredi hotel', 'vuv' ),
        'update_item' => __( 'Ažuriraj hotel', 'vuv' ),
        'view_item' => __( 'Pogledaj hotel', 'vuv' ),
        'view_items' => __( 'Pogledaj hotele', 'vuv' ),
        'search_items' => __( 'Pretraži hotele', 'vuv' ),   
        'not_found' => __( 'Nije pronađeno', 'vuv' ),
        'not_found_in_trash' => __( 'Nije pronađeno u smeću', 'vuv' ),
        'featured_image' => __( 'Glavna slika', 'vuv' ),
        'set_featured_image' => __( 'Postavi glavnu sliku', 'vuv' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'vuv' ),
        'use_featured_image' => __( 'Postavi za glavnu sliku', 'vuv' ),
        'insert_into_item' => __( 'Umentni', 'vuv' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'vuv' ),
        'items_list' => __( 'Lista', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija među hotelima', 'vuv' ),
        'filter_items_list' => __( 'Filtriranje hotela', 'vuv' ),
    );
    $args = array(
        
        'label' => __( 'Hotel', 'vuv' ),
        'description' => __( 'Hotel post type', 'vuv' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => false,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type( 'hotel', $args );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'init', 'registriraj_hotel_cpt', 0 );

    
//CMB HOTEL KONTAKT
function add_meta_box_kontakt_info() {
    add_meta_box('kontakt', 'Kontakt', 'html_meta_box_kontakt_info', 'hotel');
}
function html_meta_box_kontakt_info($post) {
    wp_nonce_field('spremi_kontakt_info', 'kontakt_info_adresa_nonce');
    wp_nonce_field('spremi_kontakt_info', 'kontakt_info_telefon_nonce');
    wp_nonce_field('spremi_kontakt_info', 'kontakt_info_email_nonce');
    wp_nonce_field('spremi_kontakt_info', 'kontakt_info_karta_nonce');

    //Dohvaćanje meta vrijednosti
    $sAdresa = get_post_meta($post->ID, 'kontakt_info_adresa', true);
    $sTelefon = get_post_meta($post->ID, 'kontakt_info_telefon', true);
    $sEmail = get_post_meta($post->ID, 'kontakt_info_email', true);
    $sKarta = get_post_meta($post->ID, 'kontakt_info_karta', true);

    echo'
    <div>
    <br/>
    <div>
    <label for="kontakt_info_adresa">Adresa:</label>
    <input type="text" id="kontakt_info_adresa" name="kontakt_info_adresa" value="'.$sAdresa.'" />
    </div>
    <br/>
    <div>
    <label for="kontakt_info_telefon">Telefon:</label>
    <input type="text" id="kontakt_info_telefon" name="kontakt_info_telefon" value="'.$sTelefon.'" />
    </div>
    <br/>
    <div>
    <label for="kontakt_info_email">e-mail:</label>
    <input type="text" id="kontakt_info_email" name="kontakt_info_email" value="'.$sEmail.'" />
    </div>
    <br/>
    <div>
    <label for="kontakt_info_karta">Karta:</label>
    <input type="text" id="kontakt_info_email" name="kontakt_info_karta" value="'.$sKarta.'" />
    </div> 
    </div>
    ';
}

function spremi_kontakt_info($post_id) {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce_kontakt_info_adresa = (isset($_POST['kontakt_info_adresa_nonce']) && wp_verify_nonce($_POST['kontakt_info_adresa_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_kontakt_info_telefon = (isset($_POST['kontakt_info_telefon_nonce']) && wp_verify_nonce($_POST['kontakt_info_telefon_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_kontakt_info_email = (isset($_POST['kontakt_info_email_nonce']) && wp_verify_nonce($_POST['kontakt_info_email_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_kontakt_info_karta = (isset($_POST['kontakt_info_karta_nonce']) && wp_verify_nonce($_POST['kontakt_info_karta_nonce'], basename(__FILE__))) ? 'true' : 'false';

    if($is_autosave || $is_revision || !$is_valid_nonce_kontakt_info_adresa || !$is_valid_nonce_kontakt_info_telefon || !$is_valid_nonce_kontakt_info_email || !$is_valid_nonce_kontakt_info_karta){
        return;
    }
//
    if(!empty($_POST['kontakt_info_adresa']))
    {
        update_post_meta($post_id, 'kontakt_info_adresa',
        $_POST['kontakt_info_adresa']);
    }
    else {
        delete_post_meta($post_id, 'kontakt_info_adresa');
    }
//
    if(!empty($_POST['kontakt_info_telefon']))
    {
        update_post_meta($post_id, 'kontakt_info_telefon',
        $_POST['kontakt_info_telefon']);
    }
    else {
        delete_post_meta($post_id, 'kontakt_info_telefon');
    }
//
    if(!empty($_POST['kontakt_info_email']))
    {
        update_post_meta($post_id, 'kontakt_info_email',
        $_POST['kontakt_info_email']);
    }
    else {
        delete_post_meta($post_id, 'kontakt_info_email');
    }
// 
    if(!empty($_POST['kontakt_info_karta']))
    {
        update_post_meta($post_id, 'kontakt_info_karta',
        $_POST['kontakt_info_karta']);
    }
    else {
        delete_post_meta($post_id, 'kontakt_info_karta');
    }
}
add_action('add_meta_boxes', 'add_meta_box_kontakt_info');
add_action('save_post', 'spremi_kontakt_info');

//-->TAKSONOMIJA KATEGORIJA HOTELA
function registriraj_taksonomiju_kategorija_hotela() {
    $labels = array(
        'name' => _x( 'Kategorije hotela', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'Kategorija hotela', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Kategorije hotela', 'vuv' ),
        'all_items' => __( 'Sve kategorije hotela', 'vuv' ),
        'parent_item' => __( 'Roditeljska kategorija', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljska kategorija', 'vuv' ),
        'new_item_name' => __( 'Nova kategorija hotela', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu kategoriju hotela', 'vuv' ),
        'edit_item' => __( 'Uredi kategoriju hotela', 'vuv' ),
        'update_item' => __( 'Ažuiriraj kategoriju hotela', 'vuv' ),
        'view_item' => __( 'Pogledaj kategoriju hotela', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite kategorije hotela sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni kategoriju hotela', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularne kategorije hotela', 'vuv' ),
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema kategoriju hotela', 'vuv' ),
        'items_list' => __( 'Lista kategorija hotela', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'kategorija_hotela', array( 'hotel' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_kategorija_hotela', 0 );
    
    //-->TAKSONOMIJA LOKACIJA HOTELA
function registriraj_taksonomiju_lokacija_hotela() {
    $labels = array(
        'name' => _x( 'Lokacije hotela', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'Lokacija hotela', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Lokacije hotela', 'vuv' ),
        'all_items' => __( 'Sve lokacije', 'vuv' ),
        'parent_item' => __( 'Roditeljska lokacija', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljska lokacija', 'vuv' ),
        'new_item_name' => __( 'Nova lokacija', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu lokaciju hotela', 'vuv' ),
        'edit_item' => __( 'Uredi lokaciju hotela', 'vuv' ),
        'update_item' => __( 'Ažuiriraj lokaciju hotela', 'vuv' ),
        'view_item' => __( 'Pogledaj lokaciju hotela', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite lokacije sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni lokaciju hotela', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularne lokacije hotela', 'vuv' ),
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema lokacije', 'vuv' ),
        'items_list' => __( 'Lista lokacija hotela', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'lokacija_hotela', array( 'hotel' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_lokacija_hotela', 0 );
    
//-->TAKSONOMIJA USLUGA HOTELA
function registriraj_taksonomiju_usluga_hotela() {
    $labels = array(
        'name' => _x( 'Usluge hotela', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'Usluga hotela', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Usluge hotela', 'vuv' ),
        'all_items' => __( 'Sve usluge', 'vuv' ),
        'parent_item' => __( 'Roditeljska usluga', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljska usluga', 'vuv' ),
        'new_item_name' => __( 'Nova usluga', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu uslugu hotela', 'vuv' ),
        'edit_item' => __( 'Uredi lokaciju hotela', 'vuv' ),
        'update_item' => __( 'Ažuiriraj uslugu hotela', 'vuv' ),
        'view_item' => __( 'Pogledaj uslugu hotela', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite usluge sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni uslugu hotela', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularne usluge hotela', 'vuv' ),
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema usluge', 'vuv' ),
        'items_list' => __( 'Lista usluga hotela', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'usluga_hotela', array( 'hotel' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_usluga_hotela', 0 );

//Dohvatiti hotele 
function daj_hotele(){
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'hotel',
        'post_status' => 'publish',
       );
            $hoteli = get_posts( $args );

            $sHtml = '<div class= "container containercard"><div class="row">';
            foreach ($hoteli as $hotel)
            {
                $sHotelUrl = $hotel->guid;
                $sHotelNaziv = $hotel->post_title;
                $sHotelID = $hotel->ID;
                $thumbnail_url = get_the_post_thumbnail_url($sHotelID);

                $sTerms = get_the_terms( $sHotelID , 'kategorija_hotela' );
                if ( $sTerms != null ){
                    foreach( $sTerms as $term ) {
                    
                     //Dohvačam kategoriju hotela
                    }}
  
                $sTermsLokacija = get_the_terms( $sHotelID , 'lokacija_hotela' );
                if ( $sTermsLokacija != null ){
                    foreach( $sTermsLokacija as $termLokacija ) {
                    
                     //Dohvačam lokaciju hotela
                    }}
                
                $sHtml .='<div class="card mb-3" style="width: 18rem; margin-left: 2%; margin-top: 2%";>
                </br>
                <img class="card-img-top" src="'.$thumbnail_url.'" alt="'.$sHotelNaziv.'" style=" width: 100%; height: 50%;">
                <div class="card-body">
               
                <h5  class="card-title" href="'.$sHotelUrl.'">'.$sHotelNaziv.'</h5>
                <div><p >'.$term->name.'</p></div>
                <div><p style="color: gray;">'.$termLokacija->name.'</p></div>
                <a style="color: black;" href="'.$sHotelUrl.'"><button type="button" class="btn btn-dark" style="color: gray; width: 100%;">Vidi više</button></a>
                </div>
              </div>';
            }
            $sHtml .='</div></div>';
            return $sHtml;
}

//--->CPT SOBE
function registriraj_sobu_cpt() {
    $labels = array(
        'name' => _x( 'Sobe', 'Post Type General Name', 'vuv' ),
        'singular_name' => _x( 'Soba', 'Post Type Singular Name', 'vuv' ),
        'menu_name' => __( 'Sobe', 'vuv' ),
        'name_admin_bar' => __( 'Sobe', 'vuv' ),
        'archives' => __( 'Sobe arhiva', 'vuv' ),
        'attributes' => __( 'Atributi', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski element', 'vuv' ),
        'all_items' => __( 'Sve sobe', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu sobu', 'vuv' ),
        'add_new' => __( 'Dodaj novu', 'vuv' ),
        'new_item' => __( 'Novu sobu', 'vuv' ),
        'edit_item' => __( 'Uredi sobu', 'vuv' ),
        'update_item' => __( 'Ažuriraj sobu', 'vuv' ),
        'view_item' => __( 'Pogledaj sobu', 'vuv' ),
        'view_items' => __( 'Pogledaj sobe', 'vuv' ),
        'search_items' => __( 'Pretraži sobe', 'vuv' ),
        'not_found' => __( 'Nije pronađeno', 'vuv' ),
        'not_found_in_trash' => __( 'Nije pronađeno u smeću', 'vuv' ),
        'featured_image' => __( 'Glavna slika', 'vuv' ),
        'set_featured_image' => __( 'Postavi glavnu sliku', 'vuv' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'vuv' ),
        'use_featured_image' => __( 'Postavi za glavnu sliku', 'vuv' ),
        'insert_into_item' => __( 'Umentni', 'vuv' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'vuv' ),
        'items_list' => __( 'Lista', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija među sobama', 'vuv' ),
        'filter_items_list' => __( 'Filtriranje soba', 'vuv' ),
    );
    $args = array(
        'label' => __( 'Soba', 'vuv' ),
        'description' => __( 'Soba post type', 'vuv' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => false,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type( 'soba', $args );
}
add_action( 'init', 'registriraj_sobu_cpt', 0 );


//CMB SOBA INFO
function add_meta_box_soba_info() {
    add_meta_box('soba', 'Soba', 'html_meta_box_soba_info', 'soba');
}
function html_meta_box_soba_info($post) {
    wp_nonce_field('spremi_soba_info', 'soba_info_cijena_nonce');
    wp_nonce_field('spremi_soba_info', 'soba_info_broj_osoba_nonce');
   
    //Dohvaćanje meta vrijednosti
    $sCijena = get_post_meta($post->ID, 'soba_info_cijena', true);
    $sBrojOsoba = get_post_meta($post->ID, 'soba_info_broj_osoba', true);

    echo'
    <div>
    <br/>
    <div>
    <label for="soba_info_cijena">Cijena:</label>
    <input type="text" id="soba_info_cijena" name="soba_info_cijena" value="'.$sCijena.'" />
    </div>
    <br/>
    <div>
    <label for="soba_info_broj_osoba">Broj osoba:</label>
    <input type="text" id="soba_info_broj_osoba" name="soba_info_broj_osoba" value="'.$sBrojOsoba.'" />
    </div>
    </div>
    ';
}//////////////////////////////////
function spremi_soba_info($post_id) {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce_soba_info_cijena = (isset($_POST['soba_info_cijena_nonce']) && wp_verify_nonce($_POST['soba_info_cijena_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_soba_info_broj_osoba = (isset($_POST['soba_info_broj_osoba_nonce']) && wp_verify_nonce($_POST['soba_info_broj_osoba_nonce'], basename(__FILE__))) ? 'true' : 'false';

    if($is_autosave || $is_revision || !$is_valid_nonce_soba_info_cijena || !$is_valid_nonce_soba_info_broj_osoba){
        return;
    }
//
    if(!empty($_POST['soba_info_cijena']))
    {
        update_post_meta($post_id, 'soba_info_cijena',
        $_POST['soba_info_cijena']);
    }
    else {
        delete_post_meta($post_id, 'soba_info_cijena');
    }
//
    if(!empty($_POST['soba_info_broj_osoba']))
    {
        update_post_meta($post_id, 'soba_info_broj_osoba',
        $_POST['soba_info_broj_osoba']);
    }
    else {
        delete_post_meta($post_id, 'soba_info_broj_osoba');
    }
}
add_action('add_meta_boxes', 'add_meta_box_soba_info');
add_action('save_post', 'spremi_soba_info');


//-->TAKSONOMIJA TIP SOBE
function registriraj_taksonomiju_tip_sobe() {
    $labels = array(
        'name' => _x( 'Tipovi soba', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'Tip sobe', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Tipovi soba', 'vuv' ),
        'all_items' => __( 'Svi tipovi sobe', 'vuv' ),
        'parent_item' => __( 'Roditeljski tip', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski tip', 'vuv' ),
        'new_item_name' => __( 'Novi tip sobe', 'vuv' ),
        'add_new_item' => __( 'Dodaj novi tip sobe', 'vuv' ),
        'edit_item' => __( 'Uredi tip sobe', 'vuv' ),
        'update_item' => __( 'Ažuiriraj tip sobe', 'vuv' ),
        'view_item' => __( 'Pogledaj ime sobe', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite tipove sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni tip sobe', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularni tipovi soba', 'vuv' ), 
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema tipa sobe', 'vuv' ),
        'items_list' => __( 'Lista tipova soba', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'tip_sobe', array( 'soba' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_tip_sobe', 0 );

//-->TAKSONOMIJA STATUS
function registriraj_taksonomiju_statusa() {
    $labels = array(
        'name' => _x( 'Statusi', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'Status', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Statusi', 'vuv' ),
        'all_items' => __( 'Svi statusi', 'vuv' ),
        'parent_item' => __( 'Roditeljski status', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski status', 'vuv' ),
        'new_item_name' => __( 'Novai status', 'vuv' ),
        'add_new_item' => __( 'Dodaj novi status', 'vuv' ),
        'edit_item' => __( 'Uredi status', 'vuv' ),
        'update_item' => __( 'Ažuiriraj status', 'vuv' ),
        'view_item' => __( 'Pogledaj status', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite statuse sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni status', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularni statusi', 'vuv' ),
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema statusa', 'vuv' ),
        'items_list' => __( 'Lista statusa', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'status', array( 'soba' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_statusa', 0 );

function daj_sobe(){
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'soba',
        'post_status' => 'publish',
    );
    $sobe = get_posts( $args );
    $sHtml = '<div class= "container containercard"><div class="row">';
            foreach ($sobe as $soba)
            {
                $sSobaUrl = $soba->guid;
                $sSobaNaziv = $soba->post_title;
                $sSobaID = $soba->ID;

                $sHtml .='<div class="card" style="width: 19rem; margin-left: 1.9%; margin-top: 3%";>
                <div class="card-body">
                <h5  class="card-title"  style="color: gray; font-size: 14px; margin-bottom: 10%;" href="'.$sSobaUrl.'">'.$sSobaNaziv.'</h5>
                <a style="color: black;" href="'.$sSobaUrl.'"><button type="button" class="btn btn-dark" style="color: gray; width: 100%;">Vidi više</button></a>
                </div>
              </div>';
            }
            $sHtml .='</div></div>';
            return $sHtml;

}
//--->CPT REZERVACIJE
function registriraj_rezervaciju_cpt() {
    $labels = array(
        'name' => _x( 'Rezervacije', 'Post Type General Name', 'vuv' ),
        'singular_name' => _x( 'Rezervacija', 'Post Type Singular Name', 'vuv' ),
        'menu_name' => __( 'Rezervacije', 'vuv' ),
        'name_admin_bar' => __( 'Rezervacije', 'vuv' ),
        'archives' => __( 'Rezervacije arhiva', 'vuv' ),
        'attributes' => __( 'Atributi', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski element', 'vuv' ),
        'all_items' => __( 'Sve rezervacije', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu rezervaciju', 'vuv' ),
        'add_new' => __( 'Dodaj novu', 'vuv' ),
        'new_item' => __( 'Novu rezervaciju', 'vuv' ),
        'edit_item' => __( 'Uredi rezervaciju', 'vuv' ),
        'update_item' => __( 'Ažuriraj rezervaciju', 'vuv' ),
        'view_item' => __( 'Pogledaj rezervaciju', 'vuv' ),
        'view_items' => __( 'Pogledaj rezervacije', 'vuv' ),
        'search_items' => __( 'Pretraži rezervacije', 'vuv' ),
        'not_found' => __( 'Nije pronađeno', 'vuv' ),
        'not_found_in_trash' => __( 'Nije pronađeno u smeću', 'vuv' ),
        'featured_image' => __( 'Glavna slika', 'vuv' ),
        'set_featured_image' => __( 'Postavi glavnu sliku', 'vuv' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'vuv' ),
        'use_featured_image' => __( 'Postavi za glavnu sliku', 'vuv' ),
        'insert_into_item' => __( 'Umentni', 'vuv' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'vuv' ),
        'items_list' => __( 'Lista', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija među rezervacijama', 'vuv' ),
        'filter_items_list' => __( 'Filtriranje rezervacija', 'vuv' ),
    );
    $args = array(
        'label' => __( 'Rezervacija', 'vuv' ),
        'description' => __( 'Rezervacija post type', 'vuv' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => false,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type( 'rezervacija', $args );
}
add_action( 'init', 'registriraj_rezervaciju_cpt', 0 );

function registriraj_taksonomiju_datum() {
    $labels = array(
        'name' => _x( 'Datumi', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'datum', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Datumi', 'vuv' ),
        'all_items' => __( 'Svdatumia', 'vuv' ),
        'parent_item' => __( 'Roditeljski datum', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski datum', 'vuv' ),
        'new_item_name' => __( 'Novi datum', 'vuv' ),
        'add_new_item' => __( 'Dodaj novi datum', 'vuv' ),
        'edit_item' => __( 'Uredi datum', 'vuv' ),
        'update_item' => __( 'Ažuiriraj datum', 'vuv' ),
        'view_item' => __( 'Pogledaj datum', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite datume sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni datum', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularni datumi', 'vuv' ),
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema datuma', 'vuv' ),
        'items_list' => __( 'Lista datuma', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'datum', array( 'rezervacija' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_datum', 0 );


//CMB REZERVACIJA INFO
function add_meta_box_rezervacija_info() {
    add_meta_box('rezervacija', 'Rezervacija', 'html_meta_box_rezervacija_info', 'rezervacija');
}
function html_meta_box_rezervacija_info($post) {
    wp_nonce_field('spremi_rezervacija_info', 'rezervacija_info_check_in_nonce');
    wp_nonce_field('spremi_rezervacija_info', 'rezervacija_info_check_out_nonce');
   
    //Dohvaćanje meta vrijednosti
    $sIme = get_post_meta($post->ID, 'rezervacija_info_ime', true);
    $sPrezime = get_post_meta($post->ID, 'rezervacija_info_prezime', true);
    $sEmail = get_post_meta($post->ID, 'rezervacija_info_email', true);
    $sTelMob = get_post_meta($post->ID, 'rezervacija_info_tel_mob', true);
    $sCheckIn = get_post_meta($post->ID, 'rezervacija_info_check_in', true);
    $sCheckOut = get_post_meta($post->ID, 'rezervacija_info_check_out', true);
    $sHotel = get_post_meta($post->ID, 'rezervacija_info_hotel', true); 
    $sSoba = get_post_meta($post->ID, 'rezervacija_info_soba', true);

    echo'
    <div>
    <br/>
    <div>
    <label for="rezervacija_info_ime">Ime:</label>
    <input type="text" id="rezervacija_info_ime" name="rezervacija_info_ime" value="'.$sIme.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_prezime">Prezime:</label>
    <input type="text" id="rezervacija_info_prezime" name="rezervacija_info_prezime" value="'.$sPrezime.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_email">E-mail:</label>
    <input type="text" id="rezervacija_info_email" name="rezervacija_info_email" value="'.$sEmail.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_tel_mob">Tel/Mob:</label>
    <input type="text" id="rezervacija_info_tel_mob" name="rezervacija_info_tel_mob" value="'.$sTelMob.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_check_in">Datum prijave:</label>
    <input type="text" id="rezervacija_info_check_in" name="rezervacija_info_check_in" value="'.$sCheckIn.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_check_out">Datum odjave:</label>
    <input type="text" id="rezervacija_info_check_out" name="rezervacija_info_check_out" value="'.$sCheckOut.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_hotel">Hotel:</label>
    <input type="text" id="rezervacija_info_hotel" name="rezervacija_info_hotel" value="'.$sHotel.'" />
    </div>
    <br/>
    <div>
    <label for="rezervacija_info_soba">Soba:</label>
    <input type="text" id="rezervacija_info_soba" name="rezervacija_info_soba" value="'.$sSoba.'" />
    </div>
    </div>     
    ';
}//////////////////////////////////
function spremi_rezervacija_info($post_id) {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce_rezervacija_info_ime = (isset($_POST['rezervacija_info_ime_nonce']) && wp_verify_nonce($_POST['rezervacija_info_ime_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_prezime = (isset($_POST['rezervacija_info_prezime_nonce']) && wp_verify_nonce($_POST['rezervacija_info_prezime_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_email = (isset($_POST['rezervacija_info_email_nonce']) && wp_verify_nonce($_POST['rezervacija_info_email_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_tel_mob = (isset($_POST['rezervacija_info_tel_mob_nonce']) && wp_verify_nonce($_POST['rezervacija_info_tel_mob_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_check_in = (isset($_POST['rezervacija_info_check_in_nonce']) && wp_verify_nonce($_POST['rezervacija_info_check_in_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_check_out = (isset($_POST['rezervacija_info_check_out_nonce']) && wp_verify_nonce($_POST['rezervacija_info_check_out_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_hotel = (isset($_POST['rezervacija_info_hotel_nonce']) && wp_verify_nonce($_POST['rezervacija_info_hotel_nonce'], basename(__FILE__))) ? 'true' : 'false';
    $is_valid_nonce_rezervacija_info_soba = (isset($_POST['rezervacija_info_soba_nonce']) && wp_verify_nonce($_POST['rezervacija_info_soba_nonce'], basename(__FILE__))) ? 'true' : 'false';
    
    if($is_autosave || $is_revision || !$is_valid_nonce_rezervacija_info_ime || !$is_valid_nonce_rezervacija_info_prezime || !$is_valid_nonce_rezervacija_info_email || !$is_valid_nonce_rezervacija_info_tel_mob || !$is_valid_nonce_rezervacija_info_check_in || !$is_valid_nonce_rezervacija_info_check_out || !$is_valid_nonce_rezervacija_info_hotel || !$is_valid_nonce_rezervacija_info_soba ){
        return;
    }
//
    if(!empty($_POST['rezervacija_info_ime']))
    {
        update_post_meta($post_id, 'rezervacija_info_ime',
        $_POST['rezervacija_info_ime']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_ime');
    }
//
    if(!empty($_POST['rezervacija_info_prezime']))
    {
        update_post_meta($post_id, 'rezervacija_info_prezime',
        $_POST['rezervacija_info_prezime']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_prezime');
    }
//
    if(!empty($_POST['rezervacija_info_email']))
    {
        update_post_meta($post_id, 'rezervacija_info_email',
        $_POST['rezervacija_info_email']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_email');
    }
//
    if(!empty($_POST['rezervacija_info_tel_mob']))
    {
        update_post_meta($post_id, 'rezervacija_info_tel_mob',
        $_POST['rezervacija_info_tel_mob']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_tel_mob');
    }
//
    if(!empty($_POST['rezervacija_info_check_in']))
    {
        update_post_meta($post_id, 'rezervacija_info_check_in',
        $_POST['rezervacija_info_check_in']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_check_in');
    }
//
    if(!empty($_POST['rezervacija_info_check_out']))
    {
        update_post_meta($post_id, 'rezervacija_info_check_out',
        $_POST['rezervacija_info_check_out']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_check_out');
    }

//
    if(!empty($_POST['rezervacija_info_hotel']))
    {
        update_post_meta($post_id, 'rezervacija_info_hotel',
        $_POST['rezervacija_info_hotel']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_hotel');
    }
//
    if(!empty($_POST['rezervacija_info_soba']))
    {
        update_post_meta($post_id, 'rezervacija_info_soba',
        $_POST['rezervacija_info_soba']);
    }
    else {
        delete_post_meta($post_id, 'rezervacija_info_soba');
    }
}
add_action('add_meta_boxes', 'add_meta_box_rezervacija_info');
add_action('save_post', 'spremi_rezervacija_info');

//-->TAKSONOMIJA OSOBA
function registriraj_taksonomiju_osoba() {
    $labels = array(
        'name' => _x( 'Osobe', 'Taxonomy General Name',
        'vuv' ),
        'singular_name' => _x( 'Osoba', 'Taxonomy Singular Name',
        'vuv' ),
        'menu_name' => __( 'Osobe', 'vuv' ),
        'all_items' => __( 'Sve osobe', 'vuv' ),
        'parent_item' => __( 'Roditeljska osoba', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljska osoba', 'vuv' ),
        'new_item_name' => __( 'Nova osoba', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu osobu', 'vuv' ),
        'edit_item' => __( 'Uredi osobu', 'vuv' ),
        'update_item' => __( 'Ažuiriraj osobu', 'vuv' ),
        'view_item' => __( 'Pogledaj osobu', 'vuv' ),
        'separate_items_with_commas' => __( 'Odvojite datume sa zarezima', 'vuv' ),
        'add_or_remove_items' => __( 'Dodaj ili ukloni osobu', 'vuv' ),
        'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
        'popular_items' => __( 'Popularne osobe', 'vuv' ),
        'search_items' => __( 'Pretraga', 'vuv' ),
        'not_found' => __( 'Nema rezultata', 'vuv' ),
        'no_terms' => __( 'Nema osobu', 'vuv' ),
        'items_list' => __( 'Lista osoba', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija', 'vuv' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'osoba', array( 'rezervacija' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_osoba', 0 );

function daj_rezervaciju(){
    $args = array(
        'posts_per_page' => -1, 
        'post_type' => 'rezervacija',
        'post_status' => 'publish',
    );
    $rezervacije = get_posts( $args );
    $sHtml = '<div class= "container containercard">';
            foreach ($rezervacije as $rezervacija)
            {
                $sRezervacijaUrl = $rezervacija->guid;
                $sRezervacijaNaziv = $rezervacija->post_title;
                $sRezervacijaID = $rezervacija->ID;

                $sHtml .='
                <h5  class="card-title"  style="color: gray; font-size: 14px; margin-bottom: 10%;" href="'.$sRezervacijaUrl.'">'.$sRezervacijaNaziv.'</h5>
                <a style="color: black;" href="'.$sRezervacijaUrl.'"><button id="idbuton" type="button" class="btn btn-dark" style="display:none; color: gray; width: 100%; ">Rezerviraj</button></a>
                ';                                                            
            }
            
            $sHtml .='</div></div>';
            return $sHtml;


}

?>