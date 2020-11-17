<?php

include_once('glava.php'); 

function get_user(){
	global $conn;
	$userID = $_SESSION["USER_ID"];
	$sql = "SELECT * FROM ads WHERE user_id = '$userID' AND duedate<CURDATE()";
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


<div class="oglas">
		<h4><?php echo $user->title;?></h4>
		<p><?php echo $user->id;?></p>
		<p><?php echo $user->description;?></p>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		
	</div>

