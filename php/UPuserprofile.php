<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

include_once("dbconnect.php");


                
              

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
   
    }





?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MY CMS</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link href="../css/style.css" rel="stylesheet"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:wght@600&display=swap"
      rel="stylesheet"
    />
  </head>

    <script>
    function hamburgerMenu() {
      var x = document.getElementById("idMenuBar");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }
  </script>

  <body>
    <!-- Top navigation bar -->
    <div class="w3-bar w3-black w3-padding-16" id="navBar">
      <a href="homepage.php" class="w3-bar-item w3-button w3-wide">
        <b>CMS</b></a
      >
      <a href="UPuserprofile.php" class="w3-bar-item w3-button w3-hide-small">User Profile</a>
      <a href="" class="w3-bar-item w3-button w3-hide-small"
        >Cemetery Record</a>
      
      <a href="userCemeteryTable" class="w3-bar-item w3-button w3-hide-small">VIEW CEMETERY RECORD</a>
      <a href="ratingpage.php" class="w3-bar-item w3-button w3-hide-small">Feedback</a>      <!-- Right-sided navbar links -->
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

   


    <div class="w3-grey">
            <h3>Update User Profile</h3>

        </div>
    </div>
    <div class="w3-bar w3-grey">
        <a href="userTable.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="UpdateuserTable.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-grey">
                <h3>Your Profile</h3>
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
                    < </p>
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
                    <input class="w3-button ww3-grey w3-round w3-block w3-border" type="submit" name="submit" value="Update">
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