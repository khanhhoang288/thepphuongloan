<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
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
define('DB_NAME', 'thepphuongloan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ujpQ3YwB_!j+q[kSJJO_(?@H5&T{B+Siaqk;U5<CL*UZ:#[>aT-qRPI-fAwg9|09');
define('SECURE_AUTH_KEY',  'u-gBuQP,gH;|9p&4Y`4XnYhSkxP7{nh:LD,+%_-@0O0%vU5db$(if3|q+p;mzJI ');
define('LOGGED_IN_KEY',    ';bc[%z[Cf&|-d<7koZegE.CB>gAwZ/{$NNlG?A$uPxG-qapEkJh@QSy@%!cRx|s#');
define('NONCE_KEY',        'eI0:7N$xB:#owQIY2uh@y=t=lnk#W?=?_42f,l+)r-Rj|Cs_VJ(9:+!d|I(7{U[5');
define('AUTH_SALT',        '(|3/MJ8Bs&s%qE!l-O_rD[KR32:DLtwu)|*}yOyx:D`043[+rdF(M`|(snmQKR^f');
define('SECURE_AUTH_SALT', '#WM+1UATvK|Q.E-6/22NwI[J;xQV-LjR  $;#A+(I{QP++ru,vUcVs%l@!M%xM|;');
define('LOGGED_IN_SALT',   'lD/- c`J!xlj}9omGVnW{Mo-`*$!,jz</nTeTmkO@,-[_dfPB8zsR/xAfaaihGae');
define('NONCE_SALT',       '--DQNYl!ld20T;#gyI)Iin%KFtC{lh8=LSlm2#836-,rf{B.WU`u;0yj@s.]/f,h');

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