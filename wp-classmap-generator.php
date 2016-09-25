<?php

require __DIR__ . '/tools/classmap/class-classmap-generator.php';

$generator = new WP_Classmap_Generator( __DIR__ . '/src' );
$generator->add_files( 'wp-admin' );
$generator->add_files( 'wp-includes' );

/**
 * The following shows how to omit classes that we want to laod manually
 * This is not required by instead added because of these trac comments:
 * @link https://core.trac.wordpress.org/ticket/36335?replyto=218#comment:218
 */
$generator->omit_classes( array(
	// 'WP',
	// 'WP_Query',
	// 'WP_Post',
	// 'WP_Rewrite',
	// 'wpdb',
));

$classmap = $generator->get_classmap();
file_put_contents( __DIR__ . '/src/wp-classmap.php', $classmap );
