<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $projectID = $_POST['projectID'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];
    
    // check for errors
    if(empty($comment)){
        header('location: ../projects.php?projectID='.$projectID);
        exit();
    }

    addComment($conn, $projectID, $author, $comment);

}else{
    header('location: ../index.php');
    exit();
}