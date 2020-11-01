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
            $string = $string . '<a class="dropdown-item" href="category.php?prod_id='.$value["pk_cat_id"].'">'.$value['name'].'</a>';
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
    
?>