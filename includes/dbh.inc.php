<?php

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $dbHost = $cleardb_url["host"];
    $dbUser = $cleardb_url["user"];
    $dbPass = $cleardb_url["pass"];
    $dbName = "heroku_dc8dde0412eeba8";

    $active_group = 'default';
    $query_builder= TRUE;

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL ' . mysqli_connect_error();
        exit();
    }