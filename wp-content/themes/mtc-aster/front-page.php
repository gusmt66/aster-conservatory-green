<?php 
/*
* Front page template
*
*/
get_header(); ?>
<div id="home" class="container" role="main">

	<div class="content">
		
		<?php print_hero(); ?>
		<?php print_top_section(); ?>
		<?php print_home_bottom_section(); ?>
		<?php print_tour_section(); ?>
		<?php print_bottom_image(); ?>

	</div>

</div>
<?php get_footer(); ?>