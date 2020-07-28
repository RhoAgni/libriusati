<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password dimenticata</title>

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
                        <figure id="signin-logo"><img src="./images/Logo.png" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Password dimenticata</h2>
                        <form method="POST" class="register-form" id="login-form" action="">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="mail_lp" id="your_name" placeholder="Email" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin_btn" id="signin" class="form-submit" value="Invia mail"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php
            include "connection.php";

            function sign_in($sn, $u, $p, $dbn){
              $mail=$_POST['mail_lp'];
              $mysqli=NEW MySQLi($sn, $u, $p, $dbn);
              $result=$mysqli->query("SELECT * FROM users WHERE mail='$mail' LIMIT 1");
              if($result->num_rows != 0){
                $row=$result->fetch_assoc();
                $validation=$row['validation'];
                $vkey=$row['vkey'];
                if($validation==1){
                    $to=$mail;
                    $subject="Change password";
                    $message="<a href='https://www.libriusati.net/reset_password.php?vkey=$vkey'>Change password</a>";
                    $sender = "postmaster@libriusati.net";
                    $headers = "From: $sender\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
                    mail($to,$subject,$message,$headers, "-f$sender");
                }else {
                  echo "Verifica la mail";
                }
              }else {
                echo "Mail o password sbagliati";
              }

            }

            if(isset($_POST['signin_btn']))
            {
                sign_in($servername, $username, $password, $dbname);
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