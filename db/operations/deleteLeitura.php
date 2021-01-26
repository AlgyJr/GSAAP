<?php
    include '../connect.php';
    
    $query = "DELETE FROM LEITURACONSUMO WHERE leitura_id='$_GET[leitura_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data deleted!") </script>';
        header('Location: ../../leituras.php');
    } else {
        echo '<script> alert("Data not deleted!") </script>';
    }

    mysqli_close($conn);
?>