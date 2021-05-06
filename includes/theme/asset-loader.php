<?php
/**
 * Load the relevant assets
 *
 * @author Adam Gardner <hello@adgardner.co.uk>
 * @since  1.0
 */

new AssetLoader;
class AssetLoader {
    /**
     * Called on class initialisation
     */
    function __construct() {
        /* Setup wp global for removing query vars */
        global $wp;

        /* Load only certain scripts in the CMS editor when using Gutenberg */
        add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ) );

        /* Add our function which allows for site-wide uploading of SVG's to the media library */
        add_filter( 'upload_mimes', array( $this, 'allow_svg_uploads' ) );

        /* Remove emoji actions introduced in WordPress 4.2 */
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    }

    /**
    * Allow SVG's to be uploaded to the WordPress media library,
    * used for adding the logo to the site through the customiser
    */
    public function allow_svg_uploads( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    public function block_editor_assets() {

        // Use location variable to avoid unnecessary function calls
        $theme = get_template_directory_uri();

        // Fetch our theme styles to display in Gutebnerg and enqueue these into the header
        wp_enqueue_style( 'admin-theme', $theme . '/assets/dist/gutenberg.css', false );

    }

}
