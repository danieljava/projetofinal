<?php @session_start(); ?>

<?php if(!isset($_SESSION['IDUsuario']) && !isset($_SESSION['UsuarioLogado']) && !isset($_SESSION['NivelUsuario'])){ header("Location:logar.php"); }?>

<?php 
//Chama a conexao com o banco de dados
require("conexao/conexao.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Gerenciar Videos</title>
<style type="text/css">
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style6 {color: #FFFFFF}
#form_busca{ margin:10px 0 15px 0; width:550px;}
#form_busca span{ font:14px Verdana, Arial, Helvetica, sans-serif; color:#000000;}
#form_busca input{ border:1px solid #CCCCCC; height:20px; font:12px Verdana, Arial, Helvetica, sans-serif; width:170px;}
#form_busca .btns{ width:70px; border:1px solid #CCCCCC; font:13px Verdana, Arial, Helvetica, sans-serif;}
#atualiza_campo { margin:10px auto; height:auto; width:450px;}
#atualiza_campo form{width:350px; display:block; margin:0; margin-left:8px; border:0;}
#atualiza_campo p{padding:3px 0;}
#atualiza_campo span{padding:3px; display:block; font:14px Verdana, Arial, Helvetica, sans-serif; color: #000000; font-weight:bold;}
#atualiza_campo input{width:400px; height:25px; border:1px solid #CCCCCC; font: 11px Verdana, Arial, Helvetica, sans-serif;}
#atualiza_campo option{ font:11px Verdana, Arial, Helvetica, sans-serif; height:18px; width:135px;}
#atualiza_campo .bt{ width:150px; border:1px solid #CCCCCC; font:12px Verdana, Arial, Helvetica, sans-serif; margin:10px auto;}
#atualiza_campo a{ color:#0099CC; font:15px Verdana, Arial, Helvetica, sans-serif; text-decoration:none; margin:20px 0 0 50px;}
</style>
</head>

<body>


<div id="box">
	
    <div id="header">
            <div id="header_logo"><a href="restrito.php"><img src="img/logo.gif" alt="Home" border="0" /></a></div>
			<div id="titulo_restrito">
                
              				 <h1>Gerenciar videos</h1>
            
            </div><!--div header_search-->
            
            <div id="header_links">
                <ul>
                    <li><a href="deslogar.php">Deslogar-se</a></li>
                    <li><a href="restrito.php">Voltar</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
    <div id="content">
                   
                <div id="form_busca">
                
                        <form method="get" enctype="multipart/form-data" action="gerenciar_videos.php">
                        	<span>Busque o video desejado:</span>
                            <input type="text" name="busca" id="busca" />
                            <input type="submit" name="buscar" value="Buscar" class="btns" />
                        </form>
        		</div>
                
				<table width="950" height="82" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="79" height="27" bgcolor="#0099CC" class="achou"><div align="center" class="style6">IDVideo</div></td>
                    <td width="152" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Foto</div></td>
                    <td width="165" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Titulo</div></td>
                    <td width="165" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Descricao</div></td>
                    <td width="175" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Categoria</div></td>
                    <td width="70" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Editar</div></td>
                    <td width="142" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Excluir</div></td>
                  </tr>
                  <?php 
				  		//Chama a conexao com o banco de dados
				  		require("conexao/conexao.php");

						if(isset($_GET['busca']))
						{
						
							$busca = $_GET['busca'];
							
							$Query ="
								SELECT 
								video.IDVideo,
								video.Nome,
								video.Descricao,
								video.IDCategoria,
								video.LinkFoto,
								categorias.Nome AS CatNome,
								canal.Nome AS CanNome
								FROM video
								LEFT JOIN categorias ON video.IDCategoria = categorias.IDCategoria
								LEFT JOIN canal ON categorias.IDCategoria = canal.IDCanal
								WHERE video.Nome LIKE '%$busca%'
								OR video.Descricao LIKE '%$busca%'		
								";
								
								//Executa query armazenando o resultado em $dr
                				$dr = $dbcon->query($Query);
								
								//Conta o numero de registros recebidos da query
               					$rows = $dr->num_rows;
								
								if($rows <= 0)
								{
									echo "<td width=\"600\" colspan=\"6\"><div align=\"center\"><span style=\"color: #000000\">Não foi encontrado nenhum video!</span></div></td>";
								}
								else
								{
									while($ln = $dr->fetch_assoc())
                    				{
										$IDVideo = $ln['IDVideo'];
										$Titulo = $ln['Nome'];
										$Desc = $ln['Descricao'];
										$IDCategoria = $ln['IDCategoria'];
										$LinkFoto = $ln['LinkFoto'];
										$Categoria = $ln['CatNome'];
										$CanalNome = $ln['CanNome'];
										
									  ?>					
									  
									  <tr>
										<td><div align="center" class="style1"><?php echo $IDVideo; ?></div></td>
										<td><div align="center"><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>" target="_blank"><img src="<?php echo $LinkFoto; ?>" border="0" alt="" width="95" height="75" /></a></div></td>
										<td><div align="center" class="style5"><?php echo $Titulo; ?></div></td>
										<td><div align="center" class="style5"><?php echo $Desc; ?></div></td>
										<td><div align="center" class="style5"><?php echo $Categoria; ?></div></td>
										<td><div align="center"><a href="gerenciar_videos.php?acao=up&amp;idvideo=<?php echo $IDVideo; ?>&amp;titulo_video=<?php echo $Titulo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>&amp;categoria_video=<?php echo $Categoria; ?>"><img src="img/editar.jpg" alt="" border="0" /></a></div></td>
										<td><div align="center"><a href="deleta_videos.php?acao=del&amp;idvideo=<?php echo $IDVideo; ?>"><img src="img/excluir.gif" width="12" height="14" border="0" alt="" /></a></div></td>
				  </tr>
									  
									  <?php 
												}//Fecha o while
											}//Fecha o else
										}//fecha o if
									?>
                              </table>
								
                            	<div id="atualiza_campo">
                                
                                	<?php 
									
										//Verifica se a acau up existe
										if(isset($_GET['acao']) == 'up')
										{
																
									?>
                                    		<form method="post" enctype="multipart/form-data" action="">
                                            	
                                                <?php 
													
													if(isset($_POST['update']) == 'updater')
													{
														$title = $_POST['titulo'];
														$IDCateg = $_POST['categoria'];
														
														//Query de atualização
														$atualiza_video = "UPDATE video SET Nome = '$title', IDCategoria = '$IDCateg' WHERE IDVideo = ".$_GET['idvideo'];
														
														//Executa a query
														$dbcon->query($atualiza_video);
														
														echo "<script>alert('Dados atualizados com sucesso!')</script>";
														
													}
												?>
                                                
                                                <p>
                                                <span>Titulo: </span>
                                                <input type="text" name="titulo" value="<?php echo $_GET['titulo_video']; ?>" />
												</p>
                                                
                                                <p>
                                                <span>Categoria: </span>
                                                <select name="categoria">
                                                	
                                                    <option value="<?php echo $_GET['idcategoria']; ?>" selected="selected"><?php echo $_GET['categoria_video']; ?></option>
													
													<?php 
                                                            //string de selecao com o banco de dados
                                                            $QueryString = "SELECT * FROM categorias";
                                                            
															//Executa a query
                                                            $x = $dbcon->query($QueryString);
                                                            
                                                            while($ln = $x->fetch_assoc())
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
                                                <input type="hidden" name="update" value="updater" />
                                                <input type="submit" name="atualiza" value="Atualizar Video" class="bt" />
                                            </form>
                                            
                                            	<a href="gerenciar_videos.php">Voltar</a>
                                    		
                                    <?php 
									
										}
									?>
                                
                                </div>    
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
