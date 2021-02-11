<?php
    include '../connect.php';

    $isAdmin = $_POST['isAdmin'] == 1 ? 1 : 0;
    
    $query = "INSERT INTO FUNCIONARIO (nome, sobrenome, apelido, email, data_nasc, sexo) VALUES ('$_POST[nome]', '$_POST[sobrenome]', '$_POST[apelido]', '$_POST[email]', '$_POST[data_nasc]', '$_POST[sexo]')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.log("Data saved!") </script>';

        $funcionario_id = mysqli_insert_id($conn);

        // Add Employer Morada
        $query = "INSERT INTO MORADA_Func (funcionario_id, provincia, bairro, casa_nr, quarteirao, rua) VALUES ('$funcionario_id', '$_POST[provincia]', '$_POST[bairro]', '$_POST[casa_nr]', '$_POST[quarteirao]', '$_POST[rua]')";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        // Add Employer Phone Number
        $query = "INSERT INTO TELEFONE_Func (funcionario_id, tel) VALUES ('$funcionario_id', '$_POST[tel]')";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        // Create Employer Credential
        $query = "INSERT INTO CREDENCIAL (email, password, isAdmin) VALUES ('$_POST[email]', '$_POST[password]', '$isAdmin')";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        header('Location: ../../funcionarios.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>