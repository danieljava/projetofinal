<?php 
	
	@session_start();
	
	
	if(isset($_GET['acao']) == 'del')
	{
		//Chama a conexao com o banco de dados
		require("conexao/conexao.php");
		
		$Deleta_canal = "DELETE FROM canal WHERE IDCanal = ".$_GET['idcanal'];
		
		//Executa query para deletar
      	$dbcon->query($Deleta_canal);
		
		//Deleta os videos do canal
		$Deleta_video = "DELETE FROM video WHERE IDCanal = ".$_GET['idcanal'];
		
		//Executa query para deletar
      	$dbcon->query($Deleta_video);
		
		echo "<script>alert('Canal excluido com sucesso!')</script>";
		
		echo '<script>history.back()</script>';
	}


?>