<?php
    require("sess_start.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" type="image/jpg" href="images/art.png">
        <title>Sair do sistema</title>
    </head>
    <body class="body">
         <div class="topnav" id="myTopnav">
            <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
            <a href="login01.php" class="right">LOGIN</a>
            <a href="cad01.php" class="right">CADASTRO</a>
            <a href="sobre.html" class="right">SOBRE</a>
            <a href="javascript:void(0);" class="icon" onclick="topResp()">
                <img src="images/menu.png" alt="menu" class="icomenu">
            </a>
        </div> 
        <div class="=msg">
                <?php
                    $_SESSION=array();
                    session_destroy();
                    echo("Retorne para a <a href='index.php' class='link'>página inicial</a>");
                ?>        
        </div>    
    </body>
</html>
