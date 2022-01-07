<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link 	rel="stylesheet" 
		  	href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
		  	integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" 
		  	crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
			crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" 
			crossorigin="anonymous"></script>
</head>
<body>
	<?php require_once 'process.php'; ?>

	<?php if (isset($_SESSION['message'])) : ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php echo $_SESSION['message'];
				  unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>
		<div class="container">

		<?php 
			$con = new mysqli('localhost', 'root', '', 'new') or die(mysql_error($con));
			$result = $con->query("SELECT * FROM users") or die(mysql_error($con));
			// pre_r($result);
			// pre_r($result->fetch_assoc());
			// pre_r($result->fetch_assoc());
		?>
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php while ($row = $result->fetch_assoc()): ?>
					<tr>
						<td> <?php echo $row['name']; ?> </td>
						<td> <?php echo $row['location']; ?> </td>
						<td>
							<a href="index.php?edit=<?php echo $row['id']; ?>"
								class="btn btn-info">Edit</a>
							<a href="process.php?delete=<?php echo $row['id']; ?>"
							class="btn btn-danger">Delete</a>

						</td>
					</tr>
				<?php endwhile; ?>
			</table>
		</div>
		<?php
			function pre_r($array) {
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
		?>

		<div class="row justify-content-center">
			<form action="process.php" method="POSt">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<div class="form-group">
					<label>Name</label> 	 
					<input  class="form-control" 
							type="text" 
							name="name" 
							value="<?php echo $name; ?>" 
							placeholder = "PLS Enter Your Name">
				</div>
				<div class="form-group">
					<label>Location </label>
					<input  class="form-control" 
							type="text" 
							name="location" 
							value="<?php echo $loc; ?>" 
							placeholder ="PLS Enter Your Location">
				</div>
				<div class="form-group">
		<?php 
			if ($update == true) :
		?>			
					<input class="btn btn-info" type="submit" value="Update" name="update">
		<?php else : ?>
					<input class="btn btn-primary" type="submit" value="Save" name="save">
		<?php endif; ?>
				</div>
			</form>
		</div>
	</div>
</body>
</html>