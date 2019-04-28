<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include('header.php');
  $var1 =  $_SESSION['userid'];

	$var2 =	$_SESSION['username'];


?>

<html>
<head>
</head>
<body id="mybody" >
<div >
<h3>Welcome</h3>
<!-- <a href="logout.php">LogOut</a>  -->
</div>
<form method="POST" action="b.php" >

<input type="submit" name = "add" value="ADD">
<input type="submit" name = "update" value="UPDATE">


</div>
</form>

</body>
</html>



<table cellspadding="5" border="1">
				<tr>
                <th>ID</th>
					<th>EMAIL</th>
					<th>Name</th>
					<th>Mobile Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Designation</th>


				</tr>
<?php
include('includes/db.php');

$show=mysqli_query($conn,"SELECT * FROM employee");
$resultcheck=mysqli_num_rows($show);
echo $resultcheck;
while($res=mysqli_fetch_array($show)){
?>
<tr>
<td>
<?php echo $res['id'];
	echo $var1;
				      echo $var2;
	?>
</td>
<td>
<?php echo $res['email'];?>
</td>
<td>
<?php echo $res['name'];?>
</td>
<td>
<?php echo $res['mobileno'];?>
</td>
<td>
<?php echo $res['designation'];?>
</td>
<td>
<?php echo $res['address'];?>
</td>
<td>
<?php echo $res['city'];?>
</td>
<td>
<?php echo $res['state'];?>
</td>

<td>
	<a href="b.php?id=<?php echo $res['id'] ?>">Update </a>
</td>
<td>
   <a href="delete.php?id=<?php echo $res['id'] ?>" >Delete </button>
</td>
</tr>
<?php
}
?>
</table>
