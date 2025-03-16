<?php
	require("sess_start.php");
    require("conectaBd.php");
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
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
		<title>Inserir questões</title>
		<link rel="stylesheet" href="style.css"> 
	</head>
	<body>
		<?php
			//trasformar os campos do forms (identificados por name) em variáveis para execução do comando insert			
			$nivel = $_POST['niv'];
			$pergunta = $_POST['perg'];
			$resposta = $_POST['resp'];
			//conferência dos campos
			//nivel
			if(!isset($_POST['niv'])){
				echo"<div class='msg'> NÍVEL não foi preenchido! <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>";
			}else{
				$nivel = $_POST['niv'];
			}
			//pergunta
			if(!isset($_POST['perg'])){
				echo"<div class='msg'> PERGUNTA não foi preenchido! <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>";
			}else{
				$pergunta = $_POST['perg'];
			}
			//resposta
			if(!isset($_POST['resp'])){
				echo"<div class='msg'> RESPOSTA não foi preenchido! <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>";
			}else{
				$resposta = $_POST['resp'];
			}
			echo("Valores transmitidos: <br>");
			echo("Nível: ".$nivel."<br>");
			echo("Pergunta: ".$pergunta."<br>");
			echo("Resposta: ".$resposta."<br><hr>");

			//sql inserir dados nas tabelas
			//resposta
			$sqlR="INSERT INTO resposta (resposta) VALUES(?)";
			$stmt = mysqli_prepare($conn,$sqlR);
			if (!$stmt){
				die("<div class='msg'>Impossivel preparar a inserção de respostas no BD.  <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>");
			}
			/*
			echo($nivel);
			echo($pergunta);
			echo("<br>$sqlP<br>"); 
			*/

			$bind = mysqli_stmt_bind_param($stmt,"s",$resposta);
			if (!$bind){
				die("<div class='msg'>Impossivel vincular dados a inserção de resposta. <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>");
			}

			$exec = mysqli_stmt_execute($stmt);
			if(!$exec){
				die("<div class='msg'>Não consegui inserir os dados de  resposta no Banco! <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>");
			}else{
				echo("Resposta: ".$resposta."<br>");
				echo("Inserção de RESPOSTA OK!");
			}
			//inserção imgs - resposta
			if(count($_FILES) > 0) {
				if(is_uploaded_file($_FILES['userImage2']['tmp_name'])) {
					$imgData =addslashes(file_get_contents($_FILES['userImage2']['tmp_name']));
					$imageProperties = getimageSize($_FILES['userImage2']['tmp_name']);
					//add a fk da palavra neste insert
					$sqlR = "INSERT INTO imgResposta(imageType ,imageData)
					VALUES('{$imageProperties['mime']}', '{$imgData}')";
					$current_id = mysqli_query($conn, $sqlR) or die("<b>Error:</b> Problema em Inserir  a imagem<br/>" . mysqli_error($conn));
					if(isset($current_id)) {
						//header("Location: listImagesVoc.php");
						echo("Inserção de imagem da resposta completa! <br> <a href='listImagesPR.php'>VER  IMAGEM NO BANCO</a><hr>");
					}
				}
			}

			//pergunta
			$sqlP= "INSERT INTO pergunta(nivel,pergunta) VALUES (?,?)";
			$stmt = mysqli_prepare($conn,$sqlP);
			if (!$stmt){
				die("<div class='msg'>Impossivel preparar a inserção de pergunta no BD.  <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>");
			}

			$bind = mysqli_stmt_bind_param($stmt,"is",$nivel,$pergunta);
			if (!$bind){
				die("<div class='msg'>Impossivel vincular dados a inserção de pergunta. <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>");
			}

			$exec = mysqli_stmt_execute($stmt);
			if(!$exec){
				die("<div class='msg'>Não consegui inserir os dados de pergunta no Banco! <br> Retorne e tente novamente: <a class='link' href='inserir.php'>VOLTAR</a></div>");
			}else{
				echo("<br>Resposta: ".$pergunta."<br>");
				echo("Inserção de PERGUNTA OK!");
			}
			//inserção imgs - pergunta
			if(count($_FILES) > 0) {
				if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
					$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
					$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
					//add a fk da palavra neste insert
					$sqlP = "INSERT INTO imgPergunta(imageType ,imageData)
					VALUES('{$imageProperties['mime']}', '{$imgData}')";
					$current_id = mysqli_query($conn, $sqlP) or die("<b>Error:</b> Problema em Inserir  a imagem<br/>" . mysqli_error($conn));
					if(isset($current_id)) {
						//header("Location: listImagesVoc.php");
						echo("Inserção de imagem da pergunta completa! <br> <a href='listImagesPR.php'>VER  IMAGEM NO BANCO</a><hr>");
					}
				}
			}
			echo("<h1>INSERÇÃO COMPLETA</h1>");	
			echo("Nível: ".$nivel."<br>");
			echo("Pergunta: ".$pergunta."<br>");
			echo("Resposta: ".$resposta."<br>");
			echo("Inserção de QUESTÃO OK!<hr>");
        ?>
	</body>
</html>