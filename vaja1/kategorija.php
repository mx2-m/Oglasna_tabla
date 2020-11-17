<?php 
	include 'glava.php'
 ?>

<h1>Rezultat pretrage</h1>
<ul>
 <?php
 $query = "SELECT id FROM category;";
	$res = $conn->query($query);
	$row = $res->fetch_assoc();
	$kategorija_id= $row['id'];
	
 if (isset($_POST['searchBut'])) {#funkcija provjerava dali je upisan string
 	$search = mysqli_real_escape_string($conn, $_POST['search']);
 	$sql = "SELECT * FROM ads
                WHERE  title LIKE '%$search%' OR description LIKE '%$search%';";
				$result = $conn->query($sql);
 	//$result = mysqli_query($conn, $sql);
 
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<ul><li><a href='oglas.php?id=" .$row['id'].
				"'<h2>" .$row['title']. "</h2>
				<br> Opis:" .$row['description']. "
				
				<p>Pogledaj oglas</p></a></li></ul>";
		}
	
	
 }
 ?>
</ul>