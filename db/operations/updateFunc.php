<?php
    include '../connect.php';

    $isAdmin = $_POST['isAdmin'] == 1 ? 1 : 0;
    
    $query = "UPDATE FUNCIONARIO SET nome='$_POST[nome]', sobrenome='$_POST[sobrenome]', apelido='$_POST[apelido]', email='$_POST[email]', data_nasc='$_POST[data_nasc]', sexo='$_POST[sexo]', isAdmin='$isAdmin' WHERE funcionario_id='$_POST[funcionario_id]'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data saved!") </script>';
        header('Location: ../../funcionarios.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>