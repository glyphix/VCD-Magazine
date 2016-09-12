<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings\
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define('DB_NAME', 'vcdmag');



/** MySQL database username */

define('DB_USER',       'root');



/** MySQL database password */

define('DB_PASSWORD',       'root');



/** MySQL hostname */

define('DB_HOST', 'localhost');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');



/**#@+* Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define('AUTH_KEY',       ')&mb!0#NL9EJurZS5u6x8Dz)k1iu^o!E^!kxxy4pyEFc*1z)Jx^a*VQpU(MY0DKw');

define('SECURE_AUTH_KEY',       'vz6FMaNZ2&gqZi7XUcga7TpJX3i#anXu*lax3^&dJ@(chcWVH5LR5uEVm4xNfob3');

define('LOGGED_IN_KEY',       '3w99N357VTa05g@Yw8qoYVo6Y(kOdADmbutpm)u0@d!(0E^N^RS@9vaoUm5hzZqT');

define('NONCE_KEY',       'u&ztKq^cocc3iDiLO26d9NJoSh9Dj6h7XTH1pk*XY%4yObmqIT7tP%Pc5tdY3Tby');

define('AUTH_SALT',       'IeJ3fNV^FWEn*Mv&63X7e)G0z(nHsuY0ZsU9EJP4qP&KE9QW@c(jTskxkSzQXf4z');

define('SECURE_AUTH_SALT',       '#&0!8jRq#34el(5h@OgqXSkAaGD94*Z(n8YG!G3DGhGG#wJYqD9jE2l!4JcKc2Wh');

define('LOGGED_IN_SALT',       'F3tkBqiL4yp8I%%J7K3NZBdIYjOsSz5YeYAEbQtPDFVjb@xKMIFFHSo%f(n5a^z9');

define('NONCE_SALT',       'hJ0in3vtS8))1Cnm!9iz8*tSiUelcrP^MQr2nK2Hc628kVios!UAYLB1jIs54RhY');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'wp_';



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define('WP_DEBUG', false);



/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

