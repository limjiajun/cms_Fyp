<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
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



    <div class="w3-content w3-padding" style="max-width: 1000px">

    <div class ="w3-header w3-center w3-padding w3-animate-opacity">
        <img src='../images/geomodel_grave_mapping_2.png' alt='' style='width:70%;'>
    </div>

    
 
  </div>
  </div>
    
      <!-- footer -->
  <footer class="w3-row-padding w3-padding-16 w3-center w3-black">
   

  <h6>© 2023 Cemetery Management System</h6>
    </footer>
  </body>
</html>
