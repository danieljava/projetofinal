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
                    <li><a href="logar.php">Enviar video</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
    <div id="content">       
            
            <div id="video">
            	<ul>
				   <?php 
                
                        //Chama a conexao com o banco de dados
                        require("conexao/conexao.php");
                        
						//String de selecao com o banco de dados
                        $QueryString = "
                                    SELECT 
                                    video.IDVideo,
                                    video.Nome, 
                                    video.Descricao,
                                    video.LinkYouTube,
                                    video.LinkFoto,
                                    video.DataPostagem,
                                    video.Visitas,
									canal.IDCanal,
									canal.Nome AS NomeCanal
                                    FROM video
									LEFT JOIN canal
									ON video.IDCanal = canal.IDCanal
                                    WHERE video.IDVideo = ".$_GET['idvideo'];
                        
                        //Executa query armazenando o resultado em $dr
                        $dr = $dbcon->query($QueryString);
                    
                        while($ln = $dr->fetch_assoc())
                        {
                            $IDVideo = $ln['IDVideo'];
                            $Titulo = $ln['Nome'];
                            $Descricao = $ln['Descricao'];
                            $LinkYouTube = substr($ln['LinkYouTube'],67,11);
                            $LinkFoto = $ln['LinkFoto'];
                            $DataPostagem = $ln['DataPostagem'];
                            $Visitas = $ln['Visitas'];
							$IDCanal = $ln['IDCanal'];
							$Canal = $ln['NomeCanal'];					
                        ?>
                        
                            <li>
                                <h2><?php echo $Titulo; ?></h2>
                                <p><iframe width="600" height="315" src="http://www.youtube.com/embed/<?php echo $LinkYouTube; ?>" frameborder="0" allowfullscreen></iframe></p>
                                <p><strong>Postado por:</strong> <a href="single_canal.php?idcanal=<?php echo $IDCanal; ?>"><?php echo $Canal; ?></a> em <?php echo $DataPostagem; ?>  <strong>Visitas:</strong> <?php echo $Visitas; ?></p>
                                <p><?php echo $Descricao; ?></p>
                            </li>			
                    
                        <?php 
                            
                            }
                            
                        ?>
                  </ul>
                  
                  <div id="comentarios">
                  		     
                         <ul>     
                            <?php 
                                
                            //Chama a conexão com o banco de dados
                            require("conexao/conexao.php");
                            
                            //Query de seleção de dados do banco de dados
                            $SelectString = "
							                 SELECT
											 Nome,
											 Comentario
											 FROM comentario
											 WHERE IDVideo = ".$_GET['idvideo'];

                            //Recupera os valores do banco de dados transformando-os em um array() vindos do select e atribui à $dr
                            $dr = $dbcon->query($SelectString);
                            
                            //Conta o numero de registros recebidos da query
                            $rows = $dr->num_rows;
                            
                            //Verifica se o numero de registros foi menor ou igual a zero
                            if($rows <= 0)
                            {
                                echo "<br><strong class='vazio'>Não existem comentários para esse video. Por favor seja o primeiro!</strong><br>";
                            }
                            else
                            {
							
								
								echo "<span class='acerto'>Existe(m) $rows comentário(s) para esse video!<span>";
									
                                //Recuperando os valores do banco de dados fatiando o array()
                                while($ln = $dr->fetch_assoc())
                                {
                                    $Nome 		= $ln['Nome'];
                                    $Comentario = $ln['Comentario'];							
                    
                                    ?>
                                            <li>
                                                <h3><?php echo $Nome; ?></h3>
                                                <p><?php echo $Comentario; ?></p>
                                            </li><hr />
                                    <?php 
                                }//Fecha o while
                                    
                            }//Fecha o else
                            ?>
                     </ul><!--fim ul-->
                  </div><!--div comentarios-->
                  
                  <div id="form">
                  		
                        <form method="post" enctype="multipart/form-data" action="">
                                
                                <legend>Poste o seu comentário abaixo:</legend>
                                 
                                 <?php 
								 	
									
									if(isset($_POST['post']) == 'postar')
									{
										$IDVideo = $_GET['idvideo'];
										$nome = strip_tags(trim($_POST['nome']));
										$comentario = strip_tags(trim($_POST['comentario']));
										
										if(empty($nome) || empty($comentario))
										{
											echo "<span class='no'>Preencha todos os campos, por gentileza!</span>";
										}
										else
										{
											//Chama a conexão com o banco de dados
											require("conexao/conexao.php");
									
											//String contendo a query de inserção no banco de dados
											$InsertString = "INSERT INTO comentario SET IDVideo = '$IDVideo', Nome = '$nome', Comentario = '$comentario'";
									
											//Verifica se foi realmente executada a query de inserção
											if($dbcon->query($InsertString))
											{
												//Alerta de comentario postado com sucesso
												echo "<span class='sim'>Comentário postado com sucesso!</span>";
											}
											else
											{
												//Alerta de errp
												echo "<span class='nao'>Erro ao postar!</span>";
											}
										}
									}//fecha o if principal
								 
								 
								 
								 ?>       
                                        
                                                        
                                <p>
                                <span>Nome:</span>
                                <input type="text" name="nome" size="30" />
                                </p>
                                
                                <p>
                                <span>Comentário:</span><br />
                                <textarea cols="31" rows="5" name="comentario" class="texto"></textarea>
                                </p>
                                
                                <input type="hidden" name="post" value="postar"  />
                                <input type="submit" name="posta" value="Postar Comentário" class="botao" />
                            </form>
                  
                  </div><!--div form-->
                  
                  </div><!--div video-->
            
            <div id="sidebar_single">
                    <div id="video_relacionados">
                    <h4>Videos relacionados</h4>
                    
                    <ul>
						<?php 
                        
                            $IDCategoria = $_GET['idcategoria'];
                        
                            //Chama a conexao com o banco de dados
                            require("conexao/conexao.php");
                                                
                            //Query de recuperacao de dados do banco de dados
                            $QueryString = "SELECT 
                                            IDVideo,
                                            Nome, 
                                            Descricao,
                                            IDCategoria,
                                            LinkFoto,
                                            Visitas
                                            FROM video
                                            WHERE IDCategoria = '$IDCategoria' ORDER BY DataPostagem ASC LIMIT 10
                                            ";
                                
                            //Executa query armazenando o resultado em $dr
                            $dr = $dbcon->query($QueryString);
                            
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
									<img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="75" width="100" border="0" /></a>
									<h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>"><?php echo $Titulo; ?></a></h2>
									<p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
								</li>
                             
                            <?php 
                                }//Fecha o while
                            ?>
    
    	</ul>
        </div><!--div videos_relacionados-->
        
        			<?php 
						
						if(isset($_GET['idcanal']))
						{
					
					?>
                    
                    	<div id="lista_reproducao">
                        	
                        	<h5>Lista de reprodução</h5>
                        
								<ul>
                                		
                                        <?php 
                        
											$IDCanal = $_GET['idcanal'];
										
											//Chama a conexao com o banco de dados
											require("conexao/conexao.php");
																
											//Query de recuperacao de dados do banco de dados
											$QueryString = "SELECT 
															IDVideo,
															Nome, 
															Descricao,
															IDCategoria,
															IDCanal,
															LinkFoto,
															Visitas
															FROM video
															WHERE IDCanal = '$IDCanal' ORDER BY DataPostagem ASC
															";
												
											//Executa query armazenando o resultado em $dr
											$dr = $dbcon->query($QueryString);
											
											while($ln = $dr->fetch_assoc())
											{
												$IDVideo = $ln['IDVideo'];
												$Titulo = $ln['Nome'];
												$Descricao = $ln['Descricao'];
												$IDCategoria = $ln['IDCategoria'];
												$IDCanal = $ln['IDCanal'];
												$LinkFoto = $ln['LinkFoto'];
												$Visitas = $ln['Visitas'];					
												?>
												<li>
													<a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>&amp;idcanal=<?php echo $IDCanal; ?>">
													<img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="45" width="60" border="0" /></a>
													<h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>&amp;idcanal=<?php echo $IDCanal; ?>"><?php echo $Titulo; ?></a></h2>
													<p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
												</li>
											 
											<?php 
												}//Fecha o while
											?>
                                </ul>
                                                        
                        </div><!--div lista_reproducao-->
                        
                    <?php } ?>
 
            </div><!--sidebar_single-->
        
        <div id="clear"></div>
        
    </div><!--div content-->
</div><!--div box-->

<div id="footer">
	<div id="footer_logo"><img src="img/logo.gif" align="" border="0" /></div>
        <div id="footer_texto">© 2012 DanielJava | Web Designer - Todos os Direitos Reservados
        Desenvolvido por: danieljava@hotmail.com || Tel.: (21) 9616-1502
        </div>
</div>

   <?php 
									
	//Contador de visitas
	$add_visitas = $Visitas +1;
	
	//string de atualizacao
	$UpString = "UPDATE video SET Visitas = '$add_visitas' WHERE IDVideo = ".$_GET['idvideo'];
	
	//Executa query de atualizacao
    $up = $dbcon->query($UpString);

	?>

</body>
</html>
