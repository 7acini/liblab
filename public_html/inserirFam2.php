<?php
	require("sess_start.php");
    require("conectaBd.php");
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
			//palavra
            $palavra = $_POST['palavra'];
			if(!isset($palavra)){
				echo"<div class='msg'>O campo PALAVRA não foi preenchido! <br> Retorne e tente novamente: <a class='link' href='inserirFam.php'>VOLTAR</a></div>";
			}else{
				$palavra = $_POST['palavra'];
				echo("<br>Valores transmitidos: <br>");
				echo("Palavra: ".$palavra."<br>");
			}

            //$sql Vocabulário
			$sqlV= "INSERT INTO familia (palavra) VALUES(?)";
			$stmt = mysqli_prepare($conn,$sqlV);
			if (!$stmt){
				die("<div class='msg'>Impossivel preparar a inserção de palavra no BD.  <br> Retorne e tente novamente: <a class='link' href='inserirFam.php'>VOLTAR</a></div>");
			}

			$bind = mysqli_stmt_bind_param($stmt,"s",$palavra);
			if (!$bind){
				die("<div class='msg'>Impossivel vincular dados a inserção da palavra. <br> Retorne e tente novamente: <a class='link' href='inserirFam.php'>VOLTAR</a></div>");
			}

			$exec = mysqli_stmt_execute($stmt);
			if(!$exec){
				die("<div class='msg'>Não consegui inserir os dados da palavra no Banco! <br> Retorne e tente novamente: <a class='link' href='inserirFam.php'>VOLTAR</a></div>");
			}else{
				echo("Inserção da PALAVRA OK!<hr>");
			}

			//id Forgein Key
			$idPalFK = "SELECT idPalavra FROM familia WHERE palavra = '$palavra'";
			$dataset = mysqli_query($conn,$idPalFK);
			if (!$dataset){
				die("Impossivel recuperar registros do ID da palavra!");
			}
			if (mysqli_num_rows($dataset)==0) {
				die("Nenhuma palavra foi cadastrada no banco de dados!");
			}
			$linhaBd=mysqli_fetch_assoc($dataset);
			$valueFk = $linhaBd['idPalavra'];
			//echo($valueFk);
            
			//inserção imgs
			if(count($_FILES) > 0) {
				if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
					$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
					$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
					//add a fk da palavra neste insert
					$sql = "INSERT INTO imgFam(imageType ,imageData)
					VALUES('{$imageProperties['mime']}', '{$imgData}')";
					$current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problema em Inserir  a imagem<br/>" . mysqli_error($conn));
					if(isset($current_id)) {
						//header("Location: listImagesVoc.php");
						echo("Inserção de imagem completa! <br> <a href='familia.php'>VER  IMAGEM NO BANCO</a>");
					}
				}
			}
			echo("<h1>INSERÇÃO COMPLETA</h1>");	
		?>
	</body>
</html>