<?php
/*
* Template Name: Floor Plans
*
*/
get_header(); ?>
    <div id="floorplans" class="container" role="main">
			<div class="content">

				<?php print_hero(); ?>
				<div class="gray-divider">
					<?php print_gray_top(); ?>
				</div>

				<div id="top-section" class="floor-plans-outer-wrapper">

					<div class="inner fade-in">
						<div id="search-form-container">
					    <form id="search-form" action="" method="post" name="searchForm">
				        <div id="move-in-date-container" class="search-input-container">
				        <div class="input-wrapper">
				        	<label for="move-in-date"><i class="fa fa-calendar"/></i></label>
				          	<?php
					          		$availableDate = strtotime(get_field('available_date','options'));
						          		$time = time();
						          		if (($availableDate > $time)){
						          			$date = date('m/d/Y', $availableDate);
						          		} else {
						          			$date = date('m/d/Y', $time);
						          		} ?>
						          	<input type="text" id="move-in-date" placeholder="Move-in Date" name="move-in-date" value="<?php echo $date; ?>" />
				          </div>
				        </div>
				        <div id="checkboxes-container" class="search-input-container">
				          <div id="mobile-category-overlay">
				            <i class="fa fa-angle-down"></i>
				          </div>
		                    <div id="checkboxes"></div>
				        </div>
				        <div id="max-rent-container" class="search-input-container">
				          <div class="input-wrapper">
				          	<label for="max-rent"><i class="fas fa-dollar-sign"></i></i></label>
				          	<input type="text" id="max-rent" name="max-rent" placeholder="Max Rent"/>
				          </div>
				        </div>
					    </form>
						</div>
					</div>
					<div id="floor-plans-wrapper">
				    <div id="floor-plans">
			        <table id="results" class="fade-in">
			          <thead>
			            <tr id="results-head">
			              <th>Name<span class="sort-indicator"><i class="fa fa-angle-down"></i></span></th>
			              <th>Bed/Bath<span class="sort-indicator"><i class="fa fa-angle-down"></i></span></th>
			              <!-- <th>Den<span class="sort-indicator"><i class="fa fa-angle-down"></i></span></th> -->
			              <th>Sq. Ft.<span class="sort-indicator"><i class="fa fa-angle-down"></i></span></th>
			              <th>Rent<span class="sort-indicator"><i class="fa fa-angle-down"></i></span></th>
			              <th>Availability<span class="sort-indicator"><i class="fa fa-angle-down"></i></span></th>
			              <th></th>
			            </tr>
			          </thead>
			          <tbody id="results-table"></tbody>
			        </table>

<!-- 			        <?php //if($no_results = get_field('no_results_content')) : ?>
				        <div id="no-results">
					        <div class="no-results-wrapper">
					        	<?php //echo $no_results; ?>
					        </div>
				        </div>
				      <?php //endif; ?> -->
			        
			        <table id="result-template-container" style="display:none;">
			          <tr id="result-template">
			            <td class="name"></td>
			            <td class="bedbath"></td>
			            <!-- <td class="den"></td> -->
			            <td class="sqft"></td>
			            <td class="rent"></td>
			            <td class="availability"></td>
			            <td class="action">
			              <button class="button">View</button>
			            </td>
			          </tr>
			          <tr>
			            <td colspan="6">
			              <div id="mobile-result-template">
			                <div class="aptnum">Apartment <span></span></div>
			                <div class="sqft">Sq. Ft. <span></span></div>
			                <div class="rent">Rent <span></span></div>
			                <div class="deposit">Deposit <span></span></div>
			                <div class="availability"></div>
			                <div class="action"><button class="button">Select</button></div>
			              </div>
			            </td>
			          </tr>
			        </table>
			        <div id="unit-detail-background" style="display:none;"></div>
			        <div id="unit-detail-wrapper" class="ease" style="display:none;">
			          <div id="unit-detail">
			            <div class="close-button" id="unit-detail-close-button">
			              <span class="icon-close ease"></span>
			            </div>
			            <div class="left">
			              <div class="vertical-center-parent">
			                <div class="vertical-center-child">
			                  <img src="" />
			                </div>
			              </div>
			            </div>
			            <div class="right">
		           			<h2 class="name"></h2>
			              <div class="info">
			                <div class="beds"></div>
			                <div class="baths"><span></span> Bath</div>
			                <div class="sqft"><span></span> Square Feet</div>
			                <div class="rent"><span></span> Per Month</div>
			                <div class="available-count"><span></span> Available</div>
			              </div>
		            		<div id="available-units"></div>
			              <div class="buttons">
			                <a id="unit-pdf-link" href="" target="_blank">Download PDF</a>
			                <button id="share-button">Share</button>
			              </div>
			            </div>
			          </div>
			          <div id="share-info-wrapper" style="display:none;">
		                <div id="share-info-background"></div>
			            <div id="share-info">
			              <div class="close-button" id="share-close-button">
			                <span class="icon-close ease"></span>
			              </div>
			              <h3>Share this on:</h3>
			              <div id="share-buttons">
		                      <!-- AddToAny BEGIN -->
		                      <div class="a2a_kit">
		                          <a class="a2a_button_facebook"><i class="fab fa-facebook-f"></i></a>
		                          <a class="a2a_button_twitter"><i class="fab fa-twitter"></i></a>
		                          <a class="a2a_button_pinterest"><i class="fab fa-pinterest"></i></a>
		                          <a class="a2a_button_linkedin"><i class="fab fa-linkedin"></i></a>
		                          <a class="a2a_button_tumblr"><i class="fab fa-tumblr"></i></a>
		                          <a class="a2a_button_wordpress"><i class="fab fa-wordpress"></i></a>
		                          <a class="a2a_button_reddit"><i class="fab fa-reddit-alien"></i></a>
		                          <a class="a2a_button_stumbleupon"><i class="fab fa-stumbleupon"></i></a>
		                          <a class="a2a_button_google_plus"><i class="fab fa-google-plus"></i></a>
		                          <a class="a2a_button_whatsapp"><i class="fab fa-whatsapp"></i></a>
		                          <a class="a2a_button_email"><i class="fas fa-envelope"></i></a>
		                          <a class="a2a_dd" href="https://www.addtoany.com/share"><i class="fa fa-plus-square"></i></a>
		                      </div>
		                      <script>var a2a_config=a2a_config||{};a2a_config.linkname="Floor Plans | Arris Apartments | Luxury D.C. Apartments";</script>
		                      <script async src="https://static.addtoany.com/menu/page.js"></script>
		                      <!-- AddToAny END -->
			              </div>
			            </div>
			          </div>
			        </div>
			        <div id="available-unit-template" class="available-unit" style="display:none;">
			          <div class="apt">Apartment <span></span></div>
			          <div class="sqft"><span></span> Sq. Ft.</div>
			          <div class="rent"><span></span> with a 12-month lease</div>
			          <div class="availability">
			            <a href="">Lease Online</a>
			          </div>
			        </div>
			        <div id="loader">
			          <i class="fas fa-spinner fa-spin"></i>
			        </div>
			        <?php if ($disclaimer=get_field('disclaimer')){ ?>
			          <div class="disclaimer">
			            <?php echo $disclaimer; ?>
			          </div>
			        <?php } ?>
				    </div>
					</div>

				</div>

 				<script>
			    var floorPlansURL = "<?php the_permalink(); ?>";
			    <?php if ($online_leasing = get_field('online_leasing')) { ?>
			      var leaseOnlineURL = "<?php echo $online_leasing; ?>";
			    <?php } ?>
				</script> 
				<?php print_crosslinks(); ?>
				<?php print_mountains_divider(); ?>
				<?php print_bottom_image(); ?>
				
			</div>
    </div>
<?php get_footer(); ?>