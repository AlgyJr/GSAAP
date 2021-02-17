<?php
  session_start();
  include 'db/connect.php';
  $emailErr = $passErr  = false;
  $email    = $password = "";

  // Validate if was submitted
  // Avoid validating on beginning
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email'])) {
      $emailErr = true;
    } else {
      $email = test_input($_POST['email']);
      // check if is a email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = true;
      }
    }

    if (empty($_POST['password'])) {
      $passErr = true;
    } else {
      $password = test_input($_POST['password']);
      // check if password matches
      if ($password) {
        $query = "SELECT * FROM CREDENCIAL WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($result);

        if ($row) {
          if ($row['password'] == $_POST['password']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION["isadmin"] = $row['isAdmin'];
            header('Location: leituras.php');
          } else {
             $passErr = true;
          }
        } else {
          $emailErr = true;
        }
      }
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!DOCTYPE html>
<html lang="pt">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Algy Ali Jr., Edilson Cumbane, and Jhon Calisto">
    <title>SAAP - Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="_css/login.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="body-login">
        <div class="card-login">
            <h1>GSAAP</h1>
            <label for="">Gestor de Sistema de Abastecimento de Água Potável</label>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : '' ?>" name="email" id="email" placeholder="name@example.com" value="<?php echo $email ?>">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?php echo $passErr ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Palavra-passe" value="<?php echo $password ?>">
                    <label for="floatingInput">Palavra-passe</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    
    <?php 
      require_once 'includes/footer.php';
      $stmt->close();
      $conn->close();
    ?>
  </body>
</html>