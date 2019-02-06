<?php

include("db.php");

	if (isset( $_POST['save_task'] )) {
		$title = $_POST['title'];	
		$description = $_POST['description'];

		// echo $title ." ". $description;

		$query = "INSERT INTO tareas (title, description) VALUES ('$title', '$description')";
		$result = mysqli_query($conn, $query);
	}

	if (!$result){
		die("Consulta fallida");
	}

	$_SESSION['message'] = 'Tarea guardada con exito';
	$_SESSION['message_type'] = 'warning';

	header("Location: index.php");
?>