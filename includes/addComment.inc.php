<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    
    $projectID = $_POST['projectID'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];
    $encodedProjectID = urlencode(base64_encode($projectID));
    
    // check for errors
    if(empty($comment)){
        header('location: ../projects.php?projectID='.$encodedProjectID);
        exit();
    }

    addComment($conn, $projectID, $author, $comment);

}else{
    header('location: ../index.php');
    exit();
}