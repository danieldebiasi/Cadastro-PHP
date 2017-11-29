<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Trabalho 3</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <?php
            session_start();
            
            if(isset($_SESSION['usuario'])){
                if(isset($_GET['Msg'])){
                    $msg = $_GET['Msg'];
                    echo "<script type='text/javascript'> alert('$msg'); </script>";
                }
            }else{
                header("location:login.php?Erro=" . urlencode("Realize login antes de acessar o sistema!"));
            }
            
            include_once 'menu.php';
        ?> 
        
        <div id="form-cadastro">
            <form class="form" action="novo.php" method="POST">
                <p>Nome: <input type="text" name="nome"/></p>
                <p>Data de Aniversário: <input type="date" name="aniversario"/></p>
                <p>CPF: <input class="cpf" type="text" name="cpf"/></p>
                <p>Telefone: <input type="tel" name="telefone"/></p>
                <p>E-Mail: <input type="email" name="email"/></p>
                <p>Rua: <input type="text" name="rua"/></p>
                <p>Número: <input type="number" name="numero" min="1"/></p>
                <p>Bairro: <input type="text" name="bairro"/></p>
                <p>Complemento <input type="text" name="complemento"/></p>
                <p>CEP: <input class="cep"  type="text" name="cep"/></p>
                <p>Cidade: <input type="text" name="cidade"/></p>
                <p>País: <input type="text" name="pais"/></p>
                <p>Usuário: <input type="text" name="usuario"/></p>
                <p>Senha: <input type="text" name="senha"/></p>
                <div class="submit">
                        <input class="botao" type="submit" value="CONFIRMAR" />
                </div>
            </form>
        </div>
        
    </body>
</html>
