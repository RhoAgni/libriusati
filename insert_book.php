<?php
session_start();
function insert(){
    $servername = "89.46.111.136";
    $username = "Sql1373592";
    $password = "08an4646u0";
    $dbname = "Sql1373592_1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $btitle = strval($_POST['book_title']);
    $bisbn = strval($_POST['book_isbn']);
    $bimg = strval("./images/book_cover/".$GLOBALS['file_name']);
    $bedition = strval($_POST['edition']);
    $boriginal_price = (int)$_POST["original_price"];
    $bcondition = strval($_POST["condition"]);
    $materia = strval($_POST["materia"]);
    $id_user=$_SESSION['id_utente'];
    
    $query="INSERT INTO books (isbn, titolo, materia, copertina, edizione, original_price, user, condizione) VALUES ('$bisbn', '$btitle', '$materia', '$bimg', '$bedition', '$boriginal_price', '$id_user', '$bcondition')";
    
    if ($conn->query($query) === TRUE) {
        $id_book = $conn->insert_id;
        echo " libro: New record created successfully. Last inserted ID is: " . $id_book;
        $check="SELECT id_user FROM searched_books WHERE isbn=$bisbn";
        $ris=mysqli_query($conn, $check);
        $row = mysqli_fetch_array($ris, MYSQLI_NUM);
        $length1 = count($row);
        for ($j=0; $j<$length1; $j++) {
            $id_user_q=$row[$j];
            $mail_q="SELECT mail FROM users WHERE id_user=$id_user_q";
            $result_u = mysqli_query($conn, $mail_q);
            if($result_u->num_rows != 0){
                $row_u=$result_u->fetch_assoc();  
                $mail=$row_u['mail'];
                echo $mail;
            }
            $subject="LIBRO DISPONIBILE";
            $message="Questo <a href='https://www.libriusati.net/libro.php?id=$id_book'>libro</a> è nella tua lista dei desideri.";
            $sender = "libriusati.net";
            $headers = "From: $sender\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($mail,$subject,$message,$headers, "-f$sender");
        }
            
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    $author=$_POST["author"];
    $autori=explode(",",$author);
    $length = count($autori);
    print_r($autori);
    for ($i = 0; $i < $length; $i++) {
        $autore_in=$autori[$i];
        $sql="INSERT INTO authors (nome) VALUE ('$autore_in')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "<br> autore: New record created successfully. Last inserted ID is: " . $last_id;
            $sql2="INSERT INTO writes (cod_author, cod_book) VALUES ('$last_id', '$id_book')";
            if (mysqli_query($conn, $sql2)) {
                echo "<br> Collegamento fatto";
            } else {
                echo "<br> errore" . mysqli_error($conn);
            }
        } else {
            echo "<br> Error: " . $sql . "<br>" . $conn->error;
        }
        
        
    }
    
    
    header("Location: https://www.libriusati.net");
}
    
    $errors= array();
    $nome_immagine=md5(time().$_SESSION['id_utente']);
      $file_size=$_FILES['book_img']['size'];
      $file_tmp=$_FILES['book_img']['tmp_name'];
      $file_type=$_FILES['book_img']['type'];
      $file_ext=pathinfo($_FILES["book_img"]["name"], PATHINFO_EXTENSION);
      $file_name=$nome_immagine.".".$file_ext;
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/book_cover/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
      insert();
?>