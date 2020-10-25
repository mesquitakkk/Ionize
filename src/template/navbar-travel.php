<?php
    session_start();
    include_once('back/conn.php');

    // querying categories 
    $sqlSelCategory = "SELECT * FROM tb_category;";
    $querySelCategory = mysqli_query($conn, $sqlSelCategory);

    $categories = array();

    while($fetchSelCategory = mysqli_fetch_assoc($querySelCategory)) {
        // print_r($fetchSelCategory);
        array_push($categories, $fetchSelCategory);
    }

    // returning query values to dropdown
    function dropdown_item($categories) {
        $string = '';
        foreach($categories as $key => $value){
            $_POST['category_id_'.$key] = $key;
            $string = $string . '<a class="dropdown-item" href="#">'.$value['name'].'</a>';
        }
        return $string;
    }

    echo('
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse -lg" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php"><h5>Ionize</h5><span class="sr-only">(current)</span></a>
        </li>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorias
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                '. dropdown_item($categories) .'
            </div>
        </li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <li class="nav-item active">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </li>

        
        </ul>
        
        <a class="nav-link" href="#"></a>
        <a class="nav-link" href="session.php">Iniciar sessão</a>
    </div>
    </nav>');

?>