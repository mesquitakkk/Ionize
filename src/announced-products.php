<!doctype html>
<html lang="pt-br">
<head>
<title>Ionize - Produtos Anunciados</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/background-font.css">
<link rel="stylesheet" href="css/announced.css">
<body>
<?php
    include_once("back/util-functions.php");
    session_start();

    if (isset($_SESSION["ionize_tb_credentials_email"]) and isset($_SESSION["ionize_tb_credentials_password"])) {
        include_once("template/navbar-aut.php");
        include_once("back/conn.php");
        $productsIds = select_ids($conn, "tb_product", "pk_prod_id", $_SESSION["ionize_tb_credentials_fk_user_id"]);
    } else {
        session_clear();
        header('location:index.php');
    }
?>

<div class="container-box">
    <div class="row justify-content-center">
        <div class="col-3">
            <label class="title">Produtos Anunciados</label>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-3">
            <a href="product-register.php" class="center"><button class="btn btn-success">Novo Produto +</button></a>
        </div>
    </div>
    <br>
    <?php
        include_once("template/product-card.php");
        for ($i=0; $i < count($productsIds); $i++) { 
            product_card_generate($conn, $productsIds[$i]);
        }
    ?>
</div>

<?php
    // print_r($productsIds);
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $("#price").on('input',function(event) {
        this.value = parseFloat(this.value.replace(/(.*){1}/, '0$1').replace(/[^\d]/g, '').replace(/(\d\d?)$/, '.$1')).toFixed(2);
    });
</script>
</body>
</html>