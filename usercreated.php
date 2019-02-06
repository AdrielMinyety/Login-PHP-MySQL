<?php
/*Aqui se requiere el archivo de conexión.
==========================================
the connection file is required.*/
	require 'includes/db.php';

/*verificar si ya se ha iniciado la sesión.
============================================
verify if the session is already started.*/
	if ( isset($_SESSION['user_id']) ) {
		$userId = $_SESSION['user_id'];
		$query = "SELECT email FROM usuario WHERE id = $userId";
		$result = mysqli_query($conn, $query);
		$usuario = mysqli_fetch_array($result);
		/*Si lo está, cargar los datos del usuario.
		===========================================
		if its done, load the user data.*/
		
	}else {
		echo "<h1>NO SIRVE ASI, DEBES REGISTRARTE xD</h1>";
		die("UPS ':D </3 ");
		/*Si nó, error.
		==============
		if NOT, ERROR*/
	}


?>

<?php include("includes/header.php"); ?>
	<div class="container">
		<div class="mx-auto m-5 position-static">
			<div class="alert alert-success">
				<?php if (isset($_SESSION['mensaje']) ) { ?>
					<h1 class="text-center">
						<?php echo $_SESSION['mensaje']; ?>
					</h1>
				<?php }else {echo "Hubo un error";} ?>				
			</div>
			<div class="mx-auto card" style="width: 18rem;">
			  <div class="card-body">
			    <h5 class="card-title">Bienvenid@!!</h5>
			    <h6 class="card-subtitle mb-2 text-muted"><?php echo $usuario['email']; ?></h6>
			    <p class="card-text">Gracias por probar este repositorio, el cual fue hecho para probarme en mis conocimientos con MySQL y PhP.</p>
			    <a href="gestor de horarios/index.php" class="card-link">AGENDA (otro proyecto)</a>
			    <br/>
			    <a href="logout.php" class="card-link">Cerrar Sesión</a>
			  </div>
			</div>
 		</div>		
	</div>
 						

<?php include("includes/footer.php"); ?>