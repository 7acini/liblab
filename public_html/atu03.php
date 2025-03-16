<?php
	require("sess_start.php");
	require("conectaBd.php");
	require("crip2gr4.php");
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
            <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
            <a href="sair.php" class="right">Sair</a>
            <a href="menupri.php" class="right">Menu</a>
            <a href="cadAdm1.php" class="right">Cadastrar</a>
            <a href="del01.php" class="right">Deletar</a>
            <a href="atu01.php" class="right">Atualizar</a>
            <a href="javascript:void(0);" class="icon" onclick="topResp()">
            <img src="menu.png" alt="menu">
            </a>
        </div> 
		<div class="conteudoSudo">
    		<div class="atu">
        		<div class="msg">
                    <h1>Atualização</h1>
        			<?php
        				//echo (print_r($_POST,true));
        				$email=$_POST['email'];
        				$nomeCompleto=$_POST['nomeCompleto'];
        				$dtNasc=$_POST['dtNasc'];
        				$senhaAtual=$_POST['senhaAtual'];
        				$senhaNova1=$_POST['senhaNova1'];
        				$senhaNova2=$_POST['senhaNova2'];
        				
        				if(empty($email)){
        					die("EMAIL precisa ser preenchido!  Retorne para <a href='atu02.php'><button class=btnMenu>Atualizar</button></a>");
        				}
        				if(empty($nomeCompleto)){
        					die("Nome precisa ser preenchido! Retorne para <a href='atu02.php'><button class=btnMenu>Atualizar</button></a>");
        				}
        				if(empty($dtNasc)){
        					die("Data de nascimento precisa ser preenchido! Retorne para <a href='atu02.php'><button class=btnMenu>Atualizar</button></a>");
        				}
        				if(empty($senhaAtual)){
        					die("Senha atual precisa ser preenchida! Retorne para <a href='atu02.php'><button class=btnMenu>Atualizar</button></a>");
        				}
        				if($senhaNova1 != $senhaNova2){
        					die("Senhas novas não conferem! Retorne para <a href='atu02.php'><button class=btnMenu>Atualizar</button></a>");
        				}				
        				
        				$sql="SELECT senha from usuario where email=? ";
                            $stmt = mysqli_prepare($conn,$sql);
                            if (!$stmt){
                                die("Impossivel preparar a consulta ao BD");
                            }
                            $bind = mysqli_stmt_bind_param($stmt,"s",$email); 
                            if (!$bind){
                                die("Impossivel vincular dados à consulta");
                            }
                            $exec = mysqli_stmt_execute($stmt); 
                            if (!$exec){
                                die("Impossivel executar consulta");
                            }
                            $result = mysqli_stmt_bind_result($stmt,$senhaBD);
                            if (!$result){
                                die("Não foi possivel recuperar dados da consulta");
                            }
                            $fetch = mysqli_stmt_fetch($stmt);
                            if (!$fetch){
                                die("Não conseguiu associar dados de retorno");
                            }
                            if ($fetch == null){
                                die("Esse EMAIL não foi encontrado no banco de dados.");
                            }                    
                            mysqli_stmt_close($stmt);
                            if(ChecaSenha($senhaAtual, $senhaBD)){
        						$sql="UPDATE usuario set ";
        						$sql.="nomeCompleto=?,dtNasc=?,senha=? ";  
        						$sql.=" WHERE email=? ";  
        						$stmt = mysqli_prepare($conn,$sql); //conexao aberta via require, que utiliza o prepare (SQL preparado)
        						if (!$stmt){
        							die("Impossivel preparar a consulta ao BDDDD");
        						}
        						$bind = mysqli_stmt_bind_param($stmt,"ssss",$nomeCompleto,$dtNasc,$senhaNova1,$email); 
        						if (!$bind){
        							die("Impossivel vincular dados à consulta");
        						}	
        						$senhaNova1 = FazSenha($email,$senhaNova1);				
        						$exec = mysqli_stmt_execute($stmt); // execucao do comando preparado
        						if (!$exec){
        							die("Impossivel executar consulta Retorne para <a href='atu02.php' class='link'><button class=btnMenu>Atualizar</button></a>");
        						}							
        						mysqli_stmt_close($stmt);
        						echo("
                                    <br>Dados do usuárioslterados com sucesso<br><br><br>
    					            <a href='menupri.php'><button cLass='btnMenu'>Menu</button></a><br><br>
    					            <a href='atu01.php'><button cLass='btnMenu'>Alterar outro usuário</button></a><br><br>
        						");
        					} else{
        							die("Senha atual não confere com a cadastrada! Retorne para <a href='atu01.php'><button class='btnMenu'>Atualizar</button></a>");
        						}                                   
        			?>								
        			<?php echo("<br><br>Operador= ".$_SESSION['email']);?>
        		</div>
    		</div>
	    </div>
	</body>
</html>