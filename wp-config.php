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
define( 'DB_NAME', 'données_koudijs' );

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
define( 'AUTH_KEY',         '|~FB{y>r|!Tpu=JEVFF7=+38jYReV{QCa`8Q:^m,Qlz`M_1e?_{K~B9nQ;<N1+(b' );
define( 'SECURE_AUTH_KEY',  'dZ8A;A.Y.NzQsZrWtP-@symBYRkvDcR,eiDJ;&~.1HImLW(iy=o(o*ysqsZI~g?P' );
define( 'LOGGED_IN_KEY',    'B2E:FS)o0^fm7U&<(hKhfX3?R>-U{q`K(?<*M%N[Tr)z49O]:,9C0ej_o&jt,kM!' );
define( 'NONCE_KEY',        'wy(au=57Qe8-pO}SGgR_v^_Pr;+38&ISLoJfm8).j[zcd63?Hcf.#Vt]y&|9ulzO' );
define( 'AUTH_SALT',        'FlB,plkoU.P%Q~5c~oEx=RWWQ#6cA3G^1L9{!2aYPY <ze|YV~}<GUMN$+zi(]ij' );
define( 'SECURE_AUTH_SALT', '9syrdMX ^BavoywxFCF`Q98DESi#=piWTF~O0wpssFL9C}yp{Y|FY[UV-}dt5(Qk' );
define( 'LOGGED_IN_SALT',   '&0+r1<%z4L@2aMq$+eNQu,<,BW1UXTOp`B/?7*nUrW*}<y?6N E 2H@qpoOqS,Xo' );
define( 'NONCE_SALT',       'r%(]Km=-]$tc J)l:( q:!~1POG4}0[|?MWR9M.+#qWZY_x ZsDmor8D<C#k%BiF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'koudijs_';

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
