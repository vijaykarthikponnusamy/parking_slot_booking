<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['ADMIN_ID']))
{
    header("Location: index.php");
}

//Update Wallet
if(isset($_GET['wid']))
{
	$wid = $_GET['wid'];
	$amt = $_POST['walletAmt'];

	$sql = "UPDATE customer SET wallet='$amt' WHERE id='$wid'";
        $result = $conn->query($sql);
        if ($result) {
                $msg = "Amount added successfully.";
        }
        else
        {
                $msg = "Amount not added. Try Again Later.";
        }
	header("Location: Wallet.php?success=$msg");
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

			 <h3>Customer Wallet Status</h3>
			  <table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Cust. Name</th>
				      <th scope="col">Mob. Number</th>
				      <th scope="col">Email</th>
				      <th scope="col">Balance</th>
				      <th scope="col">Wallet</th>
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
					 <td><?php echo $row["wallet"]; ?></td>
                                         <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Add Money</button></td>
                                        </tr>


					 <!-- Add Money to Customer Wallet -->
					 <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Add Money to Customer Wallet</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					     <form action="Wallet.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
					      <div class="modal-body">
					          <div class="form-group">
					            <label for="recipient-name" class="col-form-label">Enter the amount(Rs.) :</label>
					            <input type="text" class="form-control" id="walletAmt" name="walletAmt" required>
						    <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
					          </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary" name="addMoneyToWallet">Add</button>
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

