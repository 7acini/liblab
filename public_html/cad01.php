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
            <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
            <a href="login01.php" class="right">Login</a>
            <a href="javascript:void(0);" class="icon" onclick="topResp()">
                <img src="images/menu.png" alt="menu" class="icomenu">
            </a>
        </div> 
		<div>
        	<form name="form1" id="form1" method="POST" action="cad02.php" onsubmit="return validaCad()">
    			<h1>Cadastro</h1>
    			<label class="cad" for = "EMAIL">Email:</label>
    			<input type="text" name="email" minlength="5" maxlength="100" size="40" placeholder="Email" id="email" autocomplete="on">
    			<label class="cad" for = "Nome completo">Nome de Usuário:</label>
    			<input type="text" name="nomeCompleto" maxlength="150" size="40" minlength="5" placeholder="Nome completo" id="nomeCompleto" autocomplete="off">
    			<label class="cad" for = "senha">Senha:</label> 
    			<input type="password" name="pwd" minlength="5" maxlength="100" size="25" placeholder="Senha" id="pwd" onclick="">
    			<label class="cad" for="data">Data de nascimento:</label>
    			<input type="date" id="data" name="date"><br><br>
    			<input type="submit" name="submit" id="submit" value="Cadastrar"><br>
    			<a href="login01.php">Já tem conta? Entrar</a><br>
    		</form>
    	</div>
    </body>
</html>