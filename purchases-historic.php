<!doctype html>
<html lang="pt-br">
<head>
<title>Ionize - Histórico de compras</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/background-font.css">
<link rel="stylesheet" href="css/purchases-historic.css">
</head>
<body>

<?php
    session_start();
    include_once('back/util-functions.php');

    if (isset($_SESSION['ionize_tb_credentials_email']) and isset($_SESSION['ionize_tb_credentials_password'])) {
        include_once('template/navbar-aut.php');
    } else {
        session_clear();
        header('location:index.php');
    }
?>

<h1>Histórico de compras</h1>

<?php
    include_once('back/conn.php');

    // get transactions ids
    $sqlTranIds = "SELECT * FROM tb_transaction WHERE fk_buyer_id='".$_SESSION['user_id']."'";
    $queryTranIds = mysqli_query($conn, $sqlTranIds);
    if ($queryTranIds->num_rows == 0) {
        echo (  '<div class="alert alert-danger">Nenhuma compra foi encontrada :c</div>');
    } else {
        while($fetchTranIds = mysqli_fetch_assoc($queryTranIds)) {
            // array_push($tranIds, $fetchTranIds['pk_tran_id']);
            purchases_list($fetchTranIds, $conn);
        }
    }
    
    // if (!$fetchTranIds) {
    //     echo "Você ainda não realizou compras!";
    // }

    // show transactions
    // foreach ($tranIds as $key => $value) {
        // purchases_historic($value);
    // }
?>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

