
<?php
if (isset($_POST['submit'])) {
    include 'dbconnect.php';
    $Email = $_POST['Email'];
    $Password = sha1($_POST['Password']);
    $sqllogin = "SELECT * FROM user_profile WHERE Email = '$Email' AND Password= '$Password' LIMIT 1";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
      if($user["user_type"]=="user"){
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["Email"] = $Email ;
        echo "<script>alert('Login success');</script>";
        echo "<script>window.location.replace('homepage.php')</script>";
      }else if($user["user_type"]=="admin"){
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["Email"] = $Email ;
        echo "<script>alert('Login success');</script>";
        echo "<script>window.location.replace('adminpage.php')</script>";
      }
    }else{
      echo "<script>alert('Login failed');</script>";
    }
  }
  ?>
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login to MY Tutor</title>
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

  <script src = "js/login.js"></script>

  <body onload = "loadCookies()">
    <!-- Top navigation bar -->
    <div class="w3-bar w3-dark-gray w3-padding-8" id="navBar">
          
          <div class="w3-col m6 w3-padding-large">
            <img
              src="../images/Logo123.png"
              alt="MYTutor Logo"
              width="70"
              
            />
            <a href="index.html" class="w3-bar-item w3-button w3-wide"> <b>Cemetery Management System</b></a>
          </div>
            
            <!-- Right-sided navbar links -->
            <div class="w3-right ">
            <a href="login.php" class="w3-button w3-white w3-border">LOGIN</a>
            <a href="register.php" class="w3-button w3-white w3-border">SIGN UP</a>
            </div>
          </div>

    <div id = "cookieNotice" class="w3-block" style="display: none;">
      <div class="w3-dark-gray">
        <h4>Cookie Consent</h4>
        <p>Cookies and similar technologies are used in this website to 
          provide you a better and faster experience. 
          By continuing to use our website, you agree to our <b>Privacy Policy</b></p>
          <div class="w3-btn">
            <button onclick="acceptCookieConsent();">Accept</button>
          </div>
      </div>
    </div>
  </body>

  <div class="w3-content w3-padding-top-64" style="max-width: 900px">
     <!-- Header -->
      <div class="w3-header w3-container">
      <div class="w3-col m6 w3-padding-large w3-center">
        <img
          src="../images/Logo123.png"
          alt="CMS Logo"
          width="400"
        />
      </div>
      <!-- col -->

      <div class="w3-col m6 w3-padding-small">
          <div class="w3-container w3-padding-32"> 
              <div class="w3-card-4 w3-round w3-padding">
                <form name="loginForm" action="login.php" method="post">
                    <h3 class="w3-center">Login</h3>
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Email" name="Email" id="idemail"
                            placeholder="Enter your email" required>
                    </p>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round-xxlarge w3-border" type="Password" name="Password" id="idpassword"
                            placeholder="Enter your password" required>
                    </p>
                    <p>
                        <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                        <label>Remember Me</label>
                    </p>
                    <p>
                        <button class="w3-btn w3-dark-gray w3-round-xxlarge w3-block" type="submit" name="submit" value="login">Login</button>
                    </p>
                    <div class="w3-center"> <p>Don't have an account ? <a href="register.php"><b>Register now !!!</b> </a></p></div>
                    </form>
              </div>
          </div>
      </div>
      
      <!-- col -->
        </div>
     </div>
   </div>
    <!-- header -->
    <div class="w3-padding-top-64"></div>
    

  <!-- footer -->
  <footer class="fixedFooter w3-row-padding w3-padding-10 w3-center w3-dark-gray">
    <h6>© 2023 Cemetery Management System</h6>
  </footer>

  <script>
    let cookieConsent = getCookie("user_cookie_content");
    if (cookieConsent != ""){
      document.getElementById("cookieNotice").style.display = "none";
    } else {
      document.getElementById("cookieNotice").style.display = "block";
    }
  </script>

</body>
</html>
