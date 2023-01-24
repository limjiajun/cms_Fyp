<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");


//SELECT `Grave_ID`, `Name_Deceased`, `Years_of_Born`, `Years_of_Died`, `Location`, `Section`, `Years_Buried` FROM `cemeteryrecord` WHERE 1
if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'delete') {
        $cmid = $_GET['cmid'];
        $sqldeletepr = "DELETE FROM `cemeteryrecord` WHERE Grave_ID = '$cmid'";
        $conn->exec($sqldeletepr);
        echo "<script>alert('Record deleted')</script>";
    }

  
    if ($operation == 'search') {
        $search = $_GET['search'];
       
        if ($search == "search") {
            $sqlproduct = "SELECT * FROM cemeteryrecord WHERE Name_Deceased LIKE '%$search%'";
        } else {
            $sqlproduct = "SELECT * FROM cemeteryrecord  WHERE Years_Buried LIKE '%$search%'";
        }
    }
} else {
    $sqlproduct = "SELECT * FROM cemeteryrecord ";
}

$results_per_page = 20;
if (isset($_GET['pageno'])) {
     $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
     $pageno = 1;
    $page_first_result = 0;
}
$sqlproduct = "SELECT * FROM `cemeteryrecord`";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


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

        

            <h3>Manage Cemetery Record</h3>
            
        </div>
    </div>
    <div class="w3-bar w3-grey">
        <a href="cemeteryRecord.php" class="w3-bar-item w3-button w3-right">New Cemetery Record</a>
    </div>
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h3>Cemetery Record Search</h3>
        <form>
            <div class="w3-row">
                <div class="w3-container" style="padding-right:4px">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search term" /></p>
                </div>
              
            </div>
            <button class="w3-button w3-grey w3-round w3-right" type="submit" name="submit" value="search">search</button>
        </form>

    </div>
    <div class="w3-margin w3-border" style="overflow-x:auto;">
        <?php
        $i = 0;
        echo "<table class='w3-table w3-striped w3-bordered' style='width:100%'>
         <tr><th style='width:5%'>Grave_ID</th><th style='width:10%'>Name_Deceased</th><th style='width:10%'>Years_of_Born</th><th style='width:10%'>Years_of_Died</th><th style='width:10%'>Location</th>
         <th>Section</th><th>Years_Buried</th> <th>Operations</th></tr>";
        foreach ($rows as $cemeterys) {
            ////SELECT `user_id`, `First_name`, `Last_name`, `Gender`, `Identity_card_number`, `Email`, `Password`,
// `Phone_Number`, `Home_Address`, `otp`, `user_type` FROM `user_profile` WHERE 1
            $i++;
            $cmid = $cemeterys['Grave_ID'];
            $Name_Deceased = $cemeterys['Name_Deceased'];
            $Years_of_Born = $cemeterys['Years_of_Born'];
            $Years_of_Died = $cemeterys['Years_of_Died'];
            $Location = $cemeterys['Location'];
            $Section = $cemeterys['Section'];
            $Years_Buried = $cemeterys['Years_Buried'];
            
            echo "<tr><td>$i</td><td>$Name_Deceased </td><td>$Years_of_Born</td><td>$Years_of_Died </td><td> $Location</td><td>$Section</td>
            <td>$Years_Buried </td>
            <td><button class='btn'><a href='CemeteryTable.php?submit=delete&cmid=$cmid' class='fa fa-trash' onclick=\"return confirm('Are you sure?')\"></a></button>
            <button class='btn'><a href='UpdateCemeteryTable.php?submit=details&cmid=$cmid' class='fa fa-edit'></a></button></td></tr>";

        }
        ////SELECT `Grave_ID`, `Name_Deceased`, `Years_of_Born`, `Years_of_Died`, `Location`, `Section`, `Years_Buried` FROM `cemeteryrecord` WHERE 1

        //CemeteryTable
        echo "</table>";
        ?>
    </div>
    <br>
    <?php
        $num = 1;
        if ($pageno == 1) {
            $num = 1;
        } else if ($pageno == 2) {
            $num = ($num) + 10;
        } else {
            $num = $pageno * 10 - 9;
        }
        echo "<div class='w3-container w3-row'>";
        echo "<center>";
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a href = "CemeteryTable.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
        }
        echo " ( " . $pageno . " )";
        echo "</center>";
        echo "</div>";
    ?>
    <br>
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