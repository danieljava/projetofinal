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
<title>Gerenciar Categorias</title>
<style type="text/css">
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style6 {color: #FFFFFF}
#categorias{ margin:10px auto; width:400px;}
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
                
              				 <h1>Gerenciar Categorias</h1>
            
            </div><!--div header_search-->
            
            <div id="header_links">
                <ul>
                    <li><a href="deslogar.php">Deslogar-se</a></li>
                    <li><a href="restrito.php">Voltar</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
    <div id="content">
                         
                 <div id="categorias">         
				<table width="400" height="82" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="109" height="27" bgcolor="#0099CC" class="achou"><div align="center" class="style6">IDCategoria</div></td>
                    <td width="76" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Nome</div></td>
                    <td width="85" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Editar</div></td>
                    <td width="97" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Excluir</div></td>
                  </tr>
                  <?php 
				  		//Chama a conexao com o banco de dados
				  		require("conexao/conexao.php");
					
							$Query ="
									SELECT 
									IDCategoria,
									Nome
									FROM categorias
									";
								
									//Executa query armazenando o resultado em $dr
									$dr = $dbcon->query($Query);
								
									while($ln = $dr->fetch_assoc())
                    				{
										$IDCategoria = $ln['IDCategoria'];
										$NomeCategoria = $ln['Nome'];

									  ?>					
									  
									  <tr>
										<td><div align="center" class="style1"><?php echo $IDCategoria ; ?></div></td>
										<td><div align="center"><?php echo $NomeCategoria; ?></div></td>
										<td><div align="center" class="style5"><a href="gerenciar_categorias.php?acao=up&amp;idcategoria=<?php echo $IDCategoria; ?>&amp;categoria=<?php echo $NomeCategoria; ?>"><img src="img/editar.jpg" border="0" alt="" /></a></div></td>
										<td><div align="center" class="style5"><a href="deleta_categorias.php?acao=del&amp;idcategoria=<?php echo $IDCategoria; ?>"><img src="img/excluir.gif" border="0" alt="" /></a></div></td>
				  				</tr>
									  
									  <?php 
												}//Fecha o while
									?>
                              </table>
                              </div>
								
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
														$title = $_POST['nome'];
														
														//Query de atualização
														$atualiza_video = "UPDATE categorias SET Nome = '$title' WHERE IDCategoria = ".$_GET['idcategoria'];
														
														//Executa a query
														$dbcon->query($atualiza_video);
														
														echo "<script>alert('Dados atualizados com sucesso!')</script>";
														
													}
												?>
                                                
                                                <p>
                                                <span>Titulo: </span>
                                                <input type="text" name="nome" value="<?php echo $_GET['categoria']; ?>" />
												</p>

                                                <input type="hidden" name="update" value="updater" />
                                                <input type="submit" name="atualiza" value="Atualizar Video" class="bt" />
                                            </form>
                                            
                                            	<a href="gerenciar_categorias.php">Voltar</a>
                                    		
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
