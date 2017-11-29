<?php

    $sname = "localhost";
    include 'credenciais.php';
    $banco = json_decode($json);
    $uname = $banco->usuario;
    $pwd = $banco->senha;

    $sql = "
    CREATE DATABASE t03grupo8;
    USE t03grupo8;
    -- phpMyAdmin SQL Dump
    -- version 4.7.4
    -- https://www.phpmyadmin.net/
    --
    -- Host: 127.0.0.1
    -- Generation Time: 28-Nov-2017 às 15:40
    -- Versão do servidor: 10.1.26-MariaDB
    -- PHP Version: 7.1.9

    SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    SET time_zone = '+00:00';


    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
    /*!40101 SET NAMES utf8mb4 */;

    --
    -- Database: `t03grupo8`
    --

    -- --------------------------------------------------------

    --
    -- Estrutura da tabela `cliente`
    --

    CREATE TABLE `cliente` (
      `nome` varchar(50) NOT NULL,
      `aniversario` varchar(10) NOT NULL,
      `cpf` varchar(14) NOT NULL,
      `telefone` varchar(15) NOT NULL,
      `email` varchar(50) NOT NULL,
      `rua` varchar(60) NOT NULL,
      `numero` int(11) NOT NULL,
      `bairro` varchar(30) NOT NULL,
      `complemento` varchar(20) DEFAULT NULL,
      `cidade` varchar(40) NOT NULL,
      `cep` varchar(9) NOT NULL,
      `pais` varchar(40) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    -- --------------------------------------------------------

    --
    -- Estrutura da tabela `usuario`
    --

    CREATE TABLE `usuario` (
      `usuario` varchar(30) NOT NULL,
      `senha` varchar(30) NOT NULL,
      `acesso` varchar(15) NOT NULL,
      `cpf` varchar(14) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    --
    -- Extraindo dados da tabela `usuario`
    --

    INSERT INTO `usuario` (`usuario`, `senha`, `acesso`, `cpf`) VALUES
    ('admin', 'admin', '1', NULL);

    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `cliente`
    --
    ALTER TABLE `cliente`
      ADD PRIMARY KEY (`cpf`);

    --
    -- Indexes for table `usuario`
    --
    ALTER TABLE `usuario`
      ADD PRIMARY KEY (`usuario`),
      ADD KEY `fk_cpf` (`cpf`);

    --
    -- Constraints for dumped tables
    --

    --
    -- Limitadores para a tabela `usuario`
    --
    ALTER TABLE `usuario`
      ADD CONSTRAINT `fk_cpf` FOREIGN KEY (`cpf`) REFERENCES `cliente` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;
    COMMIT;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
    ";
    
    try{
        $conn = new PDO("mysql:host=$sname", $uname, $pwd);
        $query = $conn->prepare($sql);
        $query->execute();
        echo "<script type='text/javascript'> alert('Banco criado com sucesso!'); </script>";
    } catch (Exception $ex) {
        echo "<script type='text/javascript'> alert('Falha no banco de dados:".$ex->getMessage()."'); </script>";
    }
    finally {
        $conn = null;
    }

?>

