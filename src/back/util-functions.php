<?php
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
?>