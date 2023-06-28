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
define('ASTROKIT', "astrokit");
// plugin_dir_path() returns the trailing slash!
define('ASTROKIT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ASTROKIT_PLUGIN_FILE', __FILE__);
define('ASTROKIT_PLUGIN_URI', plugin_dir_url(__FILE__));
// Bail early if attempting to run on non-supported php versions.
if (version_compare(PHP_VERSION, '5.6', '<')) {
    function astrokit_incompatible_admin_notice()
    {
        echo '<div class="error"><p>' . __('Astrokit requires PHP 5.6 (or higher) to function properly. Please upgrade PHP. The Plugin has been auto-deactivated.', ASTROKIT) . '</p></div>';
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    }
    function astrokit_deactivate_self()
    {
        deactivate_plugins(plugin_basename(ASTROKIT_PLUGIN_FILE));
    }
    add_action('admin_notices', 'astrokit_incompatible_admin_notice');
    add_action('admin_init', 'astrokit_deactivate_self');
    return;
}
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
