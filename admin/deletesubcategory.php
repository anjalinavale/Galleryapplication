<?php error_reporting(0);
include('../dbconnect.php');?>
<?php
$id=$_GET['id'];
$del=mysql_query("delete from sub_categories where id='$id'");
$row1=mysql_fetch_array($sql);
header('location:uploadcategory.php');
?>



