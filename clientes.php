<?php 
    include 'db/connect.php';

    $result = mysqli_query($connection, "SELECT * FROM CLIENTE");
    while($row = mysqli_fetch_array($result)) {
        echo  $row['nome']."<br/>";
    }
?>