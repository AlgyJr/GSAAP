<?php
    include '../connect.php';
    
    $query = "INSERT INTO CLIENTE (nome, sobrenome, apelido, email, data_nasc, sexo) VALUES ('$_POST[nome]', '$_POST[sobrenome]', '$_POST[apelido]', '$_POST[email]', '$_POST[data_nasc]', '$_POST[sexo]')";

    $result = mysqli_query($conn, $query) or die("Não foi possível inserir:" . mysqli_query_error());
?>