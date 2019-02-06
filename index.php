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
?>

<?php include("includes/header.php"); ?>

<div class="container">
	<div class="row">
		<div class="mx-auto m-5 p-5 card position-static">	
				<h1 class="card-title">AGENDA</h1>
			<div class="card-body">
				<p>Incia Sesión o registrate si es tu primera vez.</p>
				<a href="login.php">Iniciar Sesión</a>
					<br/>
				<a href="signup.php">Registrarse</a>
					<br/>
					<br/>
				<h6 class="form-text text-muted">Esto es de práctica (No pongas información real).</h6>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<?php include("includes/footer.php"); ?>