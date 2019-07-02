<?php 
	
	@session_start();
	
	
	if(isset($_GET['acao']) == 'del')
	{
		//Chama a conexao com o banco de dados
		require("conexao/conexao.php");
		
		$Deleta = "DELETE FROM categorias WHERE IDCategoria = ".$_GET['idcategoria'];
		
		//Executa query para deletar
      	$dbcon->query($Deleta);
		
		echo "<script>alert('Categoria excluida com sucesso!')</script>";
		
		echo '<script>history.back()</script>';
	}


?>