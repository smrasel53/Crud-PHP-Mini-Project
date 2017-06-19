<?php 
	session_start();
  	include 'config/config.php'; 
  	if (isset($_GET['id'])) {
	    $id    = $_GET['id'];
	    $query = "UPDATE tbl_students SET deleted_at=1 WHERE id = '$id'";
	    $result= mysqli_query($con, $query);
	    if ($result) {
	    	$_SESSION['message'] = "<div class='success'>Data Deleted Successfully.</div>";
	         echo "<script>location='http://localhost/go/display.php'</script>";
    }
  }  
 ?> 
 