<!DOCTYPE html>
<html>
<head>
	<title>Login Raven</title>
</head>
<body>
	<div class="login-clean">
		<form method="post" action="<?= base_url()?>index.php/verifylogin">
			<div class="illustration">
				<img class="img-fluid" src="<?= base_url()?>application/views/assets/img/logoRaven.jpg">
			</div>
			<div class="form-group">
				<input class='form-control' type="text" name="usuario" placeholder="Usuario">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Contraseña">
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Log In</button>
			</div>			
		</form>
	</div>
</body>
</html>