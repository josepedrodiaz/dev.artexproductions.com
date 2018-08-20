<?php
/**
 * redgear: Header
 *
 * Contains dummy HTML to show the default structure of WordPress header file
 *
 * Remember to always include the wp_head() call before the ending </head> tag
 *
 * Make sure that you include the <!DOCTYPE html> in the same line as ?> closing tag
 * otherwise ajax might not work properly
 *
 * @package WordPress
 * @subpackage redgear
 */
?><!DOCTYPE html>
<!--[if IE 8]> <html class="ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php bloginfo('name'); echo ' - '; is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,500,400' rel='stylesheet' type='text/css'>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php
	if (is_front_page()){
	?>
		<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
		<script type='text/javascript' src='https://dev.artexproductions.com/wp-content/themes/1-7-5/js/lulu-parallax.js'></script>
		<link href="https://dev.artexproductions.com/wp-content/themes/1-7-5/css/lulu-parallax.css" type="text/css" rel="stylesheet" />											

		<script>			
			$(document).ready(function() {	
				luluParallax();
				$("#about .slider").css("display","block");
			});
			
			/*
			 * When a user resizes the browser or changes the orientation of their device
			 * https://css-tricks.com/snippets/jquery/done-resizing-event/
			 */
			var resizeTimer;
			$(window).on('resize', function(e) {
			  clearTimeout(resizeTimer);
			  resizeTimer = setTimeout(function() {
				luluParallax(); // Fire the plugin again
				// location.reload(true); // Reload the page
			  }, 400);
			});
		</script>		
			
	<?php
	}
	?>
			
	<?php
	// do not remove
	wp_head();
	?>	
</head>
<body <?php body_class(); ?>>


<!-- <div id="loading">
	<div class="loader-bar">
		<div class="inner">

		</div>
	</div>
	<div class="text">
		0%
	</div>
</div> -->
<?php
if ( is_front_page() ) {
?>
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="demo-video">
		<a href="#" class="close"></a>
<?php if( have_rows('reel_video1') ): ?>
		<div class="items">
	<?php while( have_rows('reel_video1') ): the_row();
		?>
		<div class="item">
            <?php if (get_sub_field("type") == "vimeo") {
            ?>
            <iframe src="https://player.vimeo.com/video/<?php the_sub_field("video_id") ?>" width="1280" height="545" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php
            } else {
            ?>

			<video id="example_video_1" class="video-js vjs-default-skin"
			controls preload="auto" width="1920" height="1000"
			data-setup='{"example_option":true}'>
				  <source src="<?php the_sub_field("video") ?>" type="video/mp4">
			</video>       <?php
            }
            ?>
		</div>
	<?php endwhile; ?>
	</div>

<?php endif; ?>
	</div>

	<div class="home-featured">


		<div class="video">
            <?php if (get_field("video_id1")) {
            ?>
            <script type="text/javascript" src="http://f.vimeocdn.com/js/froogaloop2.min.js"></script>
            <iframe id="vimeo_player" src="https://player.vimeo.com/video/<?php the_field("video_id1") ?>?autoplay=1&badge=0&loop=1" width="1280" height="545" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    <script>
                    jQuery(function ($) {

        var iframe = $('#vimeo_player')[0],
            player = $f(iframe),
            status = $('.status');

            player.addEvent('ready', function() {
                player.api('setVolume', 0);
            });
	window.setTimeout(function() {
        var iframe = $('#vimeo_player')[0],
            player = $f(iframe),
            status = $('.status');

            player.addEvent('ready', function() {
                player.api('setVolume', 0);
            });
	}, 0);

$(window).load(function() {
        var iframe = $('#vimeo_player')[0],
            player = $f(iframe),
            status = $('.status');

            player.addEvent('ready', function() {
                player.api('setVolume', 0);
            });
            });
            });
        </script>
            <?php
            } else {
            ?>
            <div class="image-fallback" style="background-image: url(<?php the_field("background_image_for_mobile") ?>)">

            </div>			
			<video id="home-video" width="1920" height="1000" autoplay="autoplay" playsinline="true" muted loop>
			  <source src="" type="video/mp4">
			</video>
			<script>
			var videoDesktop = "<?php echo the_field("background_video") ?>";
			var videoMobile = "<?php echo the_field("background_video_mobile") ?>";
			
			var vid=document.getElementById('home-video');
vid.addEventListener("loadstart", showVideo, false);
function showVideo(e) {
  vid.play();
};
			var video = document.getElementById('home-video');
			video.addEventListener('click',function(){
			  video.play();
			},false);
			</script><?php
            }
            ?>
		</div>
		<div class="container">
		<div class="solutions">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-min"><!--<span class="mas"><img src="<?php the_field("headline_svg") ?>" alt="Best Top #1 Video Production Company in Miami Artex Productions"> //</span>--><img src="<?php bloginfo( 'template_directory' ); ?>/img/artex_logo_stacked_WHT.svg" alt="#1 Top Best Video Production Services in Miami Artex Productions"></a>

		</div>

		<nav id="menu" class="home-top">
			<div class="trigger"><span></span></div>
			<div class="dropds">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'navigation-foot',
					'container' => false,
					'items_wrap' => '<ul id="%1$s" class="menu">%3$s</ul>'
				) );
				?>
			</div>
		</div>
			<div class="reel-wrap">
				<div class="play-btn-container">
					<div class="play">
						<a href="#" class="play-demo">PLAY REEL</a>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom">



			<header id="header">
				<div class="container">
					<span class="menu-item-type-custom slogan-mas"><a href="#about"><img src="<?php the_field("headline_svg") ?>" alt=""></a></span>
					<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<nav id="menu">

						<div class="trigger"><span></span></div>
						<div class="dropds">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'navigation-foot',
								'container' => false,
								'items_wrap' => '<ul id="%1$s" class="menu">%3$s</ul>'
							) );
							?>
						</div>
					</div>
				</div>
				<!-- / container -->
			</header>
			<!-- / header -->
		</div>
	</div>
	<?php endwhile; ?>
<?php endif; ?>
					<?php
} else {
	?>

	<header id="header">
		<div class="container">
			<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<nav id="menu">
				<div class="trigger"><span></span></div>
				<div class="dropds">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'navigation-top',
						'container' => false,
						'items_wrap' => '<ul id="%1$s" class="menu">%3$s</ul>'
					) );
					?>
				</div>
			</div>
		</div>
		<!-- / container -->
	</header>
	<!-- / header -->

	<?php
};
?>
