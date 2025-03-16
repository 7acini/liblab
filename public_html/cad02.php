<?php
	require("crip2gr4.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cadastro - Tela 2</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="shortcut icon" type="image/jpg" href="images/art.png">
	</head>
    <body class= "body">
			<?php 
			//os vetores (definidos entre []) foram definidos no campo "name" do cad01
			//campo email
				if(!isset($_POST['email'])){
					echo"<div class='msg'> cadO EMAIL não foi preenchido! <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>";
				}else{
				    $email=$_POST['email'];
				}
				if (filter_var( $email, FILTER_VALIDATE_EMAIL )) {
				}else {
					die ("<div class='msg'>Um EMAIL necessita ser escrito de forma correta (@gmail.com|@outlook.com|@___.com). <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");					
				}
			//campo nome
				$nomeCompleto=$_POST['nomeCompleto'];
				if (strlen($nomeCompleto)<=4) {
					die("<div class='msg'>O nome não foi preenchido corretamente. <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");
				}

			//campo senha
			if(!isset($_POST['pwd'])){
					die("<div class='msg'>senha não foi transmitida! <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");
				}else{
		    		$senha=$_POST['pwd'];
					if (strlen($senha)<5) {
						die("<div class='msg'>senha necessita de pelo menos 5 digitos. <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");
					}
				}
			//dataNasc
				$data=$_POST['date'];//$data é uma variavel local, criada para realizar a ligação com o nascimento atraves do metodo post.
				if(!isset($data)){
					die("<div class='msg'>Nenhum dado transmitido em nascimento.  <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");	
				}

//require vem do conectaBd
				require("conectaBd.php");//ganha a variavel $conn
				//tentar cadastrar
				$sql ="INSERT INTO usuario ";
				$sql.="(email,senha, nomeCompleto, dtNasc) ";
				$sql.="VALUES "; //todos os valores sao texto
				$sql.="(?,?,?,? ) "; //substituicao dos textos por parametros ?
				$stmt = mysqli_prepare($conn,$sql);
				if (!$stmt){
					die("<div class='msg'>Impossivel preparar o cadastro no BD.  <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");
				}
				//antes de bindar parametros no BD temos que preparar a senha
				$senha = Fazsenha($email,$senha);//troca a digitada sem criptografia, pela criptografada
				$bind = mysqli_stmt_bind_param($stmt,"ssss",$email,$senha,$nomeCompleto,$data);
				if (!$bind){
					die("<div class='msg'>Impossivel vincular dados ao cadastro. <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");
				}
				//echo $sql;
				$exec = mysqli_stmt_execute($stmt);
				if(!$exec){
					die("<div class='msg'>Não consegui inserir os dados no Banco! <br> Retorne e tente novamente: <a class='link' href='cad01.php'>Cadastro</a></div>");
				}else{
					echo("
					        <div class='topnav' id='myTopnav' >
                                <a href='index.php' class='active'><i><b>LIB-LAB</b></i></a>
                            </div>
                    		<div class='conteudo'>
                        		<div class='msg'>
                            		<h1>Resultado do cadastro</h1>
            					    Entrou no sistema!<br>
    	        				    Bora começar o aprendizado :)<br><br>
                    ");
				echo"EMAIL: $email <br>";
				echo"Nome completo: $nomeCompleto <br>";
				echo"Nascimento: $data <br>";
				echo"<a href='menupri.php'><button cLass='btnMenu'>Menu</button></a></div></div>";
				if (!session_start()){ /*O not "!" inverte a lógica, portanto se for não verdadeiro irá executar o bloco*/
                            die("<div class='msg'>Impossivel prosseguir!! Sessão não foi iniciada. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                        }
                        $_SESSION ['id']=session_id();//dados para nao deixar a session vazia
                        $_SESSION['email']=$email; //recupera o email do operador
                        $_SESSION['operador']=$email; //informacao relevante
				}
				mysqli_stmt_close($stmt);

			?>
	</body>
</html>