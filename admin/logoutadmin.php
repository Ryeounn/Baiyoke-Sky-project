<?php
session_start();
require_once '../dbconnect.php';
require_once '../Classes.php';
if(isset($_SESSION['useradmin']) && ($_SESSION['useradmin'])){
    unset($_SESSION['useradmin']);
    header('location:../src/account.php');
}
