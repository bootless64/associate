<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'parsanick' );

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
define( 'AUTH_KEY',         '&iH3,EhN%+RX8==+3CN0eD+2L&aNUp@%XTc!ECaU_icOMZMLoQk~D82}:rFv<| ~' );
define( 'SECURE_AUTH_KEY',  'sz&{c^{&g^R}!dh%?Z~u2~PQaC{xX>;s@`4XcEV`3)?|OJ-s!0v5~;B_hzy(qsx2' );
define( 'LOGGED_IN_KEY',    'o>F{r,z$j8vIdZm<H%7-Dvt?GR@b*3M<>Kk_v[.x|,K)>7q(1P[um=`q<j3[;qcS' );
define( 'NONCE_KEY',        '_Gd(rua.60jtMM]%TkQOx[OPp13SM0;o}~iuZBD0_).(`Ex=qY;kqgcx_c&fqJ>L' );
define( 'AUTH_SALT',        '_ <F&ZcNEv,s,{BCna=BAleMlM.=L<-X<$Bc6TVPTDl;!zR~p,IS 4L=DKjpB:f9' );
define( 'SECURE_AUTH_SALT', 'Vjzk-Tif5>Od`ttJI,rZ,/a/1~+dg<~YU<F+B0vzY;(dlvKcqFd1tZiq*4|O{tr8' );
define( 'LOGGED_IN_SALT',   'uR/ lXEzpD,emmvn(rJi{lvhT}e7wX0msN_<,Ox#Fym7cuC&|sFDBw6*cB87JH_E' );
define( 'NONCE_SALT',       '5GNS>SVy}eo:M,|%h=W,5D=Jmd;MWI-2`wO-9[.,xs*g{Km/h+,{8vGTt=J$|!?U' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cmp_eng_parsa';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
