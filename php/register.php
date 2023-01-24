<?php
if (isset($_POST['Register'])) {
    include_once("dbconnect.php");




    $First_name  = $_POST["First_name"];
    $Last_name = $_POST["Last_name"];
    $Gender = $_POST["Gender"];
    $Identity_card_number = $_POST["Identity_card_number"];
    $Email  = $_POST["Email"];
    $Password = sha1($_POST["Password"]);
    $Phone_Number = $_POST['Phone_Number'];
    $Home_Address = $_POST['Home_Address'];
    $otp = rand(10000,99999);

    if(!empty($_POST['user_type']) && in_array($_POST['user_type'], ['admin','user'])){
      $user_type = $_POST['user_type'];
  }else{
      $user_type = 'user';
  }


    $sqlinsert = "INSERT INTO `user_profile`(`First_name`, `Last_name`, `Gender`, `Identity_card_number`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `user_type`) 
    VALUES ('$First_name ','$Last_name','$Gender','$Identity_card_number','$Email','$Password','$Phone_Number','$Home_Address','$otp','$user_type')";


 
    try {
      $conn-> exec($sqlinsert);
      if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
          $last_id = $conn->lastInsertId();
          uploadImage($last_id);
          echo "<script>alert('Success')</script>";
          echo "<script>window.location.replace('login.php')</script>";
      }
  } catch (PDOException $e) {
          echo "<script>alert('Register Failed');</script>";
          echo "<script>window.location.replace('register.php')</script>";
  } 
  echo "<script>alert('Success')</script>";
  echo "<script>window.location.replace('login.php')</script>";
}

function uploadImage($filename)
{
  $target_dir = "../res/users/";
  $target_file = $target_dir . $filename . ".png";
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register to MY Tutor</title>
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

  <script src = "js/preview.js"></script>

  <body>
    <!-- Top navigation bar -->
        <div class="w3-bar w3-grey w3-padding-10" id="navBar">
          
        <div class="w3-col m6 w3-padding-large">
          <img
            src="../images/Logo123.png"
            alt="MYTutor Logo"
            width="70"
            
          />
          <a href="index.php" class="w3-bar-item w3-button w3-wide"> <b>Cemetery Management System</b></a>
        </div>
          
          <!-- Right-sided navbar links -->
          <div class="w3-right ">
            <a href="login.php" class="w3-button w3-white w3-border">LOGIN</a>
            <a href="login.php" class="w3-button w3-white w3-border">SIGN UP</a>
          </div>
        </div>

  <div class="w3-content w3-padding-top-64 w3-padding-bottom-32" style="max-width: 900px">
    <!-- Header -->
    <div class="w3-header w3-container">
      <div class="w3-col m6 w3-padding-large w3-center w3-hide-small ">
        <div class="w3-display-container" style="height:200px;">

        </div>
        <img
          src="../images/reg123.png"
          alt="MYTutor Logo"
          width="300"
        />
      </div>
      <!-- col -->

      <div class="w3-col m6 w3-padding-small">
          <div class="w3-container w3-padding-32"> 
              <div class="w3-card-4 w3-round w3-padding">
                <form name="registrationForm" action="register.php" enctype="multipart/form-data" method="post" >
                    <h3 class="w3-center">Registration</h3>

                    <p>
                    <div class="w3-container w3-center">
                      <img class="w3-image" src="../images/useravatar.png" style="height:100%;width:400px"><br>
                      <input type="file" name="fileToUpload" id= "fileToUpload" onchange="previewFile()">                 

                    </div>
                    </p>
                    <div class="w3-row-padding">
                    
  <p class="w3-half">
    <label><b>First Name</b></label>
    <input class="w3-input w3-round-xxlarge w3-border" type="First_name"name="First_name" id="idfirstname"
    placeholder="First_name "required>
</p>

  <p class="w3-half">
    <label><b>Last Name</b></label>
    <input class="w3-input w3-round-xxlarge w3-border" type="Last_name" name="Last_name"  id = "idlastname" 
    placeholder="Last_name"required>
</p>
<p>
<div class="w3-center" style="padding-right:4px">
<label><b>Gender</b></label>
                    <p> <select class="w3-input w3-block w3-round w3-border" name="Gender">
                            <option value="Select" selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                        </select>
                    </p>
                </div>
            
                        <label><b>Identity card number</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Identity_card_number" name="Identity_card_number" id="idIdentity_card_number"
                            placeholder="Enter your Identity card number" required>
                    </p>
                    <p>
                      
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Email" name="Email" id="idEmail"
                            placeholder="Enter your Email" required>
                    </p>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Password" name="Password" id="idPassword"
                            placeholder="Enter your password" required>
                    </p>
                    <p>
                        <label><b>Re-enter Password</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Password" name="Password" id="idreenterpassword"
                            placeholder="Re-enter your password" required>
                    </p>
                    
                    <p>
                        <label><b>Phone Number</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Phone_Number" name="Phone_Number" id="idphonenumber"
                            placeholder="Enter your phone number" required>
                    </p>
                    <p>
                        <label><b>Home Address</b></label>
                        <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="Home_Address" id="idHome_Address" 
                        placeholder="Enter your home address" required></textarea>

                        
                    </p>
                    <p>
                        <input type="submit" class="w3-btn w3-round-xxlarge w3-block w3-grey" name="Register" value="Register">
                    </p>
        
                    <div class="w3-center"> <p>Already register?? <a href="login.php"><b>Back to LOGIN</b> </a></p></div>
                    
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