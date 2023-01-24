<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

include_once("dbconnect.php");

if (isset($_POST['submit'])) {
    $operation = $_POST['submit'];
    $prid = $_POST['prid'];
    $First_name  = $_POST["First_name"];
    $Last_name = $_POST["Last_name"];
    $Gender = $_POST["Gender"];
    $Identity_card_number = $_POST["Identity_card_number"];
    $Email  = $_POST["Email"];
    $Password = sha1($_POST["Password"]);
    $Phone_Number = $_POST['Phone_Number'];
    $Home_Address = $_POST['Home_Address'];

    $sqlupdate = "UPDATE `user_profile` SET `First_name`='$First_name',`Last_name`='$Last_name',
    `Gender`='$Gender',`Identity_card_number`='$Identity_card_number',`Email`='$Email',`Password`='$Password',`Phone_Number`='$Phone_Number',`Home_Address`='$Home_Address' WHERE `user_id` = '$prid'";

    try {
        $conn->exec($sqlupdate);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($prid);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('UpdateuserTable.php')</script>";
        } else {
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('UpdateuserTable.php')</script>";
        }
      } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('UpdateuserTable.php?submit=details&prid=$prid')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../res/users/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'details') {
        $prid = $_GET['prid'];
        $sqlproduct = "SELECT * FROM user_profile WHERE user_id = '$prid'";
        $stmt = $conn->prepare($sqlproduct);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $number_of_rows = $stmt->rowCount();
        if ($number_of_rows > 0) {
            foreach ($rows as $products) {
            $prid = $products['user_id'];
            $First_name = $products['First_name'];
            $Last_name = $products['Last_name'];
            $Gender = $products['Gender'];
            $Identity_card_number = $products['Identity_card_number'];
            $Email = $products['Email'];
            $Password = $products['Password'];
            $Phone_Number = $products['Phone_Number'];
            $Home_Address= $products['Home_Address'];
            
        }
    }else{
        echo "<script>alert('No product found')</script>";
        echo "<script>window.location.replace('userTable.php')</script>";
    }
}
}else{
echo "<script>alert('Success')</script>";
echo "<script>window.location.replace('userTable.php')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js"></script>
    <script src="../js/script.js"></script>

    <title>Update User Profile</title>
</head>

<body>
    <!-- Top navigation bar -->
    <div class="w3-bar w3-black w3-padding-16" id="navBar">
      <a href="adminpage.php" class="w3-bar-item w3-button w3-wide">
        <b>CMS</b></a
      >
      <a href="userTable.php" class="w3-bar-item w3-button w3-hide-small">User Profile</a>
      <a href="cemeteryRecord.php" class="w3-bar-item w3-button w3-hide-small"
        >Cemetery Record</a>
      
      <a href="CemeteryTable.php" class="w3-bar-item w3-button w3-hide-small">VIEW CEMETERY RECORD</a>
      <a href="#profile" class="w3-bar-item w3-button w3-hide-small">Feedback</a>
      <!-- Right-sided navbar links -->
      <div class="w3-right">
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small"
          >LOGOUT</a
        >
      </div>
      <!-- Hide right-floated links on small screens and replace them with a menu icon -->

      <a
        href="javascript:void(0)"
        class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
        onclick="hamburgerMenu()"
      >
        <i class="fa fa-bars"></i>
      </a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>Update Product</h3>

        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="userTable.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="UpdateuserTable.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-yellow">
                <h3>Your Product</h3>
            </div>
            <div class="w3-container w3-center">
                <img class="w3-image w3-margin" src="../res/users/<?php echo $prid . '.png' ?>" style="height:100%;width:400px"><br>
                <input type="file" name="fileToUpload" onchange="previewFile()">
            </div>
            <hr>
            <input type="hidden" name="prid" value="<?php echo $prid ?>">
            <div class="w3-row-padding">
                    
                    <p class="w3-half">
                      <label><b>First Name</b></label>
                      <input class="w3-input w3-round-xxlarge w3-border" type="First_name"name="First_name" id="idfirstname" value="<?php echo $First_name ?>"required>
                  </p>
                  
                    <p class="w3-half">
                      <label><b>Last Name</b></label>
                      <input class="w3-input w3-round-xxlarge w3-border" type="Last_name" name="Last_name"  id = "idlastname" value="<?php echo $Last_name ?>"required>
                  </p>
                  <p>
                  <div class="w3-center" style="padding-right:4px">
                  <label><b>Gender</b></label>
                                      <p> <select class="w3-input w3-block w3-round w3-border" name="Gender">
                            <option value="Select" <?php if ($Gender == "Select") echo ' selected="selected"'; ?>>Select</option>
                            <option value="Male" <?php if ($Gender == "Male") echo ' selected="selected"'; ?>>Male</option>
                            <option value="Female" <?php if ($Gender== "Female") echo ' selected="selected"'; ?>>Female</option>
                            
                        </select>
                     </p>
                </div>
            
                        <label><b>Identity card number</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Identity_card_number" name="Identity_card_number" id="idIdentity_card_number" value="<?php echo $Identity_card_number ?>"required>
                    </p>
                    <p>
                      
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Email" name="Email" id="idEmail" value="<?php echo $Email ?>"required>
                    </p>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Password" name="Password" id="idPassword" value="<?php echo $Password ?>"required>
                    </p>
                    <p>
                        <label><b>Re-enter Password</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Password" name="Password" id="idreenterpassword" value="<?php echo $Password ?>"required>
                    </p>
                    
                    <p>
                        <label><b>Phone Number</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Phone_Number" name="Phone_Number" id="idphonenumber" value="<?php echo $Phone_Number?>"required>
                    </p>
                    <p>
                        <label><b>Home Address</b></label>
                        <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="Home_Address" id="idHome_Address" 
                         required><?php echo $Home_Address ?></textarea>

                        
                    </p>
                    <p>
                    <input class="w3-button w3-yellow w3-round w3-block w3-border" type="submit" name="submit" value="Update">
                    </p>
        
                    
                    </form>

              </div>
          </div>
          

      </div>
      
      <!-- col -->
        </div>
     </div>
  </div>
    <!-- header -->

  <!-- footer -->
  <footer class="w3-row-padding w3-padding-16 w3-center w3-grey">
  <h6>© 2023 Cemetery Management System</h6>
    </footer>
  </body>
</html>