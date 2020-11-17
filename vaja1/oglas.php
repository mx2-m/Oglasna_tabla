<?php 
include_once('glava.php');

//Funkcija izbere oglas s podanim ID-jem. Doda tudi uporabnika, ki je objavil oglas.
function get_ad($id){
	global $conn;
	$id = mysqli_real_escape_string($conn, $id);
	$query = "SELECT ads.*, users.username,users.email FROM ads LEFT JOIN users ON users.id = ads.user_id WHERE ads.id = $id ORDER BY date DESC;";
	$res = $conn->query($query);
	if($obj = $res->fetch_object()){
		return $obj;
	}
	return null;
}

if(!isset($_GET["id"])){
	echo "Manjkajoči parametri.";
	die();
}
$id = $_GET["id"];
$oglas = get_ad($id);
if($oglas == null){
	echo "Oglas ne obstaja.";
	die();
}

//Base64 koda za sliko (hexadecimalni zapis byte-ov iz datoteke)
$img_data = base64_encode($oglas->image);
$img_data1 = base64_encode($oglas->image1);
$img_data2 = base64_encode($oglas->image2);
$br_pogleda =$oglas->pogleda;
?>

	<div class="oglas">
		<h4><?php echo $oglas->title;?></h4>
		<p><?php echo $oglas->description;?></p>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		<img src="data:image/jpg;base64, <?php echo $img_data1;?>" width="200"/>
		<img src="data:image/jpg;base64, <?php echo $img_data2;?>" width="200"/>
		<p>Objavil: <?php echo $oglas->username; ?></p>
		<p>Kontakt: <?php echo $oglas->email; ?></p>
		<p>Stevilo pogleda: <?php  echo $br_pogleda ?> </p>
		<a href="index.php"><button>Nazaj</button></a>
	</div>
	<hr/>
	
	
	
	<?php
$br_pogleda+=1;
     $conn->query("UPDATE ads SET pogleda = $br_pogleda WHERE id=$id");
include_once('noga.php');
?>