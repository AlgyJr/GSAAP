<?php 
    $title = 'Home';
    require_once 'includes/head.php';
    // Barra de navegação
    include 'includes/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/navbar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php require_once 'funcionarios.php'; ?>
            </main>
        </div>
    </div>
    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
