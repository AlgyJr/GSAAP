<?php
    include '../connect.php';
    
    $query = "INSERT INTO PROPRIEDADE (client_id, provincia, bairro, codigo_postal, propriedade_nr) VALUES ('$_POST[client_id]', '$_POST[provincia]', '$_POST[bairro]', '$_POST[codigo_postal]', '$_POST[propriedade_nr]')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.log("Data saved!") </script>';
        header('Location: ../../propriedades.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>