<!DOCTYPE html>
<html>
<head>
	<title>Registrate</title>
	<style type="text/css">
		body {
		margin: auto;
		padding: 50px;
		}
		input[type=text], select {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		}
        input[type=email], select {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		}
        input[type=password], select {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		}
		input[type=submit] {
		width: 100%;
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		}
		input[type=submit]:hover {
		background-color: #45a049;
		}
		div {
		border-radius: 5px;
		background-color: #f2f2f2;
		padding: 20px;
		}

	</style>
</head>
<body>

	<center><h1>Registrate</h1></center>
	<br>
	<a href="/">Regresar</a>
	<br>
	<br>
	<div>
		<form action="/usuarios/crear" method ="POST">
		@csrf
		<label>Correo:</label>
		<input type="email" name="correo" id="correo" placeholder="Escriba su correo">
		<label>Nombre de usuario:</label>
		<input type="text" name="username" id="username" placeholder="Escriba su nombre de usuario">
		<label>Contraseña:</label>
		<input type="password" name="clave" id="clave" placeholder="Escriba su contraseña">
		<input type="hidden" name="idRol" id="idRol" value="2">
        <input type="hidden" name="estado" id="estado" value="1">
		<input type="submit" value="Guardar">
		</form>
	</div>

</body>
</html>