<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Personal Theme
 */

// Bail if sidebar has no widgets
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$post_layout = get_post_meta( $post->ID, 'personaltheme_post_layout', true );
$default_layout = get_theme_mod( 'personaltheme_default_layout' );
$layout = $post_layout ? $post_layout : $default_layout;

// Bail if no sidebar layout
if ( ! $layout || $layout == 'no_sidebar' ) {
	return;
}

?>

<aside id="secondary" class="sidebar-widget" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
