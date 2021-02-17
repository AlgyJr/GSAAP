<?php
    session_start();
    if (!isset($_SESSION["isadmin"])) {
        header('Location: login.php');
    } elseif ($_SESSION["isadmin"] == "0") {
        // 404 page
        header('Location: login.php');
    }
    include 'db/connect.php';

    // Dados do Funcionario
    $query = "SELECT nome, apelido FROM Funcionario WHERE email = '$_SESSION[email]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $funcionario = mysqli_fetch_array($result);

    $cobrador = $funcionario['nome'].' '.$funcionario['apelido'];

    // Dados do Recibo
    $query = "SELECT * FROM Recibo WHERE recibo_id='$_GET[recibo_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $recibo = mysqli_fetch_array($result);

    // Dados da Factura
    $query = "SELECT leitura_id FROM Factura WHERE factura_id='$recibo[factura_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $factura = mysqli_fetch_array($result);

    // Dados da Leitura
    $query = "SELECT contador_id FROM LeituraConsumo WHERE leitura_id='$factura[leitura_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $leitura = mysqli_fetch_array($result);

    // Dados da propriedade
    $query = "SELECT * FROM Propriedade WHERE contador_id='$leitura[contador_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $propriedade = mysqli_fetch_array($result);

    // Dados do Cliente
    $query = "SELECT * FROM Cliente WHERE client_id='$propriedade[client_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $cliente = mysqli_fetch_array($result);

    // Dados do morada do cliente
    $query = "SELECT * FROM Morada WHERE client_id='$cliente[client_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $morada = mysqli_fetch_array($result);
?>
<!-- tag link, for Bootstrap -->

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        .right_board {
            border: 5px solid rgba(126, 126, 126, 0.60);
            border-left: 0;
            border-top: 0;

            width: 350px;
            padding: 0 10px 10px 10px;

            float: right;

        }

        .receipt_data {
            display: block;
            /* align-items: center; */
            
            border: 1px solid #000000;
            width: fit-content;
            margin: 10px;
            padding: 10px;
        }

        .receipt_data:first-child { margin-left: 0;}

        .receipt_data * {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Top left -->
        <h4 style="margin-bottom: 0px">SAAP</h4>
        <p style="font-size: 10px">Sistema de Abastecimento de Água Potável</p>

        <!-- Top Right -->
        <h6 style="position: absolute; top: 0; right: 200px;">RECIBO</h6>

        Cobrado por <?php echo $cobrador; ?></br></br>

        <!-- Nome do cliente e morada -->
        <div class="right_board" >
            <b><?php echo $cliente['nome']." ".$cliente['sobrenome']." ".$cliente['apelido'] ?></b></br></br>
            <b><?php echo $morada['rua']; ?></b></br>
            <b><?php echo "QT. ".$morada['quarteirao']."   ".$morada['bairro']; ?></b></br>
            <b><?php echo $morada['provincia']; ?></b></br>
        </div>

        LOCAL DE ABASTECIMENTO</br>
        <!-- Dados da propriedade -->
        <b><?php echo $propriedade['bairro']; ?></b></br>
        <b><?php echo $propriedade['propriedade_nr']."  ".$propriedade['provincia']; ?></b></br>
        </br>

        CLIENTE</br>
        <!-- Dados do Cliente -->
        <b><?php echo $cliente['nome']." ".$cliente['sobrenome']." ".$cliente['apelido'] ?></b></br>
        COD. CLIENTE</br>
        <b><?php echo $cliente['client_id']; ?></b></br>

        <!-- Float right -->
        <!-- Dados do recibo -->

        <div style="display: flex">
            <div class="receipt_data">
                VALOR <b><?php echo number_format($recibo['valorPago'], 2, ",", ".")." MT"?></b></br>
            </div>
            <div class="receipt_data">
                RECIBO Nº <b><?php echo $_GET['recibo_id']; ?></b>
            </div>
            <div class="receipt_data">
                DATA DE EMISSAO <b><?php echo $recibo['data']; ?></b>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>FACTURA Nº.</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $recibo['factura_id']?></td>
                    <td><?php echo number_format($recibo['valorPago'], 2, ",", ".")." MT"?></td>
                </tr>
            </tbody>
        </table>
        <!-- Date and  -->
        </br></br>Cobrado por <?php echo $cobrador; ?>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
