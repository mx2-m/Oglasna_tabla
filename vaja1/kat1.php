<?php 
	include 'glava.php'
 ?>
 
 

 <?php
 	$id = $_GET['id'];
	$id = mysqli_real_escape_string($conn,$_GET['id']);
	$query =  "SELECT * FROM ads  WHERE category= $id;";
	$result = mysqli_query($conn,$query);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<ul><li><a href='oglas.php?id=" .$row['id'].
				"'<h2>" .$row['title']. "</h2>
				<br> Opis:" .$row['description']. "
				
				<p>Pogledaj oglas</p></a></li></ul>";
		}
	}
	else{
		echo "<h1>Ova kategorija još ne sadrži oglase!</h1>";
	}
 ?>
