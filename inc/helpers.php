<?php

namespace ctoolkit;

/**
 * Helper functions
 *
 * @package   ctoolkit
 * @category  Functions
 * @author    tuanvu
 * @license   GPLv3
 * @version   1.0
 */

/**
 * Parse string like "title:cToolkit is useful|author:vutuansw" to array('title' => 'cToolkit is useful', 'author' => 'vutuansw')
 *
 * @param $value
 * @param array $default
 *
 * @since 1.0
 * @return array
 */
function parse_multi_attribute( $value, $default = array() ) {
	$result = $default;
	$params_pairs = explode( '|', $value );
	if ( !empty( $params_pairs ) ) {
		foreach ( $params_pairs as $pair ) {
			$param = preg_split( '/\:/', $pair );
			if ( !empty( $param[0] ) && isset( $param[1] ) ) {
				$result[$param[0]] = rawurldecode( $param[1] );
			}
		}
	}

	return $result;
}

/**
 * Shortcut method to get the translation strings
 * @since 1.0
 * @param string $config_id The config ID.
 * @return array
 */
function l10n_get_strings( $config_id = 'global' ) {

	$translation_strings = array(
		'background-color' => esc_attr__( 'Background Color', 'ctoolkit' ),
		'background-image' => esc_attr__( 'Background Image', 'ctoolkit' ),
		'no-repeat' => esc_attr__( 'No Repeat', 'ctoolkit' ),
		'repeat-all' => esc_attr__( 'Repeat All', 'ctoolkit' ),
		'repeat-x' => esc_attr__( 'Repeat Horizontally', 'ctoolkit' ),
		'repeat-y' => esc_attr__( 'Repeat Vertically', 'ctoolkit' ),
		'inherit' => esc_attr__( 'Inherit', 'ctoolkit' ),
		'background-repeat' => esc_attr__( 'Background Repeat', 'ctoolkit' ),
		'cover' => esc_attr__( 'Cover', 'ctoolkit' ),
		'contain' => esc_attr__( 'Contain', 'ctoolkit' ),
		'background-size' => esc_attr__( 'Background Size', 'ctoolkit' ),
		'fixed' => esc_attr__( 'Fixed', 'ctoolkit' ),
		'scroll' => esc_attr__( 'Scroll', 'ctoolkit' ),
		'background-attachment' => esc_attr__( 'Background Attachment', 'ctoolkit' ),
		'left-top' => esc_attr__( 'Left Top', 'ctoolkit' ),
		'left-center' => esc_attr__( 'Left Center', 'ctoolkit' ),
		'left-bottom' => esc_attr__( 'Left Bottom', 'ctoolkit' ),
		'right-top' => esc_attr__( 'Right Top', 'ctoolkit' ),
		'right-center' => esc_attr__( 'Right Center', 'ctoolkit' ),
		'right-bottom' => esc_attr__( 'Right Bottom', 'ctoolkit' ),
		'center-top' => esc_attr__( 'Center Top', 'ctoolkit' ),
		'center-center' => esc_attr__( 'Center Center', 'ctoolkit' ),
		'center-bottom' => esc_attr__( 'Center Bottom', 'ctoolkit' ),
		'background-position' => esc_attr__( 'Background Position', 'ctoolkit' ),
		'background-opacity' => esc_attr__( 'Background Opacity', 'ctoolkit' ),
		'on' => esc_attr__( 'ON', 'ctoolkit' ),
		'off' => esc_attr__( 'OFF', 'ctoolkit' ),
		'all' => esc_attr__( 'All', 'ctoolkit' ),
		'serif' => _x( 'Serif', 'font style', 'ctoolkit' ),
		'sans-serif' => _x( 'Sans Serif', 'font style', 'ctoolkit' ),
		'monospace' => _x( 'Monospace', 'font style', 'ctoolkit' ),
		'font-family' => esc_attr__( 'Font Family', 'ctoolkit' ),
		'font-size' => esc_attr__( 'Font Size', 'ctoolkit' ),
		'font-weight' => esc_attr__( 'Font Weight', 'ctoolkit' ),
		'line-height' => esc_attr__( 'Line Height', 'ctoolkit' ),
		'font-style' => esc_attr__( 'Font Style', 'ctoolkit' ),
		'letter-spacing' => esc_attr__( 'Letter Spacing', 'ctoolkit' ),
		'top' => esc_attr__( 'Top', 'ctoolkit' ),
		'bottom' => esc_attr__( 'Bottom', 'ctoolkit' ),
		'left' => esc_attr__( 'Left', 'ctoolkit' ),
		'right' => esc_attr__( 'Right', 'ctoolkit' ),
		'center' => esc_attr__( 'Center', 'ctoolkit' ),
		'justify' => esc_attr__( 'Justify', 'ctoolkit' ),
		'color' => esc_attr__( 'Color', 'ctoolkit' ),
		'add-image' => esc_attr__( 'Add Image', 'ctoolkit' ),
		'change-image' => esc_attr__( 'Change Image', 'ctoolkit' ),
		'no-image-selected' => esc_attr__( 'No Image Selected', 'ctoolkit' ),
		'add-file' => esc_attr__( 'Add File', 'ctoolkit' ),
		'change-file' => esc_attr__( 'Change File', 'ctoolkit' ),
		'no-file-selected' => esc_attr__( 'No File Selected', 'ctoolkit' ),
		'remove' => esc_attr__( 'Remove', 'ctoolkit' ),
		'select-font-family' => esc_attr__( 'Select a font-family', 'ctoolkit' ),
		'variant' => esc_attr__( 'Variant', 'ctoolkit' ),
		'subsets' => esc_attr__( 'Subset', 'ctoolkit' ),
		'size' => esc_attr__( 'Size', 'ctoolkit' ),
		'height' => esc_attr__( 'Height', 'ctoolkit' ),
		'spacing' => esc_attr__( 'Spacing', 'ctoolkit' ),
		'invalid-value' => esc_attr__( 'Invalid Value', 'ctoolkit' ),
		'add-new' => esc_attr__( 'Add new', 'ctoolkit' ),
		'row' => esc_attr__( 'row', 'ctoolkit' ),
		'limit-rows' => esc_attr__( 'Limit: %s rows', 'ctoolkit' ),
		'open-section' => esc_attr__( 'Press return or enter to open this section', 'ctoolkit' ),
		'back' => esc_attr__( 'Back', 'ctoolkit' ),
		'reset-with-icon' => sprintf( esc_attr__( '%s Reset', 'ctoolkit' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
		'text-align' => esc_attr__( 'Text Align', 'ctoolkit' ),
		'text-transform' => esc_attr__( 'Text Transform', 'ctoolkit' ),
		'none' => esc_attr__( 'None', 'ctoolkit' ),
		'capitalize' => esc_attr__( 'Capitalize', 'ctoolkit' ),
		'uppercase' => esc_attr__( 'Uppercase', 'ctoolkit' ),
		'lowercase' => esc_attr__( 'Lowercase', 'ctoolkit' ),
		'initial' => esc_attr__( 'Initial', 'ctoolkit' ),
		'select-page' => esc_attr__( 'Select a Page', 'ctoolkit' ),
		'open-editor' => esc_attr__( 'Open Editor', 'ctoolkit' ),
		'close-editor' => esc_attr__( 'Close Editor', 'ctoolkit' ),
		'switch-editor' => esc_attr__( 'Switch Editor', 'ctoolkit' ),
		'hex-value' => esc_attr__( 'Hex Value', 'ctoolkit' ),
	);

	$config = apply_filters( 'ctoolkit_config', array() );

	if ( isset( $config['i18n'] ) ) {
		$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
	}


	return apply_filters( 'ctoolkit_' . $config_id . '_l10n', $translation_strings );
}

/**
 * Sanitize checkbox is multiple
 * @since 1.0
 * @return array
 */
function sanitize_checkbox_multiple( $value ) {

	if ( empty( $value ) ) {
		$value = array();
	}

	if ( is_string( $value ) ) {
		$value = explode( ',', $value );
	}

	return $value;
}

/**
 * Convert typography from string to array
 * 
 * @param string $value
 *
 * @since 1.0
 * @return array
 */
function build_typography( $value ) {
	$subfields = array(
		'font-family' => '',
		'variants' => '',
		'subsets' => '',
		'line-height' => '',
		'font-size' => '',
		'letter-spacing' => '',
		'text-transform' => ''
	);

	if ( !empty( $value ) ) {
		$value = json_decode( urldecode( $value ), true );
		if ( is_array( $value ) ) {
			$value = wp_parse_args( $value, $subfields );
			return $value;
		}
	}

	return $subfields;
}



/**
 * Autocomplete ajax post type
 *
 * @since 1.0
 * @return void
 */
function autocomplete_ajax_post_type() {

	$s = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
	$post_types = !empty( $_GET['types'] ) ? explode( ',', $_GET['types'] ) : array( 'post' );

	$posts = get_posts( array(
		'posts_per_page' => 20,
		'post_type' => $post_types,
		'post_status' => 'publish',
		's' => $s
			) );

	$result = array();

	foreach ( $posts as $post ) {
		$result[] = array(
			'value' => $post->ID,
			'label' => $post->post_title,
		);
	}

	wp_send_json( $result );
}

/**
 * Autocomplete ajax taxonomy
 *
 * @since 1.0
 * @return void
 */
function autocomplete_ajax_taxonomy() {

	$s = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';

	$types = !empty( $_GET['types'] ) ? explode( ',', $_GET['types'] ) : array( 'category' );

	$args['taxonomy'] = $types;
	$args['hide_empty'] = false;
	$args['name__like'] = $s;


	$terms = get_terms( $args );

	$result = array();

	foreach ( $terms as $term ) {
		$result[] = array(
			'value' => $term->term_id,
			'label' => $term->name,
		);
	}

	wp_send_json( $result );
}

add_action( 'wp_ajax_ctoolkit_autocomplete_post_type', '\ctoolkit\autocomplete_ajax_post_type' );
add_action( 'wp_ajax_ctoolkit_autocomplete_taxonomy', '\ctoolkit\autocomplete_ajax_taxonomy' );

/**
 * Build Link from string
 * 
 * @param string $value
 *
 * @since 1.0
 * @return array
 */
function build_link( $value ) {
	return parse_multi_attribute( $value, array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' ) );
}

/**
 * Print link editor template
 * Link field need a hidden textarea to work
 * 
 * @since 1.0
 * @return void
 */
function link_editor_hidden() {
	echo '<textarea id="content" class="hide hidden"></textarea>';
	require_once ABSPATH . "wp-includes/class-wp-editor.php";
	\_WP_Editors::wp_link_dialog();
}
