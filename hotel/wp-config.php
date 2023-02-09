<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wphotel' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'L|{bv/E#CqR{umG5DVA]T^0| =w+.`-g)I_P? f$tR<z5@KrK6.?w].WE3gH6($v' );
define( 'SECURE_AUTH_KEY',  '+mm/qti`vnTckju%f t5mBs.UWD&|?Bj!p29CnaPUGqzNBUl,J+uz<+^V:/e_%i<' );
define( 'LOGGED_IN_KEY',    ']7!~d*{G-+4L#%g$X&S_`:}sBa[)^ w~P-9ITYGwiX$ +V}:/C_[V,2+~+`Im~ /' );
define( 'NONCE_KEY',        'D!gMdY=K2yF(HqxX7!5!QEvmd5V|@~k _YVw*)^R%2 .H<Mt[e}pADH55U-ciD5m' );
define( 'AUTH_SALT',        'ThbU^M!;;Q>[#wPWecfgqXD[_$Y!bn$rDH6(1)fIXVRxB>vGDYQIO#dyeUuo%Tc ' );
define( 'SECURE_AUTH_SALT', 'bVE8~d6q@]CD$ gZ*#aIRxsf(/TMT(7,($CU(RS#{GPpO?6b_T[+z}g/`DLp9WHK' );
define( 'LOGGED_IN_SALT',   '>MHe`_C;0a#Tm;9IQNz/C=!7+c./Vao@jQku7OV(S;Jhjc~D40uAF$s*- nVkC=u' );
define( 'NONCE_SALT',       'mWe{hv?O}/-UJ{n#m3-u]t4?IS`dABsM+oJSuRxM@ sO@WQb@*lSfxLEnLIsD/2G' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
