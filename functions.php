<?php
/**
 * The default WordPress master functions file.
 *
 * @author Adam Gardner <hello@adgardner.co.uk>
 * @since  1.0
 */

require_once trailingslashit( get_template_directory() ) . 'includes/init.php';


class mySite extends Timber\Site {
	public function __construct() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		// Remove standard WordPress blocks from Gutenberg
		add_filter( 'allowed_block_types', array( $this, 'remove_default_blocks' ) );
		parent::__construct();
	}

		/**
	 * Remove all core blocks from the Gutenberg editor view
	 * @param array $allowed_blocks The array of all blocks
	 * @return array $filtered_blocks The filtered list of blocks to show in the CMS
	 */
	public function remove_default_blocks( $allowed_blocks ) {

		// Get all registered Gutenberg blocks to filter through
		$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

		// This array will hold the blocks we want to keep/display
		$filtered_blocks = array();

		// Loop through each block
		foreach ( $registered_blocks as $block ) {

			// If the pattern does not match core/ (the default WordPress blocks)
			if ( strpos( $block->name , 'core/' ) === false ) {

				// Add this to the array of acceptable blocks
				array_push( $filtered_blocks, $block->name  );
			}
		}

		// Return the accepted blocks to display in the CMS!
		return $filtered_blocks;
	}

	function add_to_context( $context ) {
		$context['menu'] = new Timber\Menu('main-menu');
		$context['site'] = $this;

		return $context;
	}

	function my_acf_block_editor_style() {
	    wp_enqueue_style(
	        'example_block_css',
	        get_template_directory_uri() . '/assets/example-block.css'
	    );
	}


}

new mySite();
