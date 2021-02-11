    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "leituras" ? "active" : "";?>" href="leituras.php">
              <span data-feather="bar-chart-2"></span>
              Leituras
            </a>
          </li>
          <?php if ($_SESSION["isadmin"] == "1") { ?>
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "clientes" ? "active" : "";?>" href="clientes.php">
              <span data-feather="shopping-cart"></span>
              Clientes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "propriedades" ? "active" : "";?>" href="propriedades.php">
              <span data-feather="users"></span>
              Propriedades
            </a>
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "funcionarios" ? "active" : "";?>" href="funcionarios.php">
              <span data-feather="file"></span>
              Funcionários
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "pagamentos" ? "active" : "";?>" href="pagamentos.php">
              <span data-feather="file"></span>
              Pagamento
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "recibos" ? "active" : "";?>" href="recibos.php">
              <span data-feather="file"></span>
              Recibos
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link <?php echo $entity == "facturas" ? "active" : "";?>" href="facturas.php">
              <span data-feather="layers"></span>
              Facturas
            </a>
          </li>
        </ul>

        <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul> -->
      </div>
    </nav>