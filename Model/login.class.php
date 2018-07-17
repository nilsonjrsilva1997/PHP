<?php
require_once('../database/config.php');

function getLoginSenha($login, $senha) {
	$mssql = new mssql("", "", "", "", "");
	$iSQL = "SELECT [login_user], [senha] FROM [teste_usuario] WHERE login_user = '$login' AND senha = '$senha';";
	$sql = $mssql->selectquery($iSQL);
	return $sql;
}

function getUsuarios() {
	$mssql = new mssql("", "", "", "", "");
	$iSQL = "SELECT * FROM [teste_usuario];";
	$sql = $mssql->selectquery($iSQL);
	return $sql;
}

 function insertUser($cpf, $login_user, $senha, $sexo, $nome) {
    try {
         $iSQL = "INSERT INTO teste_usuario(cpf, login_user, senha, sexo, nome) values(:cpf, :login_user, :senha, :sexo, :nome);";
   
        $host = '';
        $database = '';
        $login_db = '';
        $senha_db = '';
   
        $pdo = new PDO('sqlsrv:Server='.$host.';Database='.$database, $login_db, $senha_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $pdo->prepare($iSQL);
   
        $query->bindParam(':cpf',$cpf,PDO::PARAM_STR);
        $query->bindParam(':login_user',$login_user,PDO::PARAM_STR);
        $query->bindParam(':senha',$senha,PDO::PARAM_STR);
        $query->bindParam(':sexo',$sexo,PDO::PARAM_STR);
        $query->bindParam(':nome',$nome,PDO::PARAM_STR);
   
        $query->execute();
        $pdo = NULL;    
        return true;        
      } catch(PDOException $e) {
        echo "Erro ao inserir o usuario" . $e->getMessage();
        $pdo = NULL;    
        $resp = 'no function';
        return false;
      }    


   }
?>