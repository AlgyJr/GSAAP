<?php 
    session_start();
    if (!isset($_SESSION["isadmin"])) {
        header('Location: login.php');
    } elseif ($_SESSION["isadmin"] == "0") {
        // 404 page
        header('Location: login.php');
    }
    include 'db/connect.php';
    $title = 'Pagamento';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php
                $entity = "pagamentos";
                include 'includes/navbar.php';
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <legend>Pagamento</legend>

                <!-- Renderização dos dados da tabela -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Leitura</th>
                                <th>Valor a Pagar (MT)</th>
                                <th>Data Emissao</th>
                                <th>Data Limite</th>
                                <th>Opção</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM FACTURA WHERE isPaid = 0");

                                if (mysqli_fetch_array($result)) {
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row['factura_id']."</td>";
                                        echo "<td>".$row['leitura_id']."</td>";
                                        echo "<td>".number_format($row['valorPagar'], 2, ",", ".")."</td>";
                                        echo "<td>".$row['dataEmissao']."</td>";
                                        echo "<td>".$row['dataLimite']."</td>";
                                        echo "<td><a class='btn btn-success' target='_blank' href='db/operations/pagarConsumo.php?factura_id=$row[factura_id]&valorPagar=$row[valorPagar]' style='margin: 0px 10px'>Pagar</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colSpan='8' style='text-align: center'>Nenhuma Factura por pagar</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
<?php require_once 'includes/footer.php'; ?>

</body>
</html>