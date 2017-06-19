<?php 
	session_start();
	include 'config/config.php'; 
	if (isset($_GET['id'])) {
	    $id    = $_GET['id'];
	    $query = "DELETE FROM tbl_students WHERE id = '$id'";
	    $result= mysqli_query($con, $query);
	    if ($result) {
    		$_SESSION['message'] = "<div class='success'>Data Parmanently Deleted Successfully.</div>";
    	     echo "<script>location='http://localhost/go/trashlist.php'</script>";
	}
  }  
 ?> 
 