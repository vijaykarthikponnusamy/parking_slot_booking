<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['CUST_ID']))
{
    header("Location: index.php");
}


//Payment
if(isset($_GET['wid']))
{
        $wid = $_GET['wid'];
        $amt = $_POST['cancelAmt'];
	$reason = $_POST['reason'];
	$parkCharge = $_POST['parkingcharge'];
	$res_parking = $conn->query("SELECT * FROM customer where id='$sid' ");
        $row12 = $res_parking->fetch_assoc(); 

        //$sel_cust = $conn->query("SELECT * FROM customer WHERE id='$sid'");
        //$row12 = $sel_cus->fetch_assoc();
        $w = $row12['wallet'];

        $balance = $w-+ ($parkCharge-$amt);

	//$sel_cust = $conn->query("SELECT * FROM customer WHERE id='$sid'");
        //$row_cust = $res_sel_cus->fetch_assoc();

        //$balance = $row_cust['wallet'] + ($parkCharge - $amt);

        $sql = "UPDATE booking SET status='Cancelled',canc_charge='$amt',canc_reason='$reason' WHERE id='$wid'";
        $result = $conn->query($sql);

	$wallet_update = "UPDATE customer SET wallet='$balance' WHERE id='$sid'";
        $conn->query($wallet_update);

        if ($result) {
                $msg = "Booking Cancelled successfully.";
        }
        else
        {
                $msg = "Booking not Cancel. Try Again Later.";
        }
        header("Location: ViewBooking.php?success=$msg");
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
			<div class="col-md-12">
				 <?php
                                        if(isset($_GET['success']))
                                        {
                                        ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                  <?php echo $_GET['success']; ?>
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                        <?php
                                        }
                                ?>


  			   	  <h3>View Booking</h3>
	                          <table class="table">
	                                <thead>
	                                    <tr>
	                                      <th scope="col">#</th>
					      <th scope="col">Date</th>
	                                      <th scope="col">Area</th>
	                                      <th scope="col">Vehicle Type</th>
	                                      <th scope="col">Slot Type</th>
					      <th scope="col">Status</th>
					      <th scope="col">Payment Status</th>
	                                      <th scope="col">Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
						$todayDate = date('Y-m-d');
	                                        $res_booking = $conn->query("SELECT * FROM booking Where date > $todayDate");
	                                        while($row = $res_booking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
						 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
						 <td><?php echo $row["status"]; ?></td>
						 <td><?php echo $row["amt_status"]; ?></td>
	                                         <td><?php if($row['status'] != "Cancelled"){ ?> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cancelBooking<?php echo $row['id']; ?>">Booking Cancel</button>  <?php } else { echo "<b class='text-danger'>Cancelled</b>"; } ?> </td>
	                                        </tr>

						<?php
							$pid = $row['pid'];
							$res_parking = $conn->query("SELECT * FROM parking_list Where id='$pid'");
		                                        $row_park = $res_parking->fetch_assoc();
						 ?>
						 <!-- Booking Cancel -->
                                                 <div class="modal fade" id="cancelBooking<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Booking Cancel</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                     <form action="ViewBooking.php?wid=<?php echo $row['id']; ?>" method="post" name="bookingCancelForm" enctype="multipart/form-data">
                                                      <div class="modal-body">
                                                          <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Cancel Amount (Rs.) :</label>
                                                            <input type="text" class="form-control" id="cancelAmt" name="cancelAmt" required value="<?php echo $row_park['cancel_charge'];  ?>" readonly>
                                                            <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
							    <input type="hidden" name="parkingcharge" value="<?php echo $row['amt']; ?>">
                                                          </div>
							  <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Reason :</label>
                                                            <input type="text" class="form-control" id="reason" name="reason">
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="bookingCancelConfirm">Confirm</button>
                                                      </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>

	                                        <?php
	                                        }
	                                        ?>
	                                </tbody>
	                          </table>

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


