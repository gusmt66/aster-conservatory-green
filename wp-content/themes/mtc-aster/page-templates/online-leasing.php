<?php
/*
* Template Name: Online Leasing
*
*/
get_header(); ?>
  <div id="online-leasing" class="container" role="main">
    <div class="content">
			<?php print_basic_content(); ?>

			<div id="online-leasing-wrapper" style="position: relative;">
				<div id="widget-container"></div>
				<?php
				$scriptUrl = 'https://property.onesite.realpage.com/oll/eol/widget?';
				if (isset($_GET['site_id'])){
					$scriptUrl .=  'siteId=' . $_GET['site_id'] . '&';
                  }
				$scriptUrl .= 'container=widget-container&';
				$scriptUrl .= 'css='.urlencode( get_template_directory_uri ().'/css/realpage-widget.css?PageSpeed=off' );
				?>
				<script src="<?php echo $scriptUrl; ?>"></script>
			</div>

    </div>
  </div>
<?php get_footer(); ?>