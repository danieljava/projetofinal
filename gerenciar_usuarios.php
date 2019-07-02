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
.tabela{ margin:10px 250px 10px 250px; width:500px;}
</style>

<script type="text/javascript">

function confirmDelete(delUrl) {
  if (confirm("Deseja realmente excluir? Todos os videos do canal serão excluidos!")) {
   document.location = delUrl;
  }
}

</script>
</head>

<body>


<div id="box">
	
    <div id="header">
            <div id="header_logo"><a href="restrito.php"><img src="img/logo.gif" alt="Home" border="0" /></a></div>
			<div id="titulo_restrito">
                
              				 <h1>Gerenciar Usuários</h1>
            
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
                
                        <form method="get" enctype="multipart/form-data" action="gerenciar_usuarios.php">
                        	<span>Busque o usuário desejado:</span>
                            <input type="text" name="busca" id="busca" />
                            <input type="submit" name="buscar" value="Buscar" class="btns" />
                        </form>
        		</div>
                <div class="tabela">
				<table width="450" height="82" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="79" height="27" bgcolor="#0099CC" class="achou"><div align="center" class="style6">IDUsuário</div></td>
                    <td width="152" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Usuário</div></td>
                    <td width="165" bgcolor="#0099CC" class="achou"><div align="center" class="style6">Excluir</div></td>
                  </tr>
                  <?php 
				  		//Chama a conexao com o banco de dados
				  		require("conexao/conexao.php");
							
							if(isset($_GET['busca']))
							{
							
								$busca = $_GET['busca'];
								
								$Query ="
										SELECT
										IDUsuario,
										Usuario
										FROM
										usuario
										WHERE Usuario LIKE '%$busca%'
			 							";
									
										//Executa query armazenando o resultado em $dr
										$dr = $dbcon->query($Query);

										while($ln = $dr->fetch_assoc())
										{
											$IDUsuario = $ln['IDUsuario'];
											$Usuario = $ln['Usuario'];
											
										  ?>					
										  
										<tr>
											<td><div align="center" class="style1"><?php echo $IDUsuario; ?></div></td>
											<td><div align="center"><?php echo $Usuario; ?></div></td>
											<td><div align="center"><a href="deleta_usuarios.php?acao=del&amp;idusuario=<?php echo $IDUsuario; ?>" onclick="return confirm('Deseja realmente excluir?')"><img src="img/excluir.gif" width="12" height="14" border="0" alt="" /></a></div></td>
					  					</tr>
										  
										  <?php 
													}//Fecha o while
												}//Fecha o else
										?>
								  </table>
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
