<?php include("db.php")?>

<?php include("includes/header.php")?>


<div class="p-4">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="card card-body">
				<form action="save.php" method="POST">
					<div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="Título de la tarea" autofocus required>
					</div>
					<div class="form-group">
						<textarea name="description" rows="2" class="form-control" placeholder="Descripción" required></textarea>
					</div>
					<input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar">
					
					<?php if (isset($_SESSION['message'])) { ?>
						<div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show mt-2" role="alert">
							
							<?= $_SESSION['message'] ?>

						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php session_unset(); } ?>
				</form>
			</div>	
			<div class="card mt-2">
			  <div class="card-header">
			    Total de tareas:
			  </div>
			  <div class="alert-warning card-body">
				<?php 
				$query = "SELECT * FROM tareas";
				$resultado = mysqli_query($conn, $query); 
				?>
					  
				<h3 class="text-center"><?php echo $resultado->num_rows; ?></h3>
			  </div>
			</div>
		</div>

		<div class="col-md-8">
			<table class="table table-bordered">
				<thead class="bg-warning">
					<tr>
						<th>Tarea</th>
						<th>Notas</th>
						<th>Creado en</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM tareas";
					$result_tasks = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_array($result_tasks)) { ?>
						<tr>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['created']; ?></td>
							<td>
								<div class="d-flex justify-content-center align-center">
									<a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-info mr-1" ><i class="fa fa-marker"></i></a>
									<a href="check.php?id=<?php echo $row['id'] ?>" class="btn btn-success mr-1" ><i class="fas fa-check"></i></a>
									<a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" ><i class="far fa-trash-alt"></i></a>
								</div>								
							</td>
						</tr>

					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?php include("includes/footer.php")?>
