<?php
    include '../connect.php';
    
    $query = "UPDATE PROPRIEDADE SET client_id='$_POST[client_id]', pais='$_POST[pais]', provincia='$_POST[provincia]', bairro='$_POST[bairro]', codigo_postal='$_POST[codigo_postal]', propriedade_nr='$_POST[propriedade_nr]' WHERE contador_id='$_POST[contador_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data saved!") </script>';
        header('Location: ../../propriedades.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>