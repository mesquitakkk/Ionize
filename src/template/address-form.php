<?php
    if (!isset($_SESSION)){
        session_start();
    }

    function getAddress($conn) {
        $sql = "SELECT user_address FROM tb_user WHERE pk_user_id='".$_SESSION['ionize_tb_user_pk_user_id']."'";
        $query = mysqli_query($conn, $sql);

        $fetch = mysqli_fetch_assoc($query);

        foreach($fetch as $key => $value) {
            $address = $value; 
        }
        
        $address = explode(", ", $address);
        $city_state = explode("-", $address[2]);

        $address = Array($address[0], $address[1], $city_state[0], $city_state[1], $address[3]);
        return $address;
    }

    function address_box_generate($address){
        echo('
        <div class="box-address">
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="form-control" value="'.$address[0].'" readonly>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" value="'.$address[1].'" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <input type="text" class="form-control" value="'.$address[2].'" readonly>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" value="'.$address[3].'" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control" value="'.$address[4].'" readonly>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" placeholder="Nome (EX: Casa, Trabalho)" readonly>
                    </div>
                </div>
            </div>
        </div>
        ');
    }
?>