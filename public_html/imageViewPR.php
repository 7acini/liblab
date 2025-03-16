<?php
//recupera img do bd
    require_once "conectaBd.php";
//pergunta
	if(isset($_GET['image_id'])) {
   		$sqlP = "SELECT imageType,imageData FROM imgPergunta WHERE imageId=" . $_GET['image_id'];
		$resultP = mysqli_query($conn, $sqlP) or die("<b>Error:</b> Problema em Recuperar Imagem BLOB<br/>" . mysqli_error($conn));
		$rowP = mysqli_fetch_array($resultP);
		header("Content-type: " . $rowP["imageType"]);
        echo $rowP["imageData"];
	}

//resposta
    if(isset($_GET['image_id'])) {
        	$sqlR = "SELECT imageType,imageData FROM imgResposta WHERE imageId=" . $_GET['image_id'];
            $resultR = mysqli_query($conn, $sqlR) or die("<b>Error:</b> Problema em Recuperar Imagem BLOB<br/>" . mysqli_error($conn));
            $rowR = mysqli_fetch_array($resultR);
            header("Content-type: " . $rowR["imageType"]);
            echo $rowR["imageData"];
    }
    mysqli_close($conn);
?>
