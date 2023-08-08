<?php
?>

<h1>Add to DB</h1>


<form action="" id="rdata_from">
    <div id="data-entries">
        <div class="data-entry">
            <label for="id">Map ID</label>
            <input type="text" name="id" class="scratch-data-id" id="map_id" />
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Insert your title" id="ikrTitle" />
            <label for="des">Description</label>

            <!-- <textarea name="des" id="ikrdes" placeholder="Insert your description" cols="10" rows="5"></textarea> -->
            <div id="editor-container" name="editor-container"></div>
            <!-- <input type="text" name="des" id="ikrdes" placeholder="Insert your description" /> -->

            <label for="hovecolor">Hover Color</label>
            <input type="color" id="typeHovcolor" value="#0000FF" />

            <input type="text" name="hovecolor" id="hovecolor" value="#0000FF" />

            <label for="fill_color">Fill Color</label>
            <input type="color" id="filltype" value="#0000FF" />

            <input type="text" name="fillcolor" id="fill_color" value="#0000FF" />

            <label for="clickColor"> click color</label>
            <input type="color" id="typeClickColor" value="#0000FF" />

            <input type="text" value="#0000FF" name="clickcolor" id="clickColor" />

            <!-- <input type="text" placeholder="https://google.com" name="ikr_link" id="ikr_link" /> -->




            <input type="text" id="image_url" name="image_url" readonly>
            <button class="button" id="upload_image_button">Select Image</button>
            
            <input type="checkbox" checked id="ikrCheckbox" name="ikrcheckbox">
            <button type="button" id="ikrActiveToggle">Inactive</button>


        </div>
    </div>

    <input type="submit" value="Submit" />
</form>

<form action="" id="rdata_edit_from">
    <div id="close_edit">
        <span>&#10005;</span>
    </div>
    <div id="data-entries">
        <div class="data-entry">
            <label for="id">Map ID</label>
            <input type="text" name="id" class="scratch-data-id" id="map_id_edit" readonly />
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Insert your title" id="ikrTitle_edit" />
            <label for="des">Description</label>
            <!-- <input type="text" name="des" id="ikrdes_edit" placeholder="Insert your description" /> -->
            <textarea  id="editor-container_edit" name="editor-container_edit"></textarea>
            <label for="hovecolor">Hover Color</label>
            <input type="color" id="typeHovcolor_edit" value="#0000FF" />

            <input type="text" name="hovecolor" id="hovecolor_edit" value="#0000FF" />

            <label for="fill_color">Fill Color</label>
            <input type="color" id="filltype_edit" value="#0000FF" />

            <input type="text" name="fillcolor" id="fill_color_edit" value="#0000FF" />

            <label for="clickColor"> click color</label>
            <input type="color" id="typeClickColor_edit" value="#0000FF" />

            <input type="text" value="#0000FF" name="clickcolor" id="clickcolor_edit" />

            <input type="text" id="image_url_edit" name="image_url_edit" readonly>
            <button class="button" type="button" id="upload_image_button_edit">Select Image</button>


            <input type="checkbox" checked id="ikrCheckbox_edit" name="ikrcheckboxedit">
            <button type="button" id="ikrActiveToggle_edit">Inactive</button>

        </div>
    </div>

    <input type="submit" value="edit" />
</form>







<?php




// function scratch_save_data_add()
//     {
//         global $wpdb;

//         // Retrieve the form data
//         $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
//         $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
//         $des = isset($_POST['des']) ? sanitize_text_field($_POST['des']) : '';
//         $hov_color = isset($_POST['hovecolor']) ? sanitize_text_field($_POST['hovecolor']) : '';

//         // Insert the data into the database
//         $table_name = $wpdb->prefix . 'data_table';
//         $wpdb->insert(
//             $table_name,
//             array(
//                 'id' => $id,
//                 // 'title' => $title,
//                 'des' => $des,
//                 'hov_color' => $hov_color
//             )
//         );

//         // Return the response
//         wp_send_json_success('Data saved successfully.');
//     }
//     add_action('wp_ajax_scratch_save_data_add', 'scratch_save_data_add');
//     add_action('wp_ajax_nopriv_scratch_save_data_add', 'scratch_save_data_add');



// Enqueue scripts





// Save data to the database

?>