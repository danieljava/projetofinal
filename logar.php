<?php session_start(); ?>
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
                    <li><a href="cadastrar.php">Criar conta</a></li>
                </ul>
            </div><!--div header_links-->
        
        </div><!--div header-->
    
    <div id="content">
    		
            
            <div class="conta">Efetue login em sua conta:</div>
            
            <div class="informacao">Para postar seus videos é necessário efetuar login com seu usuário e senha de acesso.</div>
            
            <div id="formulario">
                    <form method="post" enctype="multipart/form-data" action="login.php">
                    	<fieldset>
							
                            <p>
                            <span>Usuario:</span>
                            <input type="text" name="usuario" />
                            </p>

                            <p>
                            <span>Senha:</span>
                            <input type="password" name="senha" />
                            </p>
                        
                            <input type="hidden" name="log" value="logando" />
                            <input type="submit" name="logs" value="Logar" class="btn" />
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
