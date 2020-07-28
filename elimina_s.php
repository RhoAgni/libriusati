<?php
    include "connection.php";
    $id_search=$_POST['id_search'];
    $sql="DELETE FROM searched_books WHERE ID_search=$id_search;";
    if(!mysqli_query($conn, $sql)){
        echo "Qualcosa è andato storto";
    }else{
        header("Location: https://www.libriusati.net/profilo.php");
    }
?>