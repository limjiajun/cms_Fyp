<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");
if (isset($_POST['submit'])) {
  


    
    
    
    $Name_Deceased = $_POST["Name_Deceased"];
    $Years_of_Born = date('Y-m-d', strtotime($_POST['dateofbirth']));
    $Years_of_Died = date('Y-m-d', strtotime($_POST['Years_of_Died']));
    $Location = $_POST["Location"];
    $Section = $_POST["Section"];
    $Years_Buried = $_POST["Years_Buried"];


   
  

   

    $sqlinsert = "INSERT INTO `cemeteryrecord`( `Name_Deceased`, `Years_of_Born`,`Years_of_Died`, `Location`, `Section`, `Years_Buried`) 
     VALUES ('$Name_Deceased','$Years_of_Born','$Years_of_Died', '$Location', '$Section', '$Years_Buried')";
 
    try {
      $conn-> exec($sqlinsert);
      if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
          $last_id = $conn->lastInsertId();
          uploadImage($last_id);
          echo "<script>alert('Success')</script>";
          echo "<script>window.location.replace('adminpage.php')</script>";
      }
  } catch (PDOException $e) {
          echo "<script>alert('Insert Failed');</script>";
          echo "<script>window.location.replace('cemeteryRecord.php')</script>";
  }    
}

function uploadImage($filename)
{
  $target_dir = "../res/cemetery/";
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
      <a href="adminpage.php" class="w3-bar-item w3-button w3-wide">
        <b>CMS</b></a>
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
        onclick="hamburgerMenu()">
        <i class="fa fa-bars"></i>
      </a>
    </div>

  <div class="w3-content w3-padding-top-64 w3-padding-bottom-32" style="max-width: 900px">
    <!-- Header -->
    <div class="w3-header w3-container">
      <div class="w3-col m6 w3-padding-large w3-center w3-hide-small ">
        <div class="w3-display-container" style="height:200px;">

        </div>
        <img
          src="../images/AddRecord.png"
          alt="AddRecord Logo"
          width="300"
        />
      </div>
      <!-- col -->

      <div class="w3-col m6 w3-padding-small">
          <div class="w3-container w3-padding-62"> 
              <div class="w3-card-4 w3-round w3-padding-160">
                <form name="registrationForm" action="cemeteryRecord.php" enctype="multipart/form-data" method="post" >
                    <h3 class="w3-center">Add Cemetery Record</h3>

                    <p>
                    <div class="w3-container w3-center">
                      <img class="w3-image" src="../images/useravatar.png" style="height:100%;width:400px"><br>
                      <input type="file" name="fileToUpload" id= "fileToUpload" onchange="previewFile()">                 

                    </div>
                    </p>

                    <div class="w3-row-padding">
                    
  <div class="w3-left" style="padding-right:4px">
  <br>
  <p>
  <label><b>Name_Deceased</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Name_Deceased" name="Name_Deceased" id="idName_Deceased"
                            placeholder="Enter your Name_Deceased" required>
                    </p>
                    <p>
                      
                        <label><b>Years_of_Born</b></label>
                        
                                <input type="date" name="dateofbirth" class="form-control" />
                                
                    </p>
                    <p>
                        <label><b>Years_of_Died</b></label>
                       
                                <input type="date" name="Years_of_Died" class="form-control" />
                    </p>
                    
                    <p>
                        <label><b>Location</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Location" name="Location" id="idLocation"
                            placeholder="Enter your Location" required>
</p>



<div class="w3-center" style="padding-right:4px">
<label><b>Selection</b></label>
                    <p> <select class="w3-input w3-block w3-round w3-border" name="Section">
                            <option value="Select" selected>Select</option>
                            <option value="A">A</option>
                            <option value="B">B</option>

                        </select>
                    </p>
                </div>
                
                        <label><b>Years_Buried</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Years_Buried" name="Years_Buried" id="idYears_Buried"
                            placeholder="Enter your Years_Buried" required>
                    </p>
                    <p>
                      
                     
                    <p>
                        <input type="submit" class="w3-btn w3-round-xxlarge w3-block w3-grey" name="submit" value="Save Data">
                    </p>
        
                    </div>
                    
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