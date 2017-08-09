<?php

function displayTable(){
    global $wpdb;
    $dbName = $wpdb->prefix.'pcfcf';
    $sql = "SELECT * FROM $dbName";
    
    $result = $wpdb->get_results($sql);
    
    if(!$result){
        echo "SQL Query failed.";
    }
    
    echo '<style type="text/css">
        .form_submissions{border-collapse: collapse;}
        .form_submissions th{text-align: left;}
        .form_submissions,
        .form_submissions td,
        .form_submissions th{border: solid 1px #454545;}
        .form_submissions th,
        .form_submissions td{padding: 1%;}
        .form_submissions tr:nth-child(odd){background:#d9d9d9;}
    </style>';
    
    $checkDB = 'SELECT COUNT(*) FROM form_submissions';
    
    if($wpdb->num_rows == 0){
        echo "<p>There are no form submissions saved yet! Once there are, they will be displayed here in a table.</p>";
    }
    else{
        echo "<table class='form_submissions'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date & Time</th></tr>";

        foreach($result as $result){
            $id = $result->ID;
            $name = $result->Name;
            $email = $result->Email;
            $subject = $result->Subject;
            $message = $result->Message;
            $date = $result->SubmissionDate;

            echo '<tr><td style="width:50px;">'.$id.'</td><td style="width: 200px;">'.$name.'</td><td style="width:200px;">'.$email.'</td><td style="width:200px;">'.$subject.'</td><td style="width:350px;">'.$message.'</td><td style="width:100px;">'.$date.'</td></tr>';
        }
        echo "</table>";
    }
}
?>