<?php

add_action('admin_init', 'pcfcf_init_plugin_options');
add_action('admin_menu', 'pcfcf_custom_admin_menu');

function pcfcf_custom_admin_menu(){
    add_menu_page(
        'Contact Form Options', //Browser Page Title
        'Contact Form', //Menu Item Title
        'manage_options', //Capabilities
        'pcfcf-plugin', //Menu slug
        'new_pcfcf_options_page', //Callback
        'dashicons-email-alt', //icon
        25.542565423456
    );
    add_submenu_page(
        'pcfcf-plugin', //Parent menu
        'Form Submissions', //Browser Page Title
        'Form Submissions', //Menu Item Title
        'manage_options', //Capabilities
        'pcfcf-plugin-submissions', //Menu slug
        'pcfcf_form_submissions' //Callback
    );
}
/*----------------------*
* Menu Callbacks
*-----------------------*/
//Main Options
function new_pcfcf_options_page(){
    ?>
    <div class="wrap">
        <h2>PCF Contact Form Options</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields('general_options');
    
                do_settings_sections('pcfcf-plugin');
    
                submit_button();
            ?>
        </form>
    </div>
    <?php
}
//Form Submissions
function pcfcf_form_submissions(){
    $html = '<div class="wrap">';
    $html .= '<h2>Contact Form Submissions</h2>';
    $html .= '</div>';
    
    echo $html;
    
    displayTable();
}

/*----------------------*
* Custom Settings
*-----------------------*/
function pcfcf_init_plugin_options(){
    add_settings_section(
        'pcfcf_general', //ID
        'General Settings', //Title
        'pcfcf_gen_cb', //Callback
        'pcfcf-plugin' //Page
    );
    
    //General Settings
    add_settings_field(
        'trgt_email', //ID
        'Target Email', //Title
        'trgt_email_cb', //Callback
        'pcfcf-plugin', //Page (must equal section 'page')
        'pcfcf_general' //Section (must equal section 'ID')
    );
    register_setting('general_options','trgt_email');
    
    add_settings_field(
        'message_success',
        'Message Sent Success Message',
        'smsg_cb',
        'pcfcf-plugin',
        'pcfcf_general'
    );
    register_setting('general_options', 'message_success');
    
    add_settings_field(
        'message_fail',
        'Message Fail Message',
        'fmsg_cb',
        'pcfcf-plugin',
        'pcfcf_general'
    );
    register_setting('general_options', 'message_fail');
    
    add_settings_field(
        'message_empty',
        'Field Empty Message',
        'emsg_cb',
        'pcfcf-plugin',
        'pcfcf_general'
    );
    register_setting('general_options', 'message_empty');
    
}

/*----------------------*
* Callbacks
*-----------------------*/
//General Settings
function pcfcf_gen_cb(){
    $html = '<p>General Contact Form Settings</p>';
    echo $html;
}

//Target Email
function trgt_email_cb(){
    $html = '<input type="email" id="trgt_email" name="trgt_email" value="'.get_option('trgt_email').'">';
    $html .= '<label for="trgt_email">'.$args[0].'</label>';
    echo $html;
    settings_fields('general_options');
}
//Success Message
function smsg_cb(){
    $html = '<input type="text" id="message_success" name="message_success" value="'.get_option('message_success').'">';
    $html .= '<label for="message_success">'.$args[0].'</label>';
    echo $html;
    settings_fields('general_options');
}
//Fail Message
function fmsg_cb(){
    $html = '<input type="text" id="message_fail" name="message_fail" value="'.get_option('message_fail').'">';
    $html .= '<label for="message_fail">'.$args[0].'</label>';
    echo $html;
    settings_fields('general_options');
}
//Empty Message
function emsg_cb(){
    $html = '<input type="text" id="message_empty" name="message_empty" value="'.get_option('message_empty').'">';
    $html .= '<label for="message_empty">'.$args[0].'</label>';
    echo $html;
    settings_fields('general_options');
}

?>