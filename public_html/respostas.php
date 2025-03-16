<?php
	require "sess_start.php";
	require_once "conectaBd.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
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
			<a href="sair.php" class="right">Sair</a>
			<a href="menupri.php" class="right">Menu</a>
			<a href="javascript:void(0);" class="icon" onclick="topResp()">
				<img src="images/menu.png" alt="menu" class="icomenu">
			</a>
		</div> 

		<div class="conteudo">
			<div class="msg">
			<?php
			//os campos estão no campo name
				$email=$_SESSION['email'];
				$nivel=$_SESSION['niv'];
				$respostaCorreta=$_SESSION['respostaCorreta'];

				$sqlb = "SELECT progresso FROM usuario WHERE email = '$email' ";
				//echo $sqlb ;
				$datasetb = mysqli_query($conn,$sqlb);
				if (!$datasetb) {
					die("Impossivel recuperar registros! </div>");
				}
				$linhaBd = mysqli_fetch_assoc($datasetb);
				$progresso = $linhaBd ['progresso'];


			//teste de transissao de dado
					if (empty($_POST['letra'])){
					die("Retorne e selecione uma resposta! <a href='libras1.php'>VOLTAR</a> </div>");
					}else{
					$resposta = $_POST['letra'];
					//teste de envio e respostadado echo"CHEGOUUU resosta $resposta";
					if($resposta == $respostaCorreta){
					echo("Parabéns você acertou a letra ".$respostaCorreta);
					
					$nProgresso= $progresso + 1;
					if ($nProgresso == 5 or 10 or 15 or 20 or 25 or 30 or 35 or 40 or 45 or 50){
						$nNivel = $nivel + 1;
					} 


					//sql Atualização de progresso
					$sql="UPDATE usuario set progresso = $nProgresso , nivel = $nNivel WHERE email='$email' ";
					//echo "<br> $sql <br>";
					$stmt = mysqli_prepare($conn,$sql);
					if (!$stmt){
					die("Impossivel preparar a consulta ao BD </div>");
					}
					$exec = mysqli_stmt_execute($stmt); // execucao do comando preparado
					if (!$exec){
					die("Impossivel executar consulta Retorne para <a href='atu02.php' class='link'><button class=btnMenu>Atualizar</button></a> </div>");
					}
					mysqli_stmt_close($stmt);
					echo("<br>Acertou e subiu sua pontuação!");
					//atualizar progresso no usuário
					//echo "<br> progresso = $nProgresso <br>";
						echo("
						
						<label class='labelExp'>
						<input type='radio' name='letra' value='$resposta'>
							<img src='images/$resposta.png' class='imgResp'>
							<p>Letra $resposta</p>
						</label><br><br>
						<a href='libras1.php'><button class='btnMenu'>Próximo nível</button></a>
						");                    
						//img certa  aqui
					}else{
						echo("Errou... :( <br><br> <a href='libras1.php'>Tente novamente :)</a>");
					}
				}
				               
			?>
			</div>
		</div>
	</body>
</html>