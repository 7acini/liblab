<?php
//lista imgs no bd
	require "sess_start.php";
    require_once "conectaBd.php";
	 //conferencia sudo 
	 $emailS=$_SESSION['email'];
	 //echo"$emailS";
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
<html>
    <head>
        <title>Lista de imagens</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="js/TopResponsivo.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" type="image/jpg" href="images/art.png">
    </head>
    <body>
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
            <h1 class="titulo">Lista de imagens e vocabulários</h1>
            <table class="tableVoc">
				<tr>
					<th>VOCABULÁRIO</th>
					<th> IMAGEM</th>
				</tr>
			<?php
                //vocabulario 
				$voc = "SELECT palavra FROM vocabulario ORDER BY idPalavra";
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
					<tr>
                    	<td><?php echo("Vocabulário: $palavra<hr>");?></td>
			<?php
				}
				//imagem
				$sql = "SELECT imageId FROM imgVoc ORDER BY imageId"; 
				$result = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_array($result)) {	
				?>
				 		<td>Imagem da Pergunta:<img class="imgPR" src="imageViewVoc.php?image_id=<?php echo $row["imageId"]; ?>" /><hr></td>
                	</tr>
			<?php
				}
                mysqli_close($conn);
            ?>
			</table>
        </div>
    </body>
</html>