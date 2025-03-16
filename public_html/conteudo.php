<?php
	require("sess_start.php");
	require_once "conectaBd.php";
	$email=$_SESSION['email'];
	$sqlb = "SELECT sudo, nivel FROM usuario WHERE email = ? ";
	$stmtb = mysqli_prepare($conn,$sqlb);
	if (!$stmtb){
		die("Impossivel preparar a consulta ao BD");
	}
	
	$bindb = mysqli_stmt_bind_param($stmtb,"s",$email);
	if (!$bindb){
		die("Impossivel vincular dados à consulta");
	}

	$execb = mysqli_stmt_execute($stmtb);
	if (!$execb){
		die("Impossivel executar consulta");
	}

	$resultb = mysqli_stmt_bind_result($stmtb, $sudo,$niv);
	if (!$resultb){
		die("Não foi possivel recuperar dados da consulta");
	}
	$fetchb = mysqli_stmt_fetch($stmtb);
	if (!$fetchb){
		die("Não conseguiu associar dados de retorno");
	}
	mysqli_stmt_close($stmtb);
	
	$_SESSION['niv']=$niv;
	?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
		<title>Menu principal</title>
		<script src="js/TopResponsivo.js"></script>
	</head>
	<body class="alfa">
	<div class="topnav" id="myTopnav">
		<a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
		<a href="sair.php" id="sair" class="right">Sair</a>
		<a href="menu.php" class="right">Menu</a>
			<?php 
				if ($sudo== "S") {
					echo "
						<a href='cadAdm1.php' class='right'>Cadastrar</a>
						<a href='del01.php' class='right'>Deletar</a>
						<a href='atu01.php' class='right'>Atualizar</a>
						<a href='inserir.php' class='right'>Gerenciador de questões</a>
						<a href='inserirVoc.php' class='right'>Vocabulário</a>
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
			<h1>Menu principal</h1>

			<br><a href="alfa.php">
				<button class="accordion" id="mod1">Alfabeto</button>
			</a><br>

			<br><a href="saudacao.php">
				<button class="accordion" id="mod2">Saudações</button>
			</a><br>

			<br><a href="familia.php">
				<button class="accordion" id="mod3">Pessoas e familiares</button>
			</a><br>

		</div>
	</body>
</html>