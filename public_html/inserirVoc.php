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
            <title>Upload de imagens</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="shortcut icon" type="image/jpg" href="images/art.png">
            <script src="js/script.js"></script>
            <script src="js/TopResponsivo.js"></script>
        </head>
        <body class="body">
            <div class="topnav" id="myTopnav">
                <a href="menupri.php" class="active"><i><b>LIB-LAB</b></i></a>
                <a href="sair.php" class="right">Sair</a>
                <a href="menupri.php" class="right">Menu</a>
                <a href="javascript:void(0);" class="icon" onclick="topResp()">
                <img src="images/menu.png" class="icomenu" alt="menu">
                </a>
            </div> 
            
            <div class="conteudoSudo">
                <div class="msg">
                    <h1>Inserção de vocabulário</h1>
                    <form name="frmImage" enctype="multipart/form-data" action="inserirVoc2.php" method="POST" class="frmImageUpload" onsubmit="return validaVoc()">
						Palavra:  <input type="text" id="palavra" name="palavra" size="40"maxlength="50"><br>		
                    <h2>Upload de Imagem da palavra</h2>
                        <input name="userImage" id="userImage" type="file" class="inputFile" />
                        <br> PS.<u>(Limite = 1024M ou 1G)</u><br><br>
                        <input type="submit" value="UPLOAD imagem + palavra" class="btnSubmit" />
                    </form><br>
                    <a href="listImagesVoc.php">VER  IMAGENS NO BANCO</a>
                </div>
            </div>
        </body>
    </html>