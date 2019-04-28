<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include('header.php');

include("includes/db.php");
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $del = mysqli_query($conn,"DELETE FROM employee WHERE id='$id' ");
    if($del)
{
?>
<script>alert("record deleted");</script>
<?php header("location: b.php");
}
else
{
    ?>
    <script>alert("record not deleted");</script>
    <?php header("location: b.php");
}
}
?>