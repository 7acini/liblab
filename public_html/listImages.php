<?php
//lista imgs no bd
    require_once "conectaBd.php";
    $sql = "SELECT imageId FROM output_images ORDER BY imageId DESC"; 
    $result = mysqli_query($conn, $sql);
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
        <title>Lista BLOB Images</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" type="image/jpg" href="images/art.png"> 

        <script src="js/TopResponsivo.js"></script>

    </head>
    <body class="body">
        <div class="topnav" id="myTopnav">
            <a href="sair.php" class="active"><i><b>LIB-LAB</b></i></a>
            <a href="sair.php" class="right">Sair</a>
            <a href="menupri.php" class="right">Menu</a>
            <a href="cadAdm1.php" class="right">Cadastrar</a>
            <a href="del01.php" class="right">Deletar</a>
            <a href="atu01.php" class="right">Atualizar</a>
            <a href="javascript:void(0);" class="icon" onclick="topResp()">
                        <img src="images/menu.png" alt="menu" class="icomenu">
            </a>
        </div> 
		<div class="conteudoSudo">
            <h1>Lista de imagens no banco de dados</h1>
            <?php
                while($row = mysqli_fetch_array($result)) {
            ?>
            <div><img src="imageView.php?image_id=<?php echo $row["imageId"]; ?>" /><br/></div>
            <?php		
            }
                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>