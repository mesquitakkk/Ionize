<?php
    // session_unset();
    function verify_field_already($field_name){
        if(isset($_SESSION["ionize_error_".$field_name])) {
            $error = $_SESSION["ionize_error_".$field_name];
            echo('
            <br><div class="alert alert-danger" role="alert">'.
            $error
            .'</div>
            ');
        }
    }
    function verify_field($field_name){
        if(isset($_SESSION[$field_name])){
            echo('value="'.$_SESSION[$field_name].'"');
        }
    }
    // returning query values to dropdown
    function dropdown_item($categories) {
        $string = '';
        foreach($categories as $key => $value){
            $_POST['category_id_'.$key] = $key;
            $string = $string . '<a class="dropdown-item" href="category.php?cat_id='.$value["pk_cat_id"].'">'.$value['name'].'</a>';
        }
        return $string;
    }
    function dropdown_item_option($categories) {
        $string = '';
        foreach($categories as $key => $value){
            $_POST['category_id_'.$key] = $key;
            $string = $string . '<option value="'.$value["pk_cat_id"].'">'.$value["name"].'</option>';
        }
        echo($string);
    }
    // SELECT * FROM any table and add values to _SESSION
    function select_all($table_name, $primary_key_name, $primary_key_value) {
        include('conn.php');
        $sql = "SELECT * FROM $table_name WHERE $primary_key_name='$primary_key_value'";
        $query = mysqli_query($conn, $sql);
        if($query){
            if(!isset($_SESSION)){
                session_start();
            }
            $fetch = mysqli_fetch_assoc($query);
            foreach($fetch as $key => $value) {
                $_SESSION['ionize_'.$table_name.'_'.$key] = $value;
            }
        }else{
            echo("SQL Error: ". mysqli_error($conn));
        }
    }
    function select_ids($conn, $table_name, $id_name, $id_user) {
        $sql = "SELECT ".$id_name." FROM ".$table_name." WHERE fk_salesman_id='".$id_user."';";
        $array = Array();
        $query = mysqli_query($conn, $sql);
        while($fetch = mysqli_fetch_assoc($query)){
            array_push($array, $fetch["pk_prod_id"]);
        }
        return $array;
    }
    // limpa sessão
    function session_clear() {
        session_start();

        // Apaga todas as variáveis da sessão
        $_SESSION = array();

        // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
        // Nota: Isto destruirá a sessão, e não apenas os dados!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Por último, destrói a sessão
        session_destroy();
    }
    // change a file extension to png
    function change_to_png($filename) {
        $array = explode(".", $filename);
        return $array[0] . "." . "png";
    }
    
    // purchases historic
    function purchases_list($tran, $conn) {
        // get product datas
        $sqlProd = "SELECT name, img_dir, fk_salesman_id FROM tb_product WHERE pk_prod_id='".$tran['fk_product_id']."'";
        $queryProd = mysqli_query($conn, $sqlProd);
        
        
        $fetchProd = mysqli_fetch_assoc($queryProd);
        // get salesman name
        $sqlSalesman = "SELECT username FROM tb_user WHERE pk_user_id='".$fetchProd['fk_salesman_id']."';";
        $querySalesman = mysqli_query($conn, $sqlSalesman);
        $fetchSalesman = mysqli_fetch_assoc($querySalesman);

        if ($tran['status'] == 'to_send'){
            $status_class = "transit";
            $status_text = "Preparando o envio";
            $button = "";
            $bg_color = "bg-yellow";
        } elseif ($tran['status'] == 'in_transit') {
            $status_class = "transit";
            $status_text = "Em trânsito";
            $button =  '<form action="back/confirm-receivement.php" method="POST">
                            <div class="row justify-content-center">
                            <input type="text" name="tran_id" value="'.$tran["pk_tran_id"].'" hidden>
                                <input type="submit" value="Já recebi" class="btn btn-success">
                            </div>
                        </form>';
            $bg_color = "bg-yellow";
        } elseif ($tran['status'] == 'done') {
            $status_class = "received";
            $status_text = "Entregue";
            $button = "";
            $bg_color = "bg-green";
        } 
        elseif ($tran['status'] == 'canceled') {
            $status_class = "canceled";
            $status_text = "Compra cancelada, você já foi reembolsado!";
            $button = "";
            $bg_color = "bg-red";
        }
        // print_r($tran);
        // echo "<br><br>";
        
        // echo "<br><br>";
        // print_r($fetchSalesman);
        echo('<div class="row justify-content-center '.$bg_color.'" id="purchases-box">
                <div class="col">
                    <div class="row justify-content-center date">
                        Data: '.$tran["tr_date"].'
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col align-items-center img-field"><img src="users/'.$fetchProd["img_dir"].'" height="100%"></div>
                        <div class="col">
                            <div class="row justify-content-center">
                                '.$fetchProd['name'].'
                            </div>
                            <div class="row justify-content-center">
                                Unidades: '.$tran["quantity"].'
                            </div>
                            <div class="row justify-content-center">
                                Valor total: R$ '.$tran["total_price"].'
                            </div>
                        </div>
                        <div class="col">
                            <div class="row justify-content-center">
                                Vendedor: '.$fetchSalesman["username"].'
                            </div>
                            <div class="row justify-content-center situation '.$status_class.'">
                                Situação: '.$status_text.'
                            </div>
                        </div>
                    </div>
                    '.$button.'
                </div>
            </div>');
    }

    function to_send_card($tran) {
        echo('
        <div class="to-send-box row">
            <div class="col">
                <div class="row"><img src="users/'.$tran["img_dir"].'" class="box-img"></div>
                <div class="row">'.$tran["quantity"].' unidade(s)</div>
                <div class="row">R$ '.$tran["total_price"].'</div>
            </div>
            <div class="col">
                <div class="row">'.$tran["name"].'</div>
                <div class="row">Comprador: '.$tran["username"].'</div>
            </div>
            <div class="col">
                <div class="row align-text">Endereço de entrega: '.$tran["user_address"].'</div>
            </div>
            <div class="row justify-content-around btn-box">
                <form action="back/try-send-prod.php" method="POST">
                    <div class="row justify-content-around btn-box">
                        <input type="text" name="tran_id" value="'.$tran['pk_tran_id'].'" hidden>
                        <div class="col-7"><a href="back/try-cancel-transaction.php?tran_id='.$tran["pk_tran_id"].'" class="btn btn-danger">Cancelar transação</a></div>
                        <div class="col-5"><input type="submit" class="btn btn-success" value="Item Enviado"></div>
                    </div>
                </form>
            </div>
        </div>
        ');
    }
?>