<?php include('../dbconnect.php');
error_reporting(0);?>
<?php
if(isset($_POST["submit"]))
{
$target_file = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../site/img/".$target_file;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$category=$_POST['category'];
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
         echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $msg="Sorry, file already exists.";
	header('location:adminindex.php?msg='.$msg);
    $uploadOk =0 ;
}
	

// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
    $msg="Sorry, your file is too large.";
	//header('location:adminindex.php?msg='.$msg);
    $uploadOk = 0;
}*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $msg="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	header('location:adminindex.php?msg='.$msg);
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg="Sorry, your file was not uploaded.";
	header('location:adminindex.php?msg='.$msg);
	
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir)) {
		$qry=mysql_query("update categories set photo='$target_file',category='$category' where category_id='".$_GET['id']."'");
		
			header('location:adminindex.php?msg=Upload Details Successfully');
	} else {
        $msg="Sorry, there was an error uploading your file.";
		header('location:adminindex.php?msg='.$msg);
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- left menu -->
    <?php include('leftmenu.php');?>
        
    <!-- End of left menu -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

            
                     

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        
        <div class="container-fluid" align="center">
               <table border="0" cellpadding="4" cellspacing="3">
               
                <form action="#" method="post" enctype="multipart/form-data">
                          <?php echo $_GET['msg'];?>
                          <?php 

$qry1=mysql_query("select * from categories where category_id='".$_GET['id']."'");

$fet=mysql_fetch_array($qry1);
?>

                          <tr>
                       <td>Enter Category:-<input type="text" name="category" value="<?php echo $fet['category']?>" required></td>
                       </tr>
                      <tr>
                      <td><input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" /></td>
                      </tr>
                      <tr>
                      <td>Select image to upload:
                      <input type="file" name="fileToUpload" id="fileToUpload" required><br/><br>
                      </td>
                      </tr>
                      <tr>
                       <td align="center"><input type="submit" value="Upload Image" name="submit"><br/><br/></td>
                       </tr>
                   </form>
                   </table>

          <!-- Page Heading -->
         
        </div>
        <!-- /.container-fluid -->
            <table border="1" cellpadding="7" cellspacing="5" align="center">
<tr>
<th>Sr.NO</th>
<th>Image</th>
<!--<th>Edit</th>
<th>Delete</th>
-->
<th>Category</th>
<th>Delete</th>
<th>Edit</th>
<th>Add photos</th>
</tr>

<?php
$qry1=mysql_query("select * from categories");
$fet=mysql_fetch_array($qry1);
$num=mysql_num_rows($qry1);
$i=0;
while($i<$num)
{?>
<tr>
<td><?php echo $i+1?></td>
<td><img src="../site/img/<?php  echo $data=mysql_result($qry1,$i,'photo'); ?>" width="80px" height="70px"></td>
<td><?php  echo $data=mysql_result($qry1,$i,'category'); ?></td>
<td><a href="deletecategory.php?id=<?php  echo $data=mysql_result($qry1,$i,'category_id'); ?>">Delete</td>
<td><a href="editcategory.php?id=<?php  echo $data=mysql_result($qry1,$i,'category_id'); ?>">Edit</td>
<td><a href="uploadcategory.php?id=<?php echo $data=mysql_result($qry1,$i,'category_id'); ?>">Add Photos</a></td>
</tr>
<?php
$i++;
}
	
?>
</table>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
