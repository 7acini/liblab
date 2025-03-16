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
		<link rel="stylesheet" href="css/style.css"> 
		<script src="js/script.js"></script> 
		<script src="js/TopResponsivo.js"></script> 

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
						<img alt='menu' src='images/menu.png' class='icomenu'>
                        </a>
                    </div> 
                    <div class='conteudoSudo'>
		          ";
    			}
			?>
		<fieldset class="fid"><legend class="leg">Formulário de inserção questões</legend>
			<form action="inserir2.php" enctype="multipart/form-data" method="POST" name="form1" onsubmit="return validaInsert()">
					Adicione o nível, pergunta, resposta e imagens da questão:
					<div id="quest" class="quest"> 
						<b> Nível: </b>  <input type="number"   id="niv"   name="niv"     size="7" min="1" max="50"><br>
						<b> Pergunta:</b><input type="text"     id="perg"  name="perg"    size="50" maxlength="256" ><br>
						Upload de Imagem da pergunta:<input  type="file"   name="userImage" class="inputFile" />
                        <br> PS.<u>(Limite = 1024M ou 1G)</u><br> <hr>
						<b> Resposta: </b> <input type="text"   id="resp"   name="resp"    size="50"maxlength="256" ><br>		
						Upload de Imagem da resposta: <input name="userImage2" type="file" class="inputFile" />
                        <br> PS.<u>(Limite = 1024M ou 1G)</u> 					
					</div>
					<br><input type="submit" value="ENVIAR" class="sub">
				</form>
		</fieldset>

		<br><a href="listImagesPR.php" class="btnMost" style="text-decoration: none;">Listar imagens no banco de questões</a>
	</body>
</html>