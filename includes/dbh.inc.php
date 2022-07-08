<?php

    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = 'root';
    $dbName = 'trackify_bug-tracker';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL ' . mysqli_connect_error();
        exit();
    }