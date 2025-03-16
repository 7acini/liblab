<?php
function maisUm($entrada = 1){
		return ++$entrada;//realizar o calculo e retorna-lo na mesma funcao
	}
	function menosUm($saida){
		return --$saida;//realizar o calculo e colocar o "return", para retornar a funcao
	}
	function nossoPi(){
		return 3.1415;//nao e necessario a utilizacao de variaveis, ja que PI e um valor fixo, portanto apenas retorna seu valor
	}

//ENVIO EMAIL
	function mandarEmail($To, $Subject, $Message,$cc=null,$bcc=null){
		require('PHPMailer/PHPMailerAutoload.php');//simplificada de toda estrutura do PHPMailer
		$mail = new PHPMailer;//novo obj
		//$mail->SMTPDebug = 2; //debug (dialogo da comunicação)
		$mail->isSMTP();
		$mail->Charset = 'UTF-8';
		$mail->Host ='smtp.gmail.com';
		$mail->SMTAuth = true;
		$mail->Port = 587; //em precisa especificaff que é TLS
		$mail->Username = 'viagemMleitura@gmail.com';
		$mail->Password = '!$echo.,';
		$mail->From = 'viagemMleitura@gmail.com';
		$mail->FromName = utf8_decode('Viagem Mundo da Leitura');
		$msg = "Email para ";
		if(gettype($To)=="array"){//gettype consegue pegar algo
			foreach($To as $key => $value){
				$mail->addAddress($value);
				$msg.=$value."";
			}
		} else{
			$mail->addAddress($To);
		}
	$mail->isHTML(true);
	//$mail->addAttachment('/var/tmp/file.jpg.gz');//add anexos
	//$mail->addAttachment('/tmp/image.jpg,'.'new.jpg');

	$mail->Subject = utf8_decode($Subject);//tratamento de codigo para utf-8
	$mail->Body = utf8_decode($Message);//tratamento de codigo para utf-8
	$mail->AltBody = 'Seu email precisa ser capaz dd usar HTML para mostrar a mensagem! Verifique.';

	if(!$mail->send()){
		error_log("Não consegui enviar email para $To");//log do apache
		return false;
	} 
	return true;
$txt = "<html>";
$txt.= "<head>";
$txt.= "</head>";
$txt.= "<body>";
$txt.= "<span>EMAIL</span>";
$txt.= "<br>";
$txt.= "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Omnis eaque sequi temporibus veniam ea enim? Excepturi velit nulla, animi rem ipsa quisquam molestias facilis odio porro aperiam pariatur, dolore reiciendis.";
$txt.= "<br>";
$txt.= "Verifique e retorne caso haja problemas.";
$txt.= "</body>";
$txt.= "</html>";

$retorno = mandarEmail(array("gustavo.oliveira649@etec.sp.gov.br", "gustavo.firmino.oli@gmail.com"),"Teste de envio em PHP, $txt");
if(!$retorno){
	die("Não foi possível enviar o email!");
}else{
	echo("Email enviado!");
}
}
?>