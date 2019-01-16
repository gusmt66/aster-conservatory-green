<?php
/*
* Template Name: Gallery
*
*/
get_header(); ?>
    <div id="gallery" class="container" role="main">
        <div class="content">

					<?php print_hero(); ?>
					
			    <div id="gallery-container" class="fade-in">

						<?php print_gray_top(); ?>

						<div id="top-section" class="wrapper">

				  		<ul id="categories">
				  			<li class="active"><div class="text">All</div></li>
				  		</ul>
				  		
				  		<ul id="buildings">
								<div class="form-radio">
									<label for="radio-all" class="clicked">
										<input id="radio-all" type="radio" value="All">
									</label>All
								</div>
							</ul>

				    	<div id="overlap">
				  	    <div id="gallery-wrapper">
				          <div id="gallery">
				            <div id="image-container"></div>
				            <div id="next-image"><i class="fa fa-angle-right ease"></i></div>
				            <div id="prev-image"><i class="fa fa-angle-left ease"></i></div>
				          </div>
				        </div>
				    	</div>

						</div>

			    </div>

					<?php print_crosslinks(); ?>
					<?php print_mountains_divider(); ?>
					<?php print_bottom_image(); ?>

        </div>
    </div>
<?php get_footer(); ?>