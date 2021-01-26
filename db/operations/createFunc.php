<?php
    include '../connect.php';

    $isAdmin = $_POST['isAdmin'] == 1 ? 1 : 0;
    
    $query = "INSERT INTO FUNCIONARIO (nome, sobrenome, apelido, email, data_nasc, sexo, isAdmin) VALUES ('$_POST[nome]', '$_POST[sobrenome]', '$_POST[apelido]', '$_POST[email]', '$_POST[data_nasc]', '$_POST[sexo]', '$isAdmin')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.log("Data saved!") </script>';
        header('Location: ../../funcionarios.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>