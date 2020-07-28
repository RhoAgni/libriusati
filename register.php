<?php
    include "connection.php";
         
    function sign_up($con){
        $username=$_POST['username_signup'];
        $password=$_POST['password_signup'];
        $password_repeat=$_POST['re_password'];
        $email_1=$_POST['email_signup'];
        $email=strtolower($email_1);
        $tel=$_POST['tel_signup'];
        $vkey=md5(time().$username);
        $sql2 = "SELECT * FROM users WHERE mail='$email'";
        $resul = mysqli_query($con, $sql2);
        if($resul->num_rows == 0){
            if($password==$password_repeat){
                $password_crypted=md5($password);
                $query="INSERT into users (id_user, nome, telefono, mail, password, vkey, validation) VALUES (NULL, '$username', '$tel', '$email', '$password_crypted', '$vkey', 0)";
                if(mysqli_query($con, $query)) {
                    $to=$email;
                    $subject="Email verification";
                    $message="<a href='https://www.libriusati.net/verify.php?vkey=$vkey'>Register Account</a>";
                    $sender = "libriusati.net";
                    $headers = "From: $sender\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    mail($to,$subject,$message,$headers, "-f$sender");
                    echo '<script>alert("ora verifica la mail");</script>';
                }
            }else{
                echo '<script>alert("le password non coincidono");</script>';
            }
        }else{
            echo '<script>alert("questa mail è già stata usata");</script>';
        }
    }
    if(isset($_POST['signup_btn'])){
        sign_up($conn);
    }
?>