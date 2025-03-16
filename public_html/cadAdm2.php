<?php
   require("sess_start.php");
	require("crip2gr4.php");
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
		<title>Cadastro - Tela 2</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
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
		<div class= "conteudoSudo">	
        	<div class="msg">
        		<H1>Resultado do cadastro</H1>
    			<?php 
    			//os vetores (definidos entre []) foram definidos no campo "name" do cad01
    			//campo email
    				if(!isset($_POST['email'])){
    					echo"O EMAIL não foi preenchido!<a href='cadAdm1.php' class='link'>Retorne</a></div>
						";
    				}else{
    				    $email=$_POST['email'];
    				}
    				if (filter_var( $email, FILTER_VALIDATE_EMAIL )) {
    					echo"EMAIL: $email <br>";
    				}else {
    					die ("Um EMAIL necessita ser escrito de forma correta (@gmail.com|@outlook.com|@___.com). <a href='cadAdm1.php'class='link'>Retorne</a><br></div>");					
    				}
    			//campo nome
    				$nomeCompleto=$_POST['nomeCompleto'];
    				if (strlen($nomeCompleto)<=4) {
    					die("O nome não foi preenchido corretamente. Necessita de no mínimo 4 dígitos <a href='cadAdm1.php'class='link'>Retorne</a><br></div>");
    				}else{
    					echo"Nome completo: $nomeCompleto <br>";
    				}
    			//campo senha
    			if(!isset($_POST['pwd'])){
    					die("senha não foi transmitida!<a href='cadAdm1.php'class='link'>Retorne</a></div>");
    				}else{
    		    		$senha=$_POST['pwd'];
    					if (strlen($senha)<5) {
    						die("senha necessita de pelo menos 5 digitos. <a href='cadAdm1.php'class='link'>Retorne</a><br></div>");
    					}
    				}
    			//dataNasc
    				$data=$_POST['date'];//$data é uma variavel local, criada para realizar a ligação com o nascimento atraves do metodo post.
    				if(!isset($data)){
    					die("Nenhum dado transmitido em nascimento!<a href='cadAdm1.php'class='link'>Retorne</a></div>");	
    				}
    				echo"Nacimento: $data <br>";
    			//campo adm
    				$adm = $_POST['adm'];
    				if(!isset($adm)){
    					die("Preencha o campo administrador!<a href='cadAdm1.php'class='link'>Retorne</a></div>");
    				}
    				if($adm == "S"){
    					echo"$nomeCompleto é um administrador de sistema";
    				}
    				if($adm == "N"){
    					echo"$nomeCompleto não é um administrador de sistema";
    				}
	    			//require vem do conectaBd
    				require("conectaBd.php");//ganha a variavel $conn
    				echo("<br><br>Conseguiu conectar!<br>");
    				//tentar cadastrar
    				$sql ="INSERT INTO usuario ";
    				$sql.="(email,senha, nomeCompleto, dtNasc, sudo) ";
    				$sql.="VALUES "; //todos os valores sao texto
    				$sql.="(?,?,?,?,? ) "; //substituicao dos textos por parametros ?
    				$stmt = mysqli_prepare($conn,$sql);
    				if (!$stmt){
    					die("Impossivel preparar o cadastro no BD</div>");
    				}
    				//antes de bindar parametros no BD temos que preparar a senha
    				$senha = Fazsenha($email,$senha);//troca a digitada sem criptografia, pela criptografada
    				$bind = mysqli_stmt_bind_param($stmt,"sssss",$email,$senha,$nomeCompleto,$data,$adm);
    				if (!$bind){
    					die("Impossivel vincular dados ao cadastro </div>");
    				}
    				$exec = mysqli_stmt_execute($stmt);
    				if(!$exec){
    					echo("Não consegui inserir os dados no Banco! <br> Retorne e tente novamente: <br><br><a href='cadAdm1.php'class='link'>Retorne</a></button></a><br><br>");
    				}else{
    					echo("
    					<br><p class='sis'>Usuario cadastrado com sucesso</p><br><br>
    					<a href='menupri.php'><button cLass='btnMenu'>Menu</button></a><br><br>
    					<a href='cadAdm1.php'><button cLass='btnMenu'>Cadastrar novo usuário</button></a><br><br>
    					</div>
    					");
    				}
    				mysqli_stmt_close($stmt);
    
    			?>
    		</div>
		</div>
	</body>
</html>