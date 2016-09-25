<?php
/**
 * Class WP_Autoloader
 *
 * WordPress Class, Interface and Trait Autoloader
 *
 */
class WP_Autoloader {

	/**
	 * @var array
	 */
	private static $_classmap;

	/**
	 * WP_Autoloader constructor.
	 */
	function __construct() {

		do {

			if ( defined( 'DISABLE_CORE_AUTOLOADER' ) ) {

				break;

			} else {

				define( 'DISABLE_CORE_AUTOLOADER', false );

			}

			if ( DISABLE_CORE_AUTOLOADER ) {

				break;

			}

			spl_autoload_register( array( $this, 'load' ), true, true );

			if ( ! is_file( ABSPATH . 'wp-classmap.php' ) ) {

				break;

			}

			self::$_classmap = require( ABSPATH . 'wp-classmap.php' );

		} while ( false );

	}

	/**
	 * @param string $class_name
	 */
	function load( $class_name ) {

		if ( isset( self::$_classmap[ $class_name ] ) ) {

			require ABSPATH . self::$_classmap[ $class_name ];

		}

	}

}