<?php include 'db/connect.php'; ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalForm">
  Add
</button>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th>Nome</th>
              <th>Sobrenome</th>
              <th>Apelido</th>
              <th>Email</th>
              <th>Data Nascimento</th>
              <th>Sexo</th>
              <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $result = mysqli_query($conn, "SELECT * FROM CLIENTE");
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['nome']."</td>";
                    echo "<td>".$row['sobrenome']."</td>";
                    echo "<td>".$row['apelido']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['data_nasc']."</td>";
                    echo "<td>".$row['sexo']."</td>";
                    echo "<td><a href='delete' style='margin: 0px 10px'>Apagar</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormLabel">Formulário Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="db/queries/addClient.php" method="POST">
          <div class="modal-body">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Introduza o nome">
            </div>
            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" name="sobrenome" placeholder="Introduza o sobrenome">
            </div>
            <div class="mb-3">
                <label for="apelido" class="form-label">Apelido</label>
                <input type="text" class="form-control" name="apelido" placeholder="Introduza o apelido">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="nome@exemplo.com">
            </div>
            <div class="mb-3">
                <label for="data_nasc" class="form-label">Data de nascimento</label>
                <input type="date" class="form-control" name="data_nasc">
            </div>
            <div class="mb-3">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" name="saveData" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </form>
  </div>
</div>