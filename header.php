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
