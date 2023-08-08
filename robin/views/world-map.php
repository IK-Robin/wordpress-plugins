
<?php




wp_enqueue_script( 'ikr_interactive', plugin_dir_url( __FILE__ ) . '../js/ikrgeo-interactivity.js', array(), '1.0.0', true );
wp_enqueue_script( 'ikr_edit_js', plugin_dir_url( __FILE__ ) . '../js/ikr-edit-functions.js', array(), '1.0.0', true );

?> 
    
<div class="rgeo_world_map_img">
<?php 
  include_once(__DIR__ . '/tooltip.php');
?>
<object class="svg_img_obj" data=" <?php echo plugins_url( "../assets/worldmap.svg", __FILE__ )?>" ></object>

</div>



<?php
?>


