<!doctype html>
<html lang="pt-br">
  <head>
    <title>Ionize - Cadastre-se</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/background-font.css">
    <link rel="stylesheet" href="css/box.css">
  </head>
  <body>

    <?php
        include_once('template/navbar-travel.php');
    ?>

    <div class="container" id="box">
        <form action="back/try-sign-up.php" method="POST" class="box-form">
            <div class="form-group">
                <div class="center">
                    <h2>Registre-se!</h2>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <input type="text" name="username" class="form-control" placeholder="Nome completo" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input type="date" name="userbirthday" class="form-control" required>
                    </div>
                    <div class="col">
                        <input type="text" name="usercpf" class="form-control" placeholder="CPF" required onkeydown="javascript: fMasc( this, mCPF );" maxlength="14">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input type="email" name="useremail" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="col">
                        <input type="password" name="userpassword" class="form-control" placeholder="Senha" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Endereço:</label>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-9">
                        <input type="text" name="address_street" class="form-control" placeholder="Rua" required>
                    </div>
                    <div class="col-3">
                        <input type="number" name="address_number" min=0 class="form-control" placeholder="Rua" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-5">
                        <input type="text" name="address_city" class="form-control" placeholder="Cidade">
                    </div>
                    <div class="col-3">
                        <input type="text" name="address_state" class="form-control" placeholder="Estado">
                    </div>
                    <div class="col-4">
                        <input type="text" name="address_cep" class="form-control" placeholder="CEP" onkeydown="javascript: fMasc( this, mCEP );" maxlength="9">
                    </div>
                </div>
            </div>
            
            

            <!-- submit button -->
            <div class="center">
                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-dark">
                </div>
            </div>
        </form>
        <div class="center">
            <a href="session.php"><button class="btn btn-dark">Voltar</button></a>
        </div>
</div>
      
    <!-- Optional JavaScript -->
    <script type="text/javascript">
        function fMasc(objeto,mascara) {
            obj=objeto
            masc=mascara
            setTimeout("fMascEx()",1)
        }
        function fMascEx() {
            obj.value=masc(obj.value)
        }
        function mCNPJ(cnpj){
            cnpj=cnpj.replace(/\D/g,"")
            cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
            cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
            cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
            cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
            return cnpj
        }
        function mCPF(cpf){
            cpf=cpf.replace(/\D/g,"")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
            return cpf
        }
        function mCEP(cep){
            cep=cep.replace(/\D/g,"")
            cep=cep.replace(/^(\d{5})(\d)/,"$1-$2")
            // cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
            return cep
        }
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>