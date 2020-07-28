<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            <?php echo $_SERVER["HTTP_HOST"]; ?>
        </title>
    </head>
    <body>
        <?php
          include "connection.php";
          $vkey=$_GET['vkey'];
          $mysqli=NEW MySQLi($servername, $username, $password, $dbname);
          $results=$mysqli->query("SELECT * FROM users WHERE vkey='$vkey' LIMIT 1");
          if($results->num_rows == 1){
            $row=$results->fetch_assoc();
            $verify=$mysqli->query("UPDATE users SET validation=1 WHERE vkey='$vkey' LIMIT 1");
            if($verify){
              echo "Mail verificata correttamente.";
              echo '<img src="./images/verified.gif"></img>';
            }else{
            echo "C'è stato un problema, riprova.";
            }
          }else{
            echo "C'è stato un problema, riprova.";
          }
        ?>
    </body>
</html>