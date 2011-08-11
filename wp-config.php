<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'starter');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '{BIMSTW#fa!eQHBQclon0}|o-H.34J3}S4RN=~,dB~sEGo,H:T}rwpF3&`h9F.|/');
define('SECURE_AUTH_KEY',  '5$gx<V+EQulD43Eo/!/-#x+31`o?@P:;X^F|!CzOoUZ}UDXlUH1Vf2>YD$M)(0U0');
define('LOGGED_IN_KEY',    '!o<SEaY+AWAyEF&wa VvqXeo3>0I.eGR9HgZ?>aZi<hu[bX=vjjfmUwxe^.n,.)^');
define('NONCE_KEY',        'Q`%u86Hl?B@3t3!OL%{mHwu|Zvf2bXH%KO-h.Mzd|?1YQ78T)i<@AO>fQL}s4A,o');
define('AUTH_SALT',        'O^D>BoMC$|X!MVSU~lowoZ@ni;oe#fEO?`dpkakr}u Nz.CHlaf|I,7nr!l%0b.t');
define('SECURE_AUTH_SALT', 'f{v$n!k?-^.7_HsLN9pOiY*d#KnBy)`7`>ubCj4uH|&fEwYnB_ KM&2TGhBzK ^]');
define('LOGGED_IN_SALT',   '|U1esSo,BHI#o:#9#hZYA<,7Vnky$#EA@Y5w(GJ@tj&2}xr96wLQv:VAMMd<fGkI');
define('NONCE_SALT',       'CFOmyR}`5y_=U t?mSdq HsqfV<e[mSoZk#]c]MyR^W6rdy[2T_xPqzXhh!hFy]>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
