<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Trabalho 3</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
            
            if(isset($_GET["Msg"])){
                $msg = $_GET['Msg'];
                echo "<script type='text/javascript'> alert('$msg'); </script>";
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

                $sql = $conn->prepare("SELECT * FROM cliente ORDER BY nome");
                $sql->execute();
                
                while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                    $split = explode("-", $row['aniversario']);
                    $aniversario = $split[2]."/".$split[1]."/".$split[0];
                    
                    echo "<div class='cliente'>
                    <table>
                        <tr>
                            <td class='label'>Nome: </td>
                            <td>".$row['nome']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Aniversário: </td>
                            <td>".$aniversario."</td>
                        </tr>
                        <tr>
                            <td class='label'>CPF: </td>
                            <td>".$row['cpf']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Telefone: </td>
                            <td>".$row['telefone']."</td>
                        </tr>
                        <tr>
                            <td class='label'>E-Mail: </td>
                            <td>".$row['email']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Rua: </td>
                            <td>".$row['rua']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Número: </td>
                            <td>".$row['numero']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Bairro: </td>
                            <td>".$row['bairro']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Complemento: </td>
                            <td>".$row['complemento']."</td>
                        </tr>
                        <tr>
                            <td class='label'>Cidade: </td>
                            <td>".$row['cidade']."</td>
                        </tr>
                        <tr>
                            <td class='label'>CEP: </td>
                            <td>".$row['cep']."</td>
                        </tr>
                        <tr>
                            <td class='label'>País: </td>
                            <td>".$row['pais']."</td>
                        </tr>
                    </table>
                    </div>";
                }
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


