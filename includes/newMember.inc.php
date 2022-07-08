<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $authorization = $_POST['authorization'];
    $startDate = date('Y-m-d');

    // check for errors
    if(emptyAddMemberInput($firstName, $lastName, $email, $password, $phone, $authorization)){
        header('location: ../administration.php?error=emptyinputs');
        exit();
    }

    addMember($conn, $firstName, $lastName, $email, $password, $phone, $authorization, $startDate);

}else{
    header('location: ../administration.php');
    exit();
}