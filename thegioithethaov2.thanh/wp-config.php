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
define('DB_NAME', 'thethaov2');

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
define('AUTH_KEY',         'UXPQaWqpk#S?|?,^)fmXPST2&8US]Io76mGapPq:SQTh&bV|<3bTo)g~N2%UE3]2');
define('SECURE_AUTH_KEY',  'CHw)=U5Q&uo^(XnACTAX.fip5FswFWB^Ic@M~yZvef*uZsfgG^)E[pheN?J* hf<');
define('LOGGED_IN_KEY',    'mM@t^uQ*m1em-]i8h;6Z/~V4,q;#Sq<zDyZFhH{^,U&g^Xz|-oUTUG@*iZ!3`Fo(');
define('NONCE_KEY',        '$ulr2oqmKxupM)-LL($GqJZ`u=wO#fZDrLB{k-6xv=m|stk5i}Ws)`E#y&{=/3%c');
define('AUTH_SALT',        '.n?O[viY<u-%@+b)$j Q6t`7p0$ZuuKw.<@BdfT1`dYKNKC7zQ2e}/T/XWl.: yB');
define('SECURE_AUTH_SALT', 'WMl]D}^<EwM_0NK6b#53J) mn;eKUA]Ovfi =CL%($Qg^[KaQn^Fek7@zOo0eS+b');
define('LOGGED_IN_SALT',   '?@9YmFv~!1p*>2xM+Fr/}m Walyq8|K#qiig-H(1.+]5:g%4*C(&ZV>3RSy</ZWm');
define('NONCE_SALT',       'N$c7rN_smtGq-~SH4(M.#5yvC;pb_-cz$Y{j#a j!,RGDr%j]0r4/E+ii%${2wxV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mrk_';

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
