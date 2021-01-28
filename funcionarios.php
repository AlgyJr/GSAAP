<?php 
    include 'db/connect.php';
    $title = 'Funcionários';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php
                $entity = "funcionarios";
                include 'includes/navbar.php';
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <legend>Funcionários</legend>
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
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Apelido</th>
                                <th>Email</th>
                                <th>Data Nascimento</th>
                                <th>Sexo</th>
                                <th>Admin</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM FUNCIONARIO");

                                if (mysqli_fetch_array($result)) {
                                    foreach ($result as $row) {
                                        $isAdmin = $row['isAdmin'] == 1 ? "Sim" : "Não";
                                        echo "<tr>";
                                        echo "<td>".$row['funcionario_id']."</td>";
                                        echo "<td>".$row['nome']."</td>";
                                        echo "<td>".$row['sobrenome']."</td>";
                                        echo "<td>".$row['apelido']."</td>";
                                        echo "<td>".$row['email']."</td>";
                                        echo "<td>".$row['data_nasc']."</td>";
                                        echo "<td>".$row['sexo']."</td>";
                                        echo "<td>".$isAdmin."</td>";
                                        echo "<td><button class='btn btn-primary editbtn' style='margin: 0px 10px'>Editar</button><a class='btn btn-danger' href='db/operations/deleteFunc.php?funcionario_id=$row[funcionario_id]' style='margin: 0px 10px'>Apagar</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colSpan='9' style='text-align: center'>Nenhum Funcionário</td>";
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
                        <h5 class="modal-title" id="modalFormLabel">Adicionar Funcionário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="db/operations/createFunc.php" method="POST">
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" placeholder="Introduza o nome">
                            </div>
                            <div class="col-md-6">
                                <label for="sobrenome" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" name="sobrenome" placeholder="Introduza o sobrenome">
                            </div>
                            <div class="col-md-6">
                                <label for="apelido" class="form-label">Apelido</label>
                                <input type="text" class="form-control" name="apelido" placeholder="Introduza o apelido">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="nome@exemplo.com">
                            </div>
                            <div class="col-md-6">
                                <label for="data_nasc" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" name="data_nasc">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Sexo</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="masculino" checked value="M">
                                    <label class="form-check-label" for="masculino">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="feminino" value="F">
                                    <label class="form-check-label" for="feminino">
                                        Feminino
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="isAdmin">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <b>Admin</b>
                                    </label>
                                </div>
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
                        <h5 class="modal-title" id="modalFormLabel">Editar Funcionário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="db/operations/updateFunc.php" method="POST">
                        <div class="modal-body row g-3">
                            <input type="hidden" name="funcionario_id" id="client_id" />
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Introduza o nome">
                            </div>
                            <div class="col-md-6">
                                <label for="sobrenome" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Introduza o sobrenome">
                            </div>
                            <div class="col-md-6">
                                <label for="apelido" class="form-label">Apelido</label>
                                <input type="text" class="form-control" name="apelido" id="apelido" placeholder="Introduza o apelido">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="nome@exemplo.com">
                            </div>
                            <div class="col-md-6">
                                <label for="data_nasc" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" name="data_nasc" id="data_nasc">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Sexo</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="male" checked value="M">
                                    <label class="form-check-label" for="male">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="female" value="F">
                                    <label class="form-check-label" for="female">
                                        Feminino
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="isAdmin" id="isAdmin">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <b>Admin</b>
                                    </label>
                                </div>
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

            $('#client_id').val(data[0]);
            $('#nome').val(data[1]);
            $('#sobrenome').val(data[2]);
            $('#apelido').val(data[3]);
            $('#email').val(data[4]);
            $('#data_nasc').val(data[5]);
            data[6] == 'M' ? $('#male').prop("checked", true) : $('#female').prop("checked", true);
            $('#isAdmin').prop("checked", data[7] == "Sim");
            console.log(data[7] == "Sim");
        })
    })
</script>

</body>
</html>