<?php
    if($_SESSION['acesso']==1){
        echo "<ul>
            <li><a href='cadastro.php'>Cadastrar Cliente</a></li>
            <li><a href='consulta.php'>Consultar Clientes</a></li>
            <li class='sair'><a href='logout.php'>Sair</a></li>
        </ul>";
    }else{
        echo "<ul>
            <li><a href='dados.php'>Meus Dados</a></li>
            <li class='sair'><a href='logout.php'>Sair</a></li>
        </ul>";
    }
?>