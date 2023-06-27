<?php
if (!defined('ABSPATH')) {
    exit;
}
// Get admin index.php
file_exists($functions =  ASTROKIT_PLUGIN_DIR . '/admin/index.php') ? require_once $functions : false;
file_exists($htmlClass =  ASTROKIT_PLUGIN_DIR . '/includes/template.php') ? require_once $htmlClass : false;


function shuffle_json_data()
{
    $json_file_path =  ASTROKIT_PLUGIN_DIR . 'astrokit.json';

    // Read the JSON file
    $json_data = file_get_contents($json_file_path);

    // Decode the JSON data
    $data = json_decode($json_data, true);

    // Get a random index
    $randomIndex = array_rand($data);

    // Retrieve the random element using the random index
    $randomElement = $data[$randomIndex];

    // Encode the random element as JSON
    $response = json_encode($randomElement);

    //Return the JSON response
    $response;
    // Return the shuffled data
    // wp_send_json($response);

    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . 'astrokit_users';

    // Form values
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $astrology = json_decode($response)->id;
    if (empty($fullName)) {
        wp_send_json_error('Error : Field "<strong>Name</strong>" cannot be empty. Please enter a valid field name.');
        exit;
    }
    if (empty($email)) {
        wp_send_json_error('Error : Field "<strong>Email</strong>" cannot be empty. Please enter a valid field email.');
        exit;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Email is not valid
            wp_send_json_error('Error : Pelase enter a valid "<strong>Email</strong>" address.');
            exit;
        }
    }
    if (empty($birthdate)) {
        wp_send_json_error('Error : Pelase set your "<strong>Birthdate</strong>".');
        exit;
    }
    if (empty($city)) {
        wp_send_json_error('Error : Field "<strong>City</strong>" cannot be empty. Please enter a valid field city.');
        exit;
    }
    if (empty($country)) {
        wp_send_json_error('Error : Pelase select your "<strong>Country</strong>".');
        exit;
    }
    // Insert data into the table
    $data = array(
        'name' => $fullName,
        'email' => $email,
        'gender' => $gender,
        'birthdate' => $birthdate,
        'city' => $city,
        'country' => $country,
        'astrology' => $astrology
    );

    $wpdb->insert($table_name, $data);

    // Check if the data was successfully inserted
    if ($wpdb->insert_id) {
        // New row created successfully
        $insert = array(
            'success' => true,
            'message' => 'New row created successfully.'
        );
    } else {
        // Failed to create new row
        $insert = array(
            'success' => false,
            'message' => 'Failed to create new row.'
        );
    }
    wp_send_json_success($response);
}
add_action('wp_ajax_astrokit_shuffle', 'shuffle_json_data');
add_action('wp_ajax_nopriv_astrokit_shuffle', 'shuffle_json_data');
