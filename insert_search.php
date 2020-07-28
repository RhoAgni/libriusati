<?php
    session_start();
    $servername = "89.46.111.136";
    $username = "Sql1373592";
    $password = "08an4646u0";
    $dbname = "Sql1373592_1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id_user=$_SESSION['id_utente'];
    $isbn=strval($_POST['book_isbn_search']);
    echo $id_user."<br>".$isbn."<br>";
    $insert="INSERT INTO searched_books (isbn, id_user) VALUES ('$isbn', '$id_user')";
    echo $insert;
    if ($conn->query($insert) === TRUE) {
        header('Location: https://www.libriusati.net/');
    }else{
        echo "ERRORE";
    }
?>