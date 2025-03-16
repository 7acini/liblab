<?php
     require("crip2gr4.php");
     require("conectaBd.php");
     $del = "SELECT ativo FROM usuario WHERE ativo = 'N'";
?>
<!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="shortcut icon" type="image/jpg" href="images/art.png">
            <title>Login 2</title>
        </head>
    <body class= "body">
                <?php                
                    //vem do login 1 (name)
                    $email=$_POST['email']; 
                    $senha=$_POST['pwd'];
                    //verificacao dos dados preenchidos
                    //email
                    if (!filter_var( $email, FILTER_VALIDATE_EMAIL )) {
                        die("<div class='msg'>Um EMAIL necessita ser escrito de forma correta (@gmail.com|@outlook.com|@___.com). <a href='login01.php'>Retorne</a><br></div>");					
                    }
                    //campo senha
                    if(!isset($_POST['pwd'])){
                        die("<div class='msg'>senha não foi transmitida! <a href='login01.php'>Retorne</a></div>");
                    }else{
                        $senha=$_POST['pwd'];
                        if (strlen($senha)<5) {
                            die("<div class='msg'>senha necessita de pelo menos 5 digitos. <a href='login01.php'>Retorne</a></div>");
                        }
                    }
                    //login 
                    $sql="SELECT nomeCompleto,senha,ativo from usuario where email=? "; //nao indica o texto $email; e sim apenas um parametro, representado por (?) 
                    //echo("SQL: ".$sql); //teste do sql
                    $stmt = mysqli_prepare($conn,$sql);
                    if (!$stmt){
                        die("<div class='msg'>Impossivel preparar a consulta ao BD. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }
                    
                    $bind = mysqli_stmt_bind_param($stmt,"s",$email); //vinculo de parametro de entrada, na string ao começo do programa há uma posicao de um campo por parametro "s" tal letra indica quantidade e tipo string 
                    if (!$bind){
                        die("<div class='msg'>Impossivel vincular dados à consulta. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }

                    $exec = mysqli_stmt_execute($stmt); // execucao do comando preparado
                    if (!$exec){
                        die("<div class='msg'>Impossivel executar consulta. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }

                    $result = mysqli_stmt_bind_result($stmt, $nomeCompletoBD,$senhaBD,$ativo); //obter resuoltados da execucao do comando ($exec = mysqli_stmt_execute($stmt);)
                    if (!$result){
                        die("<div class='msg'>Não foi possivel recuperar dados da consulta. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }

                    $fetch = mysqli_stmt_fetch($stmt);
                    if (!$fetch){
                        die("<div class='msg'>Não conseguiu associar dados de retorno Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }
                    
                    if ($fetch == null){
                        die("<div class='msg'>Essa combinação login/senha não foi possível de ser encontrada. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }
                    //lembre-se: O fethc já já copiou os resultados indicados pelo bind_result
                    mysqli_stmt_close($stmt);
                    //verificacao usuario ativo
                    if($ativo == "N"){
    			        die("Este usuário foi deletado do sistema! <a href='login01.php'> Retorne</a> ");
    			    }
                    //teste senha
                    if(ChecaSenha($senha, $senhaBD)){
                        echo("
                        		<div class='topnav'>
			                        <a href='index.php'class='active'><i><b>LIB-LAB</b></i></a>
                        			<a href='sair.php' class='right' id='sair' class='icon'>Sair</a>
		                        </div>
		                        <div class = 'conteudo'>
		                            <div class='msg'>
                                        <h1>Login do Sistema</h1> 
                                        <p class='sis'>Você está no sistema  $nomeCompletoBD :)</p> 
                                        <a href='menupri.php'><button class='btnMenu'>Menu</button></a> <br><br>
                                    </div>
                                </div>
				        ");
                        if (!session_start()){ /*O not "!" inverte a lógica, portanto se for não verdadeiro irá executar o bloco*/
                            die("<div class='msg'>Impossivel prosseguir!! Sessão não foi iniciada. Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                        }
                        $_SESSION ['id']=session_id();//dados para nao deixar a session vazia
                        $_SESSION['email']=$email; //recupera o email do operador
                        $_SESSION['operador']=$email; //informacao relevante
                        $_SESSION['operadorNomeCompleto']=$nomeCompletoBD;//informacao relevante
                    }else{
                        die("<div class='msg'>Retorne para <a href='login01.php' class='link'>Login</a> e tente novamente</div>");
                    }
                   
                    //$_SESSION=array();                        
                    
                ?>
    </body>
</html>
