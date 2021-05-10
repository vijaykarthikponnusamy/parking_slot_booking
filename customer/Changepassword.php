<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['CUST_ID']))
{
    header("Location: index.php");
}


if(isset($_POST['custPassUpdate']))
{
	$newPass = $_POST['custNewPass'];
	$conPass = $_POST['custConPass'];

	if($newPass == $conPass)
	{
		$sid = $_SESSION['CUST_ID'];
		$sql = "UPDATE customer SET pass='$conPass' WHERE id='$sid'";
		$result = $conn->query($sql);
		if ($result) {
	               $msg = "Password updated successfully.";
	        }
	        else
	        {
	                $msg = "Password not updated, try again later.";
	        }

	}
	else
	{
	  	$msg = "Confirm Password Mismatch, Reenter Correct New Password.";
	}

}
?>

<!DOCTYPE html>
<html lang="en">
    <title>Admin | Book Parking Slot</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
</head>

<body>

   <!-- Header Start -->
    <div class="container-fluid border-bottom mb-3">
        <div class="row justify-content-md-center p-3">
            <!-- Logo -->
            <div class="col">
              <h2 class="float-left">CUSTOMER</h2>
            </div>

            <!-- Menu -->
            <div class="col-6">
                <ul class="nav justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link active" href="Dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Booking.php">Book Parking Slot</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ViewBooking.php">Booking Cancel</a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" href="Wallet.php">Payment</a>
                  </li>
                </ul>
            </div>

	    <!-- MyAccount Menu -->
            <div class="col">
              <div class="dropdown float-right">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, <?php echo $_SESSION['CUST_NAME']; ?>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Myaccount.php">My Account</a>
		    <a class="dropdown-item" href="Changepassword.php">Change Password</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
                </div>
            </div>
        </div>
    </div>


   <!--Body-->
   <div class="container-fluid">
        <div class="container">
                <div class="row justify-content-md-center mx-auto p-5">
			<div class="col-md-6 ">
			 <?php
	                        if(isset($msg))
	                        {
	                        ?>
	                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
	                                  <?php echo $msg; ?>
	                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                    <span aria-hidden="true">&times;</span>
	                                  </button>
	                                </div>
	                        <?php
	                        }
	                ?>
	                <h2>Change Password</h2>
	                <form method="post" name="custChanPassForm" id="custChanPassForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	                  <div class="form-group">
	                    <label>New Password</label>
	                    <input type="password" class="form-control" placeholder="Enter New Password" id="custNewPass" name="custNewPass" required max-length="8">
	                  </div>
	                  <div class="form-group">
	                    <label>Confirm Password</label>
	                    <input type="password" class="form-control"  placeholder="Enter Confirm Password" id="custConPass" name="custConPass" required max-length="8">
	                  </div>
	                  <button type="submit" class="btn btn-primary" name="custPassUpdate" id="custPassUpdate">Update</button>
		         </form>
			</div>
                </div>
        </div>
   </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
   <script src="../assets/js/bootstrap.bundle.min.js"></script>
   <script src="../assets/js/bootstrap.bundle.js"></script>
   <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>

