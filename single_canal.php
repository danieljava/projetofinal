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
                
                <div id="header_canal">
                 
                 <h1>Página do Canal</h1>
                
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
						
						$IDCanal = $_GET['idcanal'];
                        
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
										WHERE canal.IDCanal = '$IDCanal' LIMIT 1";
                        
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
                                <h1>Bem vindo ao seu canal: <?php echo $Canal; ?></h1>
                                <p><iframe width="600" height="315" src="http://www.youtube.com/embed/<?php echo $LinkYouTube; ?>" frameborder="0" allowfullscreen></iframe></p>
                                <p><strong>Postado por:</strong> <a href="single_canal?idcanal=<?php echo $IDCanal; ?>"><?php echo $Canal; ?></a> em <?php echo $DataPostagem; ?>  <strong>Visitas:</strong> <?php echo $Visitas; ?></p>
                                <p><?php echo $Descricao; ?></p>
                            </li>			
                    
                        <?php 
                            
                            }
                            
                        ?>
                  </ul>
                  
                  <div id="loop_videos">
                  	
                    	<h1>Lista de Reprodução</h1>
                    
                    	<ul>
                        	<?php 
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
											WHERE IDCanal = '$IDCanal'
											ORDER BY DataPostagem DESC
											";
								
							//Executa query armazenando o resultado em $dr
							$dr = $dbcon->query($QueryString);
							
							//Conta o numero de registros recebidos da query
							$rows = $dr->num_rows;
							
							//Verifica se o numero de registros foi menor ou igual a zero
							if($rows <= 0)
							{
									echo "<br><strong class='canal_vazio'>Ops! Não possuem mais videos cadastrados nesse canal!</strong></br>";
				
							}
							else
							{
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
                                    <img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="85" width="110" /></a>
                                    <h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>&amp;idcanal=<?php echo $IDCanal; ?>"><?php echo $Titulo; ?></a></h2>
                                    <p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
                                </li>			
							<?php 
							
								}//Fecha o while
							}//Fecha o else
							?>
                        </ul>
                  
                  
                  </div><!--div loop_videos-->
                  
                  </div><!--div video-->

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
