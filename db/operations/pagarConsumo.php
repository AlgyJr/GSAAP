<?php
    include '../connect.php';
    
    $query = "UPDATE FACTURA SET isPaid='1' WHERE factura_id='$_GET[factura_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.log("Data saved!") </script>';

        $data = date('Y-m-d');

        // Criação da factura na base de dados
        $query = "INSERT INTO RECIBO (factura_id, data, valorPago) VALUES ('$_GET[factura_id]', '$data', '$_GET[valorPagar]')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $recibo_id = mysqli_insert_id($conn);

        header("Location: ../../invoice.php?recibo_id=$recibo_id");
    } else {
        echo "<script> alert('Data not saved!') </script>";
    }

    mysqli_close($conn);
?>