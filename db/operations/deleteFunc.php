<?php
    include '../connect.php';
    
    $query = "DELETE FROM FUNCIONARIO WHERE funcionario_id='$_GET[funcionario_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data deleted!") </script>';
        header('Location: ../../funcionarios.php');
    } else {
        echo '<script> alert("Data not deleted!") </script>';
    }

    mysqli_close($conn);
?>