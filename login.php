<!-- Form de login obtido de: https://codepen.io/colorlib/full/rxddKy -->

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Trabalho 3</title>
        <link rel="stylesheet" type="text/css" href="css/style-login.css">
    </head>
    <body>
        <?php
            if(isset($_GET['Erro'])){
                $msg = $_GET['Erro'];
                echo "<script type='text/javascript'> alert('$msg'); </script>";
            }
        ?>
        
        <div class="login-page">
            <div class="form">
                <form class="login-form" action="usuario.php" method="POST">
                    <input type="text" placeholder="Usuário" name="usuario"/>
                    <input type="password" placeholder="Senha" name="senha"/>
                    <input id="login" type="submit" value="Entrar" />
                </form>
            </div>
        </div>
        
    </body>
</html>
