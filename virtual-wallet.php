<!doctype html>
<html lang="pt-br">
  <head>
    <title>Ionize - Carteira Virtual</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/background-font.css">
    <link rel="stylesheet" href="css/wallet.css">
    <!-- <link rel="stylesheet" href="css/box.css"> -->

  </head>
  <body>
      
    <?php
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['ionize_tb_user_cpf'])){
            include_once('template/navbar-aut.php');
        } else {
            header("location:back/logout.php");
        }
    ?>

    <div class="box-wallet">
        <div class="container">
            <label for="" id="box-wallet-balance">Saldo atual: <span id="balance">R$ <?php echo($_SESSION["ionize_tb_user_balance"]."</span>"); ?></label>
            <form action="back/try-set-balance.php" method="POST" class="">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <input type="number" name="addBalance" min="1" step="any" class="form-control" value="0.00" id="inputBalance" required>
                    </div>
                    <div class="col-3">
                        <input type="submit" value="Depositar" class="btn btn-success">
                    </div>
                </div> 
            </form>
        </div>
    </div>
   
    <br><br><br>
    <?php
        // print_r($_SESSION);
    ?>
    <!-- Optional JavaScript -->
        
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).on('input',':input',function(event) {
        this.value = parseFloat(this.value.replace(/(.*){1}/, '0$1').replace(/[^\d]/g, '').replace(/(\d\d?)$/, '.$1')).toFixed(2);
        });
    </script>
  </body>
</html>