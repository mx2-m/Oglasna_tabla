<?php
include_once('glava.php'); 
if(isset($_POST['obrisi'])){

		$id = $_POST['ads'];
		$conn = new mysqli("localhost", "root", "", "vaja1",3308);
		$sql = "DELETE FROM ads WHERE id = '$id'";
		$result = $conn->query($sql);
		header("Location: index.php");
}



?>

<html>
<head>
	<title>Obrisi oglas</title>
</head>
<body>
	<form action="obrisi_oglas.php" method="post">
		Izaberite ID oglasa: 
		<?php
		    $userID = $_SESSION["USER_ID"];
			$conn = new mysqli("localhost", "root", "", "vaja1",3308);
			$sql = "SELECT * FROM ads WHERE user_id='$userID'";
			$result = $conn->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);

			echo "<select name='ads'>";
			foreach($rows as $row){
				echo "<option value='".$row['id']."'>" . $row['id'] . "</option>";
			}
			echo "</select><br>";

		?> 
	

			<br><input type="submit" name="obrisi">
	</form>
</body>
</html>