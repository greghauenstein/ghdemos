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
define('DB_NAME', 'heroku_806b0386df808a9');

/** MySQL database username */
define('DB_USER', 'b3dd173151be48');

/** MySQL database password */
define('DB_PASSWORD', '48def1cf');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-east-04.cleardb.com');

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
define('AUTH_KEY',         '|55-&B%nxG_lsS,/Zq.lk7(m/31XY1N]|+Xc)hEo%!+UCwH%uFdjHyBl0 Xl^wMD');
define('SECURE_AUTH_KEY',  '=Y2sG#E3eG|`9g?KQ2cxAhpn=|tih5tqR&;P.^~^-|oTD/prJiKN]c/Nwv7Pa?i=');
define('LOGGED_IN_KEY',    'tK3_a^c@-_QYD+^qfUD`=tZU#zO)[PlWkkI*m:4qiVo|@0XL]f3{f/@8Y0/3fN{6');
define('NONCE_KEY',        'NDVP ~WES|D@wp;t?Pvs_g@(TB<t(1bGw*&.)v/==}j[l=-progX|SRbYgZA2A>2');
define('AUTH_SALT',        'OVMK3sbAw^0-kvweGWllPpu7~[T/M_VL-@D>}S|vp^bd-OV=KRKs+NkF70 }ORw}');
define('SECURE_AUTH_SALT', '4^+DI6%:7ws1#STtizAEAcT+Yr1{8T(CMa1-g/[Hb$=lrWUyUa63`ekvTE6G}Kkl');
define('LOGGED_IN_SALT',   '#eu^O-V>jgJqc@e78Z)-4I-%_&,1JD&NdcH-Ja{~tyn=1l2w*s~_hg]R}5u@-1E ');
define('NONCE_SALT',       'Cvw<#XzYUOKQ8LId hn[2*,GQ *!sq/I-_ydt}apl>,%w+0>nHmR @90X/ EKkKO');

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
