 <?php
//Database Connection
include('../database.php');

//Customer Register
if(isset($_POST['custregSubmit']))
{
	$Fname = $_POST['custregFName'];
	$Lname = $_POST['custregLName'];
	$Email = $_POST['custregEmail'];
	$Mno = $_POST['custregMNo'];
	$Pass = $_POST['custregPass'];
	$CarDet = $_POST['custregCarDet'];
	$LicDet = $_POST['custregLicDet'];

	//File upload
	$filename = $_FILES["custregAttach"]["name"];
   	$tempname = $_FILES["custregAttach"]["tmp_name"];
        $folder = "uploads/".$filename;
	move_uploaded_file($tempname, $folder);

	$sql = "INSERT INTO customer(email,pass,fname,lname,mno,cardetail,licdetail,attach) VALUES('$Email','$Pass','$Fname','$Lname','$Mno','$CarDet','$LicDet','$filename')";
	$result = $conn->query($sql);
	if ($result) {
		$msg = "Record inserted successfully. You can login now.";
	}
	else
	{
		$msg = "Record insert unsuccessfully. Try Again Later.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer | Book Parking Slot</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
</head>

<body>
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
		<h2>Register</h2>
		<form name="custregForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="inputEmail4">First Name</label>
		      <input type="text" class="form-control" id="custregFName" name="custregFName" placeholder="Enter the first name..." required>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="inputPassword4">Last Name</label>
		      <input type="text" class="form-control" id="custregLName" name="custregLName" placeholder="Enter the last name..." required>
		    </div>
		  </div>
		  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Email</label>
                      <input type="email" class="form-control" id="custregEmail" name="custregEmail" placeholder="Enter the valid email id..." required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Mobile No.</label>
                      <input type="number" class="form-control" id="custregMNo" name="custregMNo" placeholder="Enter the valid mobile no..." required>
                    </div>
                  </div>
		  <div class="form-group">
		    <label for="inputAddress">Password</label>
		    <input type="password" class="form-control" id="custregPass" name="custregPass" placeholder="Min 8 Charaters..." required minlength="8" maxlenth="12">
		  </div>
		  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Car Details (RC)</label>
		      <textarea class="form-control" id="custregCarDet" name="custregCarDet"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">License Details</label>
                      <textarea class="form-control" id="custregLicDet" name="custregLicDet"></textarea>
                    </div>
                  </div>
		  <div class="form-group">
		    <label for="inputAddress2">Attachment</label>
		    <input type="file" class="form-control" id="custregAttach" name="custregAttach" placeholder="Max file size 2mb...">
		  </div>

		  <button type="submit" class="btn btn-primary" name="custregSubmit">Register</button>
		</form>
		<hr>
		Already User, Please Login <a href="index.php">here</a>
		</div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>



