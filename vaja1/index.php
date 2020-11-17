<?php
include_once('glava.php');

// Funkcija prebere oglase iz baze in vrne polje objektov
function get_oglasi(){
	global $conn;
	$query = "SELECT * FROM ads WHERE duedate>CURDATE() ORDER BY date DESC;";
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}



//Preberi oglase iz baze
$oglasi = get_oglasi();


//Izpiši oglase
//Doda link z GET parametrom id na oglasi.php za gumb 'Preberi več'
foreach($oglasi as $oglas){
	$img_data = base64_encode($oglas->image);
	$id =$oglas->id ;
	
	?>
	<div class="oglas">
		<h4><?php echo $oglas->title;?></h4>
		<p><?php echo $oglas->description;?></p>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		<a href="oglas.php?id=<?php echo $id;?>"><button>Preberi več</button></a>
	</div>
	<hr/>
	<?php
}



include_once('noga.php');
?>