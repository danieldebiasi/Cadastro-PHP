<?php

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $sname = "localhost";
    include 'banco/credenciais.php';
    $banco = json_decode($json);
    $uname = $banco->usuario;
    $pwd = $banco->senha;
    $dbname = "t03grupo8";
    
    try {
        $conn = new PDO("mysql:host=$sname;dbname=$dbname", $uname, $pwd);

        $sql = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE usuario='$usuario'");
        $sql->execute();
        
        if($sql->fetchColumn() > 0){
            $sql = $conn->prepare("SELECT * FROM usuario WHERE usuario='$usuario'");
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if($row['senha']==$senha){
                session_start();
                $_SESSION['usuario'] = $row['usuario'];
                $acesso = $row['acesso'];
                $_SESSION['acesso'] = $acesso;
                if($acesso == 1){
                    header("location:cadastro.php?Msg=" . urlencode("Acesso Gerente"));
                }else{
                    $_SESSION['cliente'] = $row['cpf'];
                    header("location:dados.php?Msg=" . urlencode("Acesso Cliente"));
                }                    
            }else{
                header("location:login.php?Erro=" . urlencode("Senha inválida!"));
            }
        }else {
            header("location:login.php?Erro=" . urlencode("Usuário inexistente!"));
        }
        
    } 
    catch (Exception $ex) {
        echo "<script type='text/javascript'> alert('Falha no banco de dados:".$ex->getMessage()."'); </script>";
    }   
    finally{
        $conn = null;
    }

?>