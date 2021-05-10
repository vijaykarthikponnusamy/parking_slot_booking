<?php
session_start();

//Database Connection
include('../database.php');

//Session Check
if(isset($_SESSION['ADMIN_ID']))
{
        header("Location: Dashboard.php");
}

//Login Check
if(isset($_POST['adminloginSubmit']))
{
        $uname = $_POST['uname'];
        $upass = $_POST['upass'];
        $uCheck = $_POST['ucheck'];

        $res_chk_login = $conn->query("SELECT * FROM admin WHERE username='$uname' AND userpass='$upass'");
        if ($res_chk_login->num_rows > 0) {
                $row = $res_chk_login->fetch_assoc();
                $_SESSION['ADMIN_ID'] = $row['id'];
                $_SESSION['ADMIN_NAME'] = $uname;
                header("Location: Dashboard.php");
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
    <title>Admin | Book Parking Slot</title>
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

		<h2>Admin</h2>
            	<form method="post" name="adminloginForm" id="adminloginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		  <div class="form-group">
		    <label>Email address</label>
		    <input type="email" class="form-control" placeholder="Enter email" id="adminloginEmail" name="uname" required>
		  </div>
		  <div class="form-group">
		    <label>Password</label>
		    <input type="password" class="form-control"  placeholder="Password" id="adminloginPass" name="upass" required>
		  </div>
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="adminloginCheck" name="ucheck" value="1">
		    <label class="form-check-label">Keep me</label>
		  </div>
		  <button type="submit" class="btn btn-primary" name="adminloginSubmit" id="adminloginSubmit">Submit</button>
		</form>
		</div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>



