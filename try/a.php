<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// if (isset($_POST['login'])) {
//     require('includes/db.php');
//     $uname=$_POST['uname'];
//     $password=$_POST['psw'];

//     if (empty($uname)||empty($password)) {
//         header("Location: a.php?error=emptyfields");
//         exit();
//     } else {
//         $sql="SELECT * FROM usermaster WHERE username=? ;";
//         //$sql1 = "SELECT id FROM usermaster where username = '' and password = '';";
//         $stmt=mysqli_stmt_init($conn);
//         if(!mysqli_stmt_prepare($stmt,$sql)){
//             header("Location: a.php?error=sqlerrors");
//             exit(); 

//         }
//         else{
//             mysqli_stmt_bind_param($stmt,"ss",  $uname, $password);
//             mysqli_stmt_execute($stmt);
//             $result=mysqli_stmt_get_result($stmt);
//             if($row=mysqli_fetch_assoc($result)){
//                   $psdcheck=password_verify($password,$row['password']);
//                   if($psdcheck==false){

//                     header("Location: a.php?error=wrongpassword");
//                     exit(); 
//                   }
//                   elseif($psdcheck==true){
//                          session_start();
//                           $_SESSION['userid']=$row['id'];
//                           $_SESSION['username']=$row['username'];
//                          header("Location: a.php?login=success");
//                     exit();
//                   }
//                   else{
//                     header("Location: a.php?error=wrongpassword");
//                     exit(); 
//                   }
//             }
//             else{
//                 header("Location: a.php?error=nousers");
//                 exit(); 
//             }
//         }
//     }
// }//else{
// //     header("Location:a.php");
// //     exit();
// // }

//include('header.php');
include('includes/db.php');
$unameErr="";
$passwordErr="";
//session_start();
if(isset($_POST['submit'])) {
	$uname=$_POST['username'];
    $password=$_POST['password'];

    if(empty($uname) || empty($password)){
        $unameErr="Cannot be empty";
        $passwordErr="Cannot be empty";

        
			
    }
    else{
    $sql= mysqli_query($conn,"SELECT * FROM usermaster WHERE username = '$uname' AND password = '$password' ") or die (mysqli_connect_error());

	$result=mysqli_query($conn,"SELECT * FROM usermaster WHERE username = '$uname' AND password = '$password' ");
	
    if (mysqli_num_rows($result)==1) {
	if($row = mysqli_fetch_assoc($result)){
        echo"you have Successfully logged in";
        // include 'Dashboard.php';
		$_SESSION['userid']=$row['id'];
		$_SESSION['username']=$row['username'];
	
		header("location:Dashboard.php");


     exit();
	    }
    } else {
        echo"You have enter incorrect password";
         exit();
    }
}
}
















?>













































<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>LOGIN PAGE</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<form  method="POST" action="#">

	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<!-- <div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div> -->
				</div>
				<div class="d-flex justify-content-center form_container">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user"  placeholder="username">
							<span class = "error"> <?php echo $unameErr;?></span>

						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" placeholder="password">
							<span class = "error"> <?php echo $passwordErr;?></span>

						</div>
						<!-- <div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div> -->
					
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">
             <input type="submit" name="submit" value="login">
		   </div>
				<!-- <div class="d-flex justify-content-center mt-3 login_container">
					<input type="submit" name="submit" value="login" class="btn login_btn"/>
                </div> -->
                <!-- <form action="logout.php" method="POST">

                <div class="d-flex justify-content-center mt-3 login_container">
					<button type="button" name="button" class="btn login_btn">Logout</button>
                </div>
                </form> -->

				<!-- <div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</form>
</body>
<style>
    body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #60a3bc !important;
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #60a3bc;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}






















</style>
</html>
