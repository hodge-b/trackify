<?php

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $dbHost = $cleardb_url['host'];
    $dbUser = $cleardb_url['user'];
    $dbPass = $cleardb_url['pass'];
    $dbName = $cleardb_url['path'];

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL ' . mysqli_connect_error();
        exit();
    }