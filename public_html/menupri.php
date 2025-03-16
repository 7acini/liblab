<?php
	require("sess_start.php");
	require_once "conectaBd.php";
	$email=$_SESSION['email'];
	$sql = "SELECT sudo, nivel FROM usuario WHERE email = ? ";
	$stmt = mysqli_prepare($conn,$sql);
	if (!$stmt){
		die("Impossivel preparar a consulta ao BD");
	}
	
	$bind = mysqli_stmt_bind_param($stmt,"s",$email);
	if (!$bind){
		die("Impossivel vincular dados à consulta");
	}

	$exec = mysqli_stmt_execute($stmt);
	if (!$exec){
		die("Impossivel executar consulta");
	}

	$result = mysqli_stmt_bind_result($stmt, $sudo,$niv);
	if (!$result){
		die("Não foi possivel recuperar dados da consulta");
	}
	$fetch = mysqli_stmt_fetch($stmt);
	if (!$fetch){
		die("Não conseguiu associar dados de retorno");
	}
	mysqli_stmt_close($stmt);
	
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
		<a href="conteudo.php" class="right">Conteúdo</a>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
	this.classList.toggle("active");
	var panel = this.nextElementSibling;
	if (panel.style.display === "block") {
		panel.style.display = "none";
	} else {
		panel.style.display = "block";
	}
  });
}
</script>


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
			<button class="accordion" id="mod1">Nível 1</button>
			<div class="panel">
				<br><a href="libras1.php"><button class="btNiv">Começar</button></a><br>
			</div>
			<br><br>
			<?php if ($niv>=2) {
				echo"
			<button class='accordion' id='mod2'>Nível 2</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=3) {
				echo"
			<button class='accordion' id='mod3'>Nível 3</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=4) {
				echo"
			<button class='accordion' id='mod4'>Nível 4</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=5) {
				echo"
			<button class='accordion' id='mod5'>Nível 5</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=6) {
				echo"
			<button class='accordion' id='mod6'>Nível 6</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=7) {
				echo"
			<button class='accordion' id='mod7'>Nível 7</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=8) {
				echo"
			<button class='accordion' id='mod8'>Nível 8</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=9) {
				echo"
			<button class='accordion' id='mod9'>Nível 9</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>
			<?php if ($niv>=10) {
				echo"
			<button class='accordion' id='mod10'>Nível 10</button>
			<div class='panel'>
				<br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
			</div>";
			} ?>
			<br><br>

		</div>
		<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
	this.classList.toggle("active");
	var panel = this.nextElementSibling;
	if (panel.style.display === "block") {
	  panel.style.display = "none";
	} else {
	  panel.style.display = "block";
	}
  });
}
</script>
	</body>
</html>