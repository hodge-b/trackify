<?php


if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $projectID = $_POST['projectID'];
    $userID = $_POST['add-member'];

    addMembersToProject($conn, $userID, $projectID);

}else{
    header('location: ../projects.php?projectID='.$projectID);
    exit();
}