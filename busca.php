<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>JAVA VideoBox</title>
</head>

<body>

	<div id="box">
	
    <div id="header">
            <div id="header_logo"><a href="index.php"><img src="img/logo.gif" alt="Home" border="0" /></a></div>
			<div id="header_search">
                
                <form method="get" enctype="multipart/form-data" action="busca.php">
                	<input type="text" name="busca" id="busca" />
                	<input type="submit" name="buscar" value="Buscar" class="busca" />
                </form>
            
            </div><!--div header_search-->
            
            <div id="header_links">
                <ul>
                    <li><a href="cadastrar.php">Criar conta</a></li>
                    <li><a href="logar.php">Enviar video</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
    <div id="content">
    		
            <div class="busca">
            
            	<ul>
            	<?php 
							
						//Recupera o valor da busca
						$busca = $_GET['busca'];
						
						if(empty($busca))
						{
						
							echo "<span class='nulo'>Precisa informar um nome no campo busca!</span>";
							
							//Chama a conexao com o banco de dados
							require("conexao/conexao.php");
							
							//String de selecao com o banco
							$Query = "
									SELECT 
									IDVideo,
									Nome, 
									Descricao,
									IDCategoria,
									LinkFoto,
									Visitas
									FROM video
									ORDER BY DataPostagem DESC
									LIMIT 10
									";
									
									//Executa query armazenando o resultado em $dr
									$dr = $dbcon->query($Query);
	
										while($ln = $dr->fetch_assoc())
										{
											$IDVideo = $ln['IDVideo'];
											$Titulo = $ln['Nome'];
											$Descricao = $ln['Descricao'];
											$IDCategoria = $ln['IDCategoria'];
											$LinkFoto = $ln['LinkFoto'];
											$Visitas = $ln['Visitas'];					
										?>
											<li>
												<a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>">
												<img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="85" width="110" /></a>
												<h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>"><?php echo $Titulo; ?></a></h2>
												<p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
											</li><hr />			
									<?php 
									
										}//Fecha o while
									}//Fecha o else
									else
									{
							  ?>
							
							<?php
							//Chama a conexao com o banco de dados
							require("conexao/conexao.php");
							
							//String de selecao com o banco
							$Query = "
									SELECT 
									IDVideo,
									Nome, 
									Descricao,
									IDCategoria,
									LinkFoto,
									Visitas
									FROM video
									WHERE Nome LIKE '%$busca%'
									OR Descricao LIKE '%$busca%'
									OR DataPostagem LIKE '%$busca%'
									ORDER BY DataPostagem DESC
									";
									
									//Executa query armazenando o resultado em $dr
									$dr = $dbcon->query($Query);
									
									//Conta o numero de registros recebidos da query
									$rows = $dr->num_rows;
									
									//Verifica se o numero de registros foi menor ou igual a zero
									if($rows <= 0)
									{
											echo "<span class='nulo'>Não foram encontrados resultados para $busca</span>";
						
									}
									else
									{
									
											echo "<span class='achou'>Foram encontrados $rows resultados para: $busca!</span>";
											
										while($ln = $dr->fetch_assoc())
										{
											$IDVideo = $ln['IDVideo'];
											$Titulo = $ln['Nome'];
											$Descricao = $ln['Descricao'];
											$IDCategoria = $ln['IDCategoria'];
											$LinkFoto = $ln['LinkFoto'];
											$Visitas = $ln['Visitas'];					
										?>
											<li>
												<a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>">
												<img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="85" width="110" /></a>
												<h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>"><?php echo $Titulo; ?></a></h2>
												<p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
											</li><hr />			
									<?php 
									
										}//Fecha o while
									}//Fecha o else
								}//Fecha o primeiro else
							?>

            					</ul>
           		 </div><!--div busca-->

        	 <div class="sidebar_busca">
						
            </div><!--div sidebar_busca-->

        <div id="clear"></div>
        
    </div><!--div content-->
</div><!--div box-->

<div id="footer">
	<div id="footer_logo"><img src="img/logo.gif" align="" border="0" /></div>
        <div id="footer_texto">© 2012 DanielJava | Web Designer - Todos os Direitos Reservados
        Desenvolvido por: danieljava@hotmail.com || Tel.: (21) 9616-1502
        </div>
</div>

</body>
</html>
