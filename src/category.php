<!doctype html>
<html lang="pt-br">
<head>
<title>Ionize - categoria</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/background-font.css">
<link rel="stylesheet" href="css/categoria.css">
</head>
<body>

<?php
    include_once('template/navbar-aut.php');
    include_once('template/product-card.php');
    include_once('back/conn.php');

    $categoryId = $_GET["prod_id"];
?>

<div class="box-container">
    <div class="row justify-content-center">
        <div class="col">
            <?php
                $sqlGetText = "SELECT name FROM tb_category WHERE pk_cat_id='".$categoryId."';";
                $queryGetText = mysqli_query($conn, $sqlGetText);
                $fetchGetText = mysqli_fetch_assoc($queryGetText);

                echo('<h1 class="title">'.$fetchGetText["name"].'</h1>');
                $sqlGetProdIds = "SELECT pk_prod_id FROM tb_product WHERE fk_salesman_id!='".$_SESSION['ionize_tb_user_pk_user_id']."' and fk_category_id='".$categoryId."';";
                $queryGetProdIds = mysqli_query($conn, $sqlGetProdIds);
                $prod_ids = Array();

                while($prodRow = mysqli_fetch_assoc($queryGetProdIds)){
                    array_push($prod_ids, $prodRow["pk_prod_id"]);
                }
            ?>
        </div>
    </div>
    <div class="row justify-content-start">
        <?php
            // $prod_ids = Array();
            if(count($prod_ids) == 0) {
                echo ('<div class="alert alert-danger">Essa categoria não possui produtos disponíveis :c</div>');
            }else{
                foreach($prod_ids as $key => $value) {
                    echo('<div class="col-3">'.prod_card_sale($conn, $value).'</div>');
                }
            } 
        ?>
    </div>
</div>
<!-- <-?php
    print_r($_SESSION);
    echo("<br>");
    print_r($prod_ids);
?> -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>