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
define( 'DB_NAME', 'Ta_Thi_Ngoc_Anh' );

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
define( 'AUTH_KEY',         '$L>x;Z<:7[qL$GCuJ0$}fMYLBFCLqF1!}_`%Y +Jk3|N9u(Nm1`8h*{piDb.9jdu' );
define( 'SECURE_AUTH_KEY',  'LtF<0Ot5]kY<BM1,{R8W<!eXNd!-[/ey,rGyJ>RU6I94i`$:H$L{~F`Z:Jvui+x>' );
define( 'LOGGED_IN_KEY',    'h[K>>1^[>DlzP(>K p,+qPngyZv;s#/v 9CjNhk6v#w|& MX14oAn/?pt=!Vp7MZ' );
define( 'NONCE_KEY',        '`;Fdg,FRiQ_CuWrmt^+A8=YjZ43S<PJR=n~c6o-8f4Gr89e;8eP=dl~vHm[a@j^n' );
define( 'AUTH_SALT',        '*/V@c9y!hm.6i9{kOReg#uznm-or^}}A7k/IHBQ/1)gUS5U-5F7Nc.#V{I;sEG|7' );
define( 'SECURE_AUTH_SALT', 'b(YvubXWk=Z2 1#MXIhCNko<fnqoj)CV[#d&-T;NO~nEfJv8EbsC;]Is9&s(zG6 ' );
define( 'LOGGED_IN_SALT',   '~,mZO_<u63QV%JMJdTj jin#ZdQO_.Pa~y2Mu;zmy1.{c}5Zyc}a6@xCfn} TvH[' );
define( 'NONCE_SALT',       '*_sN<xtx-GKzev$BtLqt6y$E:5 4&sxT_zsFR/~}z5H^]<<VZG]!Eg*]cI4o5nDI' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'ttna';

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
