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
		
				if(isset($_POST['criar']) == 'criando')
				{
					
					$IDUsuario = $_SESSION['IDUsuario'];
					$NomeCanal = $_POST['nomecanal'];
					
					//Verifica foi inserido o nome do canal
					if(empty($NomeCanal))
					{
		
						echo "<script>window.alert('Preencha todos os campos, por gentileza!')</script>";
					}
					else
					{
						
						//Chama a conexao com o banco de dados
						require("conexao/conexao.php");
						
						//Query de selecao com o banco de dados
						$Query = "SELECT * FROM canal WHERE Nome = '$NomeCanal'";
						
						//Executa a query
						$dr = $dbcon->query($Query);
						
						//Conta o numero de registros recebidos da query
						$rows = $dr->num_rows;
						
						if($rows <= 0)
						{
						
							//Query de insercao com o banco de dados
							$QueryString = "INSERT INTO canal SET IDUsuario = '$IDUsuario', Nome = '$NomeCanal'";
																	
							if($dbcon->query($QueryString))
							{
								echo "<script>window.alert('Canal criado com sucesso!')</script>";
							}
							else
							{
								echo "<script>window.alert('Erro ao criar canal!')</script>";
							}
						}
						else
						{
								echo "<script>window.alert('Já existe um canal com o nome informado!')</script>";
						}			
					}
				}//fecha o if principal
			
		?>
            
            <p>
            <span>Nome do canal</span>
            <input type="text" name="nomecanal"  />
            </p>
    		
            <input type="hidden" name="criar" value="criando"  />
    		<input type="submit" name="cria" value="Criar Canal" class="btn" />
    </form>

</div>

</body>
</html>
