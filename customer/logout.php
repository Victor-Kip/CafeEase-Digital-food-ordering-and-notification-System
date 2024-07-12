<?php 
include('../Config/constant.php');
//destroy the system
session_destroy();
//redirect to login page
header('location:login_customer.php');

?>