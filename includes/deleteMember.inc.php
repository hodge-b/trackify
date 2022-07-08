<?php

$projectID = $_POST['projectID'];

if(isset($_POST['delete'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $projectID = $_POST['projectID'];
    $userID = $_POST['userID'];

    deleteMemberFromProject($conn, $userID, $projectID);
    
}else{
    header('location: ../projects.php?projectID='.$projectID);
    exit();
}