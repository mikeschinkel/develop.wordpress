<?php
/**
 * Loaded the desired autoloader.
 */
if ( defined( 'USE_COMPOSER_AUTOLOADER' ) && USE_COMPOSER_AUTOLOADER  ) {
	/**
	 * WordPress Core PHP 5.2-compatible Autoloader
	 */
	require_once( ABSPATH . 'wp-vendor/autoload_wordpress.php' );
} else {
	/**
	 * Register the WordPress Class, Interface and Trait Autoloader
	 */
	require( __DIR__ . '/class-wp-autoloader.php' );
	new WP_Autoloader();
}
