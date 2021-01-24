<?php
    include '../connect.php';
    
    $query = "DELETE FROM CLIENTE WHERE client_id='$_GET[client_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data deleted!") </script>';
        header('Location: ../../clientes.php');
    } else {
        echo '<script> alert("Data not deleted!") </script>';
    }
?>