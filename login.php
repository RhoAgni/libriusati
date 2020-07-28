<?php
    include "connection.php";
    function sign_in($con){
        $mail_1=$_POST['mail_signin'];    echo $mail;       //acq dati da form
        $mail=strtolower($mail_1);
        $password=$_POST['password_signin'];
        $password_crypted=md5($password);     //cript password
        $sql1 = "SELECT * FROM users WHERE mail='$mail' AND password='$password_crypted' LIMIT 1";
        $result = mysqli_query($con, $sql1);
        if($result->num_rows != 0){  //acq dati da DB
            $row=$result->fetch_assoc();  
            $validation=$row['validation'];
            $id=$row['id_user'];
            if($validation==1){  //verifica validation
                $_SESSION['login']="si";
                $_SESSION['username'] = $row['nome'];
                $_SESSION['mail'] = $mail;
                $_SESSION['id_utente'] = $id;
                $accedi_txt="Ciao ".$username; //stringa sessione
                header("location: /index.php");
            }else {
                echo '<script>alert("verifica la mail prima di accedere");</script>';
            }
        }else {
            echo '<script>alert("mail o password sbagliata");</script>';
        }
        
    }
    if(isset($_POST['signin_btn'])){
        sign_in($conn);
    }
    
?>