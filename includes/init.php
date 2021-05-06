<?php

$include_dir = trailingslashit( get_template_directory() ) . 'includes/';

require trailingslashit( get_template_directory() ) . 'vendor/autoload.php';

/* Theme Specifics */
require_once $include_dir . 'theme/customizer.php';
require_once $include_dir . 'theme/asset-loader.php';

// Only load the ACF helper if plugin is active
if ( class_exists( 'acf' ) ) {
    include_once $include_dir . 'theme/acf.php';
}
