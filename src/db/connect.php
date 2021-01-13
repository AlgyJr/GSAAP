<?php
    $server = 'localhost';  // Nome do servidor = localhost
    $db     = 'SAAP';       // Nome da base de dados que será aberta
    $user   = 'root';       // Nome do usuário que tem acesso a base de dados
    $pass   = '';           // Senha do usuário (Default vazia)

    // Conexão ao servidor
    $connection = mysqli_connect($server,$user,$pass);
    if (!($connection)) {
        echo "Não foi possível estabelecer a ligação com a Base de Dados";
        exit();
    }

    // Selecionar a Base de Dados
    $select = mysqli_select_db($connection,$db);
    if (!($select)) {
        echo "Não foi possível selecionar o gerenciador MySQL";
        exit();
    }
?>