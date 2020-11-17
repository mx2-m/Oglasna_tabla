<?php
include_once('glava.php');



// Funkcija vstavi nov oglas v bazo. Preveri tudi, ali so podatki pravilno izpolnjeni. 
// Vrne false, če je prišlo do napake oz. true, če je oglas bil uspešno vstavljen.
function publish($title, $desc, $img,$category,$img1,$img2){
	global $conn;
	$Date1=date("Y-m-d");
	$duedate=date('Y-m-d', strtotime($Date1. ' + 30 days'));
	
	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	$user_id = $_SESSION["USER_ID"];
	
	$query = "SELECT id FROM category;";
	$res = $conn->query($query);
	$row = $res->fetch_assoc();
	$kategorija_id= $row['id'];
	
	//Preberemo vsebino (byte array) slike
	$img_file = file_get_contents($img["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file = mysqli_real_escape_string($conn, $img_file);
	
	$img_file1 = file_get_contents($img1["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file1 = mysqli_real_escape_string($conn, $img_file1);
	
	$img_file2 = file_get_contents($img2["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file2 = mysqli_real_escape_string($conn, $img_file2);
	
	
	$query = "INSERT INTO ads (title, description, user_id, image,date,category,duedate,kategorija_id,image1,image2)
				VALUES('$title', '$desc', '$user_id', '$img_file','$Date1','$category','$duedate','$kategorija_id','$img_file1','$img_file2');";
	if($conn->query($query)){
		return true;
	}
	else{
		//Izpis MYSQL napake z: echo mysqli_error($conn); 
		return false;
	}
	
	/*
	//Pravilneje bi bilo, da sliko shranimo na disk. Poskrbeti moramo, da so imena slik enolična. V bazo shranimo pot do slike.
	//Paziti moramo tudi na varnost: v mapi slik se ne smejo izvajati nobene scripte (če bi uporabnik naložil PHP kodo). Potrebno je urediti ustrezna dovoljenja (permissions).
		
		$imeSlike=$photo["name"]; //Pazimo, da je enolično!
		//sliko premaknemo iz začasne poti, v neko našo mapo, zaradi preglednosti
		move_uploaded_file($photo["tmp_name"], "slika/".$imeSlike);
		$pot="slika/".$imeSlike;		
		//V bazo shranimo $pot
	*/
}

$error = "";
if(isset($_POST["poslji"])){
	
	if (empty($_FILES["image"])) {
	$error = "Image is required!";
	}
	else if(publish($_POST["title"], $_POST["description"], $_FILES["image"],$_POST["category"],$_FILES["image1"],$_FILES["image2"])){
		header("Location: index.php");
		die();
	}
	else{
		$error = "Prišlo je do napake pri objavi oglasa.";
	}
}
?>
	<h2>Objavi oglas</h2>
	<form action="objavi.php" method="POST" enctype="multipart/form-data">
		<label>Naslov </label><input type="text" name="title" /> <br/>
		<label>Vsebina </label><textarea name="description" rows="10" cols="50"></textarea> <br/>
		<label>Odaberite kategoriju: </label><br><select class="category" name='category' method="POST">";
		<option value='0'>-</option>";
		<?php
			$sql = "SELECT id, name, name2 FROM category";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result)) {
				echo "<option value='" .$row['id']. "'>" .$row['name']. "</option>";
			}
		?>
		</select><br>
		
		
		
		
		
		<label>Predstavitvena slika </label><input type="file" name="image" /> <br/>
		<label>Slika1: </label><input type="file" name="image1" /> <br/>
		<label>Slika2: </label><input type="file" name="image2" /> <br/>
		<input type="submit" name="poslji" value="Objavi" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>