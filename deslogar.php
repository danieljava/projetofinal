<?php 
	
	//inicia a sessao
	session_start();
	
	//destroi a sessao
	unset($_SESSION['IDUsuario']);
	unset($_SESSION['UsuarioLogado']);
	unset($_SESSION['NivelUsuario']);
	
	//redireciona a pagina
	include "index.php";

?>