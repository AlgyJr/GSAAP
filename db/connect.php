<?php
    $server = 'localhost';  // Nome do servidor = localhost
    $db     = 'SAAP';       // Nome da base de dados que será aberta
    $user   = 'root';       // Nome do usuário que tem acesso a base de dados
    $pass   = '';           // Senha do usuário (Default vazia)

    // Conexão ao servidor
    $conn = mysqli_connect($server, $user, $pass, $db);
    if (!$conn) {
        die("A conexão a base de dados falhou: " . mysqli_connect_error());
    }
?>