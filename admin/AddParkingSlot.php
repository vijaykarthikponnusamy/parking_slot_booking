<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['ADMIN_ID']))
{
    header("Location: index.php");
}

if(isset($_POST['addParking']))
{
	$Area = $_POST['addparkingArea'];
	$TypeOfVehicle = $_POST['addparkingVehicleType'];
	$NoOfParkingSlot = $_POST['addparkingNumOfPark'];
	$SlotType = $_POST['addparkingSlotType'];
	$SlotCharge = $_POST['addparkingCharge'];
	$CancelCharge = $_POST['addparkingCancelCharge'];
	$CutOffTime = $_POST['addparkingCutOffTime'];

	$sql = "INSERT INTO parking_list(area,vehicle_type,parking_slot,slot_type,charge,cancel_charge,cutoff_time) VALUES ('$Area','$TypeOfVehicle','$NoOfParkingSlot','$SlotType','$SlotCharge','$CancelCharge','$CutOffTime')";
	$res_insert = $conn->query($sql);
	if($res_insert){ $success = "Record Successfully inserted."; } else { $success ="Server Problem, Try Again Later"; }
	header("Location: AddParkingSlot.php?success=".$success);
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
              <h2 class="float-left">ADMIN</h2>
            </div>

            <!-- Menu -->
            <div class="col-6">
                <ul class="nav justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link active" href="Dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="AddParkingSlot.php">Add Parking Slot</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ViewParkingSlot.php">View Parking Slots</a>
                  </li>
		 <li class="nav-item">
                    <a class="nav-link" href="ViewCustomer.php">View Customer</a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" href="Wallet.php">Wallet</a>
                  </li>
                </ul>
            </div>

            <!-- MyAccount Menu -->
            <div class="col">
              <div class="dropdown float-right">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, <?php echo $_SESSION['ADMIN_NAME']; ?>.
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
              </div>
            </div>
        </div>
	<span class="border-bottom"></span>
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

				<h3>Add Parking Slot</h3>
				<form method="post" name="addParkingForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype='multipart/form-data'>
				  <div class="form-group row">
				    <label  class="col-sm-4 col-form-label">Area</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="addparkingArea" name="addparkingArea" placeholder="Enter the Area" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-4 col-form-label">Type of vehicle</label>
				    <div class="col-sm-8">
				      <select class="form-control" id="addparkingVehicleType" name="addparkingVehicleType" required>
						<option value="">Select type of vehicle</option>
						<option value="simple">Simple</option>
						<option value="heavy">Heavy</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No of parking slots</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="addparkingNumOfPark" name="addparkingNumOfPark" placeholder="Enter Number of parking slot" required>
                                    </div>
                                  </div>
				  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Slot Type</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="addparkingSlotType" name="addparkingSlotType" required>
                                                <option value="">Select Slot Type</option>
                                                <option value="free">Free</option>
                                                <option value="paid">Paid</option>
                                      </select>
                                    </div>
                                  </div>
				  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Slot Charge per hour</label>
                                    <div class="col-sm-8">
                                       <input type="number" class="form-control" id="addparkingCharge" name="addparkingCharge">
                                    </div>
                                  </div>
				  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Cancelation Charge</label>
                                    <div class="col-sm-8">
                                      <input type="number" class="form-control" id="addparkingCancelCharge" name="addparkingCancelCharge">
                                    </div>
                                  </div>
				  <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Cut off time</label>
                                    <div class="col-sm-8">
				      <select class="form-control" name="addparkingCutOffTime" id="addparkingCutOffTime" required>
					   <option value="">Select</option>
					   <option value="1">1 hrs</option>
					   <option value="2">2 hrs</option>
					   <option value="3">3 hrs</option>
					   <option value="4">4 hrs</option>
					   <option value="5">5 hrs</option>
					   <option value="6">6 hrs</option>
					   <option value="7">7 hrs</option>
					   <option value="8">8 hrs</option>
					   <option value="9">9 hrs</option>
					   <option value="10">10 hrs</option>
					   <option value="11">11 hrs</option>
					   <option value="12">12 hrs</option>
					   <option value="18">18 hrs</option>
					   <option value="24">24 hrs</option>
					   <option value="48">48 hrs</option>
				      </select>
                                    </div>
                                  </div>
				  <div class="form-group row">
				  <div class="col-sm-12">
				 	 <button type="submit" class="btn btn-primary col-md-12" id="addParking" name="addParking">Add</button>
				  </div>
				  </div>
				</form>
			</div>
		</div
	</div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
   <script src="../assets/js/bootstrap.bundle.min.js"></script>
   <script src="../assets/js/bootstrap.bundle.js"></script>
   <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>

