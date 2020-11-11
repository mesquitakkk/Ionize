<!doctype html>
<html lang="pt-BR">
<head>
<title>Ionize - Vendas</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/background-font.css">
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/sales-historic.css">
</head>
<body>

<?php
    session_start();
    include_once('back/util-functions.php');

    if (isset($_SESSION["ionize_tb_credentials_email"]) and isset($_SESSION["ionize_tb_credentials_password"])) {
        include_once('template/navbar-aut.php');
        include_once('back/conn.php');
    } else {
        session_clear();
        header('location:index.php');
    }
?>

<h1>histórico de vendas</h1>

<div class="row justify-content-center" id="main-box">
    <div class="col">
        <nav class ="navbar" id="left-menu">
            <ul class ="nav navbar-nav">
                <li class ="nav-item">
                    <a class ="nav-link" href="sales-historic.php"> <h4>Vendas</h4></a>
                </li>
                <li class ="nav-item">
                    <a class ="nav-link" href="sales-historic-to-send.php"> p Enviar </a>
                </li>
                <li class ="nav-item">
                <a class ="nav-link" href="sales-historic-in-transit.php"> em Trânsito </a>
                </li>
                <li class ="active nav-item">
                    <a class ="nav-link" href="sales-historic-done.php"> Concluídas </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-9">
        <div id="content-box">
            <?php
                include_once('back/conn.php');
                include_once('template/product-card.php');

                // get transactions and your status
                $sqlTran = "SELECT tb_transaction.pk_tran_id, tb_user.username, tb_user.user_address, tb_product.name,
                            tb_product.img_dir, tb_transaction.pk_tran_id, tb_transaction.quantity, tb_transaction.total_price
                            FROM tb_user
                            INNER JOIN tb_transaction ON tb_user.pk_user_id=tb_transaction.fk_buyer_id
                            INNER JOIN tb_product ON tb_transaction.fk_product_id=tb_product.pk_prod_id
                            WHERE tb_transaction.status='done' and tb_transaction.fk_seller_id='".$_SESSION['ionize_tb_user_pk_user_id']."';";

                $queryTran = mysqli_query($conn, $sqlTran) or die('MySQL Error: ' . mysqli_error($conn));

                // generating to-send cards
                while($fetchTran = mysqli_fetch_assoc($queryTran)) {
                    done_card($fetchTran);
                    // print_r($fetchTran);
                }
            ?>
        </div>
    </div>
</div>

<?php 
    // print_r($status);
    // echo "<br>
    // to send: $to_send
    // in transit: $in_transit
    // done: $done";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>