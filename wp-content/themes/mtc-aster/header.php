<!DOCTYPE html>
<html>
	<head>
	  <title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/style.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/css/screen.css">

    <script>var templateURL="<?php bloginfo("template_url"); ?>";</script>

    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie.css">
    <script src="<?php bloginfo('template_url'); ?>/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo get_field('gtm_code','options'); ?>');</script>
    <!-- End Google Tag Manager -->

    <!-- Custom javascript code input from the CMS (like FB Pixel, etc) -->
    <?php echo get_field('header_code_snippet','options'); ?>

    <!--Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:900" rel="stylesheet">

    <!--Favicon -->
    <?php if($favicon = get_field('favicon','options')){ echo '<link rel="icon" href="'. $favicon['url']. '">'; } ?>
    
	  <?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo get_field('gtm_code','options'); ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Custom javascript code input from the CMS (like FB Pixel, etc) -->
    <?php echo get_field('body_code_snippet','options'); ?>

    <div id="wrapper">
      
      <header id="header" class="ease">
        <div class="header-content">

          <div class="phone-address-container">
            <?php print_phone_number(); ?>
            <?php print_mobile_address_link(); ?>
            <?php print_mobile_phone_link(); ?>
          </div>

          <div class="logo">
            <?php print_logo(); ?>
          </div>
          
          <?php print_header_icons(); ?>
                   
          
        </div>

        <!-- <nav id="navigation">
          <?php // wp_nav_menu( array( 'container' => '', 'theme_location' => 'main_menu') ); ?>
        </nav> -->
      </header>
      <?php print_trigger(); ?> <!-- don't move the trigger from here! -->

      <div id="dummy"></div>

      <div class="slideouts-container">
        <?php print_specials(); ?>
        <?php print_slideout2(); ?>
        
      </div>
      <div class="slideouts-container-mobile">
        <?php print_specials('mobile'); ?>
        <?php print_slideout2('mobile'); ?>
        
      </div>

      <div id="navigation-container" role="region" class="nav-background" aria-expanded="false">
        <div class="inner-container">
          <nav id="navigation" role="navigation" aria-labelledby="navigation-label" class="nav-text">
            <!-- <h2 id="navigation-label" class="accessible">Main Navigation</h2> -->
            <?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'main_menu', 'menu_class'=>'menu-main-menu') ); ?>
          </nav>


          <div class="secondary nav-text">
            <?php print_residential_links(); ?>
          </div>

          <!-- <div class="secondary nav-text">
            <?php //wp_nav_menu( array( 'container' => '', 'theme_location' => 'secondary_menu', 'menu_class'=>'menu-secondary-menu') ); ?>
          </div> -->
        </div>
      </div>