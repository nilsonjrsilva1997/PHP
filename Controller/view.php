<?php

	require_once('../Model/login.class.php');

	$cpf = $_POST['cpf'];
	$login_user = $_POST['login_user'];
	$senha = $_POST['senha'];
	$sexo = $_POST['sexo'];
	$nome = $_POST['nome'];

	if(insertUser($cpf, $login_user, $senha, $sexo, $nome)) {
		echo "Inserido com sucesso";
	}



?>