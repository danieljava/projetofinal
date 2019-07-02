<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>JAVA VideoBox</title>

<!--  STEP ONE: insert path to SWFObject JavaScript -->

<script type="text/javascript" src="banner/js/swfobject/swfobject.js"></script>

<!--  STEP TWO: configure SWFObject JavaScript and embed CU3ER slider -->

<script type="text/javascript">

		var flashvars = {};

		flashvars.xml = "config.xml";

		flashvars.font = "font.swf";

		var attributes = {};

		attributes.wmode = "transparent";

		attributes.id = "slider";

		swfobject.embedSWF("cu3er.swf", "cu3er-container", "950", "250", "9", "expressInstall.swf", flashvars, attributes);

</script>

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
                    <li><a href="cadastrar.php">Criar conta</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
        <div id="cu3er-container">
        
            <a href="http://www.adobe.com/go/getflashplayer">
    
            <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
    
            </a>

        </div><!---->
    
    <div id="content">
    		
            <div id="content_menu">
            	<h2><a href="logar.php">Clique aqui para efetuar login e compartilhar seu video</a></h2>
                                
                <ul>
                	<li><a href="index.php?topicos=home">Principal</a></li>
					<?php 
					
					//Chama a conexão com o banco de dados
					require("conexao/conexao.php");
					
					//String de selecao
					$SelectString = "SELECT IDCategoria, Nome FROM categorias";
					
					//Recupera os valores do banco de dados transformando-os em um array() vindos do select e atribui à $dr
					$dr = $dbcon->query($SelectString);
					
					while($ln = $dr->fetch_assoc())
					{
						$ln['IDCategoria'];
						$ln['Nome'];					
				
				?>
                
                	<li><a href="index.php?topicos=nav/categoria&amp;idcategoria=<?php echo $ln['IDCategoria']; ?>"><?php echo $ln['Nome']; ?></a></li>
                    
                    <?php 
						
						}//Fecha o while
											
					?>
                </ul>
            
            </div><!--div content_menu-->
            <div id="content_centro"><h1>Recentemente adicionados</h1>
            
            	<?php
					
					foreach ($_REQUEST as $___opt => $___val) {
					 $$___opt = $___val;
					}
					if(empty($topicos)) {
					include("home.php");
					}
					elseif(substr($topicos, 0, 4)=='http' or substr($topicos,
					0, 1)=="/" or substr($topicos, 0, 1)==".")
					{
					echo '<br><font face=arial size=11px><br><b>A página não existe.</b><br>Por favor selecione uma página a partir do Menu Principal.</font>';
					}
					else {
					include("$topicos.php");
					}
					
				?>
  
            </div><!--div content_centro-->
            <div id="content_sidebar">
            	
                <div id="mais_visitados">
                    <h1>Mais visitados</h1>
                    
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
                                                ORDER BY Visitas DESC LIMIT 10
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
                                        <a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>">
                                        <img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="65" width="90" border="0" /></a>
                                        <h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>"><?php echo $Titulo; ?></a></h2>
                                        <p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
                                    </li>			
                                <?php 
                                
                                    }//Fecha o while	
                                ?>
                    </ul>
                    </div><!--div visitados-->
                        <div id="canais_sidebar">
                                <h4>Canais de videos</h4>
                                <ul>
                                    <?php 
                                        
                                        //Chama a conexão com o banco de dados
                                        require("conexao/conexao.php");
                                        
                                        //String de selecao com o banco
                                        $Query = "SELECT * FROM canal ORDER BY Nome LIMIT 20";
                                        
                                        //Recupera os valores do banco de dados transformando-os em um array() vindos do select e atribui à $dr
                                        $dr = $dbcon->query($Query);
                                        
                                        while($ln = $dr->fetch_assoc())
                                        {
                                            $IDCanal = $ln['IDCanal'];
                                            $NomeCanal = $ln['Nome'];
                                                        
                                    
                                    ?>  
                                        <li><h3><a href="single_canal.php?idcanal=<?php echo $IDCanal; ?>"><?php echo $NomeCanal; ?></a></h3></li>
                                        
                                    <?php 
                                    
                                    }
                                    
                                    ?>          			
                                </ul><!--fecha ul-->
                         </div><!--div canais-->
                        
            </div><!--div content_sidebar-->
        <div id="clear"></div>
    </div><!--div content-->
</div><!--div box-->

<div id="footer">
	<div id="footer_logo"><img src="img/logo.gif" align="" border="0" /></div>
        <div id="footer_texto">© 2012 DanielJava | Web Designer - Todos os Direitos Reservados
        Desenvolvido por: danieljava@hotmail.com || Tel.: (21) 9616-1502
        </div>
</div><!--div footer-->


</body>
</html>
