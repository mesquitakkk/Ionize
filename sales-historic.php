<!doctype html>
<html lang="pt-br">
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
                <li class ="active nav-item">
                    <a class ="nav-link" href="sales-historic.php"> <h4>Vendas</h4></a>
                </li>
                <li class ="nav-item">
                    <a class ="nav-link" href="sales-historic-to-send.php"> p Enviar </a>
                </li>
                <li class ="nav-item">
                <a class ="nav-link" href="sales-historic-in-transit.php"> em Trânsito </a>
                </li>
                <li class ="nav-item">
                    <a class ="nav-link" href="sales-historic-done.php"> Concluídas </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-9">
        <div id="content-box">
            <?php
                include_once('back/conn.php');

                // get transactions and your status
                $sqlTranName = "SELECT tb_product.name, tb_transaction.status
                                FROM tb_product
                                INNER JOIN tb_transaction 
                                ON tb_product.pk_prod_id=tb_transaction.fk_product_id
                                WHERE tb_product.fk_salesman_id='".$_SESSION['ionize_tb_user_pk_user_id']."';";
                $queryTranName = mysqli_query($conn, $sqlTranName);
                $arrayTranName = Array();
                $to_send = 0;
                $in_transit = 0;
                $done = 0;
                while($fecthTranName = mysqli_fetch_assoc($queryTranName)) {
                    if ($fecthTranName['status'] == 'to_send') {
                        $to_send += 1;
                    } elseif ($fecthTranName['status'] == 'in_transit') {
                        $in_transit += 1;
                    } elseif ($fecthTranName['status'] == 'done') {
                        $done += 1;
                    }
                    array_push($arrayTranName, $fecthTranName);
                };
            ?>
            <div class="row align-center">
                <div class="col">p Enviar (<?php echo($to_send); ?>)</div>
                <div class="col">em Trânsito (<?php echo($in_transit); ?>)</div>
                <div class="col">Concluídos (<?php echo($done); ?>)</div>
            </div>
            <hr>
            <div class="row align-center">
                <div class="col">
                    <?php
                        foreach ($arrayTranName as $key => $value) {
                            if ($value['status'] == 'to_send') {
                                echo('<div class="row item-list"><p>'.$value['name'].'</p></div>');
                            }
                        }
                    ?>
                </div>
                <div class="col">
                    <?php
                        foreach ($arrayTranName as $key => $value) {
                            if ($value['status'] == 'in_transit') {
                                echo('<div class="row item-list"><p>'.$value['name'].'</p></div>');
                            }
                        }
                    ?>
                </div>
                <div class="col">
                    <?php
                        foreach ($arrayTranName as $key => $value) {
                            if ($value['status'] == 'done') {
                                echo('<div class="row item-list"><p>'.$value['name'].'</p></div>');
                            }
                        }
                    ?>
                </div>
            </div>
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