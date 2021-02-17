<?php 
    session_start();
    if (!isset($_SESSION["isadmin"])) {
        header('Location: login.php');
    }
    include 'db/connect.php';
    $title = 'Leituras';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php
                $entity = "leituras";
                include 'includes/navbar.php';
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <legend>Leituras de Consumo</legend>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModalForm">
                Add
                </button>

                <!-- Renderização dos dados da tabela -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cód. Contador</th>
                                <th>Data</th>
                                <th>Consumo (m3)</th>
                                <!-- Check if user is ADMIN (if has privilege for this) -->
                                <?php if ($_SESSION["isadmin"] == "1") { ?>
                                    <th>Opções</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM LEITURACONSUMO");

                                if (mysqli_fetch_array($result)) {
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row['leitura_id']."</td>";
                                        echo "<td>".$row['contador_id']."</td>";
                                        echo "<td>".$row['data']."</td>";
                                        echo "<td>".number_format($row['consumo'], 2, ".", "")."</td>";
                                        // Check if user is ADMIN (if has privilege for this) 
                                        if ($_SESSION["isadmin"] == "1") {
                                            echo "<td><button class='btn btn-primary editbtn' style='margin: 0px 10px'>Editar</button><a class='btn btn-danger' href='db/operations/deleteLeitura.php?leitura_id=$row[leitura_id]' style='margin: 0px 10px'>Apagar</a></td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colSpan='5' style='text-align: center'>Nenhuma leitura</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Adicionar -->
                <div class="modal fade" id="addModalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormLabel">Adicionar Leitura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="db/operations/createLeitura.php" method="POST">
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nr. Contador</label>
                                <select type="number" class="form-control" name="contador_id" required>
                                    <option selected disabled>--</option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT contador_id FROM PROPRIEDADE");

                                        foreach ($result as $row) {
                                            echo "<option value=".$row['contador_id'].">".$row['contador_id']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="data_nasc" class="form-label">Data</label>
                                <input type="date" class="form-control" name="data" value=<?php echo date("Y-m-d") ?>>
                            </div>
                            <div class="col-md-3">
                                <label for="sobrenome" class="form-label">Consumo (m3)</label>
                                <input type="number" inputMode="decimal" class="form-control" min="0" step=".01" name="consumo" value="0.0" placeholder="Introduza o consumo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" name="saveData" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>

                <!-- Modal Editar -->
                <div class="modal fade" id="editModalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormLabel">Editar Leitura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="db/operations/updateLeitura.php" method="POST">
                        <div class="modal-body row g-3">
                            <input type="hidden" name="leitura_id" id="leitura_id" />
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nr. Contador</label>
                                <select type="number" class="form-control" name="contador_id" id="contador_id" required>
                                    <option selected disabled>--</option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT contador_id FROM PROPRIEDADE");

                                        foreach ($result as $row) {
                                            echo "<option value=".$row['contador_id'].">".$row['contador_id']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="data_nasc" class="form-label">Data</label>
                                <input type="date" class="form-control" name="data" id="data" ?>
                            </div>
                            <div class="col-md-3">
                                <label for="sobrenome" class="form-label">Consumo (m3)</label>
                                <input type="number" inputMode="decimal" class="form-control" min="0" step=".01" name="consumo" id="consumo" placeholder="Introduza o consumo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" name="saveData" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                    </div>
                </div>
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

            $('#leitura_id').val(data[0]);
            $('#contador_id').val(data[1]);
            $('#data').val(data[2]);
            $('#consumo').val(data[3]);
        })
    })
</script>

</body>
</html>