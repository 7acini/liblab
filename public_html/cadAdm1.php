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
<html>
	<head>
		<meta charset="utf-8">
		<title>Cadastro Tela-1</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
		<script src="js/script.js"></script>
        <script src="js/TopResponsivo.js"></script>
	</head>
    <body class="body">
        <div class="topnav" id="myTopnav">
            <a href="menupri.php" class="active"><i><b>LIB-LAB</b></i></a>
            <a href="sair.php" class="right">Sair</a>
            <a href="menupri.php" class="right">Menu</a>
            <a href="cadAdm1.php" class="right">Cadastrar</a>
            <a href="del01.php" class="right">Deletar</a>
            <a href="atu01.php" class="right">Atualizar</a>
            <a href="javascript:void(0);" class="icon" onclick="topResp()">
                <img src="images/menu.png" alt="menu" class="icomenu">
            </a>
        </div> 
		<div class="conteudoSudo">
        	<form name="form1" id="form1" method="POST" action="cadAdm2.php" onsubmit="return validaCad()">
    			<h1>Cadastro</h1>
    			<label for = "EMAIL">Email:</label>
    			<input type="text" name="email" minlength="5" maxlength="100" size="40" placeholder="Email" id="email" autocomplete="off">
    			<label for = "Nome completo">Nome de Usuário:</label>
    			<input type="text" name="nomeCompleto" maxlength="150" size="40" value="" placeholder="Nome completo" id="nomeCompleto" autocomplete="off">
    			<label for = "senha">Senha:</label>
    			<input type="password" name="pwd" minlength="5" maxlength="100" size="25" placeholder="Senha" id="pwd">
    			<label for="data">Data de nascimento:</label>
    			<input type="date" id="data" name="date"><br>
    			<label for="Administrador">Administrador:</label>
    			SIM
    			<input type="radio" name="adm" value="S"><br>
    			NÃO
    			<input type="radio" name="adm" value="N"><br>
    			<br><input type="submit" name="submit" id="submit" value="Cadastrar"> 
    		</form>
    		<?php
    			echo("<br><br>Operador= ".$_SESSION['email']);
    		?>
    	</div>
    </body>
</html>