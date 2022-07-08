<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $name          = $_POST['name'];
    $description   = $_POST['description'];
    $contributorID = $_POST['userID'];
    $ticketsID     = 1;
    $commentsID    = 1;

    // check for errors
    if(emptyAddProjectInput($name, $description)){
        header('location: ../index.php?error=emptyinput');
        exit();
    }

    addProject($conn, $name, $description, $contributorID, $ticketsID, $commentsID);

}else{
    header('location: ../index.php?error=nosubmit');
    exit();
}