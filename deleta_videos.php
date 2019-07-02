<?php 
	
	@session_start();
	
	
	if(isset($_GET['acao']) == 'del')
	{
		//Chama a conexao com o banco de dados
		require("conexao/conexao.php");
		
		$Deleta = "DELETE FROM video WHERE IDVideo = ".$_GET['idvideo'];
		
		//Executa query para deletar
      	$dbcon->query($Deleta);
		
		echo "<script>alert('Video excluido com sucesso!')</script>";
		
		echo '<script>history.back()</script>';
	}


?>