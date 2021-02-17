<?php
    include '../connect.php';
    
    $query = "DELETE FROM RECIBO WHERE recibo_id='$_GET[recibo_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data deleted!") </script>';
        header('Location: ../../recibos.php');
    } else {
        echo '<script> alert("Data not deleted!") </script>';
    }

    mysqli_close($conn);
?>