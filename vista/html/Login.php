<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="shortcut icon" href="../../assets/img/Fondo2.png">
	<link rel="stylesheet" type="text/css" href="../css/loginstyles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
</head>
	<body>
		<div class="padre">
			<header class="header">
	            <div class="menu">
	                <article class="logo">
	                	<img src="../../assets/img/Fondo2.png">
	                </article>
	            </div>
	        </header>
	        <section class="section">
	            <div class="form-conte">
	                <article class="caja">
						<form id="formulario" action='../../controladores/validacion.php' method="post">
							<article class="titulo">
								<h1>Login</h1>
								<i class="fa-solid fa-door-open"></i>
							</article>
							<article class="art-conte">
								<i class="fa-solid fa-user"></i>
								<input class="input-control" type="text" name="usuario" placeholder="Usuario">
							</article>
							<article class="art-conte">
								<i class="fa-solid fa-lock"></i>
								<input class="input-control" type="password" name="contraseña" placeholder="Contraseña">
							</article>
							<button class="btn" type="submit" >Iniciar sesión <i class="fa-solid fa-right-to-bracket"></i></button>
						</form>
					</article>
	            </div>
	        </section>
	        <footer class="pie">
	            <div class="pie-box">
	            	<article class="art-caja">
	            		<p class="copy">Copyright &copy; Aries 2023</p>
	            	</article>
	            </div>
	        </footer>
		</div>
	</body>
</html>