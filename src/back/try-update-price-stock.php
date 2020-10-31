<?php
    // print_r($_POST);
    // print_r($_GET);

    include_once("conn.php");

    $sqlUpdateProd = "UPDATE tb_product SET price='".$_POST['product_price']."', stock='".$_POST['product_stock']."' WHERE pk_prod_id='".$_GET['prod_id']."';";
    $queryUpdateProd = mysqli_query($conn, $sqlUpdateProd) or die("morre");

    header("location:../announced-products.php");
?>