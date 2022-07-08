<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $userID = $_POST['userID'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $auth = $_POST['auth'];

    editMember($conn, $userID, $firstName, $lastName, $email, $phone, $auth);

}else{
    header('location: ../administration.php');
    exit();
}