<?php 
    session_start();
    if (!isset($_SESSION["isadmin"])) {
        header('Location: login.php');
    } elseif ($_SESSION["isadmin"] == "0") {
        // 404 page
        header('Location: login.php');
    }
    include 'db/connect.php';
    $title = 'Recibos';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php
                $entity = "recibos";
                include 'includes/navbar.php';
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <legend>Recibos</legend>
                <!-- Renderização dos dados da tabela -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nr. Factura</th>
                                <th>Data</th>
                                <th>Valor Pago (MT)</th>
                                <th>Opção</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM RECIBO");

                                if (mysqli_fetch_array($result)) {
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row['recibo_id']."</td>";
                                        echo "<td>".$row['factura_id']."</td>";
                                        echo "<td>".$row['data']."</td>";
                                        echo "<td>".number_format($row['valorPago'], 2, ",", ".")."</td>";
                                        echo "<td>
                                                <a class='btn btn-link' target='_blank' href='./invoice.php?recibo_id=$row[recibo_id]' style='margin: 0px 10px'>Imprimir</a>
                                                <a class='btn btn-danger' href='db/operations/deleteRecibo.php?recibo_id=$row[recibo_id]' style='margin: 0px 10px'>Apagar</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colSpan='8' style='text-align: center'>Nenhum Recibo</td>";
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
