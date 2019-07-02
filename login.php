<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painel Restrito</title>
</head>

<body>
<ul>
<?php 
								
								//Chama a conexao com o banco de dados
								require("conexao/conexao.php");
										
								//verifica se a acao existe
								if(isset($_POST['log']) == 'logando')
								{
									$usuario = strip_tags(trim($_POST['usuario']));
									$senha = md5($_POST['senha']);
									
									if(empty($usuario) || empty($senha))
									{
										echo "<script>window.alert('Preencha todos os campos por gentileza!')</script>";
									    echo '<script>history.back()</script>';
									}
									else
									{
															
										//Query de recuperacao de dados do banco de dados
										$QueryString = "SELECT Usuario, Senha FROM usuario WHERE Usuario = '$usuario' AND Senha = '$senha'";
											
										//Executa query armazenando o resultado em $dr
										$dr = $dbcon->query($QueryString);
										
										//Conta o numero de registros recebidos da query
										$rows = $dr->num_rows;
										
										//Verifica se o numero de registros foi menor ou igual a zero
										if($rows <= 0)
										{
												echo "<script>window.alert('Usuario e/ou senha inválidos!')</script>";
												echo '<script>history.back()</script>';

										}
										else
										{
											//String de selecao com o banco de dados
											$QueryString = "SELECT IDUsuario, Usuario, Nivel FROM usuario WHERE Usuario = '$usuario' AND Senha = '$senha'";
											
											//Executa query armazenando o resultado em $dr
											$dr = $dbcon->query($QueryString);
											
											//Fatiando os valores do array vindos do banco
											while($ln = $dr->fetch_assoc())
											{
												$IDUsuario = $ln['IDUsuario'];
												$UsuarioLogado = $ln['Usuario'];
												$NivelUsuario = $ln['Nivel'];
											}
											
											$_SESSION['IDUsuario'] = $IDUsuario;
											$_SESSION['UsuarioLogado'] = $UsuarioLogado;
											$_SESSION['NivelUsuario'] = $NivelUsuario;
											
											//header("Location:restrito/restrito.php");
											include ("restrito.php");
										}
									}
									
								}//Fecha o if principal
							
							
							?>
					</ul>



</body>
</html>
