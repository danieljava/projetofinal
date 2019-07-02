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
<title>JAVA VideoBox</title>
</head>

<body>

<div id="box">
	
    <div id="header">
            <div id="header_logo"><a href="restrito.php"><img src="img/logo.gif" alt="Home" border="0" /></a></div>
			<div id="titulo_restrito">
                
              				 <h1>Painel Administrativo</h1>
            
            </div><!--div header_search-->
            
            <div id="header_links">
                <ul>
                    <li><a href="deslogar.php">Deslogar-se</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
    <div id="content">
    		
            <div id="content_menu">
            	<h3>Menu administrativo</h3>
                    <ul>
                    	<?php 
						
						if($_SESSION['UsuarioLogado'] == 'admin')
						{						
						?>
                    	<li><a href="restrito.php">Principal</a></li>
                        <li><a href="restrito.php?acao=cadastra_video">Cadastrar videos</a></li>
                        <li><a href="restrito.php?acao=cadastra_categoria">Cadastrar categorias</a></li>
                        <li><a href="restrito.php?acao=cria_canal">Criar canais</a></li>
                        <li><a href="gerenciar_videos.php">Gerenciar videos</a></li>
                        <li><a href="gerenciar_categorias.php">Gerenciar categorias</a></li>
                        <li><a href="gerenciar_canais.php">Gerenciar canais</a></li>
                        <li><a href="gerenciar_usuarios.php">Gerenciar usuários</a></li>
                        <?php 
						}
						else
						{				
						?>
                        <li><a href="restrito.php">Principal</a></li>
                        <li><a href="restrito.php?acao=cadastra_video">Cadastrar videos</a></li>
                        <li><a href="restrito.php?acao=cria_canal">Criar canais</a></li>
                        <li><a href="gerenciar_canais_usuario.php">Gerenciar canais</a></li>
                        <li><a href="gerenciar_videos_usuario.php">Gerenciar videos</a></li>
                        <?php } ?>
                    </ul>
            </div><!--div content_menu-->
            <div id="content_centro">
            	<h4>Bem vindo: <?php echo $_SESSION['UsuarioLogado']; ?></h4>
            
            	<?php
					
					foreach ($_REQUEST as $___opt => $___val) {
					 $$___opt = $___val;
					}
					if(empty($acao)) {
					include("principal.php");
					}
					elseif(substr($acao, 0, 4)=='http' or substr($acao,
					0, 1)=="/" or substr($acao, 0, 1)==".")
					{
					echo '<br><font face=arial size=11px><br><b>A página não existe.</b><br>Por favor selecione uma página a partir do Menu Principal.</font>';
					}
					else {
					include("$acao.php");
					}
					
				?>
            
            
            </div><!--div content_centro-->
            <div class="content_sidebar">
            			<div class="mais_acessados">
                        	<h4>Mais visitados</h4>
                                    <ul>
						  		<?php 
                        
                                //Query de recuperacao de dados do banco de dados
                                $ExecQuery = "SELECT 
                                                IDVideo,
                                                Nome, 
                                                Descricao,
                                                IDCategoria,
                                                LinkFoto,
                                                Visitas
                                                FROM video
                                                ORDER BY Visitas DESC LIMIT 13
                                                ";
                                    
                                //Executa query armazenando o resultado em $dr
                                $x = $dbcon->query($ExecQuery);
                                
                                while($linha = $x->fetch_assoc())
                                {
                                    $IDVideo = $linha['IDVideo'];
                                    $Titulo = $linha['Nome'];
                                    $Descricao = $linha['Descricao'];
                                    $IDCategoria = $linha['IDCategoria'];
                                    $LinkFoto = $linha['LinkFoto'];
                                    $Visitas = $linha['Visitas'];					
                                ?>
                                    <li>
                                        <a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>" target="_blank">
                                        <img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="65" width="90" border="0" /></a>
                                        <h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>" target="_blank"><?php echo $Titulo; ?></a></h2>
                                        <p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
                                    </li>			
                                <?php 
                                
                                    }//Fecha o while	
                                ?>
                    </ul>          
                        </div><!--div mais acessados-->
            </div><!--div content_sidebar-->
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
