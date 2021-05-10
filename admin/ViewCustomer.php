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
    </div>

   <!--Body-->
   <div class="container-fluid">
        <div class="container">
                <div class="row">
                        <div class="col-md-12 mx-auto">
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

			 <h3>View Customer</h3>
			  <table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Cust. Name</th>
				      <th scope="col">Mob. Number</th>
				      <th scope="col">Email</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				   <?php
                                        $res_parking = $conn->query("SELECT * FROM customer");
                                        while($row = $res_parking->fetch_assoc()) {
                                        ?>
                                        <tr>
                                         <td><?php echo $row["id"]; ?></td>
                                         <td><?php echo $row["fname"].$row['lname']; ?></td>
                                         <td><?php echo $row["mno"]; ?></td>
                                         <td><?php echo $row["email"]; ?></td>
                                         <td><a class="btn btn-primary" href="Editcustomer.php?id=<?php echo $row['id']; ?>" role="button">Edit</a> &nbsp; <a class="btn btn-danger" href="Deletecustomer.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?');"  role="button">Delete</a></td>
                                        </tr>
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

