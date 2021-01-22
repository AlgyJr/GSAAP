<?php
    $server = 'localhost';  // Nome do servidor = localhost
    $db     = 'SAAP';       // Nome da base de dados que será aberta
    $user   = 'root';       // Nome do usuário que tem acesso a base de dados
    $pass   = '';           // Senha do usuário (Default vazia)

    // Conexão ao servidor
    $conn = mysqli_connect($server,$user,$pass);
    if (!$conn) {
        die("A conexão a base de dados falhou: " . mysqli_connect_error());
    }

    // Selecionar a Base de Dados
    $select = mysqli_select_db($conn,$db);
    if (!($select)) {
        echo "Não foi possível selecionar o gerenciador MySQL";
        exit();
    }
?>