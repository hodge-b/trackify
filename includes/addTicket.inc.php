<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $projectID    = $_POST['projectID'];
    $authorID     = $_POST['authorID'];
    $title        = $_POST['title'];
    $description  = $_POST['description'];
    $assignDevsID = $_POST['assign'];
    $estimate     = $_POST['estimate'];
    $type         = $_POST['type'];
    $priority     = $_POST['priority'];
    $status       = $_POST['status'];
    $encodedProjectID = urlencode(base64_encode($projectID));

    // check for errors
    if(emptyAddTicketInput($title, $description, $estimate)){
        header('location: ../projects.php?projectID='.$encodedProjectID.'&error=emptyinput');
        exit();
    }

    addTicket($conn, $projectID, $authorID, $title, $description, $assignDevsID, $estimate, $type, $priority, $status);
    
}else{
    header('location: ../index.php');
    exit();
}