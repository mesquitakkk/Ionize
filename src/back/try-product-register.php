<?php
    session_start();
    include_once("conn.php");
    include_once("util-functions.php");
    // print_r($_SESSION);
    // echo "<br><br>";
    // print_r($_POST);
    // echo "<br><br>";
    // print_r($_FILES);

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $product_condition = mysqli_real_escape_string($conn, $_POST["product_condition"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $description = mysqli_real_escape_string($conn, $_POST["product_description"]);
    $stock = mysqli_real_escape_string($conn, $_POST["stock"]);

    $sqlInsertProd = "INSERT INTO tb_product(name, product_condition, price, description, stock, fk_category_id, fk_salesman_id) VALUES('".$name."', '".$product_condition."', '".$price."', '".$description."', '".$stock."', '".$_POST['fk_category_id']."', '".$_SESSION['user_id']."')";

    $queryInsertProd = mysqli_query($conn, $sqlInsertProd);

    if($queryInsertProd) {
        echo("<br>success<br>Id: ");
        echo(mysqli_insert_id($conn));

        $file_name = mysqli_insert_id($conn) . ".png";
        $path = "../users/" . $_SESSION["user_id"] . "//prod/" . $file_name;

        if(move_uploaded_file($_FILES["img"]["tmp_name"], $path)){
            echo("<br>success upload");
            $pathInsert = $_SESSION["user_id"] . "//prod/" . $file_name;

            $sqlUpdate = "UPDATE tb_product SET img_dir='".$pathInsert."' WHERE pk_prod_id='".mysqli_insert_id($conn)."'";

            $queryUpdate = mysqli_query($conn, $sqlUpdate);
            if ($queryUpdate) {
                header("location:../announced-products.php");
            } else {
                echo("Error.");
            }
        } else {
            echo("<br>Fail upload");
        }
    } else {
        echo("<br>fail");
    }
?>