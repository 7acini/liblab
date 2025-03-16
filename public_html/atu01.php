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
		<div class="atu">
		    <div class="conteudoSudo">
    			<?php
    				$sql = "select * from usuario";
    				$dataset = mysqli_query($conn,$sql);
    				if (!$dataset) {
    					die("Impossivel recuperar registros!");
    				}
    				if (mysqli_num_rows($dataset)==0) {
    					die("Nenhum usuario cadastrado no banco de dados!");
    				} 
    			?>
    			<form action="atu02.php" class="frmAtu" name="frmAtu01" method="POST">
            		<h1>Atualizar registros</h1>
                    <table class="table">
                    <tr>
                    <th></th>
                    <th>EMAIL</th>
                    <th>NOME COMPLETO</th>
                    <th>ATIVO</th>
                    </tr>
                    <?php
                    while ($linhaBd=mysqli_fetch_assoc($dataset)) {
                    $email = $linhaBd['email'];
                    $nomeCompleto = $linhaBd['nomeCompleto'];
                    $ativo = $linhaBd['ativo'];
                    ?>
                    <tr>
                    <th><input type="radio" name="rdEmail" value="<?php echo($email);?>"></th>
                    <th><?php echo($email."<hr>");?></th>
                    <th><?php echo($nomeCompleto."<hr>");?></th>
                    <th><?php echo($ativo."<hr>");?></th>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
    				<br>
                    <input type="submit" class="btnAtu" value="ATUALIZAR">
    			</form>
    								
    			<?php
    					echo("<br><br>Operador= ".$_SESSION['email']);
    			?>
    				
    		</div>
        </div>
	</body>
</html>