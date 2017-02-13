<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="custom.css">
	<title>Iniciar sesion</title>
</head>
<body class="bgmain">
	<div class="container col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
		<div class="page-header">
			<img src="images/logo.png" class="img-responsive logo">
			<h1 class="text-center">Bienvenido</h1>
		</div>
		<div class="panel panel-default panel-shadow">
			<div class="panel-heading text-center">
				<span>
					Ingrese sus datos para tener acceso al sistema
				</span>
			</div>
			<div class="panel-body">
				<form class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<label for="usuario">usuario</label>
						<input type="text" class="form-control" id="usuario" required>
					</div>
					<div class="form-group">
						<label for="clave">clave</label>
						<input type="password" class="form-control" id="clave" required>
					</div>
					<button type="submit" class="btn btn-primary col-xs-12">Entrar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>