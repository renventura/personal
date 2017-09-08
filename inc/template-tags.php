<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Personal Theme
 */


if ( ! function_exists( 'personaltheme_post_navigation' ) ) :
/**
 *	Output a custom post navigation
 */
function personaltheme_post_navigation() {

	$previous_post = get_adjacent_post();
	$next_post = get_adjacent_post( false, '', false );

	?>

	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text">Post navigation</h2>
		<div class="nav-links">
			<?php if ( is_object( $previous_post ) ) : ?>
				<div class="nav-previous">
					<a href="<?php echo get_permalink( $previous_post->ID ); ?>" rel="prev">
						<?php echo $previous_post->post_title; ?> 
						<svg version="1.1" class="post-nav-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve">
							<g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225 c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g>
						</svg>
					</a>
				</div>
			<?php endif; ?>
			<?php if ( is_object( $next_post ) ) : ?>
				<div class="nav-next">
					<a href="<?php echo get_permalink( $next_post->ID ); ?>" rel="next">
						<?php echo $next_post->post_title; ?>
						<svg version="1.1" class="post-nav-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve">
							<g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5 c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g>
						</svg>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</nav>

<?php }

endif;

if ( ! function_exists( 'personaltheme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function personaltheme_posted_on() {

	$author_id = get_the_author_meta( 'ID' );

	$author_avatar_url = get_avatar_url( $author_id );

	$author = sprintf(
		esc_html_x( '%s', 'post author', 'personaltheme' ),
		'<img src="' . $author_avatar_url . '" class="author-avatar" />
		<span class="author vcard box">
			<a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author() ) . '</a>
		</span>'
	);
	
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' on %s', 'post date', 'personaltheme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo $author;
	echo '&nbsp;<span class="posted-on box">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'personaltheme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function personaltheme_entry_footer() {
	
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'personaltheme' ) );
		if ( $categories_list && personaltheme_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'personaltheme' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'personaltheme' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'personaltheme' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'personaltheme' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'personaltheme' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function personaltheme_categorized_blog() {
	
	if ( false === ( $all_the_cool_cats = get_transient( 'personaltheme_categories' ) ) ) {
		
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'personaltheme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so personaltheme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so personaltheme_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'personaltheme_post_archive_thumbnail' ) ) :

/**
 *	Output a "secondary" post thumbnail
 */
function personaltheme_post_archive_thumbnail() {

	$image = wp_get_attachment_url( get_post_meta( get_the_id(), 'personaltheme_post_archive_thumbnail', true ) );
	$image = $image ? $image : get_the_post_thumbnail_url();
	
	if ( $image ) {
		printf( '<img src="%s" class="personaltheme-post-archive-thumbnail" alt="%s" />', $image, __( 'Post Thumbnail', 'personaltheme' ) );
	}
}

endif;

if ( ! function_exists( 'personaltheme_post_archive_readmore' ) ) :

/**
 *	Post archive "Read More" link
 */
function personaltheme_post_archive_readmore() {
	printf( '<div class="readmore"><a href="%s" class="readmore-link">%s</a></div>', get_permalink(), __( 'Continue Reading &rarr;', 'personaltheme' ) );
}

endif;

/**
 * Flush out the transients used in personaltheme_categorized_blog.
 */
function personaltheme_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'personaltheme_categories' );
}
add_action( 'edit_category', 'personaltheme_category_transient_flusher' );
add_action( 'save_post',     'personaltheme_category_transient_flusher' );

if ( ! function_exists( 'personaltheme_author_bio' ) ) :

/**
 *	Post archive "Read More" link
 */
function personaltheme_author_bio() {
	
	$first_name = get_the_author_meta( 'first_name' );
	$last_name = get_the_author_meta( 'last_name' );
	$description = get_the_author_meta( 'description' );
	$author_id = get_the_author_meta( 'ID' );
	$author_avatar_url = get_avatar_url( $author_id, array( 'size' => 500 ) );

	?>

	<section id="author-box" class="clear">
		<div class="row">
			<div class="author-image-wrap col-xs-12 col-sm-3">
				<div class="box">
					<?php printf( '<img src="%s" class="author-image" />', $author_avatar_url ); ?>
				</div>
			</div>
			<div class="author-info col-xs-12 col-sm-9">
				<div class="box">
					<h4 class="author-name"><?php echo $first_name . ' ' . $last_name; ?></h4>
					<p class="author-bio"><?php echo $description; ?></p>
				</div>
			</div>
		</div>
	</section>

<?php }

endif;

if ( ! function_exists( 'personaltheme_hero' ) ):

/**
 * Output the hero area
 */
function personaltheme_hero( $title = '', $description = '', $thumbnail = true, $color_scheme = 'light' ) {

	if ( ! $title ) {
		$title = get_the_title();
	}

	if ( $thumbnail && is_singular() && has_post_thumbnail() ) {
		$thumbnail_url = get_the_post_thumbnail_url( get_the_id() );
		$thumbnail_style = "style=\"background-image: url( $thumbnail_url );\"";
	}

	if ( ! isset( $thumbnail_style ) ) {
		$color_scheme = 'dark';
	}

	switch ( $color_scheme ) {
		case 'light':
			$color = '#ffffff';
			break;

		case 'dark':
			$color = '#4A5874';
			break;
		
		default:
			break;
	}

	include_once( get_stylesheet_directory() . '/template-parts/hero.php' );
}

endif;