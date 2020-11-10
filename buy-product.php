<!doctype html>
<html lang="pt-br">
<head>
<title>Ionize - Compra</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/background-font.css">
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/buy-product.css">
</head>
<body>


<?php
    session_start();

    // need login 
    if (!isset($_SESSION["ionize_tb_credentials_email"]) and !isset($_SESSION["ionize_tb_credentials_password"])) {
        include_once("template/need-login.php");
    } else {
        include_once('template/navbar-aut.php');
        include_once('back/conn.php');

        $sqlProd = "SELECT * FROM tb_product WHERE pk_prod_id='".$_GET['prod_id']."'";

        if ($queryProd = mysqli_query($conn, $sqlProd)) {
            $fetchProd = mysqli_fetch_assoc($queryProd);
            $totalValue = $fetchProd["price"] * $_GET["qtd"];
            $newBalance = $_SESSION["ionize_tb_user_balance"] - $totalValue;
        } else {
            die('MySQL Error: '. mysqli_error($conn));
        }  

        include_once('template/buy-box.php');
    }
?>

<?php
    // print_r($_GET);
    // echo "<br>";
    // print_r($fetchProd);
    // echo "<br>";
    // print_r($_SESSION);
    // mysqli_close($conn);
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>