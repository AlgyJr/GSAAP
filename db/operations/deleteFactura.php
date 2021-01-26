<?php
    include '../connect.php';
    
    $query = "DELETE FROM FACTURA WHERE factura_id='$_GET[factura_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data deleted!") </script>';
        header('Location: ../../facturas.php');
    } else {
        echo '<script> alert("Data not deleted!") </script>';
    }

    mysqli_close($conn);
?>