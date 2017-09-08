<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Personal Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'personaltheme' ); ?></a>

	<div id="offcanvas">
		<button id="close-offcanvas" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Close Menu', 'personaltheme' ); ?></button>
	</div>

	<header id="masthead" class="site-header" role="banner">
					
		<div class="header-elements-wrap row middle-xs" data-sticky-header="enabled">
			
			<div class="branding-wrap col-xs-4">
				
				<div class="box">
					
					<div class="site-branding">

						<div class="site-logo">

							<a href="<?php echo get_home_url(); ?>">
								<svg width="100%" height="100%" viewBox="0 0 250 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><clipPath id="_clip1"><rect x="-7.812" y="-0.609" width="101.181" height="101.181"/></clipPath><g clip-path="url(#_clip1)"><clipPath id="_clip2"><rect x="41.177" y="0.694" width="51.156" height="99.109"/></clipPath><g clip-path="url(#_clip2)"><circle cx="42.778" cy="50.249" r="49.554" style="fill:url(#_Linear3);"/></g><text id="V" x="44.465px" y="76.389px" style="font-family:'MontereyFLF';font-weight:500;font-size:75.886px;fill:url(#_Linear4);">V</text><use id="R" xlink:href="#_Image5" x="2.001" y="22.727" width="35.986px" height="54.082px" transform="matrix(0.999601,0,0,0.983311,-8.88178e-16,-1.11022e-16)"/></g><g transform="matrix(1,0,0,1,-105.272,12.3431)"><text x="209.504px" y="27.573px" style="font-family:'MontereyFLF';font-weight:500;font-size:30px;fill:#101834;">Ren V<tspan x="275.564px 287.564px " y="27.573px 27.573px ">en</tspan>tura</text><text x="218.369px" y="55.773px" style="font-family:'MontereyFLF';font-weight:500;font-size:15px;fill:#101834;">Softw<tspan x="254.819px 261.269px " y="55.773px 55.773px ">ar</tspan>e Dev<tspan x="302.519px 308.519px 312.044px 320.669px " y="55.773px 55.773px 55.773px 55.773px ">elop</tspan>er.</text></g><defs><linearGradient id="_Linear3" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(-3.96209,-97.4276,97.4276,-3.96209,50.3559,98.3379)"><stop offset="0" style="stop-color:#101834;stop-opacity:1"/><stop offset="1" style="stop-color:#363c4e;stop-opacity:1"/></linearGradient><linearGradient id="_Linear4" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(13.2932,50.5142,-50.5142,13.2932,51.3391,24.8839)"><stop offset="0" style="stop-color:#d7dee4;stop-opacity:1"/><stop offset="1" style="stop-color:#fbfbfc;stop-opacity:1"/></linearGradient><image id="_Image5" width="36px" height="55px" xlink:href="data:image/png;base64,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"/></defs></svg>
							</a>

						</div>

						<?php if ( $header_image = get_header_image() ) : ?>

							<div class="site-logo">

								<a href="<?php echo get_home_url(); ?>">
									<img src="<?php echo $header_image; ?>" id="header-logo" alt="<?php echo get_bloginfo( 'title' ); ?>">
								</a>

							</div>

						<?php endif; ?>
							
					</div><!-- .site-branding -->

				</div>

			</div>

			<div id="nav-wrap" class="col-xs-8">
				
				<div class="box">
					
					<nav id="main-navigation" class="site-navigation" role="navigation">
						<button id="open-offcanvas" class="open-offcanvas menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'personaltheme' ); ?></button>
						<?php wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id' => 'primary-menu',
							'menu_class' => 'menu clearfix'
						) ); ?>
					</nav><!-- #site-navigation -->

				</div>

			</div>

		</div><!-- .header-elements-wrap -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
