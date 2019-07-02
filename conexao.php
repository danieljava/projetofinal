<?php 

	//Armazena em $dbcon o objeto mysqli
	$dbcon = mysqli_init();
	
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'projetofinal';
	
	//Realiza a conexão com o banco
	$dbcon->real_connect($hostname, $username, $password, $database);
	
	//Verifica se ocorreu algum erro na conexão
	if(mysqli_connect_errno())
	{
		echo "Ocorreu um erro: ", mysqli_connect_error();
		exit();
	}

?>