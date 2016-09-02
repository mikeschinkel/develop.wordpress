<?php

// autoload_real_wordpress.php generated by schlessera/composer-wp-autoload

class ComposerAutoloaderInit0e82b3dc330ca67abc15d988433a9d9b {
	private static $loader;

	public static function loadClassLoader($class) {
		if ('WordPress_Composer_ClassLoader' === $class) {
			require dirname(__FILE__).'/ClassLoaderWordPress.php';
		}
	}

	/**
	 * @return WordPress_Composer_ClassLoader
	 */
	public static function getLoader() {
		if (null !== self::$loader) {
			return self::$loader;
		}

		spl_autoload_register(array('ComposerAutoloaderInit0e82b3dc330ca67abc15d988433a9d9b', 'loadClassLoader'), true /*, true */);
		self::$loader = $loader = new WordPress_Composer_ClassLoader();
		spl_autoload_unregister(array('ComposerAutoloaderInit0e82b3dc330ca67abc15d988433a9d9b', 'loadClassLoader'));

		$vendorDir = dirname(dirname(__FILE__));
		$baseDir   = ABSPATH;
		$dir       = dirname(__FILE__);

		$map = require $dir.'/autoload_namespaces.php';
		foreach ($map as $namespace => $path) {
			$loader->add($namespace, $path);
		}

		$classMap = require $dir.'/autoload_classmap_wordpress.php';
		if ($classMap) {
			$loader->addClassMap($classMap);
		}

		$loader->register(true);

		return $loader;
	}
}
