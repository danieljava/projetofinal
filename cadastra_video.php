<?php @session_start(); ?>

<?php if(!isset($_SESSION['IDUsuario']) && !isset($_SESSION['UsuarioLogado']) && !isset($_SESSION['NivelUsuario'])){ header("Location:logar.php"); }?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/stilo.css" />
<title>Cadastra video</title>
</head>

<body>

<div id="cadastra">

	<form method="post" enctype="multipart/form-data" action="">
    	
        <?php 
		
			//verifica se a acao existe
			if(isset($_POST['cadastra']) == 'cadastrando')
			{
				$titulo 	= strip_tags(trim($_POST['titulo']));
				$descricao  = $_POST['descricao'];
				$link 		= str_replace("420","600",$_POST['link']);
				$categoria  = $_POST['categoria'];
				$canal 		= $_POST['canal'];
				
				$vidfoto = substr($link,67,11);
				
				//recupera a imagem dinamicamente
				$linkfoto = "http://i1.ytimg.com/vi/"."$vidfoto"."/default.jpg";
				
				if(empty($titulo) || empty($descricao) || empty($link))
				{
					echo "<script>window.alert('Preencha o campo titulo, descricao e link!')</script>";
				}
				else
				{
					
					//Chama a conexao com o banco de dados
				    require("conexao/conexao.php");
					
					//Query de insercao com o banco de dados
					$String = "INSERT INTO video SET Nome = '$titulo', Descricao = '$descricao', LinkYouTube = '$link', 
					IDCategoria = $categoria, IDCanal = $canal, LinkFoto = '$linkfoto', DataPostagem = Now(), Visitas = 1";
															
					if($dbcon->query($String))
					{
						echo "<script>window.alert('Video cadastrado com sucesso!')</script>";
					}
					else
					{
						echo "<script>window.alert('Erro ao cadastrar video!')</script>";
					}		
				}
			}//fecha o if principal
			
		?>

        <p>
        <span>Titulo do video</span>
    	<input type="text" name="titulo"  />
        </p>
        
         <span>Descrição do video</span>
    	 <textarea cols="31" rows="3" name="descricao"></textarea>
        
        <p>
         <span>Link youtube</span>
    	<input type="text" name="link" />
        </p>
               
        <span>Selecione a categoria que seu video pertence</span>
        <p>
        	<select name="categoria">
            
                        <?php 
							
							//chama a conexao com o banco de dados
							require("conexao/conexao.php");
							
							//string de selecao com o banco de dados
							$QueryString = "SELECT * FROM categorias";
							
							$dr = $dbcon->query($QueryString);
							
							while($ln = $dr->fetch_assoc())
							{
							
								$IDCategoria 	= $ln['IDCategoria'];
								$NomeCategoria = $ln['Nome'];
																				
						?>
                            <option value="<?php echo $IDCategoria; ?>"><?php echo $NomeCategoria; ?></option>
                        
                        <?php 
						
						}
						
						?>
             </select>
        
        </p>
        
        <span>Selecione o canal que seu video pertencerá</span>
        <p>
        	<select name="canal">
                       
                       <?php 
							
													
							//chama a conexao com o banco de dados
							require("conexao/conexao.php");
							
							//string de selecao com o banco de dados
							$Query= "SELECT * FROM canal WHERE IDUsuario = ".$_SESSION['IDUsuario'];
							
							$x = $dbcon->query($Query);
							
							while($linha = $x->fetch_assoc())
							{
							
								$IDCanal 	= $linha['IDCanal'];
								$NomeCanal  = $linha['Nome'];
																				
						?>
                            <option value="<?php echo $IDCanal; ?>"><?php echo $NomeCanal; ?></option>
                        
                        <?php 
						
						}
						
						?>
             </select>
        
        </p>
        
        <input type="hidden" name="cadastra" value="cadastrando"  />
        <input type="submit" name="cadastrarvideo" value="Cadastrar" class="btn" />
    
    </form>

</div>




</body>
</html>
