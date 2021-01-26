<?php 
    include 'db/connect.php';
    $title = 'Home';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php
                $entity = "facturas";
                include 'includes/navbar.php';
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Renderização dos dados da tabela -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Leitura</th>
                                <th>Valor a Pagar</th>
                                <th>Data Emissao</th>
                                <th>Data Limite</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM FACTURA");

                                if (mysqli_fetch_array($result)) {
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row['factura_id']."</td>";
                                        echo "<td>".$row['leitura_id']."</td>";
                                        echo "<td>".$row['valorPagar']."</td>";
                                        echo "<td>".$row['dataEmissao']."</td>";
                                        echo "<td>".$row['dataLimite']."</td>";
                                        echo "<td><a class='btn btn-danger' href='db/operations/deleteFactura.php?factura_id=$row[factura_id]' style='margin: 0px 10px'>Apagar</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colSpan='8' style='text-align: center'>Nenhum Cliente</td>";
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

<script>
    $(document).ready(function () { 
        $('.editbtn').on('click', function () {
            $('#editModalForm').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            });

            console.log(data);

            $('#client_id').val(data[0]);
            $('#nome').val(data[1]);
            $('#sobrenome').val(data[2]);
            $('#apelido').val(data[3]);
            $('#email').val(data[4]);
            $('#data_nasc').val(data[5]);
            data[6] == 'M' ? $('#male').prop("checked", true) : $('#female').prop("checked", true);
        })
    })
</script>

</body>
</html>
