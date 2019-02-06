<?php 

	include("db.php");

	if ( isset( $_GET['id'] )) {
		$id = $_GET['id'];
		$query = "SELECT * FROM tareas WHERE id = $id";
		$result = mysqli_query($conn, $query);

		if (!$result) {
			die("Consulta fallida");
		}
		
		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_array($result);
			$title = $row['title'];
			$description = $row['description'];
		}
		
		if (isset($_POST['done'])) {
			echo "HECHO!";

			$query = "DELETE FROM tareas WHERE id = $id";
			$result = mysqli_query($conn, $query);

			if (!result) {
				die("No se pudo eliminar");
			}

			$_SESSION['message'] = "Tarea finalizada!";
			$_SESSION['message_type'] = "success";
			header("location: index.php");
		}
	}

?>

<?php include("includes/header.php"); ?>
	
	<div class="row p-5">
		<div class="mx-auto card">
		  <h1 class="card-header bg-warning"><?php echo $title; ?></h1>
		  <div class="card-body">
		    <h5 class="card-title">Nota: </h5>
			<form action="check.php?id=<?php echo $_GET['id']; ?>" method="POST">
			    <p class="card-text font-weight-bold"><?php echo $description; ?></p>
			    <p class="card-text">¿Seguro que terminaste?</p>
				<button class="btn btn-primary btn-block" name="done">¡Si!</button>
			</form>
		  </div>
		</div>
	</div>
						

<?php include("includes/footer.php"); ?>