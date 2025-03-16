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
        <title>Deletear registros</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
            <h1>Remover usuário</h1>
            <h2>Resultados da remoção</h2>
                <?php                    
                    //die( print_r($_POST));                   
                    if (isset($_POST['chkAtivo'])) {
                        $_SESSION['ativo']='N';
                        ob_clean();//outputbuffer clean = faz um "reload" da pag. para ver os outros usuarios
                        header("Location: del01.php");
                        exit();
                    }else{
                        header("Location: del01.php");
                    }
                    $email = $_POST['rdEmail'];
                    //$sql = "DELETE from usuario where email='$email'"; //exclusao real
                    $sql = "UPDATE usuario set ativo='N' where email='$email'";//exclusao logica
                    //die("<br>$sql");
                    $dataset = mysqli_query($conn,$sql);
                    //conferir se foi marcado
                    if(!$dataset){
                        die("Não foi possivel remover usuario!");
                    }else{
                        echo("Usuario removido com sucesso!");
                    }                        
                    echo("<br><br>Operador EMAIL= ".$_SESSION['email']);
                ?>
        </div>
    </body>
</html>