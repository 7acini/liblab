<?php
	//conectar BD
	$servidorCONN="127.0.0.1"; //proprio equipamento; porém caso utilize um servidor, basta mudar o IP
	$usuarioCONN="root"; //usuario de acesso ao BD
	$senhaCONN=""; // senha do acesso ao BD
	$bdCONN="id19548709_libbanco"; //muda a tabela de BD
	$conn = mysqli_connect($servidorCONN,$usuarioCONN,$senhaCONN,$bdCONN);//passagem de parametros, para realizar conexao, teste true = !0 | false = 0
	if(!$conn){
		die("Impossivel realizar conexão com o Banco de dados!");
	}
