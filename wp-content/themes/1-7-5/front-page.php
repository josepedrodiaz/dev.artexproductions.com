<?php

/**
 * Page Name: Front
 *
 *
 * Can be used for Front Page display
 * see: http://codex.wordpress.org/Creating_a_Static_Front_Page
 *
 *
 */
get_header();

$para= get_field('parallax_image');
$para= wp_get_attachment_image_src( $para, "bgpara" );
?>


	
	<div class="about-section" id="about">
		<div class="container"  style="background-image: url(<?php the_field("background_image_for_referrals") ?>); background-repeat:no-repeat;
background-size:100%;
background-position:top center;">
			<div class="cols">
				<?php //the_field("about_content") ?>
					<div class="referalls">
					<div class="title">
						<?php the_field("about_content") ?>
					</div>
						<div class="slider">
							<div class="items">

								<?php
								  $temp = $wp_query;
								  $wp_query = null;
								  $wp_query = new WP_Query();
								  $wp_query->query('posts_per_page=-1&post_type=referral');
									?>
									<?php if ($wp_query->have_posts()) : ?>
									<?php $i = 1; while ( $wp_query->have_posts() && $i < 7) : $wp_query->the_post(); ?>

															<div class="item">
																<blockquote>																	
																	<h4><sup>&gt;&gt;</sup><?php the_field("title") ?><sup>&lt;&lt;</sup></h4>
																	<?php the_content(); ?>
																	<?php the_post_thumbnail("referral"); ?>
																	<cite>- <?php the_title(); ?> <span><?php echo get_the_excerpt(); ?></span></cite>
																</blockquote>
															</div>

								<?php $i++; endwhile; ?>
								<?php endif; ?>

								<?php
								  $wp_query = null;
								  $wp_query = $temp;  // Reset
								?>

								<?php wp_reset_query(); ?>
							<?php wp_reset_query(); ?>
							</div>
						</div>
			</div>	
			</div>
		</div>
	</div>
	
		

	<div class="body">
		<div class="parallax-holder">
			<div class="mask">
				<div class="mask1">
					<div class="parallax-image" style="background-image: url(<?php echo $para[0]; ?>);background-repeat: repeat; background-size: 47%"> </div>
				</div>
			</div>			
		</div>
		
		<script type="text/javascript">
			jQuery(window).scroll(function(e){
			  parallax();
			});

			function parallax(){
			  var scrolled = jQuery(window).scrollTop();			  
			  jQuery('.parallax-image').css('background-position-y', (scrolled)+'px');
			}
		</script>		
		
		<div class="container-disciplines">
			<div class="disciplines">
				<div class="title">
					<h2>disciplines</h2>
				</div>
<?php if( have_rows('disciplines') ): ?>
				<div class="cols">
	<?php while( have_rows('disciplines') ): the_row();  ?>

					<div class="col">
						<?php echo wp_get_attachment_image( get_sub_field("image"), "dis" ); ?>
						<div class="moving">
							<div class="wrp">
								<h3><?php the_sub_field('title'); ?></h3>
								<p><?php the_sub_field('text'); ?></p>
								<div class="more-text">
									<p><?php the_sub_field('more_text'); ?></p>
								</div>
							</div>
						</div>
						<p><a href="#">READ <span class="more">MORE</span><span class="less">LESS</span></a></p>
					</div>
	<?php endwhile; ?>
				</div>
<?php endif; ?>
			</div>
			<!-- <div class="recent-works">
				<div class="title">
					<h2>LATEST W0RKS</h2>

					<div class="filter">
						<ul>

					</div>
				</div>
			</div> -->
		</div>
	</div>

	<div class="clients">
		<div class="container">
			<div class="title">
				<h2>clients</h2>
			</div>
			<div class="cols">
<?php if( have_rows('clients') ): ?>
				<div class="items">
	<?php while( have_rows('clients') ): the_row();  ?>
					<div class="item">
						<a><?php echo wp_get_attachment_image( get_sub_field("image"), "full" ); ?></a>
					</div>
	<?php endwhile; ?>
				</div>
<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="team view-all" id="team">
		<div class="container">
			<div class="title">
				<h2>our team</h2>
				<a href="<?php the_field("team_link") ?>" class="btn-all"><?php the_field("tbutton_text") ?></a>
				<a href="<?php the_field("team_link") ?>" class="btn-all less">Show less</a>
			</div>
			<div class="cols">
				<div class="slider">
					<div class="items">
<?php
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query('posts_per_page=-1&post_type=team&orderby=ASC');

  while ($wp_query->have_posts()) : $wp_query->the_post();
?>						
						<div><a class="team-show-less-display-none">Show less</a></div>
						<div class="item">							
							<div class="image">
								<?php the_post_thumbnail("team"); ?>
							</div>							
							<div class="moving">
								<h3><?php the_title(); ?></h3>
								<div class="role"><?php the_field("role") ?></div>
								<div class="entry-holder">
									<div class="entry">
										<?php echo get_the_excerpt(); ?>
									</div>
								</div>							
							</div>							
						</div>

<?php endwhile; ?>
<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>

<?php wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="promo">		
		<div class="image">
			<?php echo wp_get_attachment_image( get_field("image"), "promo" ); ?>
		</div>
		<div class="container">
			<h2><?php the_field("title") ?></h2>
			<a href="<?php the_field("button_link") ?>" class="btn-all"><?php the_field("button_text") ?></a>
		</div>
	</div>

	<div class="latest-post">
		<div class="container">
			<div class="title">
				<h2>PROJECT UPDATES</h2>
				<a href="http://artexproductions.com/category/industry-news/" class="btn-all">MORE NEWS</a>
			</div>
			<div class="cols">
<?php
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query('posts_per_page=1&post_type=post');

  while ($wp_query->have_posts()) : $wp_query->the_post();
?>

				<div class="post">
					<?php if ( has_post_thumbnail() ) {?>

					<div class="image">
						<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail("homepost"); ?></a>
					</div>
					<?php } ?>
					<div class="text">
						<div class="date">
		<?php $curre = get_the_ID();
	$postNumberQuery = new WP_Query('orderby=date&order=ASC&posts_per_page=-1&post_type=post');
	$counter = 1;
	$postCount = 0;
	if($postNumberQuery->have_posts()) :
		while ($postNumberQuery->have_posts()) : $postNumberQuery->the_post();
			if ($curre == get_the_ID()){
				$postCount = $counter;
			} else {
				$counter++;
			}
	endwhile; endif;
	echo $postCount;
		 ?>
						</div>
						<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a></h3>
						<div class="meta"><?php the_time( 'F j Y' ); ?> by <?php the_author_posts_link(); ?></div>
						<div class="entry">
							<?php echo get_the_excerpt(); ?>
						</div>
					</div>
				</div>
<?php endwhile; ?>
<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>

<?php wp_reset_query(); ?>
			</div>
		</div>
	</div>

	<div class="contacts" id="contact">
		<div class="map-holder">
			<div class="map-inner" id="map-canvas"></div>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFapxo9dGNbkRzyY-8eQseUHtTXOqDE-E&callback=initMap"></script>
		    <script>
		function initialize() {
		  var mapOptions = {
		    zoom: 14,draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: false,disableDefaultUI: true,
		    center: new google.maps.LatLng(25.756921, -80.259077),
		                        styles:[{"featureType":"all","elementType":"all","stylers":[{"hue":"#c3ce8a"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-70}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60}]}]

		  }
		  var map = new google.maps.Map(document.getElementById('map-canvas'),
		                                mapOptions);

		var pinIcon = new google.maps.MarkerImage(
		    "<?php bloginfo( 'template_directory' ); ?>/img/pin.png",
		    null, /* size is determined at runtime */
		    null, /* origin is 0,0 */
		    null, /* anchor is bottom center of the scaled image */
		    new google.maps.Size(80, 96)
		);
		  var myLatLng = new google.maps.LatLng(25.756921, -80.259077);
		  var beachMarker = new google.maps.Marker({
		      position: myLatLng,
		      map: map,
		      icon: pinIcon
		  });


		}
jQuery(document).ready(function($) {
$(window).load(function() {

	window.setTimeout(function() {
		$("#map-canvas").html("");
		$(".contacts").removeClass("contact-map-visible");
		initialize();
	}, 100);
	window.setTimeout(function() {
		$(".contacts").addClass("contact-map-visible");
	if ($(".contacts").length) {
		$(window).scroll(function() {
			var offset = $(".contacts").offset();
			if ($(window).scrollTop() > offset.top - $(window).height() ) {
				$(".contacts").removeClass("contact-map-visible");

			} else {
				$(".contacts").addClass("contact-map-visible");
			};
		});

	};
	}, 1000);
});
});
		google.maps.event.addDomListener(window, 'load', initialize);

		    </script>
		</div>
		<div class="container">
			<div class="holder">
				<div class="contact-info">
					<div class="row">
						<div class="label">Contact</div>
						<div class="text">
            <?php the_field("contact", "option") ?>
						</div>
					</div>
					<div class="row">
						<div class="label">Offices</div>
						<div class="text">
            <?php the_field("office", "option") ?>
						</div>
					</div>
					<div class="row">
						<div class="label">Social</div>
						<div class="text">
							<ul class="links">
              <?php if (get_field("vimeo", "option")) {?>
              <li><a target="_blank" class="link-1" href="<?php the_field("vimeo", "option") ?>">Vimeo</a></li>
              <?php } ?>
              <?php if (get_field("facebook", "option")) {?>
              <li><a target="_blank" class="link-2" href="<?php the_field("facebook", "option") ?>">Facebook</a></li>
              <?php } ?>
              <?php if (get_field("twitter", "option")) {?>
              <li><a target="_blank" class="link-3" href="<?php the_field("twitter", "option") ?>">Twitter</a></li>
              <?php } ?>
              <?php if (get_field("instagram", "option")) {?>
              <li><a target="_blank" class="link-4" href="<?php the_field("instagram", "option") ?>">Instagram</a></li>
              <?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="form">
					<h3>GET REACHY WITH US</h3>
					<?php echo do_shortcode( '[contact-form-7 id="5876" title="Contact form recaptcha"]' ); ?>
				</div>
			</div>
		</div>
	</div>

<?php // add pagination if needed here  ?>

  <div class="recent-awards">
    <div class="container">
      <div class="title">
        <h2>RECENT AWARDS</h2>
      </div>
      <div class="cols">
        <div class="items">
        <div class="slides">
        <div class="slide">
<?php
  $temp = $wp_query;
  $wp_query = null;
  $i1;
	$args = array(
		'posts_per_page' => '-1',
		'post_type' => 'awards',
		'orderby' => 'date',
		'order'   => 'ASC',
	);
	$wp_query = new WP_Query( $args );
  while ($wp_query->have_posts()) : $wp_query->the_post();
  // if (($i1 % 8) == 0 && ($i1) != 0) {
  // 	echo "</div><div class='slide'>";
  // };
  $i1++;
?>
          <div class="item">
            <div class="inner">
              <h3><?php the_field("award") ?></h3>
              <h4><?php the_title(); ?></h4>
              <p><?php the_field("years") ?></p>
            </div>
          </div>

<?php
  endwhile; ?>
<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>

<?php wp_reset_query(); ?>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
