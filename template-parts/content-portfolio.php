<?php
/**
 * Template part for displaying single portfolio projects
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Personal Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/CreativeWork">

	<?php if ( have_rows( 'portfolio_layout' ) ) : ?>

		<?php while ( have_rows('portfolio_layout') ) : the_row(); ?>

			<?php if ( get_row_layout() == 'single_column' ) : ?>

				<div class="entry-wrap" itemprop="text">
					
					<?php echo get_sub_field( 'column_one' ); ?>

				</div>

			<?php elseif ( get_row_layout() == 'two_column' ) : ?>				

				<div class="two-columns full-width-content">
					
					<div class="row">

						<div class="col-xs">
							<div class="box">
								<div class="column-one" itemprop="text"><?php echo get_sub_field( 'column_one' ); ?></div>
							</div>
						</div>

						<div class="col-xs">
							<div class="box">
								<div class="column-two" itemprop="text"><?php echo get_sub_field( 'column_two' ); ?></div>
							</div>
						</div>

					</div>

				</div>

			<?php elseif ( get_row_layout() == 'full_width_image' ) :  ?>

				<?php $image = get_sub_field( 'full_image' ); ?>

				<?php if ( ! empty( $image ) ) : ?>

					<div class="full-width-image">
						<img itemprop="image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
					</div>

				<?php endif; ?>

			<?php elseif ( get_row_layout() == 'contained_image' ) :  ?>

				<?php $image = get_sub_field( 'contained_image' ); ?>

				<?php if ( ! empty( $image ) ) : ?>

					<div class="entry-wrap" style="margin: 50px auto;">
						<img itemprop="image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
					</div>

				<?php endif; ?>

			<?php endif; ?>

		<?php endwhile; ?>

	<?php else : ?>

		<?php // no layouts found ?>

	<?php endif; ?>
	
	<div class="entry-wrap">
		
		<div class="entry-content" itemprop="text">
			<?php the_content(); ?>
		</div>

		<?php if ( get_field( 'client_testimonial' ) ) : ?>
			<div class="portfolio-info">
				<div class="client-testimonial">
					<div class="testimonial"><?php the_field( 'client_testimonial' ); ?></div>
					<?php if ( get_field( 'client_name' ) ) : ?>
						<div class="name"><?php the_field( 'client_name' ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
			
		<?php if ( get_field( 'project_url' ) ) : ?>
			<div class="portfolio-link"><a href="<?php the_field( 'project_url' ); ?>" class="button" target="_blank" rel="noopener noreferrer" style="color: #fff;"><?php _e( 'View Project', 'personaltheme' ); ?></a></div>
		<?php endif; ?>

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'personaltheme' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</footer>
		<?php endif; ?>

	</div>

</article>
