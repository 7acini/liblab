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
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
		<title>Atualizar</title>
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
    		<div class="atu">
    			<?php
    				//echo(print_r($_POST,true));//conferencia do resultado do form print (imprimir) r (recursive) true (para funcionar de modo que apenas mostre o valor doque existe, não a dimensão)
    				if(!isset($_POST['rdEmail'])){
    				    die("<div class='msg'>nenhum usuario selecionado, retorne para <a href='atu01.php'><button class=btnMenu>Atualizar</button></a></div>");
    				}
    				$email = $_POST['rdEmail'];
    				$sql = "select * from usuario where email = '$email'";
    				$dataset = mysqli_query($conn,$sql);
    				if (!$dataset) {
    					die("<div class='msg'>Impossivel recuperar registros! Retorne para <a href='atu01.php'><button class=btnMenu>Atualizar</button></a></div>");
    				}
    				if (mysqli_num_rows($dataset)==0) {
    					die("<div class='msg'>Nenhum usuario cadastrado no banco de dados! Retorne para <a href='atu01.php'><button class=btnMenu>Atualizar</button></a></div>");
    				}
    				$linhaBd = mysqli_fetch_assoc($dataset);
    				$nomeCompleto = $linhaBd ['nomeCompleto'];
    				$dtNasc = $linhaBd ['dtNasc'];
    			?>
        
    			<form name="frm_atu02" id="form1" method="POST" action="atu03.php">
                    <h1>Atualizar registros</h1>
    				<label for = "EMAIL">EMAIL:</label><br>
    				<input type="text" id="email" name="email" value="<?php echo($email);?>" maxlength="11" size="11" readonly> <br>
    				<label for = "nomeCompleto">Nome completo:</label><br>
    				<input type="text" id="nomeCompleto" name="nomeCompleto" value="<?php echo($nomeCompleto);?>" maxlength="150" size="50"><br><!--O name = "nome completo será utilizado no cad 2, para realziar a verificação se está correto ou não o numero de caracteres"--->
    				<label for = "senha">Informe a senha atual:</label><br>
    				<input type="password" id="senhaAtual" name="senhaAtual", value=""> <br>
    				<label for = "senha">Informe a nova senha:</label><br>
    				<input type="password" id="senhaNova1" name="senhaNova1", value=""> <br>
    				<label for = "senha">Confirme a senha:</label><br>
    				<input type="password" id="senhaNova2" name="senhaNova2", value=""> <br>
    				<label for = "senha">Data:</label><br>
    				<input type="date" name="dtNasc" id="data" value="<?php echo($dtNasc);?>">
    				<br><br>				
				<input type="submit" name="envioDados" id="submit" class="btnSis" value="ENVIAR"><br>
    			</form>
    			
    								
    
    
    			<?php
    					echo("<br><br>Operador= ".$_SESSION['email']);
    			?>
            </div>
    	</div>
	</body>
</html>