<?php
defined('ABSPATH') or die('No access.');

/*
Plugin Name: PCF Contact Form

Description: Creates an easy to use contact form that saves submissions to a database.
Version: 1.3
Author: PC Futures
Author URI: https://profiles.wordpress.org/pcfdev/
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages

PCF Contact Form is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

PCF Contact Form is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with PCF Contact Form. If not, see {plugin URI}.
*/

//Link all files to this main file
$dir = plugin_dir_path(__FILE__);

require_once($dir.'core/pcfcf-options.php'); //Creates options page
require_once($dir.'core/form.php'); //Creates contact form

//Creates database in MySQL
function pcfcf_table_init(){
    global $wpdb;
    
    $dbName = $wpdb->prefix.'pcfcf';
    $charset = $wpdb->get_charset_collate();
    
    if($wpdb->get_var("SHOW TABLES LIKE $dbName") != $dbName){
        $sql = "CREATE TABLE $dbName(
        ID integer NOT NULL AUTO_INCREMENT,
        Name varchar(255) DEFAULT NULL,
        Email varchar(255) DEFAULT NULL,
        Subject varchar(255) DEFAULT NULL,
        Message varchar(2000) DEFAULT NULL,
        SubmissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(ID)
        ) $charset;";
        
        require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
register_activation_hook(__FILE__, 'pcfcf_table_init');

require_once($dir.'sql/displaytable.php'); //Display database

//Link Custom CSS files
function pcfcf_styles(){
    wp_register_style('pcfcf-css', plugins_url('/css/pcfcf-style.css', __FILE__));
    
    wp_enqueue_style('pcfcf-css');
}
add_action('wp_enqueue_scripts', 'pcfcf_styles');

?>