<?php
    include '../connect.php';
    
    $query = "UPDATE CLIENTE SET nome='$_POST[nome]', sobrenome='$_POST[sobrenome]', apelido='$_POST[apelido]', email='$_POST[email]', data_nasc='$_POST[data_nasc]', sexo='$_POST[sexo]' WHERE client_id='$_POST[client_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data saved!") </script>';

        // Update Client Morada
        $query = "UPDATE MORADA SET provincia='$_POST[provincia]', bairro='$_POST[bairro]', casa_nr='$_POST[casa_nr]', quarteirao='$_POST[quarteirao]', rua='$_POST[rua]' WHERE client_id='$_POST[client_id]'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        // Update Telefone
        $query = "UPDATE TELEFONE SET tel='$_POST[tel]' WHERE client_id='$_POST[client_id]'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        header('Location: ../../clientes.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>