<?php 
  include 'inc/header.php'; 
  include 'config/config.php'; 
?>
  <div class="maincontent">
    <h2>All Student Record</h2>
    <div class="message">
      <?php 
        if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
      ?>
    </div>
    <?php 
        if (isset($_GET['msg'])) {
          $msg = $_GET['msg'];
          echo "<div class='success'>".$msg."</div>";
        }
     ?>
      <table class="tbl_one">
        <tr>
          <th>No</th>
          <th>Full Name</th>
          <th>Gender</th>
          <th>Depertment</th>
          <th>Skill</th>
          <th>Actions</th>
        </tr>
        <?php 
            $per_page = 5;
            if (isset($_GET['page'])) {
              $page = $_GET['page'];
            } else {
              $page = 1;
            }
            // Page will start from 0 and Multiple by Per Page
            $start_from = ($page-1) * $per_page;
            //Selecting the data from table but with limit
            $query = "SELECT * FROM tbl_students WHERE deleted_at=0 LIMIT $start_from, $per_page";
            $result = mysqli_query ($con, $query);
           
            $i = 0;
            while ($alldata = mysqli_fetch_assoc($result)) {
              $i++;
         ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $alldata['fullname']; ?></td>
          <td><?php echo $alldata['sex']; ?></td>
          <td><?php echo $alldata['dept']; ?></td>
          <td><?php echo $alldata['skill']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $alldata['id']; ?>">Edit</a> || 
            <a href="trash.php?id=<?php echo $alldata['id']; ?>" onclick="return confirm('Are you sure to delete data?');">Delete</a>
          </td>
        </tr>
        <?php  } ?>
      </table>
      <div class="pagination">
      <?php 
          //Now select all from table
          $query = "select * from tbl_students";
          $result = mysqli_query($con, $query);
          // Count the total records
          $total_records = mysqli_num_rows($result);

          //Using ceil function to divide the total records on per page
          $total_pages = ceil($total_records / $per_page);
          //Going to first page
          echo "<center><a href='display.php?page=1'>".'First Page'."</a>";

          for ($i=1; $i<=$total_pages; $i++) {

          echo "<a href='display.php?page=".$i."'>".$i."</a>";
          };
          // Going to last page
          echo "<a href='display.php?page=$total_pages'>".'Last Page'."</a></center>";
       ?>
       </div>
  </div>
<?php include 'inc/footer.php'; ?>   