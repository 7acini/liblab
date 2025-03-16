<?php
//recupera img do bd
//pergunta
	require_once "conectaBd.php";
	if(isset($_GET['imageid'])) {
	$sql = "SELECT imageType,imageData FROM imgPergunta WHERE imageId=" . $_GET['imageid'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problema em Recuperar Imagem BLOB<br/>" . mysqli_error($conn));
		$linhaBd30 = mysqli_fetch_array($result);
		header("Content-type: " . $linhaBd30["imageType"]);
		echo $row["imageData"];
	}else{echo"falhou";}
	mysqli_close($conn);
?>