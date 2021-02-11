<?php
    include '../connect.php';

    
    
    $query = "UPDATE FUNCIONARIO SET nome='$_POST[nome]', sobrenome='$_POST[sobrenome]', apelido='$_POST[apelido]', email='$_POST[email]', data_nasc='$_POST[data_nasc]', sexo='$_POST[sexo]' WHERE funcionario_id='$_POST[funcionario_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data saved!") </script>';

        // Update Employer Morada
        $query = "UPDATE MORADA_FUNC SET provincia='$_POST[provincia]', bairro='$_POST[bairro]', casa_nr='$_POST[casa_nr]', quarteirao='$_POST[quarteirao]', rua='$_POST[rua]' WHERE funcionario_id='$_POST[funcionario_id]'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        // Update Employer Telefone
        $query = "UPDATE TELEFONE_FUNC SET tel='$_POST[tel]' WHERE funcionario_id='$_POST[funcionario_id]'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        // Update Employer Credential
        $password = $_POST['password'];
        $isAdmin = $_POST['isAdmin'] == 1 ? 1 : 0;
        $query = $password == "" ? "UPDATE CREDENCIAL SET isAdmin='$isAdmin' WHERE email='$_POST[email]'" : "UPDATE CREDENCIAL SET password='$password', isAdmin='$isAdmin' WHERE email='$_POST[email]'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        header('Location: ../../funcionarios.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>