
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include('header.php');


if (isset($_POST['submit'])) {
    require('includes/db.php');
    $name=$_POST['name'];
    //$lname=$_POST['lname'];
    $email=$_POST['email'];
    $mobileno=$_POST['mobileno'];
    $address=$_POST['adress'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $designation=$_POST['des'];
    $profile='';

    if (empty($name)||empty($email)||empty($mobileno)||empty($address)||empty($state)||empty($city)||empty($designation)) {
        header("Location: b.php?error=emptyfields&name=".$name."&email=".$email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z ]*$/", $name)) {
        header("Location: b.php?error=INVALID EMAIL& INVALID name");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: b.php?error=INVALID EMAIL&name=".$name);
        exit();
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        header("Location: b.php?error=INVALID firstname&email=".$email);
        exit();
    } else {
        $sql="SELECT name FROM employee WHERE name= ?";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: b.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck=mysqli_stmt_num_rows($stmt);
            if ($resultcheck>0) {
                header("Location: b.php?error=user firstname taken&email=".$email);
                exit();
            } else {
                echo $sql="INSERT INTO employee(email,name,mobileno,designation,address,profile,city,state) VALUES(?,?,?,?,?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: b.php?error=sqlerror");
                    exit();
                } else {
                    $item = mysqli_stmt_bind_param($stmt, "ssssssss", $email, $name, $mobileno, $designation, $address, $profile, $city, $state);
                    $a = mysqli_stmt_execute($stmt);
                    //var_dump($a);die;
                    header("Location: b.php?insertionup=success");
                    exit();
                }
            }
        }
        // mysqli_stmt_close($stmt);
        // mysqli_close($conn);
    }
}
// else{
//     header("Location: b.php");
//             exit();
// }

?>




<!Doctype html>
<html>
<head>
     <meta charset="UTF-8">
     <title>FORM</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

 <div class="container">
 <!---heading---->
     <header class="heading"> Insertion Form:</header><hr>
    <!---Form starting----> 
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error']=="emptyfields") {
            echo'<p class="signuperror">Fill in all fields!</p>';
        } elseif ($_GET['error']=="INVALID EMAIL& INVALID name") {
            echo'<p class="signuperror">invalid username!</p>';
        } elseif ($_GET['error']=="INVALID EMAIL") {
            echo'<p class="signuperror">invalid username!</p>';
        } elseif ($_GET['error']=="INVALID firstname") {
            echo'<p class="signuperror">invalid username!</p>';
        }
    }
    else if($_GET['insertionup']=="success"){
        echo'<p class="signupsuccess">Signup success</p>';
    }




    

    ?>



    <form action=" " method="POST">

	<div class="row ">
	 <!--- For Name---->
         <div class="col-sm-12">
             <div class="row">
			     <div class="col-xs-4">
          	         <label class="firstname">First Name :</label> </div>
		         <div class="col-xs-8">
		             <input type="text" name="name" id="name" placeholder="Enter your Name" class="form-control ">
             </div>
		      </div>
		 </div>
		 
		 
         <!-- <div class="col-sm-12">
		     <div class="row">
			     <div class="col-xs-4">
                     <label class="lastname">Last Name :</label></div>
				<div class ="col-xs-8">	 
		             <input type="text" name="lname" id="lname" placeholder="Enter your Last Name" class="form-control last">
                </div>
		     </div>
		 </div> -->
     <!-----For email---->
		 <div class="col-sm-12">
		     <div class="row">
			     <div class="col-xs-4">
		             <label class="mail" >Email :</label></div>
			     <div class="col-xs-8"	>	 
			          <input type="email" name="email"  id="email"placeholder="Enter your email" class="form-control" >
		         </div>
		     </div>
		 </div>
	 <!-----For Password and confirm password---->
          <div class="col-sm-12">
		         <div class="row">
				     <div class="col-xs-4">
		 	              <label class="pass">Mobile No:</label></div>
				  <div class="col-xs-8">
			             <input type="number" name="mobileno" id="password" placeholder="Enter your MOBILE NO." class="form-control">
				 </div>
          </div>
          </div>
          
          <div class="col-sm-12">
            <div class="row">
                <div class="col-xs-4">
                    <label class="Address">Address :</label></div>
               <div class ="col-xs-8">	 
                    <input type="text" name="adress" id="address" placeholder="Enter your Address" class="form-control last">
               </div>
            </div>
        </div>



        <div class="col-sm-12">
            <div class="row">
                <div class="col-xs-4">
                    <label class="Address">State :</label></div>
               <div class ="col-xs-8">	 
                    <select id="selectbasic" name="state" class="form-control">
                            <option value="1">Option one</option>
                            <option value="2">Option two</option>
                          </select>
               </div>
            </div>
        </div>
        <div class="col-sm-12">
                <div class="row">
                    <div class="col-xs-4">
                        <label class="Address">City:</label></div>
                   <div class ="col-xs-8">	 
                        <select id="selectbasic" name="city" class="form-control">
                                <option value="1">Option one</option>
                                <option value="2">Option two</option>
                              </select>
                   </div>
                </div>
            </div>
    


		  
     <!-----------For Phone number-------->
         <div class="col-sm-12">
		     <div class ="row">
                 <div class="col-xs-4 ">
			       <label class="gender">Designation:</label>
				 </div>
			 <div class="col-xs-8">
			     <select id="selectbasic" name="des" class="form-control">
                    <option value="1">Option one</option>
                    <option value="2">Option two</option>
                  </select>
                </div>
				 
				 
			
               </div>
               

               
		     <div class="col-sm-12">
             <input type="submit" name="submit" value="submit"class="btn login_btn"/>
		   </div>
		 </div>
	 </div>	 
		 		 
</form>
	 
</div>

</body>		
</html>
	 
	 