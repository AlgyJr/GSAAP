<?php
    include '../connect.php';
    
    $query = "UPDATE CLIENTE SET nome='$_POST[nome]', sobrenome='$_POST[sobrenome]', apelido='$_POST[apelido]', email='$_POST[email]', data_nasc='$_POST[data_nasc]', sexo='$_POST[sexo]' WHERE client_id='$_POST[client_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data saved!") </script>';
        header('Location: ../../clientes.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>