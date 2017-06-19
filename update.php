<?php 
  include 'inc/header.php'; 
  include 'config/config.php'; 
?>
  <div class="maincontent">
    <div class="subcontent">
      <div class="insert-box">
        <h2>Update Student Record</h2>
        <?php 
          if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $fullname  = $_POST['fullname'];
            $sex       = $_POST['sex'];
            $dept      = $_POST['dept'];
            $skill     = $_POST['skill'];

            if (empty($fullname) || empty($sex) || empty($dept)) {
              echo "<div class='error'>Field must not be empty !</div>";
            } else {
              if (strlen($fullname) > 3) {
                  foreach ($skill as $value) {
                    $data[] = $value;
                    $finaldata = implode(',', $data);
                  }
                  $query = "UPDATE tbl_students SET fullname='$fullname', sex='$sex', dept='$dept', skill='$finaldata' WHERE id = '$id'";
                  $update_row = mysqli_query($con, $query);
                  if ($update_row) {
                    $_SESSION['message'] = "<div class='success'>Data Updated Successfully.</div>";
                      echo "<script>location='http://localhost/go/display.php'</script>";
                  }
              } else {
                echo "<div class='error'>Name should be at least 3 letter.</div>";
              }
            }
          }
         ?>
        <?php 
              if (isset($_GET['id'])) {
              $id    = $_GET['id'];
              $query = "SELECT * FROM tbl_students WHERE id = '$id'";
              $result= mysqli_query($con, $query);
              $alldata  = mysqli_fetch_assoc($result);
          ?>
        <form action="" method="post">
          <table>
            <input type="hidden" name="id" value="<?php echo $alldata['id']; ?>">
            <tr>
              <td>Full Name:</td>
              <td><input type="text" name="fullname" value="<?php echo $alldata['fullname']; ?>"></td>
            </tr>
            <tr>
              <td>Gender:</td>
              <td>
                  <input type="radio" name="sex" value="Male"<?php if ($alldata['sex'] == 'Male') { echo "checked=checked";} ?>>Male
                  <input type="radio" name="sex" value="Female" <?php if ($alldata['sex'] == 'Female') { echo "checked=checked";} ?>>Female
                  <input type="radio" name="sex" value="Others" <?php if ($alldata['sex'] == 'Others') { echo "checked=checked";} ?>>Others
              </td>
            </tr>
            <tr>
              <td>Department:</td>
              <td>
                  <select name="dept" style="padding:5px;width:250px">
                    <option value="CSE" <?php if ($alldata['dept'] == 'CSE') { echo "selected=selected";} ?>>CSE</option>
                    <option value="EEE" <?php if ($alldata['dept'] == 'EEE') { echo "selected=selected";} ?>>EEE</option>
                    <option value="BBA" <?php if ($alldata['dept'] == 'BBA') { echo "selected=selected";} ?>>BBA</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Skill:</td>
              <td>
                <?php  
                  $data = explode(',', $alldata['skill']); 
                  if(in_array('PHP',$data))echo '<input type="checkbox" name="skill[]" value="PHP" checked>PHP'; else echo '<input type="checkbox" name="skill[]" value="PHP">PHP';
                  if(in_array('Java',$data))echo '<input type="checkbox" name="skill[]" value="Java" checked >Java'; else echo '<input type="checkbox" name="skill[]" value="Java">Java';
                  if(in_array('Perl',$data))echo '<input type="checkbox" name="skill[]" value="Perl" checked >Perl'; else echo '<input type="checkbox" name="skill[]" value="Perl">Perl';
                  if(in_array('Python',$data))echo '<input type="checkbox" name="skill[]" value="Python" checked >Python'; else echo '<input type="checkbox" name="skill[]" value="Python">Python';
                  ?>
                
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" name="submit" value="Update"></td>
            </tr>
          </table>
        </form>
       <?php } ?>
      </div>
    </div>  
  </div>
<?php include 'inc/footer.php'; ?>   