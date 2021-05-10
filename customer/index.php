<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(isset($_SESSION['CUST_ID']))
{
	header("Location: Dashboard.php");
}

//Login Check
if(isset($_POST['custloginSubmit']))
{
	$uname = $_POST['uname'];
	$upass = $_POST['upass'];
	$uCheck = $_POST['ucheck'];

	$res_chk_login = $conn->query("SELECT * FROM customer WHERE (email='$uname' OR mno='$uname') AND pass='$upass'");
	if ($res_chk_login->num_rows > 0) {
		$row = $res_chk_login->fetch_assoc();
		$_SESSION['CUST_ID'] = $row['id'];
		$_SESSION['CUST_NAME'] = $uname;
		header("Location: Dashboard.php");
		exit();
	}
	else
	{
		$error = "Wrong username or password. Try Again.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Custmer | Book Parking Slot</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center mx-auto p-5">
		<div class="col-md-6">
		<?php 
			if(isset($error))
			{
			?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <?php echo $error; ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php
			}
		?>
		<h2>Customer Login</h2>
            	<form method="post" name="custloginForm" id="custloginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		  <div class="form-group">
		    <label>Email / Mobile no</label>
		    <input type="text" class="form-control" placeholder="Enter Register Email/Mno" id="custloginUsername" name="uname" required>
		  </div>
		  <div class="form-group">
		    <label>Password</label>
		    <input type="password" class="form-control"  placeholder="Password" id="custloginPass" name="upass" required>
		  </div>
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="custloginCheck" name="ucheck" value="1">
		    <label class="form-check-label">Keep me</label>
		  </div>
		  <button type="submit" class="btn btn-primary" name="custloginSubmit" id="custloginSubmit">Login</button>
		</form>
		<hr>
		New Customer register <a href="Register.php">here</a>
		</div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>



