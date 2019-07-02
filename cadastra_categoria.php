<?php @session_start(); ?>

<?php if(!isset($_SESSION['IDUsuario']) && !isset($_SESSION['UsuarioLogado']) && !isset($_SESSION['NivelUsuario'])){ header("Location:logar.php"); }?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/stilo.css" />
<title>Untitled Document</title>
</head>

<body>

<div id="cadastra">

    <form method="post" enctype="multipart/form-data" action="">
            
            <?php 
				
				if(isset($_POST['cadastra']) == 'cadastrando')
				{
					$NomeCateg = $_POST['nomecateg'];
					
					if(empty($NomeCateg))
					{
						echo "<script>window.alert('Preencha o campo Nome da Categoria!')</script>";
					}
					else
					{
						//Chama a conexao com o banco de dados
						require("conexao/conexao.php");
						
						//Query de insercao com o banco de dados
						$String = "INSERT INTO categorias SET Nome = '$NomeCateg'";
																
						if($dbcon->query($String))
						{
							echo "<script>window.alert('Categoria cadastrada com sucesso!')</script>";
						}
						else
						{
							echo "<script>window.alert('Erro ao cadastrar categoria!')</script>";
						}
				  	  }
				   }//fecha o if principal			
			?>
            
            
            <p>
            <span>Nome da categoria</span>
            <input type="text" name="nomecateg"  />
            </p>
    		
            <input type="hidden" name="cadastra" value="cadastrando"  />
    		<input type="submit" name="cadastre" value="Cadastrar Categoria" class="btn" />
    </form>

</div>



</body>
</html>
