<?php     
	require "sess_start.php";
    require "conectaBd.php";
    //algoritmo reconhecimento do nível paradirecionar o usuário de acordo com seu nível
    //$progresso campo da tabela usuario que avanca de acrodo com os acertos
    //select nível user
    $email = $_SESSION['email'];
    $sql = "SELECT progresso FROM usuario WHERE email = '$email'";
    $result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problema em Recuperar pergunta<br/>" . mysqli_error($conn));
    $linha = mysqli_fetch_array($result);
    $progresso = $linha["progresso"];
    switch($progresso){
        case "1":
            echo("Você está na introdução!! ".$progresso);
            header("Location: game1.php");
            //die();//protecao rastreadores
        break;
        case "2":
            echo("Você está no modulo inicial!! ".$progresso);
            header("Location: game2.php");
            //die();//protecao rastreadores
        break;
        case "3":
            echo("Você está no ".$progresso);
            header("Location: game3.php");
            //die();//protecao rastreadores
        break; 
        default:
            echo"Você está começando agr ;)";
            header("Location: game.php");
            //die();//protecao rastreadores   
    }
?>
<!DOCTYPE HTML>
<html lang="pt-br">    
    <head>         
        <meta charset="UTF-8">       
        <link rel="shortcut icon" type="image/jpg" href="images/art.png">	
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <script src="js/scriptGame.js"></script>
        <link rel="stylesheet" href="css/styleGame.css">
        <title>modulos</title>
    </head>
    <body>
        <h1>Seleção de modulos</h1>
    </body>
</html>


