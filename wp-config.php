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
define('DB_NAME', 'dbs14814719');

/** Database username */
// define( 'DB_USER', 'dbu2542588' );
define('DB_USER', 'root');

/** Database password */
// define('DB_PASSWORD', 'C9XpABBbKMM4kRyERRZDlK1wwLIxrHem4nP');
define('DB_PASSWORD', '');

/** Database hostname */
// define('DB_HOST', 'database-5018723247.webspace-host.com');
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'rlGrrRQf5bJplRGduAqtYqQQPs9DEL5VHGIxHOPd3tkCiMOzTZU68i1d373tu8LB');
define('SECURE_AUTH_KEY',  'Ynz1sxufAy5bbXUINCKl14xtoja3uihk3bIwVp1w6T3h0ivCBiuyDM8l0W7rGFpG');
define('LOGGED_IN_KEY',    'EB8QUXJvl93qE1BDimFpMpMROjsdKrJbuXg4uBB9fCPTL2flHuGTvnu1kjF5fnTW');
define('NONCE_KEY',        '1wKAjZfGfVjyd0wvE7FQ010hoE37iIkXuvp5dtccnRRtC8I6qoUwiEh04HFv5aIK');
define('AUTH_SALT',        'qcqog7ZC7Fd2gMF0sWQOLNu2yE3VexprBlKjifiM5CSaDCDvetvyHMTfKVytyZMe');
define('SECURE_AUTH_SALT', 'q6H9vQ7rYUXlxrMqAJZnevcvSNyL3UfPlQ5T0h4hkAPwj8qhSMpTV28hrbWdO4em');
define('LOGGED_IN_SALT',   'mt8Z4qtMsYftv8OB5CzURWXa3BezQ8DdxsEfnYS4qtPzMbN2bdi3MSuGcglvx9wM');
define('NONCE_SALT',       'dW6C87ApypmA3oKuAdfIM42d1PpAw5HiugRRYQAQmEEGueQV5T7Uq55p0qnVlURq');

/**
 * Other customizations.
 */
define('WP_TEMP_DIR', dirname(__FILE__) . '/wp-content/uploads');


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
$table_prefix = 'blet_';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define("WP_AUTO_UPDATE_CORE", true);
