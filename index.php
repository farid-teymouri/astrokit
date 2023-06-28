<?php

/**
 * Plugin Name: Astrokit
 * Plugin URI: https://asandev.com
 * Description: Astrokit plugin is the  mathematics of your life, derived from the calculations of your planetary positions to predict what the future holds for you.
 * Version: 1.0.1
 * Author: Farid Teymouri
 * Author URI: https://asandev.com
 * Text Domain: asandev
 * License: GPLv2
 * Released under the GNU General Public License (GPL)
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) {
    exit;
}
define('ASTROKIT_VERSION', '1.0.1');
const ASTROKIT = "astrokit";
// plugin_dir_path() returns the trailing slash!
define('ASTROKIT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ASTROKIT_PLUGIN_FILE', __FILE__);
define('ASTROKIT_PLUGIN_URI', plugin_dir_url(__FILE__));
// Get including functions.php
file_exists($functions =  ASTROKIT_PLUGIN_DIR . 'functions.php') ? require_once $functions : false;
/**
 * Creates a table in the MySQL database when the plugin is activated.
 * The table includes columns for id, name, email, gender, birthdate, city, country, and result_id.
 * @param string $astrokit_users The name of the table to create.
 */
register_activation_hook(__FILE__, 'myplugin_create_table');
function myplugin_create_table()
{
    global $wpdb;

    $astrokit_users = $wpdb->prefix . 'astrokit_users';

    $sql = "CREATE TABLE $astrokit_users (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        gender ENUM('Male', 'Female') NOT NULL,
        birthdate DATE NOT NULL,
        city VARCHAR(255) NOT NULL,
        country VARCHAR(255) NOT NULL,
        astrology INT(11) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
