<?php
    include '../connect.php';
    
    $query = "INSERT INTO CLIENTE (nome, sobrenome, apelido, email, data_nasc, sexo) VALUES ('$_POST[nome]', '$_POST[sobrenome]', '$_POST[apelido]', '$_POST[email]', '$_POST[data_nasc]', '$_POST[sexo]')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.log("Data saved!") </script>';

        $client_id = mysqli_insert_id($conn);

        $query = "INSERT INTO MORADA (client_id, provincia, bairro, casa_nr, quarteirao, rua) VALUES ('$client_id', '$_POST[provincia]', '$_POST[bairro]', '$_POST[casa_nr]', '$_POST[quarteirao]', '$_POST[rua]')";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $query = "INSERT INTO TELEFONE (client_id, tel) VALUES ('$client_id', '$_POST[tel]')";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        header('Location: ../../clientes.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>