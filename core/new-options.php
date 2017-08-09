<?php

add_action('admin_init', 'pcfcf_init_plugin_options');

function pcfcf_create_menu_page(){
    add_menu_page(
        'Contact Form Options', //Page Title
        'Contact Forms', //Menu text
        'manage_options', //permissions
        'pcf_cf', //unique ID (slug)
        'pcf_cf_options_display', //callback
        'dashicons-email-alt', //icon
        26 //position
    );
    add_submenu_page(
        'pcf_cf', //What menu to go under
        'Form Submissions', //Page Title
        'Form Submissions', //Menu text
        'manage_options', //permissions
        'pcf_cf_submissions', //unique ID (slug)
        'pcf_cf_submissions_display' //callback
    );
}
add_action('admin_menu', 'pcfcf_create_menu_page');

/*------------------------------*
* Menu Callbacks
*-------------------------------*/
//Sub Menu Page 1 (Main Options)
function pcf_cf_options_display(){
    $html = '<div class="wrap">';
    $html .= '<h2>Main Options</h2>';
    $html .= '</div>';
    
    echo $html;
}
//Sub Menu Page 2 (Form Submissions)
function pcf_cf_submissions_display(){
    $html = '<div class="wrap">';
    $html .= '<h2>Form Submissions</h2>';
    $html .= '</div>';

    echo $html;
    displayTable();
}


function pcfcf_init_plugin_options(){
    /*------------------------------*
    * Add Settings Section
    *-------------------------------*/
    add_settings_section(
        'general_settings_section',
        'Contact Form Options',
        'pcfcf_general_options_callback',
        'general'
    );
    
    /*------------------------------*
    * Add Settings
    *-------------------------------*/
    //Target Email
    add_settings_field(
        'trgt_email',
        'Target Email',
        'pcfcf_trgt_email_callback',
        'general',
        'general_settings_section',
        array('The email address to send form submissions to.')
    );
    //Success Message
    add_settings_field(
        'message_success',
        'Message Sent Success Message',
        'pcfcf_smsg_callback',
        'general',
        'general_settings_section',
        array('Message to output when a message is sent successfully.')
    );
    //Fail Message
    add_settings_field(
        'message_fail',
        'Message Failed Error Message',
        'pcfcf_fmsg_callback',
        'general',
        'general_settings_section',
        array('Message to output when a message fails to send.')
    );
    //Empty Message
    add_settings_field(
        'message_empty',
        'Empty Field Error Message',
        'pcfcf_emsg_callback',
        'general',
        'general_settings_section',
        array('Message to output when a field is left empty.')
    );
    
    //SQL Toggle
    add_settings_field(
        'toggle_sql',
        'Enable SQL',
        'pcfcf_toggle_sql_callback',
        'general',
        'general_settings_section',
        array('Check this if you want contact form submissions saved to a database.')
    );
    //SQL Host
    add_settings_field(
        'sql_host',
        'SQL Hostname',
        'pcfcf_sqlh_callback',
        'general',
        'general_settings_section',
        array('MySQL Hostname.')
    );
    //SQL User
    add_settings_field(
        'sql_user',
        'SQL Username',
        'pcfcf_sqlu_callback',
        'general',
        'general_settings_section',
        array('MySQL Username.')
    );
    //SQL Pass
    add_settings_field(
        'sql_pass',
        'SQL Password',
        'pcfcf_sqlp_callback',
        'general',
        'general_settings_section',
        array('MySQL Password.')
    );
    //SQL Database Name
    add_settings_field(
        'sql_db',
        'SQL Database',
        'pcfcf_sqldb_callback',
        'general',
        'general_settings_section',
        array('MySQL Database.')
    );
        
    
    /*------------------------------*
    * Register Settings
    *-------------------------------*/
    register_setting(
        'general',
        'trgt_email'
    );
    register_setting(
        'general',
        'message_success'
    );
    register_setting(
        'general',
        'message_fail'
    );
    register_setting(
        'general',
        'message_empty'
    );
    register_setting(
        'general',
        'toggle_sql'
    );
    register_setting(
        'general',
        'sql_host'
    );
    register_setting(
        'general',
        'sql_user'
    );
    register_setting(
        'general',
        'sql_pass'
    );
    register_setting(
        'general',
        'sql_db'
    );
}

/*------------------------------*
* Callbacks
*-------------------------------*/
//
function pcfcf_general_options_callback(){
    echo '<p>PCF Contact Form Options. Make sure to input a target email, and MySQL DB information if you enable MySQL.</p>';
}

//Target Email
function pcfcf_trgt_email_callback($args){
    $html = '<input type="email" id="trgt_email" name="trgt_email" value="'.get_option('trgt_email').'">';
    $html .= '<label for="trgt_email">'.$args[0].'</label>';
    echo $html;
}
//Success Message
function pcfcf_smsg_callback($args){
    $html = '<input type="text" id="message_success" name="message_success" value="'.get_option('message_success').'">';
    $html .= '<label for="message_success">'.$args[0].'</label>';
    echo $html;
}
//Fail Message
function pcfcf_fmsg_callback($args){
    $html = '<input type="text" id="message_fail" name="message_fail" value="'.get_option('message_fail').'">';
    $html .= '<label for="message_fail">'.$args[0].'</label>';
    echo $html;
}
//Empty Message
function pcfcf_emsg_callback($args){
    $html = '<input type="text" id="message_empty" name="message_empty" value="'.get_option('message_empty').'">';
    $html .= '<label for="message_empty">'.$args[0].'</label>';
    echo $html;
}

//Toggle MySQL
function pcfcf_toggle_sql_callback($args){
    $html = '<input type="checkbox" id="toggle_sql" name="toggle_sql" value="1" '.checked(1,get_option('toggle_sql'), false).'/>';
    $html .= '<label for="toggle_sql">'.$args[0].'</label>';
    echo $html;
}
//MySQL Hostname
function pcfcf_sqlh_callback($args){
    $html = '<input type="text" id="sql_host" name="sql_host" value="'.get_option('sql_host').'">';
    $html .= '<label for="sql_host">'.$args[0].'</label>';
    echo $html;
}
//MySQL Hostname
function pcfcf_sqlu_callback($args){
    $html = '<input type="text" id="sql_user" name="sql_user" value="'.get_option('sql_user').'">';
    $html .= '<label for="sql_user">'.$args[0].'</label>';
    echo $html;
}
//MySQL Password
function pcfcf_sqlp_callback($args){
    $html = '<input type="text" id="sql_pass" name="sql_pass" value="'.get_option('sql_pass').'">';
    $html .= '<label for="sql_pass">'.$args[0].'</label>';
    echo $html;
}
//MySQL Database
function pcfcf_sqldb_callback($args){
    $html = '<input type="text" id="sql_db" name="sql_db" value="'.get_option('sql_db').'">';
    $html .= '<label for="sql_db">'.$args[0].'</label>';
    echo $html;
}
?>