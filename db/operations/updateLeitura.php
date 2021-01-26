<?php
    include '../connect.php';
    
    // Constante valor a pagar
    $PRECOPERLITRO = 120;

    $leitura_id    = $_POST['leitura_id'];
    $consumo       = $_POST['consumo'];
    $dataEmissao   = $_POST['data'];

    $query = "UPDATE LEITURACONSUMO SET contador_id='$_POST[contador_id]', data='$dataEmissao', consumo='$consumo' WHERE leitura_id='$leitura_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script> console.("Data saved!") </script>';

        // Procura do cliente proprietário do contador
        $query = "SELECT client_id FROM PROPRIEDADE WHERE contador_id = '$_POST[contador_id]'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_array($result)) {
            // Procura do número de telefone do cliente proprietário do contador
            $query = "SELECT tel FROM TELEFONE WHERE pessoal_id = '$row[client_id]'";
            $result = mysqli_query($conn, $query);
            
            $number = mysqli_fetch_array($result);
            
            $valorPagar = $consumo * $PRECOPERLITRO;
            $data = strtotime("+14 day", strtotime($dataEmissao));
            $dataLimite = date("Y-m-d", $data);

            // Criação da factura na base de dados
            $query = "INSERT INTO FACTURA (leitura_id, valorPagar, dataEmissao, dataLimite) VALUES ('$leitura_id', '$valorPagar', '$dataEmissao', '$dataLimite')";
            $result = mysqli_query($conn, $query);
            // GET do id do último inserido, uma vez que o campo usa o AUTO_INCREMENT
            $factura_id = mysqli_insert_id($conn);

            // Mensagem a ser enviada ao proprietário do contador
            $msg = "Número da Factura: " . $factura_id . " | Valor a pagar: " . $valorPagar . "MT | Data limite: " . $dataLimite;

            if ($result) {
                include '../../requests/send_sms.php';
            }
        }
        header('Location: ../../leituras.php');
    } else {
        echo '<script> alert("Data not saved!") </script>';
    }

    mysqli_close($conn);
?>