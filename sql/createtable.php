<?php
    if(get_option('toggle_sql')){
        $dbhost = get_option('sql_host');
        $dbuser = get_option('sql_user');
        $dbpass = get_option('sql_pass');
        $dbname = get_option('sql_db');
        
        $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

        if(mysqli_connect_errno()){
            die('Unable to connect to database ('.mysqli_connect_error().')');
        }

        $sql_create_table = "CREATE TABLE IF NOT EXISTS form_submissions(
        ID int NOT NULL AUTO_INCREMENT,
        Name varchar(255) DEFAULT NULL,
        Email varchar(255) DEFAULT NULL,
        Subject varchar(255) DEFAULT NULL,
        Message varchar(2000) DEFAULT NULL,
        SubmissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(ID)
        );";

        $result = mysqli_query($conn, $sql_create_table, MYSQLI_USE_RESULT);
        if(!$result){
            die('There was an error running the query: '.$conn->error);
        }

        mysqli_close($conn);
    }
?>