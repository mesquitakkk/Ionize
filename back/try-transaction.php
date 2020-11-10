<?php
    session_start();
    // print_r($_POST);
    // echo "<br><br>";
    
    if ($_POST['new_balance'] < 0 and $_POST['stock'] > 0) {
        $_SESSION['ionize-transaction-error'] = 'Saldo insuficiente';
        header('location:../buy-product.php?prod_id='. $_POST['prod_id'] . '&qtd=' .$_POST['qtd']);
    } else {
        include_once('conn.php');

        // transaction
        $sqlTran = "INSERT INTO tb_transaction(fk_product_id, total_price, quantity, status, fk_buyer_id, fk_seller_id) 
        VALUES('".$_POST['prod_id']."', '".$_POST['total_price']."', '".$_POST['qtd']."', 'to_send', '".$_SESSION['user_id']."', '".$_POST['seller_id']."');";
        $queryTran = mysqli_query($conn, $sqlTran);

        if(!$queryTran) {
            $_SESSION['ionize-transaction-error'] = 'MySQL Error: ' . mysqli_error($conn);
            header('location:../buy-product.php?prod_id='. $_POST['prod_id'] . '&qtd=' .$_POST['qtd']);
        } else {
            
            // debiting value
            $sqlDebiting = "UPDATE tb_user SET balance=balance-".$_POST['total_price']."
                           WHERE pk_user_id='".$_SESSION['user_id']."';";
            $queryDebiting = mysqli_query($conn, $sqlDebiting);

            if(!$queryDebiting) {
                $_SESSION['ionize-transaction-error'] = 'MySQL Error: ' . mysqli_error($conn);
                header('location:../buy-product.php?prod_id='. $_POST['prod_id'] . '&qtd=' .$_POST['qtd']);
            } else {
                // paying the seller
                $sqlPaySeller = "UPDATE tb_user SET balance=balance+".$_POST['total_price']."
                WHERE pk_user_id='".$_POST['seller_id']."';";
                $queryPaySeller = mysqli_query($conn, $sqlPaySeller);

                if(!$queryPaySeller) {
                    $_SESSION['ionize-transaction-error'] = 'MySQL Error: ' . mysqli_error($conn);
                    header('location:../buy-product.php?prod_id='. $_POST['prod_id'] . '&qtd=' .$_POST['qtd']);
                } else {
                    // subtract stock
                    $sqlStock = "UPDATE tb_product 
                                 SET stock=stock-".$_POST['qtd']."
                                 WHERE pk_prod_id='".$_POST['prod_id']."'";

                    $queryStock = mysqli_query($conn, $sqlStock);
                    if (!$queryStock) {
                        $_SESSION['ionize-transaction-error'] = 'MySQL Error: ' . mysqli_error($conn);
                        header('location:../buy-product.php?prod_id='. $_POST['prod_id'] . '&qtd=' .$_POST['qtd']);
                    } else {
                        $_SESSION['transaction_status'] = "Compra Efetuada com sucesso!";
                        header('location:../purchases-historic.php');
                    }
                }
            }
        }
    }

    // echo "<br><br>";
    // print_r($_SESSION);
    // echo "<br><br>";
    // print();
?>