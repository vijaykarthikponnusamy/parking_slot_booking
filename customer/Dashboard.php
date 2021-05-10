<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['CUST_ID']))
{
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
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
		 <li class="nav-item">
                     <a class="nav-link" href="Vehicleout.php">Vehicle Out</a>
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
                <div class="row">
			<div class="col-md-4">
	                        <div class="alert alert-primary text-center" role="alert">
	                          <p>No. of Booking</p>
	                          <h3><?php $Sid = $_SESSION['CUST_ID']; $res_booking = $conn->query("SELECT * FROM booking WHERE cid='$Sid'"); echo $res_booking->num_rows; ?></h3>
	                        </div>
			</div>
			<div class="col-md-4">
				<div class="alert alert-success text-center" role="alert">
				  <p>No. of Booking Canceled</p>
				 <h3><?php $Sid = $_SESSION['CUST_ID']; $res_cancel = $conn->query("SELECT * FROM booking WHERE cid='$Sid' AND status='2'"); echo $res_cancel->num_rows; ?></h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert alert-danger text-center" role="alert">
	                          <p>Balance Wallet Amount</p>
				  <h3><?php $Sid = $_SESSION['CUST_ID']; $res_wallet = $conn->query("SELECT * FROM customer WHERE id='$Sid'"); $row_wallet = $res_wallet->fetch_assoc(); echo $row_wallet['wallet']; ?></h3>
	                        </div>
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


