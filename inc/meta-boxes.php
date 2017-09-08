<?php
/**
 * Add meta boxes
 *
 * @package Personal Theme
 */


// Register meta boxes
function personaltheme_register_post_layout_meta_box() {
    add_meta_box( 'post_layout', __( 'Post Layout', 'personaltheme' ), 'personaltheme_render_post_layout_meta_box', array( 'post', 'page' ), 'side', 'default', null );
    // add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
}
add_action( 'add_meta_boxes', 'personaltheme_register_post_layout_meta_box' );

// Meta box callback
function personaltheme_render_post_layout_meta_box( $post ) {

	$default_layout = get_theme_mod( 'personaltheme_default_layout' );
	$post_layout = get_post_meta( $post->ID, 'personaltheme_post_layout', true );

	$layout = $post_layout ? $post_layout : $default_layout;

	$default_text = __( '(Default)', 'personaltheme' );

	wp_nonce_field( basename(__FILE__), 'post-layout-nonce' );

	?>

	<div class="layout-options">
		<p><input type="radio" name="amerge_post_layout" value="no_sidebar" <?php checked( $layout, 'no_sidebar', 'selected' ); ?>> No Sidebar <?php if ( $default_layout == 'no_sidebar' ) echo $default_text; ?></p>
		<p><input type="radio" name="amerge_post_layout" value="left_sidebar" <?php checked( $layout, 'left_sidebar', 'selected' ); ?>> Left Sidebar <?php if ( $default_layout == 'left_sidebar' ) echo $default_text; ?></p>
		<p><input type="radio" name="amerge_post_layout" value="right_sidebar" <?php checked( $layout, 'right_sidebar', 'selected' ); ?>> Right Sidebar <?php if ( $default_layout == 'right_sidebar' ) echo $default_text; ?></p>
	</div>

	<?php
}

// Process meta box
function amerging_save_meta_box( $post_id, $post, $update ) {

	if ( ! isset( $_POST['post-layout-nonce'] ) || ! wp_verify_nonce( $_POST['post-layout-nonce'], basename(__FILE__) ) ) {
		die();
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$default_layout = get_theme_mod( 'personaltheme_default_layout' );
	$post_layout = isset( $_POST['amerge_post_layout'] ) ? sanitize_text_field( $_POST['amerge_post_layout'] ) : '';

	if ( $post_layout && $post_layout != $default_layout ) {
		update_post_meta( $post_id, 'personaltheme_post_layout', $post_layout );
	} else {
		delete_post_meta( $post_id, 'personaltheme_post_layout' );
	}
}
add_action( 'save_post', 'amerging_save_meta_box', 10, 3 );