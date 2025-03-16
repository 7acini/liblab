<?php
    require "sess_start.php";
    require "conectaBd.php";
     //conferencia sudo 
     $emailS=$_SESSION['email'];
     $sqlS = "SELECT sudo FROM usuario WHERE email = ? ";
     $stmt = mysqli_prepare($conn,$sqlS);
     if (!$stmt){
         die("Impossivel preparar a consulta ao BD");
     }
 
     $bind = mysqli_stmt_bind_param($stmt,"s",$emailS);
     if (!$bind){
         die("Impossivel vincular dados à consulta");
     }
 
     $exec = mysqli_stmt_execute($stmt);
     if (!$exec){
         die("Impossivel executar consulta");
     }
 
     $result = mysqli_stmt_bind_result($stmt, $sudo);
     if (!$result){
         die("Não foi possivel recuperar dados da consulta");
     }
     $fetch = mysqli_stmt_fetch($stmt);
     if (!$fetch){
         die("Não conseguiu associar dados de retorno");
     }
     mysqli_stmt_close($stmt);
     if($sudo == "N"){
         header("Location: menupri.php");
     }
?>
    <html>
        <head>
            <title>Vocabulário</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="shortcut icon" type="image/jpg" href="images/art.png">
            <script src="js/TopResponsivo.js"></script>
        </head>
        <body class="body">
            <div class="topnav" id="myTopnav">
                <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
                <a href="sair.php" class="right">Sair</a>
                <a href="menupri.php" class="right">Menu</a>
                <a href="javascript:void(0);" class="icon" onclick="topResp()">
                <img src="images/menu.png" class="icomenu" alt="menu">
                </a>
            </div> 
                <div class="conteudoSudo">
                    <h1>Gestão de vocabulários</h1>
                   <br> <a href="inserirVoc.php" class="vocLink">INSERIR VOCABULÁRIO</a> <br>
                   <br> <a href="listImagesVoc.php" class="vocLink">LISTAR VOCABULÁRIO</a>
                </div>
            </div>
        </body>
    </html>

