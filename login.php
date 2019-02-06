<?php 
/*Aqui se requiere el archivo de conexión.
==========================================
the connection file is required.*/
	require 'includes/db.php';
	
/*verificar si ya se ha iniciado la sesión.
============================================
verify if the session is already started.*/
	if (isset($_SESSION['user_id'])) {
		header("Location: usercreated.php");
		/*Si lo está, redirigir a usercreated.php
		=========================================
		if its done, redirect to usercreated.php*/
	}else { 
		/*Si nó, cargar esta página.
		===========================
		if Not, load this page.*/


/*-Primero valida que los datos no vengan vacios y
 luego que los caracteres de la contraseña sean mayores
 que 8.
 -Si toda validación es correcta, selecciona los datos de
  la base de datos del usuario, si nó, pide los datos que
  necesita.
 -Para "iniciar sesión", guarda la id del usuario en la
 variable global $_SESSION, la cual se utiliza en la
 sesión para saber si está iniciada con ese usuario.
 -Si recibe datos incorrectos, se redirige a la misma
 página pero pidiendo los datos correctos.
=======================================================
  -First, it valid if the dates are empty and if the
  password length is more than 8.
  -If all the validation is correct, select the user's data
  in the database, if not, ask for the data needed.
  -For "Login", save the user's id in the global variable
  $_SESSION, which is used in the session to know if it has
  been started with the user who use the id.
  -If it receive the incorrect data, it redirect in the same
  page but asking for the corrects data.
 */
	if ( !empty($_POST['email']) && !empty($_POST['password']) ) {
		if (isset($_POST['email']) && strlen($_POST['password']) > 8 ) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$query = "SELECT id, email, password FROM usuario WHERE email = '$email'";
			$result = mysqli_query($conn, $query);
			// echo $query; its a flag to verify // Es una bandera para verificar.

			if (mysqli_num_rows($result) > 0 ) {
				$usuario = mysqli_fetch_array($result);
				// echo "<br>";				 		its a flag to verify. 
				// echo $usuario['password'];	===================================
				// echo "SI EXISTE CUENTA";    Es una bandera para verificar.


				if ( password_verify($password, $usuario['password']) ) {
					// echo "SI ES EL USUARIO";  its a flag to verify // Es una bandera para verificar.
					$_SESSION['user_id'] =	$usuario['id'];
					$_SESSION['mensaje'] = 'Sesión iniciada';
					header("Location: usercreated.php");
				}else {
					$_SESSION['error'] = "Contraseña incorrecta";
					$_SESSION['accesoNemail'] = $_POST['email'];
				}
			}else{
				$_SESSION['error'] = "NO EXISTE ESA CUENTA";
			}
		} else {
			$_SESSION['error'] = 'La contraseña debe ser de más de 8 Caracteres.';
			$_SESSION['accesoNemail'] = $_POST['email'];
		}

	}

?>

<?php include("includes/header.php"); ?>

<div class="container">
	<div class="row">
		<div class="mx-auto m-5 position-static">
			<div class="card">
				<div class="card-header">
					<h1 class="card-title">Iniciar Sesión</h1> ó <a href="signup.php">Registrarse</a>
				</div>
				
				<form class="card-body p-5" action="login.php" method="POST">
				  <div class="form-group">
				<?php if (isset($_SESSION['error'])) { ?>	
						<p class="alert alert-danger text-center">
							<?php echo $_SESSION['error']; ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							   	<span aria-hidden="true">&times;</span>
							</button>
						</p>
				<?php } ?>
				    <label>Correo electrónico</label>
				    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="******@email***" required autofocus value="<?php echo $_SESSION['accesoNemail'] ?> ">
				    <small class="form-text text-muted">Tu información estará segura.</small>
				  </div>
				  <div class="form-group">
				    <label>Contraseña</label>
				    <input type="password" class="form-control" name="password" placeholder="Más de 8 Caracteres" required>
				  </div>

				  <div class="form-group form-check">
				     <h6 class="form-text text-muted">Esto es de práctica (No pongas información real).</h6>
				    <input type="checkbox" class="form-check-input" required="HOla">
				    <label class="form-check-label" for="exampleCheck1">Entendido</label>
				  </div>
				  <button type="submit" class="btn btn-primary">Enviar</button>
				</form>		
			</div>			
		</div>
	</div>
</div>

<?php } ?>
<?php include("includes/footer.php"); ?>