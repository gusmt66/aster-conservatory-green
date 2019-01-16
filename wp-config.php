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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '');

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
define('AUTH_KEY',         'Si}jbk F<ZuXxM{)yAqx%NQ9RbgeysWBt3;h}3rHg0Gx$s2|WS5,(bSTcBO0=;79');
define('SECURE_AUTH_KEY',  'ldYcqhWQWtCkcn?uC1%=/<u|UY~z-Z %7-|cW [$UzX|_r|[PZqL0Q+~ rwQ=T!;');
define('LOGGED_IN_KEY',    'KlGa^pBWWdz|8[+&RNpby2U=q36EOcZ;BHu?8.F.:ps:cX/!z^8!J@0-r=aV=m0H');
define('NONCE_KEY',        '%=bbD82Vqc`s!47I3b:,m`!__$APQ]Mh=-RZcm]f3|$/qo>ng>arfC6~@ ?<Ux7:');
define('AUTH_SALT',        'zWoD60^Z<}11`Pyw23OX$MC2-m(5}BZu3Q6@Qk(HDHN4Z%M)Y*s=Ip4_Vrz(]-.z');
define('SECURE_AUTH_SALT', '~FJ@J7xuDX|}^Cju1/0|wx8uA;=znVc:[+D664T/O,;gCy<ioJ(85wTx7he$O5;b');
define('LOGGED_IN_SALT',   's e$9cWZHMmg:I`O~+.WF0S{zoG3[)#BC~T-G<{ IN39F=[4T*T`6!|!rt{5ou1f');
define('NONCE_SALT',       '8r*:?!c_3QeqJg7g:Ov4kZs._4j~%Um_J^QWjpuHMYO9vF{Wb$^aGkE9TJJdC( A');

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
