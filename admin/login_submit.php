<?php include('../dbconnect.php');
error_reporting(0);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
</script>

</head>

<body>
<?php 
$qry=mysql_query("select * from adminlogin");

$fetch=mysql_fetch_array($qry);
$username=$_POST['username'];
$password=$_POST['password'];
if(isset($_POST['submit']))
{
	if($fetch['username']==$username && $fetch['password']==$password)
	{
			header('location:adminindex.php');
	}
	else
	{
		header('location:index.php?msg=inccorect username and pasword');
	}
}?>

</body>


</html>