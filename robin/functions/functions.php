<?php
// add scripts on map plugin
function add_rdat_scripts() {
    // Get the page parameter from the URL
    $page_param = isset( $_GET['page'] ) ? $_GET['page'] : '';

    // Check if the current screen is your custom plugin's submenu page
    if ( 'submit-from-data' === $page_param ) {
        wp_enqueue_script('from_submit', plugin_dir_url(__FILE__) . '../js/your-custom.js', array(), true);
        wp_enqueue_script('edit_from_list', plugin_dir_url(__FILE__) . '../js/ikr-edit-functions.js', array(), true);
        wp_enqueue_script('ikr_admin__image_script', plugin_dir_url(__FILE__) . '../js/ikr-image-load.js', array('jquery'), '1.0.0', true);

    // Enqueue the media uploader script 
    if (is_admin()) {
        wp_enqueue_media();
    }
    wp_enqueue_editor();

        wp_localize_script(
            'from_submit',
            'your_ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'action' => 'rdata_save_data_add',
                'editaction' => 'rdata_edit_the_map_data'
            )
        );
    }
}

add_action('admin_enqueue_scripts', 'add_rdat_scripts');



// add style 
function add_world_map_enqueue_style()
{
    wp_enqueue_style('robingeo_enqueue_styel', plugin_dir_url(__FILE__) . '../style/wp-world-map-style.css', array(), '1.0.0');
}

add_action('admin_enqueue_scripts', 'add_world_map_enqueue_style');



 
function rdata_add_admin_menu_page()
{


    ?>
    <div class="robingeo-container">

        <div class="map_container">
            <div class="map-img">

                <?php
                include_once RBOIN_DIR_PATH . './views/world-map.php';
                // ?>
            </div>
            <div class="map-data-show">
                <?php
                include_once RBOIN_DIR_PATH . './views/show-map-data.php';
                ?>
            </div>
        </div>


        <div class="input-form">
            <?php

            include_once RBOIN_DIR_PATH . './views/from-data.php';
            ?>
        </div>
    </div>
    <?php












}


// add new data in data base 
function rdata_save_data_add()
{
    global $wpdb;



    
    error_log('Form data received: ' . print_r($_POST, true));
    // Retrieve the form data
    $id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
    $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
    $des = isset($_POST['editor-container']) ? wp_kses_post($_POST['editor-container']) : '';
    $hov_color = isset($_POST['hovecolor']) ? sanitize_text_field($_POST['hovecolor']) : '';
    $fill_colors = isset($_POST['fillcolor']) ? sanitize_text_field($_POST['fillcolor']) : '';
    $click_color = isset($_POST['clickcolor']) ? sanitize_text_field($_POST['clickcolor']) : '';
    $add_image = isset($_POST['image_url']) ? sanitize_text_field($_POST['image_url']) : '';
    $isChecked = $_POST['ikrcheckbox'] === 'on' ? 1 : 0;
    
    // Insert the data into the database
  // Replace with the actual value of map_id you want to check
    $table_name = $wpdb->prefix . 'interactive_geo_maps';
    
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE map_id = %d", $id);
    

    
  
    $wpdb->insert(
        $table_name,
        array(
            'map_id' => $id,
            'title' => $title,
            'map_des' => $des,
            'hov_color' => $hov_color,
            'fill_color' => $fill_colors,
            'click_color' => $click_color,
            'is_active' => $isChecked,
            'map_img'  => $add_image,
        )
    );

      // Query to check if data exists based on map_id
      $result = $wpdb->get_row($query);
    
      if ($result) {
          // Data with the given map_id exists, so the insertion was successful
          // You can perform any further actions here if needed
          
        wp_send_json_success('Data saved successfully.');
      } else {
          // Data with the given map_id does not exist, so the insertion failed
        
        wp_send_json_error('Failed to save form data.');

        }
    // // Return the response
    // if ($wpdb->insert_id) {
    //     wp_send_json_success('Data saved successfully.');
    // } else {
    //     $error_message = 'Failed to save form data. Error: ' . $wpdb->last_error;
    //     error_log($error_message); // Log the error for further investigation
    //     wp_send_json_error($error_message);
    //     // wp_send_json_error('Failed to save form data.');
    // }
}

add_action('wp_ajax_rdata_save_data_add', 'rdata_save_data_add');
add_action('wp_ajax_nopriv_rdata_save_data_add', 'rdata_save_data_add');


function rdata_edit_the_map_data()
{
    global $wpdb;

    // Retrieve the form data
    $id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

    $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
    $des = isset($_POST['editor-container_edit']) ? wp_kses_post($_POST['editor-container_edit']) : '';

    // $des = isset($_POST['editor-container']) ? wp_kses_post($_POST['editor-container']) : '';


    $hov_color = isset($_POST['hovecolor']) ? sanitize_text_field($_POST['hovecolor']) : '';
    $fill_colors = isset($_POST['fillcolor']) ? sanitize_text_field($_POST['fillcolor']) : '';
    $click_color = isset($_POST['clickcolor']) ? sanitize_text_field($_POST['clickcolor']) : '';
    $add_image = isset($_POST['image_url_edit'])? sanitize_text_field($_POST['image_url_edit'] ) :'';
    $isChecked = $_POST['ikrcheckboxedit'] === 'on' ? 1 : 0;
    // Insert the data into the database
    $table_name = $wpdb->prefix . 'interactive_geo_maps';
    //  add data from data base 

    $wpdb->update(
        $table_name,
        array(
            'title' => $title,
            'map_des' => $des,
            'hov_color' => $hov_color,
            'fill_color' => $fill_colors,
            'click_color' => $click_color,
            'is_active' => $isChecked,
            'map_img'  => $add_image,
        ),
        array('map_id' => $id) // Add this line to specify the row to update based on 'map_id'
    );
    

    // Return the response
    if ($wpdb->insert_id) {
        wp_send_json_success('Data saved successfully.');
    } else {
        wp_send_json_error('Failed to save form data. on edit');
    }


    // Check if the number of rows is less than 7
    // $num_rows = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    //  if ($num_rows < 9) {

    // } else {
    //     wp_send_json_error('All fields are full. Cannot add more data. To Add More data go to Prow');
    // }

    // Return the response
    //  wp_send_json_success('Data saved successfully.');
}
add_action('wp_ajax_rdata_edit_the_map_data', 'rdata_edit_the_map_data');
add_action('wp_ajax_nopriv_rdata_edit_the_map_data', 'rdata_edit_the_map_data');



//  get data from data base 
// AJAX callback to fetch data from the database
function rdata_fetch_data_from_database()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'interactive_geo_maps';

    // Retrieve data from the database
    $data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    // Return the response
    wp_send_json_success($data);
}
add_action('wp_ajax_rdata_fetch_data', 'rdata_fetch_data_from_database');
add_action('wp_ajax_nopriv_rdata_fetch_data', 'rdata_fetch_data_from_database');