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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'Z6<`m@-MgdcqLHR>0f}TRt=B~ZG9UF6HG9)`Uv{`6_!cE!Q,|xGya)G=SjM!~:&!' );
define( 'SECURE_AUTH_KEY',   'M1BmN6JTQZZ~29|m{D=T{#lYDn.~(Ds[~o Fa[jTkYu(Q2!G)_hUAbA:6_a^jC4S' );
define( 'LOGGED_IN_KEY',     '4U/P`U[r!~&;[OZPn=J37^9T8-,F|l;nlOU|_0sDT6^pxv5fL<U 8[@]/-7</mQQ' );
define( 'NONCE_KEY',         '?WzmR0/U~2C*JQq$k4S`Wpu6?t&gE`@<j6Z&nC<@%3Lu7B.IArD]I2Qc FREw>My' );
define( 'AUTH_SALT',         ')q|.[Jt=3@up2gIpv#<TaofM!!9$$cm>Y^&[qM/G.X9do.[Ed2tN/N^Qi)6OEo&s' );
define( 'SECURE_AUTH_SALT',  'k_y;9gXes!ou]-G8ekWlhHsZSGr(aA:fm3_kHA7{f~84:Ed8SDtR/]Hg2Um>vo^m' );
define( 'LOGGED_IN_SALT',    'F60u.ax&I`gWV<6%9prsgcHq<ba@;u-?=od$PFyw?Sa|JY}6fZ{3ZoqOm3HUUq},' );
define( 'NONCE_SALT',        'qQvWB^ekd.y$-S-sM/y${Jh%|%1BM;`9n`:X[)j}_+8O5Kvxyf0tTLOqx&/><8<&' );
define( 'WP_CACHE_KEY_SALT', 'V4E&aF;pqntu!Vfi%2Tt:N<Q8]b,Sap,vu09ac5;o.nwm6:(m+/`6evh/.cpYl_E' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
