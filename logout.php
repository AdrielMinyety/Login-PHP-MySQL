<?php 
	session_start();

	session_unset();

	session_destroy();

	header("Location: index.php");

	/*Cierra y la destruye la sesión  para
	poder desconectar al usuario, después redirige
	a index.php
	==============================================
	Close and destroys the session for disconnect
	the user, then redirect to index.php*/
?>