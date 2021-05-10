<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['CUST_ID']))
{
    header("Location: index.php");
}


//Confirm Booking
if(isset($_POST['confirmBooking']))
{
	$CArea = $_POST['confirmArea'];
	$CTVehicle = $_POST['confirmTVehicle'];
	$CSType = $_POST['confirmSType'];
	$CDate = $_POST['confirmDate'];
	$CSTime = $_POST['confirmSTime'];
	$CCTime = $_POST['confirmCTime'];
	$CPid = $_POST['confirmPid'];
	$CPAmt = $_POST['confirmPAmt'];
	$CCAmt = $_POST['confirmCancAmt'];
	$CSlot = $_POST['bookingNoSlot'];
	$CRegDate = date('d-m-Y');
	$cid = $_SESSION['CUST_ID'];

	$sql = $conn->query("INSERT INTO booking (date,cid,status,area,vehicle_type,slot_type,st_time,cut_time,slot_no,amt,amt_status,pid,regdate) VALUES ('$CDate','$cid','Booked','$CArea','$CTVehicle','$CSType','$CSTime','$CCTime','$CSlot','$CPAmt','','$CPid','$CRegDate')");
        if($sql){ $success = "Slot Successfully booked."; } else { $success ="Server Problem, Try Again Later"; }
        header("Location: Wallet.php?success=".$success);

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
			<div class="col-md-6 mx-auto">
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

				<h3>Booking</h3>
                                <form method="post" name="bookingForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype='multipart/form-data'>
                                  <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Area</label>
                                    <div class="col-sm-8">
					<select class="form-control bookingArea" id="bookingArea" name="bookingArea" required>
                                                <option value="">Select Area</option>
						<?php
							$sql = $conn->query("SELECT DISTINCT area,id FROM parking_list");
							while($res = $sql->fetch_assoc())
							{
							?>
								<option data-id="<?php echo $res['id']; ?>" value="<?php echo $res['area']; ?>"><?php echo $res['area']; ?></option>
							<?php
							}
						?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Type of vehicle</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="bookingType" name="bookingType" required>
                                                <option value="">Select type of vehicle</option>
                                                <option value="simple">Simple</option>
                                                <option value="heavy">Heavy</option>
                                      </select>
                                    </div>
                                  </div>
				  <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                      <input type="date" class="form-control" id="bookingDate" name="bookingDate" required>
                                    </div>
                                  </div>
				  <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Start Time</label>
                                    <div class="col-sm-8">
                                       <input type="time" class="form-control" id="bookingStartTime" name="bookingStartTime" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Cut Off Time</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="bookingTime" name="bookingTime" required>
                                                <option value="">Select Cut Off Time</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                  <div class="col-sm-12">
					<input type="hidden" name="bookingParkId" id="bookingParkId">
                                         <button type="submit" class="btn btn-primary col-md-12" id="searchBooking" name="searchBooking">Search</button>
                                  </div>
                                  </div>
                                </form>

			</div>
                </div>

		<!-- Search Result -->
		<div class="row">
			<div class="col-md-12 text-center">
				<hr>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype='multipart/form-data' name="confirmBookingForm">
				<?php
					if(isset($_POST['searchBooking']))
					{
						$Area = $_POST['bookingArea'];
						$TypeVehicle = $_POST['bookingType'];
						$Date = $_POST['bookingDate'];
						$STime = $_POST['bookingStartTime'];
						$CTime = $_POST['bookingTime'];
						$Pid = $_POST['bookingParkId'];

						$parking_sql = $conn->query("SELECT * FROM parking_list WHERE id='$Pid'");
                                                $parking_res = $parking_sql->fetch_assoc();

						$slottype = $parking_res['slot_type'];
						$slotperamt = $parking_res['charge'];
						$slotcancamt = $parking_res['cancel_charge'];

						echo "<input type='hidden' name='confirmArea' value=".$_POST['bookingArea']."><input type='hidden' name='confirmTVehicle' value=".$_POST['bookingType']."><input type='hidden' name='confirmSType' value=".$slottype."><input type='hidden' name='confirmDate' value=".$_POST['bookingDate']."><input type='hidden' name='confirmSTime' value=".$_POST['bookingStartTime']."><input type='hidden' name='confirmCTime' value=".$_POST['bookingTime']."><input type='hidden' name='confirmPid' value=".$_POST['bookingParkId']."><input type='hidden' name='confirmPAmt' value=".$slotperamt."><input type='hidden' name='confirmCancAmt' value=".$slotcancamt.">";

						echo "<p>Area : ".$_POST['bookingArea']." | Type of Vehicle : ".$_POST['bookingType']." | Date : ".$_POST['bookingDate']." | Start Time : ".$_POST['bookingStartTime']." </p>";

						$pslot = $parking_res['parking_slot'];

						$time =  $STime + $CTime;

						for($i=1;$i<=$pslot;$i++)
						{
							$book_chk_sql = $conn->query("SELECT * FROM booking WHERE date='$Date' AND st_time BETWEEN '$STime' AND '$time' AND pid='$Pid' AND slot_no='$i' AND status='Booked'");
						?>
							<div class="alert alert-<?php if($book_chk_sql->num_rows > 0){ echo 'success'; } else { echo 'dark'; } ?> col-md-2 float-left ml-4" role="alert"><input type="radio" name="bookingNoSlot" value="<?php echo $i; ?>" <?php if($book_chk_sql->num_rows > 0){ echo "disabled"; } ?>> Slot <?php echo $i; ?></div>
						<?php
						}

						echo "<button type='submit' class='btn btn-primary' name='confirmBooking'>Book Now</button>";
					}
				 ?>
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

   <script>
	$('#bookingArea').change(function() {

	var bookingAreaId = $(this).find(':selected').attr('data-id');

	$.ajax({
	        type:"POST",
	        url : "ajaxCall.php",
	        data : "bookingAreaId="+bookingAreaId,
	        success : function(response) {
	            $("#bookingTime").html(response);
		    $("#bookingParkId").val(bookingAreaId);
	        }
	    });
	});


	$('#bookingType').change(function()
	{
		var Area = $("select#bookingArea").val();
		var Type = $("select#bookingType").val();

        $.ajax({
                type:"POST",
                url : "ajaxCall.php",
                data : "ChkData1="+Area+"&ChkData2="+Type,
                success : function(response) {
			if(response == '') {
			alert('Parking Slot not available this area and vehicle type. Choose different.'); }
                }
            });
        });

   </script>

</body>

</html>


