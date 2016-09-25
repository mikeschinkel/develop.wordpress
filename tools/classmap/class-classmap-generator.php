<?php

/**
 * Class WP_Classmap_Geneator
 *
 * Class to generate a classmap by scanning core for classes, interfaces and traits.
 *
 */
class WP_Classmap_Generator {

	private $_classmap = array();
	private $_root_dir;

	public function __construct( $root_dir ) {

		$this->_root_dir = rtrim( $root_dir, '/' );

	}

	/**
	 * @param string $dir
	 */
	public function add_files( $dir ) {

		$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( "{$this->_root_dir}/{$dir}" ) );

		foreach ( $files as $file ) {

			$filepath = $this->_get_filepath( $file );

			if ( ! $filepath ) {
				continue;
			}

			foreach( $this->_get_file_classnames( $file ) as $class_name ) {
				$this->_classmap[ $class_name ] = $filepath;
			}

		}

	}

	/**
	 * @param string[] $class_names
	 */
	public function omit_classes( $class_names ) {

		foreach ( $class_names as $class_name ) {

			unset( $this->_classmap[ $class_name ] );

		}

	}

	/**
	 * @param SplFileInfo $file
	 * @return string|null
	 */
	private function _get_filepath( $file ) {

		do {

			$filepath = null;

			if ( $file->isDir() ) {
				continue;
			}

			if ( 'php' !== strtolower( $file->getExtension() ) ) {
				continue;
			}

			$dir = preg_quote( $this->_root_dir );

			$filepath = preg_replace( "#^{$dir}/(.+)$#", '$1', $file->getRealPath() );

		} while ( false );

		return $filepath;

	}

	/**
	 * @param SplFileInfo $file
	 * @return string[]
	 */
	private function _get_file_classnames( $file ) {

		$classes = array();

		$php_code = file_get_contents( $file->getRealPath() );

		/**
		 * @see http://stackoverflow.com/a/12011255/102699
		 */
		$token = '([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)';

		if ( preg_match_all( "/\n\s*(final|abstract)?\s*(class|interface|trait)\s+{$token}/", $php_code, $matches ) ) {

			$classes = $matches[ 3 ];

		}

		return $classes;

	}

	/**
	 *
	 */
	public function get_classmap() {

		ob_start();
		var_export( $this->_classmap );
		$classmap = ob_get_clean();
		$classmap = '<?' . <<<PHP
php
// WordPress Core Classmap
return {$classmap};
PHP;

		return "{$classmap}\n";

	}


}
