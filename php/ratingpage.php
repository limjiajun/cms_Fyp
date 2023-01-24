<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
    
}
include_once("dbconnect.php");


$Email = $_SESSION["Email"];
$sqlproduct = "SELECT * FROM user_profile WHERE Email = '".$Email."' ";

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
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS</title>
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
        <b>CMS</b></a>
      

      <a href="UPuserprofile.php?submit=details&prid=<?php echo $prid ?>"class="w3-bar-item w3-button w3-hide-small">User Profile</a>
   

      <a href="" class="w3-bar-item w3-button w3-hide-small">Cemetery Record</a>
      
      <a href="userCemeteryTable.php" class="w3-bar-item w3-button w3-hide-small">VIEW CEMETERY RECORD</a>
      <a href="" class="w3-bar-item w3-button w3-hide-small">Feedback</a>

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

    <!-- Hamburger menu -->
  


    <div class="w3-content w3-padding" style="max-width: 1000px">

    <div class ="w3-header w3-center w3-padding w3-animate-opacity">
        <img src='../images/rating.png' alt='' style='width:70%;'>
    </div>

    
 
  </div>
  </div>
    
      <!-- footer -->
  <footer class="w3-row-padding w3-padding-16 w3-center w3-black">
   

  <h6>© 2023 Cemetery Management System</h6>
    </footer>
  </body>
</html>
