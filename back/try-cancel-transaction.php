<?php

    session_start();
    
    if(isset($_SESSION["ionize_tb_credentials_email"]) and isset($_SESSION["ionize_tb_credentials_password"])) {
        include_once('conn.php');

        // getting transaction data
        $sqlTran = "SELECT pk_tran_id, fk_product_id, total_price,
                    quantity, fk_buyer_id, fk_seller_id
                    FROM tb_transaction 
                    WHERE pk_tran_id='".$_GET['tran_id']."' 
                    AND status='to_send' 
                    AND fk_seller_id='".$_SESSION['ionize_tb_user_pk_user_id']."';";

        $queryTran = mysqli_query($conn, $sqlTran) or die("MySQL Error: " . mysqli_error($conn));
        $fetchTran = mysqli_fetch_assoc($queryTran);

        // print_r($fetchTran);
        // echo "<br><br>";
        // print_r($queryTran);
        // echo "<br><br>";
        // print_r($_SESSION);
        
        // ensures authentication of user seller
        if($queryTran->num_rows == 1 and $fetchTran['fk_seller_id'] == $_SESSION['ionize_tb_user_pk_user_id']) {
            // returning money to the buyer
            $sqlReturning = "UPDATE tb_user 
                    SET balance=balance+".$fetchTran['total_price']."
                    WHERE pk_user_id='".$fetchTran['fk_buyer_id']."';";

            mysqli_query($conn, $sqlReturning) or die("MySQL Error: " . mysqli_error($conn));

            // debiting money from the seller
            $sqlDebiting = "UPDATE tb_user 
                            SET balance=balance-".$fetchTran['total_price']."
                            WHERE pk_user_id='".$fetchTran['fk_seller_id']."';";
            
            mysqli_query($conn, $sqlDebiting) or die("MySQL Error: " . mysqli_error($conn));

            // fix stock
            $sqlStock = "UPDATE tb_product
                         SET stock=stock+".$fetchTran['quantity']."
                         WHERE pk_prod_id='".$fetchTran['fk_product_id']."';";
            
            echo($sqlStock);

            mysqli_query($conn, $sqlStock) or die("MySQL Error: " . mysqli_error($conn));

            // canceling transaction
            $sqlCancel = "UPDATE tb_transaction
                          SET status='canceled'
                          WHERE pk_tran_id='".$fetchTran['pk_tran_id']."';";

            mysqli_query($conn, $sqlCancel) or die("MySQL Error: " . mysqli_error($conn));
            
            // return to page
            header('location:../sales-historic-to-send.php');
        }
    }

?>