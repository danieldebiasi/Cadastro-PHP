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
            
            $sname = "localhost";
            include 'banco/credenciais.php';
            $banco = json_decode($json);
            $uname = $banco->usuario;
            $pwd = $banco->senha;
            $dbname = "t03grupo8";

            try {
                $conn = new PDO("mysql:host=$sname;dbname=$dbname", $uname, $pwd);

                $sql = $conn->prepare("SELECT * FROM cliente WHERE cpf='".$_SESSION['cliente']."'");
                $sql->execute();
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                
                $sql = $conn->prepare("SELECT usuario, senha FROM usuario WHERE cpf='".$_SESSION['cliente']."'");
                $sql->execute();
                $urow = $sql->fetch(PDO::FETCH_ASSOC);
                
                echo "<div id='form-cadastro'>
                <form class='form' action='novo.php' method='POST'>
                    <p>Nome: <input type='text' name='nome' value='".$row['nome']."' readonly/></p>
                    <p>Data de Aniversário: <input type='date' name='aniversario' value='".$row['aniversario']."' readonly/></p>
                    <p>CPF: <input class='cpf' type='text' name='cpf' value='".$row['cpf']."' readonly/></p>
                    <p>Telefone: <input type='tel' name='telefone' value='".$row['telefone']."'/></p>
                    <p>E-Mail: <input type='email' name='email' value='".$row['email']."'/></p>
                    <p>Rua: <input type='text' name='rua' value='".$row['rua']."'/></p>
                    <p>Número: <input type='number' name='numero' value='".$row['numero']."'/></p>
                    <p>Bairro: <input type='text' name='bairro' value='".$row['bairro']."'/></p>
                    <p>Complemento <input type='text' name='complemento' value='".$row['complemento']."'/></p>
                    <p>CEP: <input class='cep' type='text' name='cep' value='".$row['cep']."'/></p>
                    <p>Cidade: <input type='text' name='cidade' value='".$row['cidade']."'/></p>
                    <p>País: <input type='text' name='pais' value='".$row['pais']."'/></p>
                    <p>Usuário: <input type='text' name='usuario' value='".$urow['usuario']."' readonly/></p>
                    <p>Senha: <input type='text' name='senha' value='".$urow['senha']."'/></p>
                    <div class='submit'>
                            <input class='botao' type='submit' value='ALTERAR' />
                    </div>
                </form>
                </div>";
            } 
            catch (Exception $ex) {
                echo "<script type='text/javascript'> alert('Falha no banco de dados:".$ex->getMessage()."'); </script>";
            }  
            finally{
                $conn = null;
            }
        ?>
    </body>
</html>




