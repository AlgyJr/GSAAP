<?php 
    session_start();
    if (!isset($_SESSION["isadmin"])) {
        header('Location: login.php');
    } elseif ($_SESSION["isadmin"] == "0") {
        // 404 page
        header('Location: login.php');
    }
    include 'db/connect.php';
    $title = 'Propriedades';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php
                $entity = "propriedades";
                include 'includes/navbar.php';
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <legend>Propriedades</legend>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModalForm">
                Add
                </button>

                <!-- Renderização dos dados da tabela -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nr. Contador</th>
                                <th>Client</th>
                                <th>País</th>
                                <th>Província</th>
                                <th>Bairro</th>
                                <th>Código Postal</th>
                                <th>Nr. Propriedade</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM PROPRIEDADE");

                                if (mysqli_fetch_array($result)) {
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row['contador_id']."</td>";
                                        echo "<td>".$row['client_id']."</td>";
                                        echo "<td>".$row['pais']."</td>";
                                        echo "<td>".$row['provincia']."</td>";
                                        echo "<td>".$row['bairro']."</td>";
                                        echo "<td>".$row['codigo_postal']."</td>";
                                        echo "<td>".$row['propriedade_nr']."</td>";
                                        echo "<td><button class='btn btn-primary editbtn' style='margin: 0px 10px'>Editar</button><a class='btn btn-danger' href='db/operations/deletePropriedade.php?contador_id=$row[contador_id]' style='margin: 0px 10px'>Apagar</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colSpan='8' style='text-align: center'>Nenhuma propriedade</td>";
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
                        <h5 class="modal-title" id="modalFormLabel">Adicionar Propriedade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="db/operations/createPropriedade.php" method="POST">
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label for="client_id" class="form-label">Cliente</label>
                                <select type="number" class="form-control" name="client_id" required>
                                    <option selected disabled>--</option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT client_id, nome FROM CLIENTE");

                                        foreach ($result as $row) {
                                            echo "<option value=".$row['client_id'].">".$row['nome']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="provincia" class="form-label">Província</label>
                                <select class="form-control" name="provincia" required>
                                    <option selected disabled>--</option>
                                    <option value="Maputo">Maputo</option>
                                    <option value="Gaza">Gaza</option>
                                    <option value="Inhambane">Inhambane</option>
                                    <option value="Sofala">Sofala</option>
                                    <option value="Manica">Manica</option>
                                    <option value="Tete">Tete</option>
                                    <option value="Zambezia">Zambezia</option>
                                    <option value="Nampula">Nampula</option>
                                    <option value="Cabo Delgado">Cabo Delgado</option>
                                    <option value="Niassa">Niassa</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro" placeholder="Introduza o bairro" required>
                            </div>
                            <div class="col-md-6">
                                <label for="codigo_postal" class="form-label">Código Postal</label>
                                <input type="number" inputMode="numeric" min="1000" max="1111" class="form-control" name="codigo_postal" placeholder="ZIP" required>
                            </div>
                            <div class="col-md-6">
                                <label for="propriedade_nr" class="form-label">Nr. Propriedade</label>
                                <input type="number" inputMode="numeric" min="0" max="299" class="form-control" name="propriedade_nr" placeholder="Nr. da Propriedade" required>
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
                        <h5 class="modal-title" id="modalFormLabel">Editar Propriedade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="db/operations/updatePropriedade.php" method="POST">
                        <div class="modal-body row g-3">
                            <input type="hidden" name="contador_id" id="contador_id" />
                            <div class="col-md-6">
                                <label for="client_id" class="form-label">Cliente</label>
                                <select type="number" class="form-control" name="client_id" id="client_id" required>
                                    <option selected disabled>--</option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT client_id, nome FROM CLIENTE");

                                        foreach ($result as $row) {
                                            echo "<option value=".$row['client_id'].">".$row['nome']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="provincia" class="form-label">Província</label>
                                <select class="form-control" name="provincia" id="provincia" required>
                                    <option selected disabled>--</option>
                                    <option value="Maputo">Maputo</option>
                                    <option value="Gaza">Gaza</option>
                                    <option value="Inhambane">Inhambane</option>
                                    <option value="Sofala">Sofala</option>
                                    <option value="Manica">Manica</option>
                                    <option value="Tete">Tete</option>
                                    <option value="Zambezia">Zambezia</option>
                                    <option value="Nampula">Nampula</option>
                                    <option value="Cabo Delgado">Cabo Delgado</option>
                                    <option value="Niassa">Niassa</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Introduza o bairro">
                            </div>
                            <div class="col-md-6">
                                <label for="codigo_postal" class="form-label">Código Postal</label>
                                <input type="number" inputMode="numeric" min="1000" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="ZIP" required>
                            </div>
                            <div class="col-md-6">
                                <label for="propriedade_nr" class="form-label">Nr. Propriedade</label>
                                <input type="number" inputMode="numeric" min="0" class="form-control" name="propriedade_nr" id="propriedade_nr" placeholder="Nr. da Propriedade" required>
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

            $('#contador_id').val(data[0]);
            $('#client_id').val(data[1]);
            $('#provincia').val(data[3]);
            $('#bairro').val(data[4]);
            $('#codigo_postal').val(data[5]);
            $('#propriedade_nr').val(data[6]);
        })
    })
</script>

</body>
</html>