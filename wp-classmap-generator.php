<?php

require __DIR__ . '/tools/classmap/class-classmap-generator.php';

$generator = new WP_Classmap_Generator( __DIR__ . '/src' );
$generator->add_files( 'wp-admin' );
$generator->add_files( 'wp-includes' );
$classmap = $generator->get_classmap();
file_put_contents( __DIR__ . '/src/wp-classmap.php', $classmap );