<?php
    //Database credentials
    $db_server = "localhost";
    $db_username = "avenrate_fuelin_db";
    $db_password = "S9m*Zt7#KcYH4";
    $db_name = "avenrate_fuelin_db";
    
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    
    //error variable
    $view_error = "";

    //message variable
    $view_message = "";

    // Check connection
    if($conn == false){
        $view_error = "Database Error! Please try again!!!!";
        //echo $view_error;
    }
?>