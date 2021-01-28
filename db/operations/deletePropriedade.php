<?php
    include '../connect.php';
    
    $query = "DELETE FROM PROPRIEDADE WHERE contador_id='$_GET[contador_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data deleted!") </script>';
        header('Location: ../../propriedades.php');
    } else {
        echo '<script> alert("Data not deleted!") </script>';
    }

    mysqli_close($conn);
?>