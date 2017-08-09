<?php

    $smsg_def = 'Message sent! Thanks for contacting us!';
    $fmsg_def = 'An error occurred, try again later.';
    $empty_def = 'You missed a field!';

    function html_form_code(){
        echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post" class="pcfcf">';
        echo '<p class="required">Your Name</p>';
        echo '<p><input type="text" name="cf-name" pattern="[a-zA-Z ]+" title="Only characters \'A-Z\' and \'a-z\' allowed" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40"  class="pcfcf-input" />';
        echo '</p><p class="required">Your Email</p>';
        echo '<p><input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" class="pcfcf-input" />';
        echo '</p><p class="required">Subject</p>';
        echo '<p><input type="text" name="cf-subject" pattern="[^\x22\x27]+" title="No quote marks allowed (double or single)." value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40"  class="pcfcf-input" />';
        echo '</p><p class="required">Your Message</p>';
        echo '<p><textarea rows="10" cols="35" name="cf-message" class="pcfcf-ta" >' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea></p>';
        echo '<p><input type="submit" name="cf-submitted" value="Send"  class="pcfcf-input"/></p>';
        echo '</form>';
    }
    
    function send_mail(){
        global $wpdb;
        $wpdb->show_errors();
        if(isset($_POST['cf-submitted'])){
            $name = sanitize_text_field($_POST['cf-name']);
            $email = $_POST['cf-email'];
            $user_subject = sanitize_text_field($_POST['cf-subject']);
            $user_message = esc_textarea($_POST['cf-message']);
            
            if(empty($name) || empty($email) || empty($user_subject) || empty($user_message)){
                $error = get_option('message_empty');
                echo "<p class='error'>$error</p>";
            }else{   
                $to = get_option('trgt_email');

                $blogname = get_bloginfo('name');
                
                $blogname = html_entity_decode($blogname, ENT_QUOTES);

                $subject = "Contact Form Message via $blogname";

                $message = "From: $name ($email)"."\r\n"."Subject: $user_subject"."\r\n"."Message: $user_message";

                $send = wp_mail($to, $subject, $message);

                if($send){
                    
                    $success = get_option('message_success');
                    echo "<p class='success'>$success</p>";
                    
                    $data = array(
                        'Name' => $name,
                        'Email' => $email,
                        'Subject' => $user_subject,
                        'Message' => $user_message
                    );
                    
                    if($wpdb->insert($wpdb->prefix.'pcfcf', $data)){
                        echo "Message saved to database successfully.";
                    }else{
                        echo "Message failed to save to database.";
                        $wpdb->print_error();
                    }
                }else{
                    $error = get_option('message_fail');
                    echo "<p class='error'>$error</div>";
                }
            }
        }
    }
    
    function pcfcf_shortcode(){
        ob_start();
        send_mail();
        html_form_code();
        
        return ob_get_clean();
    }

    add_shortcode('pcf_contact_form', 'pcfcf_shortcode');

?>