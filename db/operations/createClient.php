<?php
    include '../connect.php';
    
    $query = "INSERT INTO CLIENTE (nome, sobrenome, apelido, email, data_nasc, sexo) VALUES ('$_POST[nome]', '$_POST[sobrenome]', '$_POST[apelido]', '$_POST[email]', '$_POST[data_nasc]', '$_POST[sexo]')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.log("Data saved!") </script>';
        header('Location: ../../clientes.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>