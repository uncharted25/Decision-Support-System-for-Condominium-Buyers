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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

define('WP_ALLOW_REPAIR', true);
/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n12fiCZ5k6KG1T51rdmVKmEdK7QnlDVKfU2MGSUOWridmYBJeEYMa4VQEHoUJ4Gvc9A/qqe03EAuUHN7b1VAwg==');
define('SECURE_AUTH_KEY',  'TjsRJotE6isHpUThidKoMyp07T507VGVLWZi65ykhEJwZB6+13eYlwU+VuUjmFbqW0PHx4LYBraZLkWipzyySQ==');
define('LOGGED_IN_KEY',    '5crMXyGuBNQk2mkxyNYChFYO3QHIAOy/Ms3ONHs/RN0HIQnEsxwyXtZmG1KwiRl8IEFmg3I2drQf7gY7lK4qTg==');
define('NONCE_KEY',        'E1ocH+y5IGUG1c5sXm/oZsTaFJP5GSlAbBQWcSLZZecuA4SryluGluTSmATExKjE6tJxsGF57salPSUiGF8NcA==');
define('AUTH_SALT',        'cLBlBFKEJ3ceFV3PYbfNLsouUPtj08Q9yuHWWLQ2a9i7xjdb3t3Bn48/zUqhQjO/GactzFShRsmO4yfoANvPGQ==');
define('SECURE_AUTH_SALT', 'R9tVLHjpQYxQzTlPMuub9sUepipHCWdReQ1GrNqWhJzuuJP/1HDnKqbB7gGYXp1zkn4V5m9Gwm7H7pBIoGLAzg==');
define('LOGGED_IN_SALT',   'tMEYd0OmCdnz5sg02co4tb+B/D9PXKOTwNqGv6MqhV6B2xO0Gmc0oDttpNTzd63bQuuZ17SK93+z/n4SsmQg+g==');
define('NONCE_SALT',       'fMThfaAcZWKeKcproCc28E09trsKeePctTYgMXPgOCQN7Z4mmoqhx9UJY39M1/63TBhubkM0PQm4NfMRVbLaXA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
