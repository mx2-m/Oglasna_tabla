<?php
include_once('glava.php');
function get_user(){
	global $conn;
	$userID = $_SESSION["USER_ID"];
	$sql = "SELECT * FROM ads WHERE user_id = '$userID'";
	$r = $conn->query($sql);
	while($obj = $r->fetch_object()){
		return $obj;
	}
	return null;
}

$user=get_user();
$img_data = base64_encode($user->image);
$idOglas =$user->id ;
?>

<style>
.oglas {
  display: grid;
  grid-template-columns: auto auto auto;
  grid-template-rows: 80px 200px;
  grid-gap: 10px;
  background-color: LightSkyBlue;
  padding: 10px;
}

.oglas h4 {
  text-align: center;
  background: #1abc9c;
  font-size: 30px;
}
.vertical-menu {
  width: 200px; 
}

.vertical-menu a {
  background-color: #eee; 
  color: black; 
  display: block; 
  padding: 12px; 
  text-decoration: none; 
}

.vertical-menu a:hover {
  background-color: #ccc;
}

.vertical-menu a.active {
  background-color: #4CAF50;
  color: white;
}

.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}


.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: blue;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>


<div class="vertical-menu">
<a href="objavi.php">Objavi oglas</a>
<a href="azuriraj_oglas.php?id='.$idOglas.'">Izmjeni</a>
<a href="obrisi_oglas.php?id=$idOglas">Obrisi oglas</a></div>
<label class="container">Prikazi zapadle oglase: <input class=""  type="checkbox" id="myCheck"  onclick="myFunction()"> <span class="checkmark"></span> </label>


<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("id2");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

<?php


// Funkcija prebere oglase iz baze in vrne polje objektov
function get_oglasi(){
	global $conn;
	$userID = $_SESSION["USER_ID"];
	$query = "SELECT * FROM ads WHERE user_id = '$userID' AND duedate>CURDATE();;";
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}

function get_oglasi1(){
	global $conn;
	$userID = $_SESSION["USER_ID"];
	$query = "SELECT * FROM ads WHERE user_id = '$userID' AND duedate<CURDATE();";
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}



$oglasi = get_oglasi();
$oglasi1 = get_oglasi1(); 


foreach($oglasi as $oglas){
$img_data = base64_encode($oglas->image);
	?>

	<div class="oglas" >
		<h4><?php echo $oglas->title;?></h4>
		<p>Opis: <?php echo $oglas->description;?></p>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		
	</div>
	<hr/>
		<?php
}

foreach($oglasi1 as $oglas){
	?>
	<div class="oglas" id="id2">
		<h4><?php echo $oglas->title;?></h4>
		<p>Opis: <?php echo $oglas->description;?></p>
		
	</div>
	<hr/>
	
	
	
	<?php
}


include_once('noga.php');
?>