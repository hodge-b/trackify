<?php

$ticketID = $_POST['ticketID'];
$projectID= $_POST['projectID'];

if(isset($_POST['delete'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    deleteTicket($conn, $ticketID, $projectID);

}else{
    header('location: ../index.php');
    exit();
}