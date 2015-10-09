<?php

?>

<div id="jkl-page-ss-navigation">
    <h2 class="nav-tab-wrapper current">
        <a class="nav-tab nav-tab-active" href="javascript:;">Style Box (CSS)</a>
        <a class="nav-tab" href="javascript:;">Script Box (JS)</a>
    </h2>
    
    <?php
        // Include the views for rendering the tabbed content
        include_once( 'stylebox.php' );
        include_once( 'scriptbox.php' );
        
        // Add a nonce field for security
        wp_nonce_field( 'jkl_page_ss_save', 'jkl_page_ss_nonce' );
    ?>
    
</div>
