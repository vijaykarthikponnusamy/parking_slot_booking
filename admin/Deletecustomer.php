<?php
session_start();

//Database Connection
include('../database.php');


if(isset($_GET['id']))
{
        $did = $_GET['id'];
        $res_del_parking = $conn->query("DELETE FROM customer WHERE id=$did");
        if($res_del_parking){ $success = "Record Successfully deleted."; } else { $success ="Record not deleted. Try again"; }
        header("Location: ViewCustomer.php?success=".$success);
}

?>

