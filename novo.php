<?php

    $nome = $_POST['nome'];
    $aniversario = $_POST['aniversario'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $pais = $_POST['pais'];
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

        $stmt = $conn->prepare("SELECT COUNT(*) FROM cliente WHERE cpf='$cpf'");
        $stmt->execute();
        
        if($stmt->fetchColumn() > 0){ 
            $stmt = $conn->prepare("UPDATE cliente SET nome=:nome, aniversario=:aniversario, cpf=:cpf, telefone=:telefone, "
                    . "email=:email, rua=:rua, numero=:numero, bairro=:bairro, complemento=:complemento, cidade=:cidade, "
                    . "cep=:cep, pais=:pais WHERE cpf=:cpf");
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':aniversario', $aniversario);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':pais', $pais);
            $stmt->execute();
            
            $stmt = $conn->prepare("UPDATE usuario SET usuario=:usuario, senha=:senha WHERE cpf=:cpf");
            
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            
            if($_SESSION['acesso'] == 1){
                header("location:cadastro.php?Msg=".urlencode("Cliente atualizado!"));
            }else{
                header("location:dados.php?Msg=".urlencode("Dados atualizados!"));
            }
        }else{
            $stmt = $conn->prepare("INSERT INTO cliente (nome, aniversario, cpf, telefone, email, rua, numero, "
                    . "bairro, complemento, cidade, cep, pais) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $aniversario);
            $stmt->bindParam(3, $cpf);
            $stmt->bindParam(4, $telefone);
            $stmt->bindParam(5, $email);
            $stmt->bindParam(6, $rua);
            $stmt->bindParam(7, $numero);
            $stmt->bindParam(8, $bairro);
            $stmt->bindParam(9, $complemento);
            $stmt->bindParam(10, $cidade);
            $stmt->bindParam(11, $cep);
            $stmt->bindParam(12, $pais);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO usuario (usuario, senha, acesso, cpf) VALUES (?,?,2,?)");

            $stmt->bindParam(1, $usuario);
            $stmt->bindParam(2, $senha);
            $stmt->bindParam(3, $cpf);
            $stmt->execute();
            
            header("location:cadastro.php?Msg=".urlencode("Cliente cadastrado!"));
        }
    } 
    catch (Exception $ex) {
        if($_SESSION['acesso'] == 1){
            header("location:cadastro.php?Msg=".urlencode("Erro no banco de dados: ").$ex->getMessage());
        }else{
            header("location:dados.php?Msg=".urlencode("Erro no banco de dados: ").$ex->getMessage());
        }        
    }
    finally {
        $conn = null;
    }
?>

