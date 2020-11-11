<!doctype html>
<html lang="pt-br">
<head>
    <title>Ionize - Início</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/background-font.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/categoria.css">
    </head>
<body>

<?php 
    session_start();
    include_once("template/product-card.php");
    // include_once("back/conn.php");
    if (isset($_SESSION["ionize_tb_credentials_email"]) and isset($_SESSION["ionize_tb_credentials_password"])) {
        include_once("template/navbar-aut.php");
        $user_id = $_SESSION["ionize_tb_user_pk_user_id"];
    } else {
        include_once('template/navbar-travel.php');
        $user_id = 0;
    }

    // get categories id
    $sqlAllCat = "SELECT pk_cat_id, name FROM tb_category";
    $queryAllCat = mysqli_query($conn, $sqlAllCat);
    $categories = Array();

    while ($cat = mysqli_fetch_assoc($queryAllCat)) {

        $sql = "SELECT pk_prod_id
                FROM tb_product 
                WHERE fk_category_id='".$cat['pk_cat_id']."' and fk_salesman_id!='$user_id'
                AND stock>'0';";

        $query = mysqli_query($conn, $sql);

        if ($query->num_rows > 0) {
            array_push($categories, $cat);
        }
    }
    // print_r($categories);
    // show random categories
    while (count($categories) > 0) { 
        $rand_index = array_rand($categories);

        // get products

        $sqlProd = "SELECT * 
                    FROM tb_product
                    WHERE fk_category_id='".$categories[$rand_index]['pk_cat_id']."';";
        $queryProd = mysqli_query($conn, $sqlProd) or die("MySQL Error: " . mysqli_error($conn));

        // rand products
        $products = Array();
        while($fetchProd = mysqli_fetch_assoc($queryProd)) {
            array_push($products, $fetchProd);
        }

        echo('
            <div class="box-container">
                <div class="row justify-content-center">
                    <div class="col">
                        <h1 class="title">
                            '.$categories[$rand_index]["name"].'
                        </h1>
                    </div>
                </div>
                
                <div class="row justify-content-start">
                    ');
        // show product cards
        while(count($products) > 0) {
            $rand_prod_i = array_rand($products, 1);
            // print_r($products);
            echo('<div class="col-3">'.prod_card_sale($conn, $products[$rand_prod_i]['pk_prod_id']).'</div>');

            unset($products[$rand_prod_i]);
            
        }
        echo('
                </div>
            </div>
        ');
        
        unset($categories[$rand_index]);
    }

    
    
    // print_r($catIds);

    // include_once('back/conn.php');
    // echo "<br><br><br>";
    // print_r($_SESSION);
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>