<?php
    // include_once("../back/util-functions.php");
    function product_card_generate($conn, $pro_id){
        $sql = "SELECT * FROM tb_product WHERE pk_prod_id='".$pro_id."';";
        $query = mysqli_query($conn, $sql) or die("fodase");
        $fetch = mysqli_fetch_assoc($query);
        // print_r($fetch);
        
        echo('
        <div class="product-card">
            <div class="row justify-content-center">
                <div class="col align-self-center">
                    <img src="users/'.$fetch["img_dir"].'" alt="#" width="100px">
                </div>
                <div class="col-4 align-self-center">
                    <label>'.$fetch["name"] .'</label>
                </div>
                <div class="col align-self-center">
                    <form action="back/try-update-price-stock.php?prod_id='.$fetch["pk_prod_id"].'" method="POST">
                        <label for="product-stock">Estoque:</label><br>
                        <input type="text" mi="0" name="product_stock" value="'.$fetch["stock"].'" size="6"><br>
                        <label for="product-price">Preço: </label>
                        <input type="text" name="product_price" id="price" value="'.$fetch["price"].'" size="6"><br><br>
                </div>
                <div class="col align-self-center">
                    <input type="submit" value="Atualizar" class="btn btn-warning">
                    </form>
                </div>
            </div>
        </div>
        <br>');
    }
?>

