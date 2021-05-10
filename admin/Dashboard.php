
<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['ADMIN_ID']))
{
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
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


    <!-- Body -->
    <div class="container">
        <div class="row justify-content-md-center mx-auto p-5">
		<div class="col-md-4 text-center">
			<div class="alert alert-primary" role="alert">
			  No. of Parking Slot <br> <span style="font-size:1.5em";><?php $res_park = $conn->query("SELECT * FROM parking_list"); echo $res_park->num_rows; ?></span>
			</div>
   	        </div>
		<div class="col-md-4 text-center">
			<div class="alert alert-success" role="alert">
                          No. of Customer <br> <span style="font-size:1.5em";><?php $res_cust = $conn->query("SELECT * FROM customer"); echo $res_cust->num_rows; ?></span>
                        </div>
		</div>
		<div class="col-md-4">
			<div class="alert alert-danger text-center" role="alert">
                          No. of Booking <br> <span style="font-size:1.5em";><?php $res_book = $conn->query("SELECT * FROM booking"); echo $res_book->num_rows; ?></span>
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


