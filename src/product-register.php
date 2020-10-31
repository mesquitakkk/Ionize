<!doctype html>
<html lang="pt-br">
<head>
<title>Ionize - Anunciar</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/background-font.css">
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/product-register.css">
</head>
<body>
<?php
    session_start();
    include_once('template/navbar-aut.php');
    include_once('back/conn.php');
    include_once('back/util-functions.php');

    $sqlSelCategory = "SELECT * FROM tb_category;";
    $querySelCategory = mysqli_query($conn, $sqlSelCategory);

    $categories = array();

    while($fetchSelCategory = mysqli_fetch_assoc($querySelCategory)) {
        // print_r($fetchSelCategory);
        array_push($categories, $fetchSelCategory);
    }
?>

<div class="product-box">
    <form action="back/try-product-register.php" method="POST" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col">
                <label class="title">Anuncie seu produto!</label>
            </div>
            
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <input type="text" class="form-control" name="name" placeholder="Produto, marca e modelo" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <input type="textarea" class="form-control" name="product_description" placeholder="Descrição" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <label>Condição:</label>
            </div>
            <div class="col-4">
                <label>Novo: </label>
                <input type="radio" name="product_condition" value="new" required>
            </div>
            <div class="col-4">
                <label>Usado: </label>
                <input type="radio" name="product_condition" value="used">
            </div>  
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                <label for="fk_category_id">Categoria: </label>
            </div>
            <div class="col">
                <select name="fk_category_id" class="form-control">
                    <?php
                        dropdown_item_option($categories);
                    ?> 
                </select>
            </div>  
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <label for="img" class="center">Imagem do produto: </label>
            </div>
            <div class="col">
                <input type="file" name="img" accept="image/*" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-2">
                <label for="price">Valor: </label>
            </div>
            <div class="col-4">
                <input type="number" id="price" name="price" min="1" step="any" class="form-control" value="0.00" id="inputBalance" class="form-control" required>
            </div>
            <div class="col-6">
                <input type="number" name="stock" placeholder="Qtd. no estoque" class="form-control" min="0" step="1">
            </div>
        </div>
        <div class="row justify-content-center">
            <input type="submit" class="btn btn-dark" value="Cadastrar">
        </div>
        
    </form>
</div>

<?php
    // print_r($_SESSION);
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $("#price").on('input',function(event) {
        this.value = parseFloat(this.value.replace(/(.*){1}/, '0$1').replace(/[^\d]/g, '').replace(/(\d\d?)$/, '.$1')).toFixed(2);
    });
</script>
</body>
</html>