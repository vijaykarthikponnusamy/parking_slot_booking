<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(!isset($_SESSION['ADMIN_ID']))
{
    header("Location: index.php");
}

//Get Data
$get_id = $_GET['id'];
$get_data = $conn->query("SELECT * FROM customer WHERE id='$get_id'");
$row = $get_data->fetch_assoc();


//Customer Update
if(isset($_POST['custregUpdate']))
{
        $Fname = $_POST['custregFName'];
        $Lname = $_POST['custregLName'];
        $Email = $_POST['custregEmail'];
        $Mno = $_POST['custregMNo'];
        $CarDet = $_POST['custregCarDet'];
        $LicDet = $_POST['custregLicDet'];

        if($_FILES["custregAttach"]["name"] != '')
        {
                //File upload
                $filename = $_FILES["custregAttach"]["name"];
                $tempname = $_FILES["custregAttach"]["tmp_name"];
                $folder = "uploads/".$filename;
                move_uploaded_file($tempname, $folder);
        }
        else
        {
                $filename = $_POST['custregOldAttach'];
        }

        $Uid = $_POST['custregid'];

        $sql = "UPDATE customer SET email='$Email',fname='$Fname',lname='$Lname',mno='$Mno',cardetail='$CarDet',licdetail='$LicDet',attach='$filename' WHERE id='$Uid'";
        $result = $conn->query($sql);
        if ($result) {
                $msg = "Record successfully updated.";
        }
        else
	{
                $msg = "Record not updated.";
        }

        header("Location: ViewCustomer.php");
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
		<div class="col-md-10">
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
                <h2>Customer Update</h2>
		 <form name="custregForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">First Name</label>
                      <input type="text" class="form-control" id="custregFName" name="custregFName" placeholder="Enter the first name..." required value="<?php echo $row['fname']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Last Name</label>
                      <input type="text" class="form-control" id="custregLName" name="custregLName" placeholder="Enter the last name..." required value="<?php echo $row['lname']; ?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Email</label>
                      <input type="email" class="form-control" id="custregEmail" name="custregEmail" placeholder="Enter the valid email id..." required value="<?php echo $row['email']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Mobile No.</label>
                      <input type="number" class="form-control" id="custregMNo" name="custregMNo" placeholder="Enter the valid mobile no..." required value="<?php echo $row['mno']; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Car Details (RC)</label>
                      <textarea class="form-control" id="custregCarDet" name="custregCarDet"><?php echo $row['cardetail']; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">License Details</label>
                      <textarea class="form-control" id="custregLicDet" name="custregLicDet"><?php echo $row['licdetail']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputAddress2">Attachment</label>
                        <input type="file" class="form-control" id="custregAttach" name="custregAttach" placeholder="Max file size 2mb...">
                    </div>
                    <div class="form-group col-md-4">
                        <?php
                                if($row['attach'] != '')
                                {
                                ?>
				 <input type="hidden" name="custregOldAttach" value="<?php echo $row['attach']; ?>">
                                <img src="../customer/uploads/<?php echo $row['attach']; ?>" width="120">
                                <?php
                                }
                        ?>
                    </div>
                  </div>
                  <input type="hidden" name="custregid" value="<?php echo $row['id']; ?>">
                  <button type="submit" class="btn btn-primary" name="custregUpdate">Update</button>
                </form>


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
