<?php

add_filter( 'acf/settings/load_json', 'acf_json_load_point' );
add_action( 'acf/init', 'canvas_acf_init' );


function canvas_acf_init() {
    // Bail out if function doesn’t exist.
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    // Register a new block.
    acf_register_block( array(
        'name'            => 'hero_image',
        'title'           => __( 'Hero Image', 'canvas' ),
        'description'     => __( 'A custom example block.', 'canvas' ),
        'render_callback' => 'hero_image_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'example' ),
    ) );
}

/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function hero_image_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( '/block/hero-image.twig', $context );
}

function acf_json_load_point( $paths ) {

	// remove original path
	unset($paths[0]);

	// append path
	$paths[] = get_stylesheet_directory() . '/acf-json';

	// return
	return $paths;

}
