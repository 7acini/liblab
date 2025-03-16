<?php
//recupera img do bd
//pergunta
    require_once "conectaBd.php";
    if(isset($_GET['image_id'])) {
    $sql = "SELECT imageType,imageData FROM imgVoc WHERE imageId=" . $_GET['image_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problema em Recuperar Imagem BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
	}
	mysqli_close($conn);
?>
