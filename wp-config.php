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
define( 'DB_NAME', 'aventurax' );

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
define( 'AUTH_KEY',         'n-I]-c|{-wQ=}L5.4kR=XhR%Cp>Sw>/ {QRzyTP<hk-92(ge@KrTOf(`{eVO%^%!' );
define( 'SECURE_AUTH_KEY',  'Evf&aedeT4PcGgY/xeY}n$7s:mF])}$gTX_4*9%*RAoP^1v2LoiFOsm0G<%$x81T' );
define( 'LOGGED_IN_KEY',    'BkZ VjOjh]Ly{GKv.}Ct,]0uT9CuZ68FOR#<po@hMZEQ@5/@N=Flm./u:t3lVjQ$' );
define( 'NONCE_KEY',        'y1 ?MS7e6J,H1#>e{$~Xe*/ B4[syvQYvv{MG`B@],Sp4>v6t#If40@MD:/GQl->' );
define( 'AUTH_SALT',        '?m}xx2qxI>]U3%bDoa9xJZEWBq5uDO]<+6WrvLI/Kuph7>n*u,c<%ys-d?aaX1Wv' );
define( 'SECURE_AUTH_SALT', 'FV/+a5.grPDHFz4^llQ%=Q1I+so@Eb@(*X#Eg;i-K[}f#xqAtNYMsQH8VB}+#:.R' );
define( 'LOGGED_IN_SALT',   '>mG5eLAr|fOMIQo{h;F s,p<h_7*{;Cj=3hWX({EV$~8O-oUc:u8<SI^H0KyX0#H' );
define( 'NONCE_SALT',       'm5}l=TJO+lQ[!>JtXjJ0Ei)y:h(%{L`5XY(|@yiR(_`|,uwNSD{aogIreKA5^ 4M' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
