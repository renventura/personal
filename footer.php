<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Personal Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<i class="fa fa-code-fork" aria-hidden="true"></i>
			<?php _e( 'Built by Yours Truly', 'personaltheme' ) ?>
			<br>
			<?php _e( 'Powered by ', 'personaltheme' ) ?>
			<a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>" target="_blank" rel="noopener noreferrer"><?php printf( __( 'WordPress', 'personaltheme' ) ); ?></a>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( 'https://renventura.com/go/siteground/' ); ?>" target="_blank" rel="noopener noreferrer"><?php _e( 'SiteGround Hosting', 'personaltheme' ); ?></a>
			<br>
			<?php printf( '%s - %s', __( 'Copyright ' ) . date('Y'), get_bloginfo( 'name' ) ); ?> 
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
