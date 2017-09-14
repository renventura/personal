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

	<div class="pre-footer">
		<h3><?php _e( 'Ready to dicsuss your business?', 'personaltheme' ); ?></h3>
		<p>Let's talk about putting web and mobile technology to work for you.</p>
		<a href="/#contact" class="button button-round cta-button"><?php _e( 'Get In Touch', 'personaltheme' ); ?></a>
	</div>

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
