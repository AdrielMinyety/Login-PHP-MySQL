<?php
	/*$conn: Variable que contienen los datos necesarios para conectar
 	a la base de datos y que despues son utilizados.
	===========================================================
	$conn: Variable that contains the necessary data to connect
	to the database and which are then used.
 	*/

	session_start();
	$server = 'localhost'; 		/* Tipo de servidor // server type                      */
	$username = 'root';			/* usuario (hecho usando MAMP)// user (made using MAMP) */
	$password = 'root';			/* contraseña // password                               */
	$database = 'login-php';	/* nombre de la base de datos // database's name        */

	$conn = mysqli_connect(
		$localhost,
		$username,
		$password,
		$database
	);

	/**/

?>