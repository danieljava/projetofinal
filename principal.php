<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/stilo.css" />
<title>Untitled Document</title>
</head>

<body>

	<div id="loop">
    
    	<ul>
			<?php 
            
                //Chama a conexao com o banco de dados
                require("conexao/conexao.php");
                                    
                //Query de recuperacao de dados do banco de dados
                $QueryString = "SELECT 
                                video.IDVideo,
                                video.Nome, 
                                video.Descricao,
                                video.IDCategoria,
                                video.LinkFoto,
                                video.Visitas
                                FROM video
								LEFT JOIN canal
								ON video.IDCanal = canal.IDCanal
								WHERE canal.IDUsuario = ".$_SESSION['IDUsuario'];

                    
                //Executa query armazenando o resultado em $dr
                $dr = $dbcon->query($QueryString);
                
                //Conta o numero de registros recebidos da query
                $rows = $dr->num_rows;
                
                //Verifica se o numero de registros foi menor ou igual a zero
                if($rows <= 0)
                {
                        echo "<br><strong class='erro'>Você ainda não cadastrou nenhum video, comece criando um canal de video, clicando <a href='restrito.php?acao=cria_canal'>aqui!</a></strong></br>";
    
                }
                else
                {
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
                            <a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>" target="_blank">
                            <img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="85" width="110" border="0" /></a>
                            <h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>" target="_blank"><?php echo $Titulo; ?></a></h2>
                            <p><?php echo $Descricao; ?></p> <p><strong>Visitas:</strong> <?php echo $Visitas; ?></p>
                        </li>			
                <?php 
                
                    }//Fecha o while
                }//Fecha o else
                ?>
    
    	</ul>
    </div><!--div loop-->

</body>
</html>
