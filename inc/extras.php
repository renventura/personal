<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Personal Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function personaltheme_body_classes( $classes ) {

	global $post;
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// If post has a featured image
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'post-thumbnail';
	}

	// If header image (logo) is set
	if ( get_header_image() ) {
		$classes[] = 'header-image';
	}

	// Catch-all for singular posts/pages/cpts
	if ( is_singular() ) {
		$classes[] = 'singular';
	} else {
		$classes[] = 'not-singular';
	}

	/**
	 *	Determine layout
	 */

	$layout = '';

	// Default layout
	if ( $default_layout = get_theme_mod( 'personaltheme_default_layout' ) ) {

		switch ( $default_layout ) {

			case 'left_sidebar':
				$layout = 'layout-sidebar-content';
				break;

			case 'right_sidebar':
				$layout = 'layout-content-sidebar';
				break;

			case 'no_sidebar':
			default:
				$layout = 'layout-default';
				break;
		}

	}

	// Adds appropriate class for selected layout
	if ( is_object( $post ) ) {

		$post_layout = get_post_meta( $post->ID, 'personaltheme_post_layout', true );
		if ( isset( $post_layout ) && ! empty( $post_layout ) ) {

			switch ( $post_layout ) {

				case 'left_sidebar':
					$layout = 'layout-sidebar-content';
					break;

				case 'right_sidebar':
					$layout = 'layout-content-sidebar';
					break;

				case 'no_sidebar':
					$layout = 'layout-default';
					break;
			}
		}

		// Post type
		$classes[] = $post->post_type;
	}

	// Default if no widgets sidebar
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$layout = 'layout-default';
	}

	$classes[] = $layout;

	return $classes;
}
add_filter( 'body_class', 'personaltheme_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function personaltheme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'personaltheme_pingback_header' );


/**
 *	Set up Backstretch for posts with thumbnails
 */
function personaltheme_backstretch_setup() {

	global $post;

	if ( is_singular() && has_post_thumbnail( $post->ID ) ) {
		
		$thumbnail = get_the_post_thumbnail_url( get_the_id(), 'full' );
		
		wp_localize_script( 'personaltheme', 'backstretch', array(
			'url' => $thumbnail
		) );	
	}
}
add_action( 'wp_enqueue_scripts', 'personaltheme_backstretch_setup' );

/**
 *	Redirect 404s to the front page
 */
function personaltheme_redirect_404s() {

	if ( is_404() ) {
		wp_redirect( get_home_url() );
		exit;
	}
}
add_action( 'template_redirect', 'personaltheme_redirect_404s' );