<?php
    require("sess_start.php");
    require("conectaBd.php");
    $ativo="S";
    if (isset($_SESSION['ativo'])) {
        $ativo="N";
        unset($_SESSION['ativo']);
    }
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
        <link rel="shortcut icon" type="image/jpg" href="images/art.png">
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
            <?php //não precisa de slq injection
                $sql = "select * from usuario ";
                if ($ativo=="S"){$sql.=("where ativo='S'");} 
                $dataset = mysqli_query($conn, $sql);//chama as variaveis de conexao
                if(!$dataset){
                    die("Não foi possivel recuperar dados do banco");
                }
                $qtde = mysqli_num_rows($dataset);
                if($qtde == 0){
                    echo("Não há registros cadastrados,para a exclusão!");
                }else{//chamada de campos na tela por o laço while
                echo("<form name='frmDel' class='frmAtu' action='del02.php' method='POST'>
                        <h1>Remover usuário</h1>
                        <h2>Escolha um usuário para remover</h2>
                    ");
                echo("<input type='checkbox' name='chkAtivo' value='X' onclick='form.submit()'");
                if ($ativo == "N"){echo("checked");}
                echo(">Mostrar registros deletados<br>");                            
                    echo("<table class='table'><tr>");
                    echo("<th></th>");    
                    echo("<th>EMAIL</th>");
                    echo("<th>Nome completo</th>");
                    echo("<th>Data de nascimento</th>");
                    echo("<th>|Administrador</th>");
                    echo("</tr>");
                    $i =0;//numerando vetor
                    while($linhaBD=mysqli_fetch_assoc($dataset)){
                     //Ira retornar $linhaBD ['EMAIL']; (em vetores)   
                     //Ira retornar $linhaBD ['senha']; (em vetores)   
                     //Ira retornar $linhaBD ['nomeCompleto']; (em vetores)   
                     //Ira retornar $linhaBD ['dtNasc']; (em vetores)
                     //Ira retornar $linhaBD ['operador']; (em vetores)
                    echo("<tr>");//coluna de escolha do tipo radio
                        echo("<td><input type='radio' 
                            value='".$linhaBD['email']."' 
                            name='rdEmail'></td>");   //numerando vetor
                        $i++;//numerando vetor
                        echo("<td>".$linhaBD['email']."</td>");
                        echo("<td>".$linhaBD['nomeCompleto']."</td>");
                        echo("<td>".$linhaBD['dtNasc']."</td>");
                        echo("<td>".$linhaBD['sudo']."</td>");
                    echo("</tr>");
                    
                    }
                    echo("</table> <br>");
                    echo("<input type='submit' class='btnAtu' value='REMOVER' >");
                    echo("</form>");
                }
                echo("<br><br>Operador EMAIL= ".$_SESSION['email']);
            ?>
        </div>            
    </body>
</html>