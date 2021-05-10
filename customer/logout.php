<?php
session_start();
unset($_SESSION["CUST_ID"]);
unset($_SESSION["CUST_NAME"]);
header("Location:index.php");
?>
