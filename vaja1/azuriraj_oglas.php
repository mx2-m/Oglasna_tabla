<?php
include_once('glava.php'); 


if(isset($_POST['azuriraj'])){
	$id = $_POST['ads'];
	$naslov = $_POST['title'];
	$sadrzaj = $_POST['description'];
	$datum = $_POST['duedate'];
	$kategorija = $_POST['category'];
    $img=$_FILES["image"];
      $img_file = file_get_contents($img["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file = mysqli_real_escape_string($conn, $img_file);
	

	if(empty($id))
		echo "Morate odabrati id";


	else
	{
	
		$conn = new mysqli("localhost", "root", "", "vaja1",3308);
		$sql = "UPDATE ads SET title = '$naslov', description = '$sadrzaj', duedate = '$datum',image='$img_file', category = '$kategorija' WHERE id = '$id'";
		$result = $conn->query($sql);
		
		echo "Azurirali ste oglas";
		header("Location: index.php");

	}
}



?>

<html>
<head>
	<title>Azuriraj oglas</title>
</head>
<body>
	<form action="azuriraj_oglas.php" method="post" enctype="multipart/form-data">
		Izaberite ID oglasa: 
		<?php
		    $userID = $_SESSION["USER_ID"];
			$conn = new mysqli("localhost", "root", "", "vaja1",3308);
			$sql = "SELECT * FROM ads WHERE user_id = '$userID'";
			$result = $conn->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);

			echo "<select name='ads'>";
			foreach($rows as $row){
				echo "<option value='".$row['id']."'>" . $row['id'] . "</option>";
			}
			echo "</select><br>";

		?> 
		
		Naslov <input type="text" name="title"><br>
		Vsebina <textarea name="description" placeholder="description..."></textarea><br>
		Datum <input type="date" name="duedate"><br>
	<label>Slika </label><input type="file" name="image" /> <br/>
		Kategorija 
		<?php
			$conn = new mysqli("localhost", "root", "", "vaja1",3308);
			$sql = "SELECT * FROM category";
			$result = $conn->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);

			echo "<select name='category'>";
			foreach($rows as $row){
				echo "<option value='".$row['id']."'>" . $row['name'] . "</option>";
			}
			echo "</select>";

		?> 
		

			<br><br><input type="submit" name="azuriraj">
	</form>
</body>
</html>

<?php
include_once('noga.php');
?>