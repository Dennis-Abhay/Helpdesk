<?php 
@ob_start();
include('dbconfig.php');
$f3->clear("SESSION");
$f3->reroute("login.php");
?>