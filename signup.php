<?php 

/*Aqui se requiere el archivo de conexión.
==========================================
the connection file is required.*/
	require 'includes/db.php';

/*-Primero valida que los datos no vengan vacios,
 luego que los caracteres de la contraseña sean mayores
 que 8 y luego verifica si la contraseña de confirmación 
 es la misma que la primera contraseña.
 -Si toda validación es correcta, inserta los datos en
 la base de datos, si nó, pide los datos que necesita.
 -Para "iniciar sesión", guarda la id del usuario en la
 variable global $_SESSION, la cual se utiliza en la
 sesión para saber si está iniciada.
 -Si recibe datos incorrectos, se redirige a la misma
 página pero pidiendo los datos correctos.
=======================================================
  -First, it valid if the dates are empty, if the
  password length is more than 8 and then if the confimation
  password is the same to the first password.
  -If all the validation is correct, insert the data in the 
  database, if not, ask for the data needed.
  -For "Login", save the user's id in the global variable
  $_SESSION, which is used in the session to know if it has
  been started.
  -If it receive the incorrect data, it redirect in the same
  page but asking for the corrects data.
 */
if ( !empty($_POST['email']) && !empty($_POST['password']) ) {
	$email = $_POST['email'];
	$query = "SELECT id, email, password FROM usuario WHERE email = '$email'";
	$result = mysqli_query($conn, $query);
	$usuario = mysqli_fetch_array($result);
	
	if ($_POST['email'] == $usuario['email']) {
		$_SESSION['accesoNegado'] = "Ya existe un usuario con esa cuenta.";
	}else {

		if (isset($_POST['email']) && strlen($_POST['password']) > 8 ) {

			if ($_POST['password'] == $_POST['confirm_password']) {
					
				$email = $_POST['email'];
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$query = "INSERT INTO usuario (email, password) VALUES ('$email', '$password')";
				$result = mysqli_query($conn, $query);

				if ($result) {
					$query = "SELECT id, email, password FROM usuario WHERE email = '$email'";
					$result = mysqli_query($conn, $query);

					$usuario = mysqli_fetch_array($result);
					$_SESSION['user_id'] =	$usuario['id'];
					$_SESSION['mensaje'] = 'Usuario creado';
					header("Location: usercreated.php");	
				}

			}/*if are the same*/else {
				$_SESSION['accesoNegado'] = 'La contraseña no coincide.';
				$_SESSION['accesoNemail'] = $_POST['email'];
			}
		} else {
			$_SESSION['accesoNegado'] = 'La contraseña debe ser de más de 8 Caracteres.';
			$_SESSION['accesoNemail'] = $_POST['email'];
		}
	}
}/*if not empty*/


?>

<?php include("includes/header.php"); ?>

<div class="container">
	<div class="row">
		<div class="mx-auto m-5 position-static">
			<div class="card">
				<div class="card-header">
					<h1 class="card-title">Registrarse</h1> ó <a href="login.php">Iniciar Sesión</a>
				</div>

				<form class="card-body p-5" action="signup.php" method="POST">
				  <div class="form-group">
				    <label>Correo electrónico</label>
				    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="******@email***" required autofocus value="<?php echo $_SESSION['accesoNemail'] ?> ">
				    <small class="form-text text-muted">Tu información estará segura.</small>
				  </div>
				  <div class="form-group">
				    <label>Contraseña</label>
				    <input type="password" class="form-control mb-1" name="password" placeholder="Más de 8 Caracteres" required>
					<input type="password" class="form-control" name="confirm_password" placeholder="Confirmar contraseña" required>
				  </div>

				<?php if (isset($_SESSION['accesoNegado']) ) { ?>	
					<p class="alert alert-danger text-center">
						<?php echo $_SESSION['accesoNegado']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						   	<span aria-hidden="true">&times;</span>
						</button>
					</p>
				<?php } ?>

				  <div class="form-group form-check">
				     <h6 class="form-text text-muted">Esto es de práctica (No pongas información real).</h6>
				    <input type="checkbox" class="form-check-input" id="exampleCheck1" required="HOla">
				    <label class="form-check-label" for="exampleCheck1">Entendido</label>
				  </div>
				  <button type="submit" class="btn btn-primary">Enviar</button>
				</form>
			</div>
		</div>
	</div>
</div>


<?php include("includes/footer.php"); ?>