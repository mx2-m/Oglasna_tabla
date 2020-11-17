
<?php
	session_start();
	
	//Seja poteče po 30 minutah - avtomatsko odjavi neaktivnega uporabnika
	if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
		session_regenerate_id(true);
	}
	$_SESSION['LAST_ACTIVITY'] = time();
	

	//Poveži se z bazo
	$conn = new mysqli('localhost', 'root', '', 'vaja1',3308);
	if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}







	
	//Nastavi kodiranje znakov, ki se uporablja pri komunikaciji z bazo
	$conn->set_charset("UTF8");
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background-color: lightblue;
}

h1 {
  color: black;
  text-align: center;
}

div.scrollmenu {
  background-color: #333;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}

/* Add a black background color to the top navigation bar */
.topnav {
  overflow: hidden;
  background-color:#333;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the "active" element to highlight the current page */
.topnav a.active {
  background-color: #2196F3;
  color: white;
}

/* Style the search box inside the navigation bar */
.topnav input[type=text] {
  float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;
}


}
</style>





<div>

	<title>Vaja 1</title>
</head>
<body>
	<h1>Oglasnik</h1>
	
	<div class="scrollmenu">
	<nav>
		<ul>
			<a href="index.php">Domov</a>
			<?php
			if(isset($_SESSION["USER_ID"])){
				
				?>
			<a href="odjava.php">Odjava</a>	
			<a href='moj.php'>Moj oglasi</a>
			
		
		  <a href="kat1.php?id=1">Živali</a>
		  <a href="kat1.php?id=2">Biljke</a>
		  <a href="kat1.php?id=3">Ostalo</a>
		  <a href="kat1.php?id=0">Bez kategorije</a>
        	
			<div class="topnav">
			<form class="search" action="kategorija.php" method="POST">
				<input id="src" type="text" name="search" placeholder="Upiši pojam...">
				<button id="searchBut" type="submit" name="searchBut"></button>
			</form>
		</div>
		   
		  
		
				
				
				
				
				
				<?php
			} else{
				?>
				<li><a href="prijava.php">Prijava</a></li>
				<li><a href="registracija.php">Registracija</a></li>
				<?php
			}
			?>
			
		</ul>
	</nav>
	</div>
	<hr/>
	</div>