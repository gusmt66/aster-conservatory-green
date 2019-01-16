<?php get_header(); ?>
  <div id="single-post" class="container">
    <div class="content">
        <?php print_hero(); ?>
        <div class="gray-divider">
            <?php print_gray_top(); ?>
        </div>

        <div class="middle-content wrapper">
            <div class="left">

                <div class="post">
                    <div class="post-content">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="image">
                        <?php
                        if ( has_post_thumbnail() ) {
                            echo '<a class="post-link" href="' . get_the_permalink($post) .'">';
                            the_post_thumbnail();
                            echo '</a>';
                        } ?>
                        </div>
                        <div class="post-info">
                            <h4 class="post-date"><?php the_date(); ?></h4>
                            <div class="post-copy"><?php the_content(); ?></div>
                        </div>
                    </div>
                </div>

                <?php print_back_to_blog(); ?>

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
