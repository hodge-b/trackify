<?php

$ticketID= $_POST['ticketID'];
$projectID= $_POST['projectID'];

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    $title = $_POST['title'];
    $description = $_POST['description'];
    $assign = $_POST['assign'];
    $estimate = $_POST['estimate'];
    $type = $_POST['type'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    editTicket($conn, $ticketID, $projectID, $title, $description, $assign, $estimate, $type, $priority, $status);

}else{
    header('location: ../ticketInfo.php?ticketID='.$ticketID);
    exit();
}