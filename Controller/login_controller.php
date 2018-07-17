<?php
	require_once('../Model/login.class.php');

	$login = $_POST['username'];
	$senha = $_POST['password'];

	$sql = getLoginSenha($login, $senha);	

	var_dump($sql);

	if(count($sql) != 0) {
		header("Location: ../View/table_usuarios.php");		
	} else {
		echo "Login ou senha incorreto";
	}
?>