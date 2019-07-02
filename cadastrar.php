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
    		
            
            <div class="conta">Crie uma nova conta:</div>
            
            <div class="informacao">Efetue seu cadastro e comece à compartilhar os videos.</div>
            
            <div id="formulario">
                    <form method="post" enctype="multipart/form-data" action="">
                    	<fieldset>
							<?php 
												
								if(isset($_POST['record']) == 'cadastre')
								{
									$usuario = strip_tags(trim($_POST['usuario']));
									$email   = strip_tags(trim($_POST['email']));
									$senha 	 = 	md5($_POST['senha']);
									
									if(empty($usuario) || empty($email) || empty($senha))
									{
										echo "<span class='no'>Preencha todos os campos, por gentileza!</span>";
									}
									else
									{
										
										//Chama a conexao com o banco de dados
										require("conexao/conexao.php");
								
										//Query de selecao com o banco de dados
										$Query = "SELECT * FROM Usuario WHERE Usuario = '$usuario'";
										
										$dr = $dbcon->query($Query);
										
										//Conta o numero de registros recebidos da query
										$rows = $dr->num_rows;
										
										if($rows <= 0)
										{
											//Query de insercao com o banco de dados
											$QueryString = "INSERT INTO usuario SET Usuario = '$usuario', email = '$email', Senha = '$senha', Nivel = 'cliente'";
																					
											if($dbcon->query($QueryString))
											{
												echo "<span class='yes'>Usuário: $usuario cadastrado com sucesso!</span>";
											}
											else
											{
												echo "<span class='no'>Erro ao cadastrar!</span>";
											}

										}
										else
										{
											echo "<span class='no'>O usuário: $usuario já existe!</span>";
										}
									
									}
										
								}//Fecha o if principal
								
							
							
							?>
                            <p>
                            <span>Usuario:</span>
                            <input type="text" name="usuario" />
                            </p>
                            
                            <p>
                            <span>E-mail:</span>
                            <input type="text" name="email" />
                            </p>
                            
                            <p>
                            <span>Senha:</span>
                            <input type="password" name="senha" />
                            </p>
                        
                            <input type="hidden" name="record" value="cadastre" />
                            <input type="submit" name="cadastra" value="Cadastrar" class="btn" />
                          </fieldset>
                    </form>
                              
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
