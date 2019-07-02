<link rel="stylesheet" type="text/css" href="css/stilo.css" />
<title>Untitled Document</title>
</head>

<body>

    <div id="loop">
    
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
							WHERE IDCategoria = '$IDCategoria' LIMIT 11
							";
				
			//Executa query armazenando o resultado em $dr
			$dr = $dbcon->query($QueryString);
			
			//Conta o numero de registros recebidos da query
			$rows = $dr->num_rows;
			
			//Verifica se o numero de registros foi menor ou igual a zero
			if($rows <= 0)
			{
					echo "<br><strong class='erro'>Ops! Não possuem videos cadastrados nessa categoria!</strong></br>";

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
                    	<a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>">
                        <img src="<?php echo $LinkFoto; ?>" alt="<?php echo $Titulo; ?>" height="85" width="110" border="0" /></a>
                        <h2><a href="single.php?idvideo=<?php echo $IDVideo; ?>&amp;idcategoria=<?php echo $IDCategoria; ?>"><?php echo $Titulo; ?></a></h2>
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
