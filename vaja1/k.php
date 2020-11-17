<?php
	require "glava.php";
?>
<body>
	<h1>Kategorije</h1>
	<form action=dodaj_kategoriju.php method='post'>
		<button class='dodaj_kat1' type='submit' name='dodaj_kat1'> Dodaj Kategoriju</button></form>
	<ul>
	<?php 
		$sql = "SELECT a.id_kategorija, a.naziv, a.slika,IFNULL(b.broj,0) AS br FROM kategorija AS a LEFT JOIN (
	    			SELECT id_kategorija, count(*) as broj FROM oglas
					WHERE aktivan GROUP BY id_kategorija
					) AS b ON a.id_kategorija=b.id_kategorija;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
			
		if ($resultCheck > 0) { # lista kategorija
			while ($row = mysqli_fetch_assoc($result)) {
				if(isset($_SESSION['kor_id'])){
					if($_SESSION['id_tip']=='0'){	
														#ADMIN PRIKAZ
						echo"<li><a href='uredi_kategoriju.php?id=" .$row['id_kategorija']."'>
							<h2>" . $row['naziv'] . "</h2>" . "
							<p class='br_ogl'>broj oglasa:" . $row['br'] ."<br>Uredi kategoriju</p>";
							if($row['slika'] == 0){
								echo "<p><img class='slProf1' src='uploads/kategorije/kategorija.png' style='width:128px;height:128px;'/></p></a></li>";
							}else{
								echo"<p><img class='slProf1' src='uploads/kategorije/kategorija".$row['id_kategorija'].".png' style='width:128px;height:128px;'/></p></a></li>";
							}
				}
				elseif($_SESSION['id_tip']!='0'){		#PRIKAZ ZA ULOGIRANOG KORISNIKA
					echo "<li><a href='oglasi_kategorije.php?id=". $row['id_kategorija']. "'>
						<h2>" . $row['naziv'] . "</h2>" . "
						<p class='br_ogl'>broj oglasa:" . $row['br']."
						</p>";
						if($row['slika'] == 0){
							echo "<p><img class='slProf1' src='uploads/kategorije/kategorija.png' style='width:128px;height:128px;'/></p></a></li>";
						}else{
							echo"<p><img class='slProf1' src='uploads/kategorije/kategorija".$row['id_kategorija'].".png' style='width:128px;height:128px;'/>";
						}"</p></a></li>";
					}
				}
				else{									#PRIKAZ ZA ANONIMNOG KORISNIKA
					echo "<li><a href='oglasi_kategorije.php?id=". $row['id_kategorija']. "'>
						<h2>" . $row['naziv'] . "</h2>" . "
						<p class='br_ogl'>broj oglasa:" . $row['br']."
						</p>";
						if($row['slika'] == 0){
							echo "<p><img class='slProf1' src='uploads/kategorije/kategorija.png' style='width:128px;height:128px;'/></p></a></li>";
						}else{
							echo"<p><img class='slProf1' src='uploads/kategorije/kategorija".$row['id_kategorija'].".png' style='width:128px;height:128px;'/>";
						}"</p></a></li>";
				}
			}
		}
	?>
	</ul>
</body>