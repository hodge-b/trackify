<?php

if(isset($_POST['submit'])){
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    // check for errors
    if(emptyLoginInput($email, $password)){
        header('location: ../login.php?error=emptyinput');
        exit();
    }

    loginUser($conn, $email, $password);
    
}else{
    header('location: ../login.php');
    exit();
}