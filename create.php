<?php 
  include 'inc/header.php'; 
  include 'config/config.php'; 
?>
  <div class="maincontent">
    <div class="subcontent">
      <div class="insert-box">
        <h2>Student Registration</h2>
        <?php 
            if (isset($_POST['submit'])) {
              $fullname = $_POST['fullname'];
              $sex      = $_POST['sex'];
              $dept     = $_POST['dept'];
              $skill    = $_POST['skill'];
              
              if (empty($fullname) || empty($sex) || empty($dept) || empty($skill)) {
                echo "<div class='error'>Field must not be empty !</div>";
              } else {
                if (strlen($fullname) > 3) {
                    foreach ($skill as $value) {
                      $data[] = $value;
                      $finaldata = implode(',', $data);
                    }
                    $query = "INSERT INTO tbl_students(fullname, sex, dept, skill, created_at) VALUES('$fullname', '$sex', '$dept', '$finaldata', now())";
                    
                    $insert_row = mysqli_query($con, $query);
                    
                    if ($insert_row) {
                    	$_SESSION['message'] = "<div class='success'>You are successfully registered.</div>";
                      echo "<script>location='http://localhost/go/display.php'</script>";
                    }
                } else {
                  echo "<div class='error'>Name should be at least 3 letter.</div>";
                }
              }
            }
         ?>
        <form action="" method="post">
          <table>
            <tr>
              <td>Full Name:</td>
              <td><input type="text" name="fullname" placeholder="Enter your full name"></td>
            </tr>
            <tr>
              <td>Gender:</td>
              <td>
                  <input type="radio" name="sex" value="Male" checked>Male
                  <input type="radio" name="sex" value="Female">Female
                  <input type="radio" name="sex" value="Others">Others
              </td>
            </tr>
            <tr>
              <td>Department:</td>
              <td>
                <select name="dept" style="padding:5px;width:250px">
                  <option value="CSE">CSE</option>
                  <option value="EEE">EEE</option>
                  <option value="BBA">BBA</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Skill:</td>
              <td>
                  <input type="checkbox" name="skill[]" value="PHP" checked>PHP
                  <input type="checkbox" name="skill[]" value="Java">Java
                  <input type="checkbox" name="skill[]" value="Perl">Perl
                  <input type="checkbox" name="skill[]" value="Python">Python
              </td>
            </tr>
            <tr>
              <td></td>
              <td> <input type="submit" name="submit" value="Create"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>  
  </div>
<?php include 'inc/footer.php'; ?>   