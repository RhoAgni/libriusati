<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure id="signin-logo" class="visible-lg-*"><img src="./images/Logo.png" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Reset password</h2>
                        <form method="POST" class="register-form" id="login-form" action="">
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_rp" id="your_name" placeholder="New password" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="repeat_password_rp" id="your_pass" placeholder="Repeat password" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="rp_btn" id="signin" class="form-submit" value="Reset password"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php
            include "connection.php";

            function reset_password($sn, $u, $p, $dbn){
              $password=$_POST['password_rp'];
              $r_password=$_POST['repeat_password_rp'];
              $c_password=md5($password);
              $vkey=$_GET['vkey'];
              $mysqli=NEW MySQLi($sn, $u, $p, $dbn);
              $result=$mysqli->query("SELECT * FROM users WHERE vkey='$vkey' LIMIT 1");
              if($result->num_rows != 0){
                $row=$result->fetch_assoc();
                $validation=$row['validation'];
                if($validation==1){
                  if($password==$r_password){
                    $update=$mysqli->query("UPDATE users SET password='$c_password' WHERE vkey='$vkey' ");
                  }else{
                      echo "Password don't match";
                  }
                }else {
                  echo "Verifica la mail";
                }
              }else {
                echo "Mail o password sbagliati";
              }

            }

            if(isset($_POST['rp_btn']))
            {
                reset_password($servername, $username, $password, $dbname);
            }

        ?>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    
    <script type="text/javascript">
        function isMobileDevice() {
            return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
        };
        if(isMobileDevice() == true)
        {
            document.getElementById("signin-logo").style.display = "none";
        }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>