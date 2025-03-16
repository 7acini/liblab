<?php 
    require"sess_start.php";
    require"conectaBd.php";
    $sudo = "SELECT sudo FROM usuario ";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" type="image/jpg" href="images/art.png">
        <title>Familiaresinserir</title>
        <script src="js/TopResponsivo.js"></script>
	</head>
	<body class="alfa">
    <div class="topnav" id="myTopnav">
        <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
        <a href="sair.php" class="right">Sair</a>
        <a href="modulos.php" class="right">Módulos</a>
        <a href="pesquisa.php" class="right">Pesquisa</a>
		<a href="alfa.php" class="right">Alfabeto</a>

		<?php 
			if ($sudo== "S") {
				echo "
					<a href='inserir.php' class='right'>Gerenciador de questões</a>
					<a href='cadAdm1.php' class='right'>Cadastrar</a>
					<a href='del01.php' class='right'>Deletar</a>
					<a href='atu01.php' class='right'>Atualizar</a>
					<a href='vocabulario.php' class='right'>Vocabulario</a>
					<a href='javascript:void(0);' class='icon' onclick='topResp()'>
						<img src='images/menu.png' class='icomenu' alt='menu'>
					</a>
				</div> 
				<div class='conteudoSudo'>
				";
			}
			else{
				echo"
					<a href='javascript:void(0);' class='icon' onclick='topResp()'>
						<img src='images/menu.png' class='icomenu' alt='menu'>
					</a>
				</div>
					<div class='conteudo'>
				";
			}
		?>
        </div>
            <div class="conteudoSudo">
                <h1>Familiares e amigos</h1>
                <?php
                    //vocabulario 
                    $voc = "SELECT palavra FROM familia ORDER BY idPalavra";
                    $dataset = mysqli_query($conn,$voc);
                    if (!$dataset) {
                        die("Impossivel recuperar registros de vocabulário!");
                    }
                    if (mysqli_num_rows($dataset)==0) {
                        die("Nenhuma palavra cadastrada no banco de dados!");
                    }
                    while($linhaBd=mysqli_fetch_assoc($dataset)){
                        $palavra = $linhaBd['palavra'];
                ?>
                <?php //echo("Vocabulário: $palavra");?>

                <?php
                
                    }
                    //imagem
                    $sql = "SELECT imageId FROM imgFam ORDER BY imageId"; 
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {	
                ?>
        <div class="grup4">
            <div class="divDasCards">
                <div class="cardVid">
                    <img src="imageViewFam.php?image_id=<?php echo $row["imageId"]; ?>" />
                </div>
            </div>
        </div>
                <?php
                    }
                    mysqli_close($conn);
                ?>
        </div>
	</body>
</html>
