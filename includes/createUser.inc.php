<?php

if(isset($_POST['submit'])){
    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    

}else{
    header('location: ../login.php');
    exit();
}