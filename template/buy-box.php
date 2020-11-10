<div id="box-buy">
    <?php if(isset($_SESSION["ionize-transaction-error"])){
        echo('<div class="row justify-content-center">
            <div class="alert alert-danger">'.$_SESSION["ionize-transaction-error"].'</div>
        </div>');
        unset($_SESSION["ionize-transaction-error"]);
    } ?>
    <div class="row" id="top-row">
        <div class="col" id="prod-img">
            <img src="users/<?php echo($fetchProd['img_dir']); ?>" height="150px">
        </div>
        <div class="col">
            <div class="row justify-content-center" id="small-values">
                    <?php
                        echo('R$ '. $fetchProd["price"] .'&nbsp&nbsp Unidades: ' . $_GET["qtd"]);
                    ?>
            </div>
            <div class="row justify-content-center" id="big-value">
                Valor total: R$ <?php echo($totalValue); ?>
            </div>
            <div class="row justify-content-center">
                Endereço de entrega:
            </div>
            <div class="row justify-content-center">
                <?php echo($_SESSION['ionize_tb_user_user_address']); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="row justify-content-center" id="prod-name">
                        <?php echo($fetchProd['name']); ?>
                    </div>
                    <div class="row" id="row-desc">
                        <?php echo($fetchProd['description']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col align-self-center">
            <div class="row justify-content-center">
                saldo anterior: R$ <?php echo($_SESSION['ionize_tb_user_balance']); ?>
            </div>
            <div class="row justify-content-center">
                novo saldo: R$ <?php echo($newBalance); ?>
            </div>
            <div class="row justify-content-center">
                <div class="col">
                    <form action="back/try-transaction.php" method="POST">
                        <div class="row justify-content-center">
                            <input type="text" name="new_balance" value="<?php echo($newBalance); ?>" hidden>
                            <input type="text" name="prod_id" value="<?php echo($fetchProd['pk_prod_id']); ?>" hidden>
                            <input type="text" name="qtd" value="<?php echo($_GET['qtd']); ?>" hidden>
                            <input type="text" name="total_price" value="<?php echo($totalValue); ?>" hidden>
                            <input type="text" name="seller_id" value="<?php echo($fetchProd['fk_salesman_id']); ?>" hidden>
                            <input type="text" name="stock" value="<?php echo($fetchProd['stock']); ?>" hidden>
                            <input type="submit" value="Efetuar compra" class="btn btn-success">
                        </div>
                    </form>
                    <div class="row justify-content-center">
                            <a href="prod-details.php?<?php echo("prod_id=".$_GET['prod_id']."&cat_id=". $fetchProd['fk_category_id']) ?>" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>