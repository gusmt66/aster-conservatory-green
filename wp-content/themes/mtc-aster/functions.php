<?php

add_action ('init', 'init_template');

function init_template(){
  setup_template_theme();
  add_action( 'wp_enqueue_scripts', 'enqueue_template_scripts' );
}

// Override 'Howdy' message, because we're professionals.
function howdy_message($translated_text, $text, $domain) {
  $new_message = str_replace('Howdy', 'Welcome', $text);
  return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);


function setup_template_theme(){
  // Remove added padding from Admin Bar
  add_action('get_header', 'remove_admin_login_header');
  function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
  }

  // Setting up theme
  if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails' );
  }

  if (function_exists('register_sidebar')){
    register_sidebar(array('name'=>'Sidebar %d'));
  }

  if (function_exists('register_nav_menu')) {
    register_nav_menu( 'main_menu', 'Main Menu' );
    register_nav_menu( 'mobile_menu', 'Mobile Menu' );
  }

  if (function_exists('add_image_size')){
    // add_image_size('name', width, height, true);
  }

  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
  }

  // set Google Maps API for Advanced Custom Fields Pro use
  if( function_exists('acf_update_setting') ) {
	acf_update_setting('google_api_key', 'AIzaSyBLGDbL7PkNbZLKg2BRtIb6anAkSnl0Y_Y');
  }
}

function enqueue_template_scripts() {
  wp_deregister_script( 'jquery' ); // Google hosted jQuery
  wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js' );
  wp_enqueue_script( 'jquery' );

  wp_deregister_script( 'modernizr-js' ); //
  wp_register_script( 'modernizr-js', get_bloginfo('template_directory') . '/js/vendor/modernizr-custom.js', array(), false, true );
  wp_enqueue_script( 'modernizr-js' );

  wp_register_style('slick-css','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css');
  wp_enqueue_style('slick-css');

  wp_deregister_script( 'slick-js' );
  wp_register_script('slick-js', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js', array ( 'jquery' ), false, true );
  wp_enqueue_script('slick-js');

  wp_deregister_script( 'font-awesome' ); //font awesome script
  wp_register_script('font-awesome','https://use.fontawesome.com/releases/v5.2.0/js/all.js');
  wp_enqueue_script('font-awesome');

  wp_deregister_script( 'shiv' ); // 
  wp_register_script( 'shiv', get_bloginfo('template_directory') . '/js/html5shiv.js' );
  wp_enqueue_script( 'shiv' );
    
  wp_deregister_script( 'skrollr' ); // skrollr
  wp_register_script( 'skrollr', 'https://cdnjs.cloudflare.com/ajax/libs/skrollr/0.6.30/skrollr.min.js', array ( 'jquery','shiv' ), false, true );
  wp_enqueue_script( 'skrollr' );

  // wp_deregister_script( 'vendor-js' ); // combined vendor scripts
  // wp_register_script( 'vendor-js', get_bloginfo('template_directory') . '/js/dist/vendor.min.js', array ( 'jquery' ) );
  // wp_enqueue_script( 'vendor-js' );

  // wp_deregister_script( 'custom-js' ); // combined theme scripts
  // wp_register_script( 'custom-js', get_bloginfo('template_directory') . '/js/dist/main.min.js', array ( 'jquery', 'vendor-js' ), false, true );
  // wp_enqueue_script( 'custom-js' );

  wp_deregister_script( 'custom-js' ); // combined theme scripts
  wp_register_script( 'custom-js', get_bloginfo('template_directory') . '/js/src/template.min.js', array ( 'jquery','modernizr-js'), false, true );
  wp_enqueue_script( 'custom-js' );

  $ajax_theme_data = array(
    'templateURL' => get_bloginfo('template_directory')
  );
  wp_localize_script('custom-js', 'themeData', $ajax_theme_data);

  // Area page JS
  if(is_page_template('page-templates/neighborhood.php')) {
    // Google Maps API
    wp_register_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBLGDbL7PkNbZLKg2BRtIb6anAkSnl0Y_Y');

    // Map JS
    wp_register_script( 'poi-map-js', get_bloginfo('template_directory') . '/js/src/poi-map.min.js', array ( 'google-maps' ), false, true);
    wp_enqueue_script( 'poi-map-js' );


    wp_localize_script('poi-map-js', 'themeData', $ajax_theme_data);
  }
  // Floor Plans
  if(is_page_template('page-templates/floor-plans.php')) {

    // jQuery UI CSS
    //wp_register_style( 'jquery-ui-css', '//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css');
    //wp_enqueue_style( 'jquery-ui-css' );

    //JQuery UI CSS (customized with the colors of the theme)
    wp_register_style( 'jquery-ui-css', get_bloginfo('template_directory') . '/css/jquery-ui.css');
    wp_enqueue_style( 'jquery-ui-css' );

    // jQuery UI js
    wp_register_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js', array ( 'jquery' ), false, false );
    wp_enqueue_script( 'jquery-ui' );

    // jQuery Tablesorter js
    wp_register_script( 'jquery-tablesort', get_bloginfo('template_directory') . '/js/vendor/jquery.tablesorter.min.js', array ( 'jquery' ), false, false );
    wp_enqueue_script( 'jquery-tablesort' );

    // jQuery history js
    wp_register_script( 'jquery-history', '//cdnjs.cloudflare.com/ajax/libs/history.js/1.7.1/bundled/html5/jquery.history.js', array ( 'jquery' ), false, false );
    wp_enqueue_script( 'jquery-history' );

    wp_deregister_script( 'floor-plans-js' );
    wp_register_script( 'floor-plans-js', get_bloginfo('template_directory') . '/js/src/floorplans.min.js', array ( 'jquery', 'jquery-ui', 'jquery-tablesort', 'jquery-history' ), false, true );
    wp_enqueue_script( 'floor-plans-js' );

  }
  // Gallery
  if(is_page_template('page-templates/gallery.php')) {
      // Swipe functionality
      wp_deregister_script( 'touch-swipe-js' );
      wp_register_script( 'touch-swipe-js', get_bloginfo('template_directory') . '/js/vendor/jquery.detect_swipe.js', array ( 'jquery' ), false, true );
      wp_enqueue_script( 'touch-swipe-js' );

      //Featherlight: A JS library for galleries
      wp_register_style( 'featherlight-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css');
      wp_enqueue_style( 'featherlight-css' );

      wp_register_style( 'featherlight-gallery-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.css');
      wp_enqueue_style( 'featherlight-gallery-css' );
      
      wp_register_script( 'featherlight-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js', array ( 'jquery'), false, true );
      wp_enqueue_script( 'featherlight-js' );
      
      wp_register_script( 'featherlight-gallery-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.js', array ( 'jquery','featherlight-js','touch-swipe-js'), false, true );
      wp_enqueue_script( 'featherlight-gallery-js' );

      // Gallery JS
      wp_register_script( 'gallery-js', get_bloginfo('template_directory') . '/js/src/gallery.min.js', array ( 'jquery','touch-swipe-js' ), false, true);
      wp_enqueue_script( 'gallery-js' );
  }



}

// Adds page slug to Body Class function
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Returns property schema data
function mtc_print_microdata() {
	$microdata = array();
	if (is_page_template('page-templates/contact.php')) {
		// Creating the contact page microdata
		$contactMicrodata = array(
			'@context' => 'http://schema.org',
			'@type' => 'ContactPage'
		);

		// Adding The Elms microdata and then the Contact Page Microdata
		array_push($microdata, mtc_get_microdata());
		array_push($microdata, $contactMicrodata);

	} else {
		$microdata = mtc_get_microdata();
	}

	echo '<script type="application/ld+json">';
	echo json_encode($microdata, JSON_PRETTY_PRINT);
	echo '</script>';
}

function mtc_get_microdata() {
	if (function_exists('get_option')){
		$microdata = array(
			'@context' => 'http://schema.org',
			'@type' => 'Organization',
			'name' => get_field('property_name', 'options'),
			'address' => array(
				'@type' => 'PostalAddress',
				'streetAddress' => get_field('address', 'options'),
				'addressLocality' => get_field('city', 'options').', '.get_field('state', 'options'),
				'postalCode' => get_field('zip', 'options'),
			),
			'telephone' => get_field('phone', 'options'),
			'url' => get_home_url()
		);
		if ($header_logo = get_field('header_logo','options')){
			$microdata['logo'] = $header_logo['url'];
		}
		return $microdata;
	}
}

// Takes an alphabetic character and returns the phone numeric equivalent
function alpha_to_phone($char){
	$conversion = array('a' => 2, 'b' => 2, 'c' => '2', 'd' => 3, 'e' => 3, 'f' => 3, 'g' => 4, 'h' => 4, 'i' => 4, 'j' => 5, 'k' => 5, 'l' => 5, 'm' => 6, 'n' => 6, 'o' => 6, 'p' => 7, 'q' => 7, 'r' => 7, 's' => 7, 't' => 8, 'u' => 8, 'v' => 8, 'w' => 9, 'x' => 9, 'y' => 9, 'z' => 9);
	return $conversion[$char];
}

// Takes phone number, returns cleaned numeric equivalent for mobile link functionality
function clean_phone($phone){
	$chars = str_split(strtolower($phone));
	$phone = '';
	foreach($chars as $char){
		if (ctype_lower($char)){
			$char = alpha_to_phone($char);
		}
		$phone .= $char;
	}
	$phone = preg_replace("/[^0-9]/", "",$phone);
	return $phone;
}

// Create Site Options - uncomment if needed.
 require_once( get_template_directory() . '/incl/acf_site_options.php' );

// Custom Functions
require_once( get_template_directory() . '/incl/custom-functions.php' );