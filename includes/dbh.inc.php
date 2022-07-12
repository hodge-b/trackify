<?php

    $dbHost = 'bradleyhodge.ca';
    $dbUser = 'trackifyUser';
    $dbPass = 'pTrackify1111';
    $dbName = 'trackify_bugtracker';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL ' . mysqli_connect_error();
        exit();
    }