<?php
    if(!isset($_SESSION)){
        session_start();
    }
    // fixed-top
    include_once('back/conn.php');
    include_once('back/util-functions.php');

    // querying categories 
    $sqlSelCategory = "SELECT * FROM tb_category;";
    $querySelCategory = mysqli_query($conn, $sqlSelCategory);

    $categories = array();

    while($fetchSelCategory = mysqli_fetch_assoc($querySelCategory)) {
        // print_r($fetchSelCategory);
        array_push($categories, $fetchSelCategory);
    }

    // querying user
    select_all('tb_user', 'pk_user_id', $_SESSION['user_id']);
    select_all('tb_credentials', 'pk_cred_id', $_SESSION['cred_id']);

    echo('
    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
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
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opções
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="user-profile.php">Informações Básicas</a>
                <a class="dropdown-item" href="virtual-wallet.php">Carteira Virtual</a>
                <a class="dropdown-item" href="user-address.php">Endereços</a>
                <a class="dropdown-item" href="#">Histórico de Compras</a>
                <a class="dropdown-item" href="announced-products.php">Produtos Anunciados</a>
                <a class="dropdown-item" href="#">Histórico de Vendas</a>
                <a class="dropdown-item" href="back/logout.php">Sair</a>
            </div>
        </li>
        <a class="nav-link" href="product-register.php">Anunciar</a>
        <a id="nav-balance" href="virtual-wallet.php"> Saldo: R$ '.$_SESSION["ionize_tb_user_balance"].'</a>
        <a class="nav-link" href="user-profile.php">'.$_SESSION["ionize_tb_user_username"].'</a>
    </div>
    </nav>');
?>

