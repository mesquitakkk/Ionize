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
        // print_r($fetch);
    }

    function prod_card_sale($conn, $prod_id) {
        $sql = "SELECT name, img_dir, price, fk_category_id FROM tb_product WHERE pk_prod_id='".$prod_id."';";
        $query = mysqli_query($conn, $sql);
        $fetch = mysqli_fetch_assoc($query);
        $card = '
        <a href="prod-details.php?cat_id='.$fetch["fk_category_id"].'&prod_id='.$prod_id.'" class="hidden-link">
        <div class="card">
            <img class="card-img-top" src="users/'.$fetch["img_dir"].'" alt="Card image cap">
            <div class="card-body">
                <div class="card-title">'.$fetch["name"].'</div>
                <p class="card-text"><small class="text-success">R$ '.$fetch["price"].'</small></p>
            </div>
        </div>
        </a>
        ';
        return $card;
        // print_r($fetch);
    }
?>