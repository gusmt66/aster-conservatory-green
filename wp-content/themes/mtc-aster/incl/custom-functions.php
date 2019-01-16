<?php

// This file holds the different custom functions.  Most of these functions refer to
// fields created with the ACF plugin, and will not work unless the fields have been defined.
// There is a .json file that is included with the respository that can be imported to create the fields.
//sizes are "thumbnail","medium","medium_large", "large" and "full"
function print_responsive_image($image, $mobile='thumbnail', $tablet='medium', $desktop='medium_large', $large='large'){

  echo '<img class="responsive-img" data-m="'.$image['sizes'][$mobile].'"  data-t="'.$image['sizes'][$tablet].'"  data-d="'.$image['url'].'"  data-l="'.$image['url'].'" src="" alt="'.$image['alt'].'" />'; 

}

function print_image($image, $width=125, $height=75){
  if($image){
    echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
  // } elseif(is_user_logged_in() && get_field('show_placeholder_images','options')){
  } else{
    //echo '<img src="http://via.placeholder.com/'.$width.'x'.$height.'">';
  }
}

function print_property_name(){
  $property = get_field('property_name','options');
  if($property){
    echo '<div class="property-name">'.$property.'</div>';
  }
}

// Header functions
function print_logo(){
  if($logo = get_field('logo', 'options')) {
    echo '<div id="logo">';
 	  	echo '<a href="'. home_url('') .'">';
   			echo '<img src="'. $logo['url'] .'" />';
    	echo '</a>';
    echo '</div>';
  }
}

function print_trigger() {
  echo '<div id="nav-trigger" class="inactive ease" role="button" tabindex="0">';
    echo '<div class="trigger-wrap">';
	    echo '<span class="line"></span>';
	    echo '<span class="line"></span>';
	    echo '<span class="line"></span>';
    echo '</div>';
  echo '</div>';
}

function print_header_icons(){
  $tour = get_field('tour_code','options');
  $chat = get_field('chat_url','options');
  
  if($chat || $tour){
    echo '<div class="header-icons-container">';
    if($tour){
      //echo '<a id="schedule-tour-popup-button"><i class="fa fa-calendar-alt"></i></a>';
      echo $tour;
    }
    if($chat){
      echo '<a href="'.$chat.'"><i class="fa fa-comments"></i></a>';
    }
    echo '</div>';    
  }

}

function print_mobile_address_link(){
  $address = get_field('address','options');
  $city = get_field('city','options');
  $state = get_field('state','options');
  $zip = get_field('zip','options');
  if($address){
    echo '<div class="link mobile-icon"><a class="address-link" href="https://maps.google.com/?daddr='.$address.', '.$city.', '.$state.' '.$zip.'" target="_blank"><i class="fas fa-map-marker-alt"></i></a></div>';
  }
}

function print_address() {
  $address = get_field('address','options');
  $city = get_field('city','options');
  $state = get_field('state','options');
  $zip = get_field('zip','options');
  if($address){
      echo '<div class="address">';
        echo '<a href="https://www.google.com/maps/place/'.$address.'+'.$city.'+'.$state.'+'.$zip.'" target="_blank">';
          echo '<p class="address-line1">'.$address.'</p>';
          echo '<p class="address-line2">'.$city.', '.$state.' '.$zip.'</p>';
          echo '</a>';
      echo '</div>';
    }
}

function print_phone_number(){
  if ($phone = get_field('phone','options')){
    echo '<div class="phone">';
      echo '<a href="tel:+1'.clean_phone($phone).'" class="phone-number ease">'.$phone.'</a>';
    echo '</div>';
  }
}

function print_mobile_phone_link(){
  if ($phone = get_field('phone','options')){
    echo '<div class="link mobile-icon"><a href="tel:+1'.clean_phone($phone).'" class="phone-link" aria-label="Click to Call"><i class="fas fa-phone"></i></a></div>';
  }
}

function print_social_icons($class='desktop'){
  if($social = get_field('social_media','options') ){
    echo '<div class="social-icons '.$class.'">';
      foreach ($social as $icon) {
        $domain = parse_url($icon['url']);
        $type = strtolower($icon['social_media_type']);
        echo '<a class="icon" href="'.$icon['url'].'" target="_blank" aria-label="'.ucfirst(substr($domain['host'],0,-4)).'">';
          if($type === 'facebook'){
            $type .= '-f';
          }
          echo '<i class="fab fa-'.$type.'"></i>';
        echo '</a>';
      }
    echo '</div>';
  }
}

//Pages functions
function print_button($button,$size='small',$class='primary',$aria_label=''){
  echo '<div class="btn btn-'.$class.' '.$size.'" role="button" aria-label="'.$aria_label.'">';
    echo '<a href="'.$button['url'].'" target="'.$button['target'].'">'.$button['title'] .'</a>';
  echo '</div>';
}

function print_gray_top(){

  if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
    //IE
    //$attr = 'width="100%"';
  }else{
    //Chrome, Firefox etc
    //$attr = 'viewBox="0 0 1386 74.584"';
  }
  $attr = 'viewBox="0 0 1386 74.584"';

  echo '<div class="gray-bg-container">';
    echo '<img src="'.get_bloginfo('template_directory').'/images/gray_top.svg">';
    // echo '<svg '. $attr .' id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" ><title></title><path style="fill:#eceded;" d="M1386,74.584H0v-71c2-.023,4-.017,5.991-.073q33.18-.947,66.359-1.92c2.661-.079,5.324-.511,7.976-.432,16.618.5,33.286.447,49.838,1.8C155.006,5,179.719,8.651,204.571,10.5c29.39,2.184,58.866,3.223,88.309,4.674,15.472.762,31,2.378,46.419,1.739,18.955-.785,37.54,1.754,56.278,3.205,23.183,1.795,45.961,6.589,69.47,6.531,36.126-.09,72.259,2.075,108.387,3.333,50.5,1.759,100.95.166,151.4-1.933,14.133-.588,28.274-1.182,42.415-1.3,10.773-.092,21.553.81,32.328.774,4.944-.017,9.868-1.638,14.828-1.83q56.157-2.178,112.326-4.051c7.989-.278,16-.159,23.973-.662,17.413-1.1,34.8-2.77,52.218-3.641,10.8-.539,21.682.482,32.477-.116,21.433-1.187,42.813-3.871,64.25-4.348,26.083-.579,52.011-3.469,78.184-3.3,22.167.14,44.373-3.444,66.535-5.644C1254.786,2.89,1265.136.14,1275.531.063c34.647-.256,69.3.331,103.949.655a51.1,51.1,0,0,1,6.52.921Z"/></svg>';
  echo '</div>';
}

function print_top_section(){
  $section = get_field('top_section');
  $icon = $section['top_section_icon'];
  $headline = $section['top_section_headline'];
  $copy = $section['top_section_copy'];
  $button = $section['top_section_button'];

  echo '<div id="top-section" class="top-section-container">';

    print_gray_top();

    echo '<div class="content wrapper">';
      
     echo '<div class="main-icon">';
       if(is_page_template('page-templates/amenities.php')) {
          echo '<img src="'.get_bloginfo('template_directory').'/images/circle_leaves.svg">';
       }else if(is_page_template('page-templates/features.php')) {
          echo '<img src="'.get_bloginfo('template_directory').'/images/grass_icon.svg">';
       }else if(is_page_template('page-templates/neighborhood.php')) {
          echo '<img src="'.get_bloginfo('template_directory').'/images/magnifier.svg">';
       }else if(is_page_template('page-templates/contact.php')) {
          //print nothing
       }else{
          echo '<img src="'.get_bloginfo('template_directory').'/images/compass.svg">';
       }
     echo '</div>';

      if($headline){
        echo '<h3 class="headline">'.$headline.'</h3>';      
      }
      if($copy){
        echo '<div class="copy">'.$copy.'</div>';
      }
      if($button){
        echo '<div class="button-container">';
          print_button($button,'small','primary');
        echo '</div>';
      }
    echo '</div>';
  echo '</div>';
}

function print_mountains_divider(){
    echo '<div class="mountains-container">';
      //echo '<div class="mountain-back" id="parallax-1" data-0="top: -10%;" data-end="top: 100%;">';
      echo '<div class="mountain-back" id="parallax-1" data-bottom-top="top: 0%;" data-top="top: 35%;">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/mountain1_back.svg">';
      echo '</div>';
      echo '<div class="mountain-front1">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/mountain1_front.svg">';
      echo '</div>';
    echo '</div>';
}

function print_mountains_divider2(){
    echo '<div class="mountains-container">';
      echo '<div class="mountain-back" id="parallax-2" data-bottom-top="top: 0%;" data-top-bottom="top: -60%;">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/mountain2_back.svg">';
      echo '</div>';
      echo '<div class="mountain-front2">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/mountain2_front.svg">';
      echo '</div>';
    echo '</div>';
}

function print_water_divider(){
    //echo '<div class="water-container" id="parallax-2" data-0="bottom: -17%;" data-end="bottom: -3%;">';
  echo '<div class="water-container" id="parallax-3" data-bottom-top="bottom: -5%;" data-top-bottom="bottom: -2%">';
      echo '<img src="'.get_bloginfo('template_directory').'/images/water.svg">';
    echo '</div>';
}

function print_tour_section(){
  $button = get_field('take_tour_code');
  $tour_icon = get_field('take_tour_icon');

  if($tour_icon || $button){
    echo '<div class="tour-container">';

      echo '<div class="tour-container__background-top">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/gray_background_top.svg">';
      echo '</div>';
      
      // echo '<div class="tour-container__background">';
      //   echo '<img src="'.get_bloginfo('template_directory').'/images/gray_background.svg">';
      // echo '</div>';

      echo '<div class="tour-container__content">';

        if($tour_icon){
          echo '<div class="tour-icon">';
            echo '<img src="'.$tour_icon['url'].'">';
          echo '</div>';             
        }

        if($button){
          echo '<div class="tour-button">';
            //print_button($button,'small','primary','schedule-tour-popup-button');
            echo $button ? $button : '';
          echo '</div>';  
        }
      echo '</div>';


      echo '<div class="tour-container__background-bottom">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/gray_background_bottom.svg">';
      echo '</div>';


    echo '</div>';
  }
}

function print_bottom_image(){
  global $post;

  if(is_home() || is_single()) {
    $slug = get_page_by_path( 'blog' );
    $post_id = $slug->ID;
  }else{
    $post_id = $post->ID;
  }

  $image = get_field('bottom_image',$post_id);
  if($image){
    echo '<div class="object-fit-container bottom-image-container">';
      print_responsive_image($image, 'medium_large', 'medium_large');
    echo '</div>';        
  }
}

function print_crosslinks(){
  $buttons = get_field('crosslinks');
  if($buttons){
    echo '<div class="buttons-container">';
      foreach ($buttons as $i => $btn) {
        print_button($btn['button'],'small','primary');
      }
    echo '</div>';
  }
}

function print_home_bottom_section(){
  $section = get_field('bottom_section');

  print_mountains_divider2();

  echo '<div class="bottom-section-container">';

    //Content
    if($section){
      foreach ($section['row_section'] as $k => $s) {   
        $icon = $s['icon'];
        $headline = $s['headline'];
        $copy = $s['copy'];
        $image = $s['image'];
        $button = $s['button'];

        $class = ($k % 2) > 0 ? 'odd' : 'even';

        echo '<div class="content wrapper">';

          if($image){
            echo '<div class="object-fit-container image-container-mobile">';
              print_responsive_image($image, 'medium_large', 'medium_large', 'medium_large', 'large');
            echo '</div>';
          }

          echo '<div class="rows-content '.$class.'">';

            echo '<div class="row half-width">';
              if($icon){
                echo '<div class="main-icon">';
                  echo '<img src="'.$icon['url'].'"/>';
                echo '</div>';
              }
            echo '</div>';

            echo '<div class="row flex-content '. $class .'">';

              echo '<div class="col left">';
                
                if($headline){
                  echo '<h3 class="headline">'.$headline.'</h3>';      
                }
                if($copy){
                  echo '<div class="copy">'.$copy.'</div>';
                }
                
              echo '</div>';

              echo '<div class="col right">';
                if($image){
                  echo '<div class="object-fit-container image-container-desktop">';
                    print_responsive_image($image, 'medium', 'medium_large', 'medium_large', 'large');
                  echo '</div>';
                }
              echo '</div>';

            echo '</div>';
            
            echo '<div class="row half-width">';
              if($button){
                echo '<div class="button-container">';
                  print_button($button,'small','secondary');
                echo '</div>';
              }
            echo '</div>';

          echo '</div>';

        echo '</div>';
      }
    }

    if (!(is_front_page() && !($tour = get_field('take_tour_code')))){
      print_water_divider();      
    }

  echo '</div>';
}

function print_features_content(){

  echo '<div class="title-content">';
    echo get_the_title();
  echo '</div>';

  $section = get_field('middle_section');

  if($section){
    echo '<div class="middle-content wrapper">';
    foreach ($section['row_section'] as $k => $s) {
      $headline = $s['headline'];
      $copy = $s['copy'];
      $images = $s['images'];

      $class = ($k % 2) > 0 ? 'even' : 'odd'; //had to switch it to reuse css from home page

      echo '<div class="row flex-content '. $class .'">';
        echo '<div class="col left">';
          if($headline){
            echo '<h3 class="headline">'.$headline.'</h3>';      
          }
          if($copy){
            echo '<div class="copy">'.$copy.'</div>';
          }
        echo '</div>';
        echo '<div class="col right">';
        foreach ($images as $j => $img) {
          echo '<div class="object-fit-container image-container-desktop">';
            print_responsive_image($img['image'], 'medium', 'medium_large', 'medium_large', 'large');
          echo '</div>';
        }
        echo '</div>';
      echo '</div>';

      $image = $s['images'][0]['image']; //taking just the 1st image

      if($image){
        echo '<div class="object-fit-container image-container-mobile">';
          print_responsive_image($image, 'medium_large', 'medium_large', 'medium_large', 'large');
        echo '</div>';
      }
    }
    print_crosslinks();
    echo '</div>';            
  }
}

function print_amenities_content(){

  echo '<div class="title-content">';
    echo get_the_title();
  echo '</div>';
  $section = get_field('middle_section');
  if($section){
    echo '<div class="middle-content wrapper">';
      if($section['headline']){
        echo '<h3 class="headline">'.$section['headline'].'</h3>';      
      }
      echo '<div class="copy">';
        echo $section['copy'];
      echo '</div>'; 

      if($section['images']){

        echo '<div class="images-container">';
        $images = $section['images'];

        //desktop images
        foreach ($images as $j => $img) {
          echo '<div class="object-fit-container image-container-desktop">';
            print_responsive_image($img['image'], 'medium', 'medium_large', 'medium_large', 'large');
          echo '</div>';
        }
        echo '</div>'; 

        //mobile images
        foreach ($images as $k => $img) {
          echo '<div class="object-fit-container image-container-mobile">';
            print_responsive_image($img['image'], 'medium', 'medium_large', 'medium_large', 'large');
          echo '</div>';
        }
      }
      print_crosslinks();
    echo '</div>'; 
  }
}


// Print the pop out if it meets the logig below.
function print_specials($screen='desktop') {
  // Check if scheduled. (Overrides default activation switch.)
  if($scheduled = get_field('schedule_specials','options')) {
    $start = strtotime(get_field('start_time','options'));
    $end = strtotime(get_field('end_time','options'));
    $today = (time() - 14400);  // UTC with 4 hours subtracted to make Eastern Time.
    // Checks to make sure today is within scheduled time.
    if($today >= $start && $today <= $end) {
      print_slideout($screen);
    }
  }
  // Check to see if its even active.
  elseif ($activated = get_field('activate_slideout1','options')) {
    print_slideout($screen);
  }
}

//Specials
function print_slideout($screen='desktop'){
  if(get_field('activate_slideout1', 'options')) {
    $button = get_field('slideout1_button_title','options');
    $title = get_field('slideout1_title','options');
    $copy = get_field('slideout1_content','options');
    $id = 'slideout1';
    if($screen == 'mobile'){
      $id .= '-'.$screen;
    }
    echo '<div id="'.$id.'" aria-expanded="" role="region" class="inactive">';
      echo '<div class="slideout-outer-wrapper">';
        echo '<div class="slideout-inner-wrap">';
          echo '<div class="content">';
            //echo '<div class="icon-close" role="button" aria-label="Close Special Content" tabindex="0"><i class="fas fa-times"></i></div>';
            echo '<div class="title">'.$title.'</div>';
            if($copy = get_field('slideout1_content','options')) {
              echo '<div class="copy">'.$copy.'</div>';
            }
            if($disclaimer = get_field('slideout1_disclaimer','options')) {
              echo '<div class="disclaimer">'.$disclaimer.'</div>';
            }
          echo '</div>';
        echo '</div>';
        echo '<div class="button-wrap" role="button" tabindex="0" aria-label="Open Special Content" aria-pressed="false">'.$button.'</div>';
      echo '</div>';
    echo '</div>';
  }
}

//Availability
function print_slideout2($screen='desktop'){
  if(get_field('activate_slideout2', 'options')) {
    $button = get_field('slideout2_button_title','options');
    $title = get_field('slideout2_title','options');

    $id = 'slideout2';
    if($screen == 'mobile'){
      $id .= '-'.$screen;
    }
    echo '<div id="'.$id.'" aria-expanded="" role="region" class="inactive">';
      echo '<div class="slideout-outer-wrapper">';
        echo '<div class="slideout-inner-wrap">';
        if($is_form = get_field('is_quick_sign_form','options') && $code = get_field('quick_sign_form_code','options')){

            echo '<div class="content-form">';
              eval($code);
            echo '</div>';

        }else{

          echo '<div class="content">';
            //echo '<div class="icon-close" role="button" aria-label="Close Special Content" tabindex="0"><i class="fas fa-times"></i></div>';
            echo '<div class="title">'.$title.'</div>';
            if($copy = get_field('slideout2_content','options')) {
              echo '<div class="copy">'.$copy.'</div>';
            }
            if($disclaimer = get_field('slideout2_disclaimer','options')) {
              echo '<div class="disclaimer">'.$disclaimer.'</div>';
            }
          echo '</div>';

        }

        echo '</div>';
        echo '<div class="button-wrap" role="button" tabindex="0" aria-label="Open Special Content" aria-pressed="false">'.$button.'</div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_hero_divider(){
    echo '<div class="hero-divider-container" id="parallax-4" data-0="bottom: -16%;" data-top="bottom: -12%;">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/mountain1.svg">';
    echo '</div>';
}

function print_hero() {
  global $post;

  if(is_home() || is_single() || is_archive() || is_category()) {
    $slug = get_page_by_path( 'blog' );
    $post_id = $slug->ID;
  }else if (wp_get_post_parent_id($post->ID)){
    $post_id = wp_get_post_parent_id($post->ID);
  }else{
    $post_id = $post->ID;    
  }
//print_r($post->ID);
  echo '<div class="hero-container">';

    //hero slider
    if(have_rows('hero_content',$post_id)) :
      echo '<div class="main-slider" id="main-slider">';
        while ( have_rows('hero_content',$post_id) ) : the_row();
          if(!get_sub_field('hide_slide',$post_id)) :
            echo '<div class="item '.get_row_layout().'">';
              
              $image = get_sub_field('image',$post_id);
              echo '<div class="slide-image slide-media" tabindex="-1">';
                echo print_image($image);
              echo '</div>';

            echo '</div>';
          endif;
        endwhile;
      echo '</div>';
    endif;

    //headline/subheadline    
    if(get_field('hero_headline',$post_id) || get_field('hero_subheadline',$post_id)){

      echo '<div class="headline-container">';
      if($text = get_field('hero_headline',$post_id)){
        echo '<h2 class="hero-headline">'.$text.'</h2>';
      }
      if($text = get_field('hero_subheadline',$post_id)){
        echo '<h1 class="subheadline">'.$text.'</h1>';
      }
      echo '</div>';
    }

    //arrow
    echo '<div class="anchor-arrow">';
      echo '<a id="anchor-arrow" href="#top-section"><img src="'.get_bloginfo('template_directory').'/images/arrow_down.svg"></a>';
    echo '</div>';

    print_hero_divider();
  
  echo '</div>';

}

//For basic pages
function print_basic_content(){
  //same structure as print_hero()
  echo '<div class="hero-container">';
    if($featuredImg = get_the_post_thumbnail()){
      echo '<div class="main-slider" id="main-slider">';
        echo '<div class="item">';
          echo '<div class="slide-image slide-media" tabindex="-1">';
            echo $featuredImg;
          echo '</div>';
        echo '</div>';
      echo '</div>';
      print_hero_divider();
    }
  echo '</div>';

  //Same structure as print_top_section()
  echo '<div id="top-section" class="top-section-container">';
    print_gray_top();
    echo '<div class="content wrapper">';
     echo '<div class="main-icon">';
        echo '<img src="'.get_bloginfo('template_directory').'/images/compass.svg">';
     echo '</div>';
      if($headline = get_the_title()){
        echo '<h3 class="headline">'.$headline.'</h3>';      
      }
      if($copy = get_the_content()){
        echo '<div class="copy">'.$copy.'</div>';
      }
    echo '</div>';
  echo '</div>';
  
}


// Footer functions
function print_privacy_policy() {
  if($privacy = get_field('privacy_policy', 'options')){
    echo '<div id="privacy"><a href="'.$privacy['url'].'" target="'.$privacy['target'].'">'.$privacy['title'].'</a></div>';
  }
}

function print_resident_portal() {
  if($res = get_field('resident_portal', 'options')){
    echo '<div id="resident"><a href="'.$res['url'].'" target="'.$res['target'].'">'.$res['title'].'</a></div>';
  }
}

function print_footer_logos(){
  echo '<a href="https://www.brookfieldproperties.com" target="_blank">';
    echo '<img src="'. get_bloginfo('template_directory').'/images/brookfield-white.png">';
  echo '</a>';
  echo '<span class="icon-eho"></span>';
  echo '<span class="icon-handicap"></span>';
}

function print_footer(){

  //row 1
  echo '<div class="top-container">';
    echo '<a href="https://stapletonapartments.com" target="_blank">Stapleton Apartments</a>';
  echo '</div>';

  //row 2
  echo '<div class="middle-container">';

    //col 1
    echo '<div class="col">';
      print_social_icons('desktop');
    echo '</div>';

    //col 2
    echo '<div class="col property-info-container">';
      print_property_name();
      print_address();
      print_phone_number();
    echo '</div>';

    //mobile row
    echo '<div class="row">';
      print_social_icons('mobile');
    echo '</div>';

    //mobile row
    echo '<div class="bottom-container mobile">';
      print_privacy_policy();
      print_resident_portal();
    echo '</div>';

    //col 3
    echo '<div class="col footer-logos-container">';
      print_footer_logos();
    echo '</div>';

  echo '</div>';

  //row 3
  echo '<div class="bottom-container desktop">';
    print_privacy_policy();
    print_resident_portal();
  echo '</div>';

}


// Gallery Pages

// Saves gallery data to json file on page save
function save_gallery_json($post_id){
  if (get_page_template_slug($post_id) == 'page-templates/gallery.php'){
    if($buildings = get_field('building_specific_gallery',$post_id)){
      $images_arr = array();
      foreach ($buildings as $i => $building) {
        // Categories
        foreach($building['gallery'] as $k => $cat){
          // Images
          $images = array();
          if (!empty($cat['images'])){
            foreach ($cat['images'] as $row){
                $image = array(
                    'url' => $row['image']['sizes']['large'],
                    'thumb' => $row['image']['sizes']['medium'],
                    'medium' => $row['image']['sizes']['medium_large'],
                    'caption' => $row['caption'],
                    'building' => $building['building_name'],
                    'category' => $cat['category']
                );
                $images_arr[] = $image;
            }
          }
        }
      }
      file_put_contents(get_template_directory() . '/JSON/gallery.json',json_encode($images_arr));
    }
  }
}
add_action( 'save_post', 'save_gallery_json' );


function print_fc_guarantee() {
    if($copy = get_field('copy')) {
        echo '<div id="fc-guarantee-content" class="top-section-container">';

            print_gray_top();

            echo '<div class="content-wrapper">';

            echo '<div class="copy-wrapper">';
                if($headline = get_field('headline')) {
                    echo '<div class="headline">'.$headline.'</div>';
                }
                if($subheadline = get_field('subheadline')) {
                    echo '<div class="subheadline">'.$subheadline.'</div>';
                }
                echo '<div class="copy">'.$copy.'</div>';

                
                echo '</div>';
                echo '<div class="guarantee-wrapper">';
                     echo '<div class="fc-gurantee-logo"><span class="icon-fc-guarantee"></span></div>';
                echo '<div class="guarantee-headline">The Forest City Guarantee Program</div>';
                    echo '<div class="guarantee-copy">';
                    if($line1 = get_field('line_1')) {
                        echo '<div class="guarantee-copy-1">'.$line1.'</div>';
                    }
                    if($line2 = get_field('line_2')) {
                        echo '<div class="guarantee-copy-2">'.$line2.'</div>';
                    }
                echo '</div>';
                if($link = get_field('link')) {
                echo '<div class="link"><a href="'.$link['url'].'" target="'.$link['target'].'">'.$link['title'].'</a></div>';
            }
            echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}


// Neighborhood Pages



// Saves area data to json file on page save
function save_neighborhood_json($post_id){
  if (get_page_template_slug($post_id) == 'page-templates/neighborhood.php'){
    if ($rows = get_field('points_of_interest_map',$post_id)){
      $pois = array(
        'categories' => array()
      );
      // Categories
      foreach($rows as $category){

        // POI Location
        $locations = array();
        if (!empty($category['point_of_interest'])){
          foreach ($category['point_of_interest'] as $poi){
            $poi_data = array(
              'name' => $poi['name'],
              'url' => $poi['website']
            );
            if ($poi['location']){
              $poi_data['address'] = str_replace(', United States','',$poi['location']['address']); // Strip country which ACF Google Maps plugin sometimes appends
              $poi_data['lat'] = (float) $poi['location']['lat'];
              $poi_data['lng'] = (float) $poi['location']['lng'];
            }
            $locations[] = $poi_data;
          }
        }

        // Marker information array
        $marker = array();
        if (!empty($category['category_marker_image'])){
          $marker_data = array(
            'url' => $category['category_marker_image']['url'],
            'width' => $category['category_marker_image']['width'],
            'height' => $category['category_marker_image']['height']
          );
          $marker = $marker_data;
        }

        // Assemble Category Array
        $pois['categories'][] = array(
          'name' => $category['category_name'],
          'marker' => $marker,
          'pois' => $locations
        );
      }

      // Property Information
      $property = array(
        'property_name' => get_field('property_name', 'options'),
        'address' => get_field('address', 'options'),
        'city' => get_field('city', 'options'),
        'state' => get_field('state', 'options'),
        'zip' => get_field('zip', 'options'),
        'lat' => (float) get_field('latitude','options'),
        'lng' => (float) get_field('longitude','options')
      );
      if ($property_map_marker = get_field('property_map_marker', 'options')){
        $property['property_map_marker'] = array(
          'url' => $property_map_marker['url'],
          'width' => $property_map_marker['width'],
          'height' => $property_map_marker['height']
        );
      }
      $pois['property'] = $property;

      file_put_contents(get_template_directory() . '/JSON/neighborhood.json',json_encode($pois));
    }
  }
}
add_action( 'save_post', 'save_neighborhood_json' );



function print_map() {
  echo '<div id="map-container">';
    if($mobile_map = get_field('mobile_map_image','options')) {
        $address = get_field('address','options');
        $city = get_field('city','options');
        $state = get_field('state','options');
        $zip = get_field('zip','options');

        echo '<div class="mobile-map"><a class="address" href="https://maps.google.com/?daddr='.$address.', '.$city.', '.$state.' '.$zip.'" target="_blank"><span class="map-image" style="background-image: url('.$mobile_map['url'].');""></span></a></div>';
    }
    echo '<div id="categories-container">';
      echo '<ul id="categories"></ul>';
    echo '</div>';
    echo '<div id="map"></div>';
  echo '</div>';
}

function print_neighborhood_links() {
  $links = get_field('neighborhood_links');
  if($links) {
    echo '<div id="neighborhood-links">';
      echo '<h2 class="headline">'.$$links['headline'].'</h2>';
      echo '<div class="link-wrapper">';
        foreach ($links['neighborhood'] as $link) {
          echo '<a class="neighborhood" style="background: url('.$link['image']['url'].')" href="'.$link['link']['url'].'" target="'.$link['link']['target'].'">';
            echo '<div class="overlay">';
              echo '<div class="link-text">'.$link['link']['title'].'</div>';
              // echo '<img src="'.$link['image']['url'].'" />';
            echo '</div>'; 
          echo '</a>';
        }
      echo '</div>';
    echo '</div>';
  }
}

function print_neighborhood_content(){
  if($list = get_field('list')){
    echo '<div class="title-content">';
      echo get_the_title();
    echo '</div>';
    echo '<div class="middle-content wrapper">';
      echo '<div class="copy">';
        echo $list;
      echo '</div>';
    echo '</div>'; 
  }
} 

// Contact Page

function print_contact_info_columns(){
  if($top_section = get_field('top_section')){
    $info = $top_section['contact_info'];

    echo '<div class="info-columns-container wrapper">';

    foreach ($info as $i => $c) {

      if($i !== 0){
        echo '<div class="col dots">';
          echo '<img src="'.get_bloginfo('template_directory').'/images/dots_divider.png">';
        echo '</div>';
      }

      echo '<div class="col">';
        echo $c['info_column'];
      echo '</div>';
    }

    echo '</div>';

  }
}

function print_contact_form() {
    if($form_snippet = get_field('form_snippet')) {
        echo '<div id="contact-form" class="fade-in">';
          eval($form_snippet);
        echo '</div>';
    }
}

function print_contact_content(){

  $section = get_field('top_section');
  $headline = $section['top_section_headline'];
  $copy = $section['top_section_copy'];

  echo '<div id="top-section" class="top-section-container">';

    print_gray_top();

    echo '<div class="content wrapper">';

      print_contact_info_columns();

      if($headline){
        echo '<h3 class="headline">'.$headline.'</h3>';      
      }
      if($copy){
        echo '<div class="copy">'.$copy.'</div>';
      }

      print_contact_form();

    echo '</div>';
  echo '</div>';

}

function print_residential_links(){

  $residential = get_field('resident_portal_link','options');
  $leasing = get_field('online_leasing_link','options');

  if($residential || $leasing){
    echo '<ul id="menu-secondary-navigation" class="menu-secondary-menu">';
    if($residential){
      echo '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
        echo '<a href="'.$residential['url'].'" target="'.$residential['target'].'" tabindex="0">'.$residential['title'].'</a>';
      echo '</li>';
    }
    if($leasing){
      echo '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
        echo '<a href="'.$leasing['url'].'" target="'.$leasing['target'].'" tabindex="0">'.$leasing['title'].'</a>';
      echo '</li>';
    }
    echo '</ul>';
  }           
}

// Blog

function print_post_link(){
  global $post;
  $title = apply_filters('the_title',$post->post_title);
  $date = get_the_date();
  echo '<a class="post post-link" href="' . get_the_permalink($post) . '">';
    if ( has_post_thumbnail() ) {
      echo '<div class="post-image">';
        the_post_thumbnail();
      echo '</div>';
    }
    echo '<div class="post-content">';
      echo '<h2>' . $title . '</h2>';
      echo '<em class="post-attribution">' . $date . '</em>';
    echo '</div>';
  echo '</a>';
}

function print_back_to_blog(){
  $page_for_posts = get_option('page_for_posts');
  $blog_url = get_permalink($page_for_posts);
  echo '<div id="back-to-blog">';
    echo '<a href="' . $blog_url . '">&lt; Back</a>';
  echo '</div>';
}

?>