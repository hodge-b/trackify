<?php


if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $projectID = $_POST['projectID'];
    $userID = $_POST['add-member'];

    addMembersToProject($conn, $userID, $projectID);

}else{
    $encodedProjectID = urlencode(base64_encode($projectID));

    header('location: ../projects.php?projectID='.encodedProjectID);
    exit();
}