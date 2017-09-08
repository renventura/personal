<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Personal Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php personaltheme_hero( get_the_title(), get_the_excerpt() ); ?>
		
		<div class="content-sidebar">
			
			<main id="main" class="main-content" role="main">

			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					// personaltheme_author_bio();

					// personaltheme_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
			?>

			</main>

			<?php get_sidebar(); ?>
			
		</div>

	</div>

<?php
get_footer();
