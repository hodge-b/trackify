<?php

if(isset($_POST['delete'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $projectID = $_POST['projectID'];
    deleteProject($conn, $projectID);

}else{
    header('location: ../index.php');
    exit();
}