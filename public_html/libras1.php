<?php
	require 'sess_start.php';
	$email=$_SESSION['email'];
 
	require("conectaBd.php");


	$sqlx = "SELECT progresso, nivel FROM usuario WHERE email = '$email'";
	$datasetx = mysqli_query($conn,$sqlx);
	if (!$datasetx) {
		die("Impossivel recuperar registros!");
	}else {
		$linhaBdx = mysqli_fetch_assoc($datasetx);
		$idResp = $linhaBdx ['progresso'];
		$nivel = $linhaBdx ['nivel'];
	}


	$sql = "SELECT pergunta FROM pergunta WHERE idPergunta = '$idResp'";
	$stmt = mysqli_prepare($conn,$sql);
	if (!$stmt){
		die("Impossivel preparar a consulta ao BD -1");
	}
	$exec = mysqli_stmt_execute($stmt);
	if (!$exec){
		die("Impossivel executar consulta -1");
	}
	$result = mysqli_stmt_bind_result($stmt,$pergunta);
	if (!$result){
		die("Não foi possivel recuperar dados da consulta -1");
	}
	$fetch = mysqli_stmt_fetch($stmt);
	if (!$fetch){
		die("Não conseguiu associar dados de retorno -1");
	}
	mysqli_stmt_close($stmt);

	$sql3 = "SELECT resposta from resposta where idResposta = $idResp ";
	$stmt3 = mysqli_prepare($conn,$sql3);
	if (!$stmt3){
		die("Impossivel preparar a consulta ao BD -3");
	}
	$exec3 = mysqli_stmt_execute($stmt3);
	if (!$exec3){
		die("Impossivel executar consulta -3");
	}
	$result3 = mysqli_stmt_bind_result($stmt3,$respostaCorreta);
	if (!$result3){
		die("Não foi possivel recuperar dados da consulta -3");
	}
	$fetch3 = mysqli_stmt_fetch($stmt3);
	if (!$fetch3){
		die("Não conseguiu associar dados de retornoooooooooo -3");
	}
	mysqli_stmt_close($stmt3);

	$_SESSION['respostaCorreta']=$respostaCorreta;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lib-Lab Game</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/styleGame.css">
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/TopResponsivo.js"></script>
	</head>
	<body class="alfa">
		<div class="topnav" id="myTopnav">
			<a href="menupri.php" class="active"><i><b>LIB-LAB</b></i></a>
			<a href="cad01.php" class="right">sair</a>
			<a href="menupri.php" class="right">Menu</a>
			<a href="javascript:void(0);" class="icon" onclick="topResp()">
				<img src="images/menu.png" alt="menu" class="icomenu">
			</a>
		</div> 

		<div class="conteudo">
			<?php

				$sql4 = "SELECT * From respTip1";
				$dataset = mysqli_query($conn,$sql4);
				if (!$dataset) {
					die("Impossivel recuperar registros!");
				}
				$qtde = mysqli_num_rows($dataset);
				if ($qtde==0) {
					die("Nenhum usuario cadastrado no banco de dados!");
				}//else {echo "qtde = $qtde <br> <br>";}

				$id_pergunta=rand(1,$qtde);

				$alternativas=array($respostaCorreta);
				for ($i=1; $i <4 ; $i++) { 
					// testar se alternativa é única no vetor de alternativas
					do {
						$loop=false;
						$alt_sorte = rand(1,$qtde); 
						foreach ($alternativas as $key => $value) {
							if ($alt_sorte==$value) {
								$loop=true;
							}
						}
					} while ($loop);
					array_push($alternativas,$alt_sorte);
				}
				foreach ($alternativas as $key => $value) {
					//echo(" valor= $value ");
				}

				echo" <h2> $pergunta </h2>";
				?>
				<form action="respostas.php" method="POST" onsubmit="confSelect()" name="formGame" class="formGame">

			<?php
				$resp1=$alternativas[1];
				//echo "<br><br>  $resp1";
				$resp2=$alternativas[2];
				//echo "<br><br>  $resp2";
				$resp3=$alternativas[3];
				//echo "<br><br>  $resp3";

					
					$sql5 = "SELECT resposta From respTip1 WHERE idResp = ? ";
					$stmt5 = mysqli_prepare($conn,$sql5);
					if (!$stmt5){
						die("Impossivel preparar a consulta ao BD -5");
					}
					$bind5 = mysqli_stmt_bind_param($stmt5,"s",$resp1);
						if (!$bind5){
							die("Impossivel vincular dados à consulta -5");
						}
						$exec5 = mysqli_stmt_execute($stmt5);
						if (!$exec5){
							die("Impossivel executar consulta -5");
						}
						$result5 = mysqli_stmt_bind_result($stmt5,$alt1);
						if (!$result5){
							die("Não foi possivel recuperar dados da consulta -5");
						}
						$fetch5 = mysqli_stmt_fetch($stmt5);
						if (!$fetch5){
							die("Não conseguiu associar dados de retornoooooooooo -5");
						}
						mysqli_stmt_close($stmt5);
						//echo "<br>alt1= $alt1";

					$sql6 = "SELECT resposta From respTip1 WHERE idResp = ? ";
					$stmt6 = mysqli_prepare($conn,$sql6);
					if (!$stmt6){
						die("Impossivel preparar a consulta ao BD -6");
					}
					$bind6 = mysqli_stmt_bind_param($stmt6,"i",$resp2);
						if (!$bind6){
							die("Impossivel vincular dados à consulta -6");
						}
						$exec6 = mysqli_stmt_execute($stmt6);
						if (!$exec6){
							die("Impossivel executar consulta -6");
						}
						$result6 = mysqli_stmt_bind_result($stmt6,$alt2);
						if (!$result6){
							die("Não foi possivel recuperar dados da consulta -6");
						}
						$fetch6 = mysqli_stmt_fetch($stmt6);
						if (!$fetch6){
							die("Não conseguiu associar dados de retornoooooooooo -6");
						}
						mysqli_stmt_close($stmt6);
						//echo "<br>alt2= $alt2";


					$sql7 = "SELECT resposta From respTip1 WHERE idResp = ? ";
					$stmt7 = mysqli_prepare($conn,$sql7);
					if (!$stmt7){
						die("Impossivel preparar a consulta ao BD -7");
					}
					$bind7 = mysqli_stmt_bind_param($stmt7,"i",$resp3);
						if (!$bind7){
							die("Impossivel vincular dados à consulta -7");
						}
						$exec7 = mysqli_stmt_execute($stmt7);
						if (!$exec7){
							die("Impossivel executar consulta -7");
						}
						$result7 = mysqli_stmt_bind_result($stmt7,$alt3);
						if (!$result7){
							die("Não foi possivel recuperar dados da consulta -7");
						}
						$fetch7 = mysqli_stmt_fetch($stmt7);
						if (!$fetch7){
							die("Não conseguiu associar dados de retornoooooooooo -7");
						}
						mysqli_stmt_close($stmt7);
						//echo "<br>alt3= $alt3";


					$arrayres=array($respostaCorreta, $alt1, $alt2, $alt3);

				//print_r($arrayres);
				shuffle($arrayres);
				//echo "<br><hr><br>";
						echo(
						"<label class='labelExp'>
						<input type='radio' name='letra' value='$arrayres[0]'>
							<div class='radio-btns'>
								<img src='images/$arrayres[0].png'>
							</div>
						</label>");
						echo(
							"<label class='labelExp'>
							<input type='radio' name='letra' value='$arrayres[1]'>
								<div class='radio-btns'>
									<img src='images/$arrayres[1].png'>
								</div>
							</label>");
						echo(
							"<label class='labelExp'>
							<input type='radio' name='letra' value='$arrayres[2]'>
								<div class='radio-btns'>
									<img src='images/$arrayres[2].png'>
								</div>
							</label>");
						echo(
							"<label class='labelExp'>
							<input type='radio' name='letra' value='$arrayres[3]'>
								<div class='radio-btns'>
									<img src='images/$arrayres[3].png'>
								</div>
							</label>");

			?>
				<input type="submit" value="RESPONDER" id="resp" class="btnMenu">
			</form>

			<br>
		</div>
	</body>
</html>
