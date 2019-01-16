<?php
get_header(); ?>
    <div id="blog" class="container">
			<div class="content">
		    <?php print_hero(); ?>
		    <div class="gray-divider">
		        <?php print_gray_top(); ?>
		    </div>

				<div id="top-section" class="middle-content wrapper">
			    <div class="left">
			        <?php if (have_posts()) : ?>
			            <?php while (have_posts()) : the_post(); ?>
			                <div class="post">
			                    <div class="post-content">
			                        <div class="image">
		                            <?php
		                            if ( has_post_thumbnail() ) {
		                            	echo '<a class="post-link" href="' . get_the_permalink($post) .'">';
		                                the_post_thumbnail();
		                                echo '</a>';
		                            } ?>
			                        </div>
			                        <div class="post-info">
			                        	<a class="post-link" href="<?php echo get_the_permalink($post); ?>">
			                        		<h3 class="post-title"><?php the_title(); ?></h3>
			                        	</a>
			                        	<h4 class="post-date"><?php the_date(); ?></h4>
			                        </div>
			                    </div>
			                </div>
			            <?php endwhile;?>
			        <?php endif;?>
			    </div>
			    <div class="right">
			        <?php get_sidebar(); ?>
			    </div>
		  	</div>

		    <?php print_mountains_divider(); ?>
		    <?php print_bottom_image(); ?>
			</div>
    </div>
<?php get_footer(); ?>