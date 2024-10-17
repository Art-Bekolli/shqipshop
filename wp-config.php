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
define( 'DB_NAME', 'jkqbwekjqwb' );

/** Database username */
define( 'DB_USER', 'qwebljkqw' );

/** Database password */
define( 'DB_PASSWORD', '6p1m3t1R%' );

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
define( 'AUTH_KEY',         'e:DVE?m]-xVea{WhxwP|IQ=Jm]_srW_B1x8`yRYZ*qEd?Ydv_=Ss4K]l-_Z=ywi*' );
define( 'SECURE_AUTH_KEY',  'xhgQh[p=JX<y&0>YMMyHp4AD$KH*vaES!xMy lix}XX^X2lUJ0M$,n.s,HRe<WJj' );
define( 'LOGGED_IN_KEY',    'Xg%*,Hx>D2ahTbk|}%YJN:.~LG>iCja2K+kN?Zi79-b?7GUhFH!&O9QkOi7Vz,NJ' );
define( 'NONCE_KEY',        's&xA/hDTm4/|~k)B$V{169c2<4hE<N!(k5wldeqrT@tZcUU.dO}V8YzZ&ArxCis%' );
define( 'AUTH_SALT',        '&^C:!oh_IJOWJ E3BNc/`0hbS8Mn-Xf3x93Wawe,`0SLJ8oPFkfa0?g7V@|gu0<>' );
define( 'SECURE_AUTH_SALT', 'eug=&Q6R:eCU=*S(ZpIFTzO~sfWYVw_y4ey33S4C<&llme00wIpcox9eWO{jd?@#' );
define( 'LOGGED_IN_SALT',   'q@@hW]4S|46557G85U4D c!junirN7}~rNeq%-LBa{qGi{d4/F@/j?)j++]`M4 g' );
define( 'NONCE_SALT',       '5WR7sx:6lIgT9I2zs1$9UC[oLMoTqWeI<{[S5[yzLP-7Q7d#9cTUn(rJ?=b*2WR}' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 *
 */
define( 'WP_MEMORY_LIMIT', '64M' );
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
