<?php

wp_enqueue_script( 'ikr_tooltip_js', plugin_dir_url( __FILE__ ) . '../js/tooltpi-change-value.js ', array(), '1.0.0', true );

?>


<div class="tooltip" id="tooltip"> </div>
  <div class="detail" id="detail">
    <div id="close">
      <span>&#10005;</span>
    </div>
    <button type="button" id="isEditBtn"> edit data</button>

   <div id="detail_img">
      <img  src="" alt="" id="map_img">
   </div>
   <div class="map_details">
    <p id="plotId"> id</p>
    <h2 id="detail_name">The RV map 1 </h2>
    <p id="detail_des">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ratione recusandae doloribus quaerat, iste quia ipsa non nostrum magnam mollitia?</p>
   </div>
  </div>