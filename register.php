<?php 

require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location: http://localhost/stock/dashboard.php');	
}

$errors = array();

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle registration logic
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Connect to MySQL database
    $connect = new mysqli('localhost', 'username', 'password', 'stock');
    
    // Check if the username is already in use
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = $connect->query($check_query);
    
    if ($check_result->num_rows == 0) {
        $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful. You can now login.";
        } else {
            echo "Error: " . $connect->error;
        }
    } else {
        echo "Username already in use. Please choose a different one.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Stock Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">	

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" >
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info" style="box-shadow: 15px 15px 30px #bebebe,
             -15px -15px 30px #ffffff;">
					<div class="panel-heading" style="background: rgb(0, 243, 247);">
						<h3 class="panel-title">Register Account</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Login</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<img src="logo.png" alt="logo">
		<!-- /row -->
	</div>
	<!-- container -->	
	<style>
		img[alt="logo"]{
			transform: translate(370px, -100px);
		}
	</style>
</body>
</html>