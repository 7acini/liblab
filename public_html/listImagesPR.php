<?php
//lista imgs no bd
	require_once "sess_start.php";
    require_once "conectaBd.php";
	 //conferencia sudo 
	 $emailS=$_SESSION['email'];
	 //echo"$emailS";
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
<html>
    <head>
        <title>Lista de imagens</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="js/TopResponsivo.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" type="image/jpg" href="images/art.png">
    </head>
    <body>
	<div class="topnav" id="myTopnav">
        <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
        <a href="sair.php" class="right">Sair</a>
        <a href="modulos.php" class="right">Módulos</a>
        <a href="pesquisa.php" class="right">Pesquisa</a>
		<a href="alfa.php" class="right">Alfabeto</a>

			<?php 
    			if ($sudo== "S") {
					echo "
						<a href='inserir.php' class='right'>Gerenciador de questões</a>
			    		<a href='cadAdm1.php' class='right'>Cadastrar</a>
                        <a href='del01.php' class='right'>Deletar</a>
                        <a href='atu01.php' class='right'>Atualizar</a>
                        <a href='vocabulario.php' class='right'>Vocabulario</a>
                        <a href='javascript:void(0);' class='icon' onclick='topResp()'>
                            <img src='images/menu.png' class='icomenu' alt='menu'>
                        </a>
                    </div> 
                    <div class='conteudoSudo'>
		          ";
    			}
    			else{
    			    echo"
                        <a href='javascript:void(0);' class='icon' onclick='topResp()'>
                            <img src='images/menu.png' class='icomenu' alt='menu'>
                        </a>
                    </div>
    			        <div class='conteudo'>
    			    ";
    			}
			?>
        </div>
        <div class="conteudoSudo">
            <h1 class="titulo">Lista de níveis, perguntas, respostas e imagens...</h1>
           <table class="tablePR">
                <tr>
                    <th>NÍVEL</th>
                    <th> PERGUNTA</th>
                    <th> IMG-PERGUNTA</th>
                </tr>
                
           <?php
            //pergunta
				$perg = "SELECT nivel, pergunta FROM pergunta ORDER BY idPergunta ";
				$datasetP = mysqli_query($conn,$perg);
                if (!$datasetP) {
                    die("Impossivel recuperar registros!");
                }
                if (mysqli_num_rows($datasetP)==0) {
                    die("Nenhuma pergunta cadastrada no banco de dados!");
                } 
                echo("LISTA NÍVEIS, PERGUNTAS E RESPOSTAS<br>");
                while($linhaBdP=mysqli_fetch_assoc($datasetP)){
                    $nivel = $linhaBdP['nivel'];
                    $pergunta = $linhaBdP['pergunta']; 
                    echo("Nível: $nivel<br>");
                    echo("Pergunta: $pergunta<hr>");
                ?>
                <tr>
                    <td><?php echo("Nível: $nivel<hr>");?></td>
                    <td><?php echo("Pergunta: $pergunta<hr>");?></td>
                <?php
                } 
           //imgPergunta
                $sqlP = "SELECT imageId FROM imgPergunta ORDER BY imageId "; 
                $stmtP = $conn ->prepare($sqlP);
                $stmtP->execute();
                $resultP = $stmtP->get_result();
                if($resultP->num_rows > 0){
                    while($rowP = $resultP->fetch_assoc()) {
            ?>
                    <td>Imagem da Pergunta:<img class="imgPR" src="imageViewPR.php?image_id=<?php echo $rowP["imageId"]; ?>" /><hr></td>
                </tr>
            <?php		
                    }
                }
            ?> 
                <tr>
                    <th>RESPOSTA</th>
                    <th> IMG-RESPOSTA</th>
                </tr>
			<?php
            //resposta
            $resp = "SELECT resposta FROM resposta ORDER BY idResposta ";
            $datasetR = mysqli_query($conn,$resp);
            if (!$datasetR) {
                die("Impossivel recuperar registros!");
            }
            if (mysqli_num_rows($datasetR)==0) {
                die("Nenhuma resposta cadastrada no banco de dados!");
            } 
            while($linhaBdR=mysqli_fetch_assoc($datasetR)){
                $resposta = $linhaBdR['resposta'];
                echo("Resposta: $resposta<hr>"); 
            ?>
            <tr>
                <td><?php echo("Resposta: $resposta<hr>");?></td>
            <?php
            }
            //imgResposta
                $sqlR = "SELECT imageId FROM imgResposta ORDER BY imageId "; 
                $stmtR = $conn ->prepare($sqlR);
                $stmtR->execute();
                $resultR = $stmtR->get_result();
                if($resultR->num_rows > 0){
                    while($rowR = $resultR->fetch_assoc()) {
            ?>
                    <td><div>Imagem da Resposta:<img class="imgPR" src="imageViewPR.php?image_id=<?php echo $rowR["imageId"]; ?>" /><hr></div></td>
                </tr>
           
            <?php		
                    }
                }
                mysqli_close($conn);
            ?>         
           </table>
        </div>
    </body>
</html>