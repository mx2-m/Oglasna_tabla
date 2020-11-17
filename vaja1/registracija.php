<?php
include_once('glava.php');

// Funkcija preveri, ali v bazi obstaja uporabnik z določenim imenom in vrne true, če obstaja.
function username_exists($username){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM users WHERE username='$username'";
	$res = $conn->query($query);
	return mysqli_num_rows($res) > 0;
}

// Funkcija ustvari uporabnika v tabeli users. Poskrbi tudi za ustrezno šifriranje uporabniškega gesla.
function register_user($username, $password,$email,$name,$lastname,$addres,$post,$number,$gender,$age){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = sha1($password);
	/*$email= mysqli_real_escape_string($conn, $email);
	$name= mysqli_real_escape_string($conn, $name);
	$lastname= mysqli_real_escape_string($conn, $lastname);/*
	/* 
		Tukaj za hashiranje gesla uporabljamo sha1 funkcijo. V praksi se priporočajo naprednejše metode, ki k geslu dodajo naključne znake (salt).
		Več informacij: 
		http://php.net/manual/en/faq.passwords.php#faq.passwords 
		https://crackstation.net/hashing-security.htm
	*/
	$query = "INSERT INTO users (username, password, email, name, lastname, addres, post, number, gender, age) VALUES ('$username', '$pass','$email','$name','$lastname','$addres','$post','$number','$gender','$age');";
	if($conn->query($query)){
		return true;
	}
	else{
		echo mysqli_error($conn);
		return false;
	}
}

$error = "";

if(isset($_POST["poslji"])){
	/*
		VALIDACIJA: preveriti moramo, ali je uporabnik pravilno vnesel podatke (unikatno uporabniško ime, dolžina gesla,...)
		Validacijo vnesenih podatkov VEDNO izvajamo na strežniški strani. Validacija, ki se izvede na strani odjemalca (recimo Javascript), 
		služi za bolj prijazne uporabniške vmesnike, saj uporabnika sproti obvešča o napakah. Validacija na strani odjemalca ne zagotavlja
		nobene varnosti, saj jo lahko uporabnik enostavno zaobide (developer tools,...).
	*/
	//Preveri če se gesli ujemata
	if($_POST["password"] != $_POST["repeat_password"]){
		$error = "Gesli se ne ujemata.";
	}
	//Preveri ali uporabniško ime obstaja
	else if(username_exists($_POST["username"])){
		$error = "Uporabniško ime je že zasedeno.";
	}
	
	else if (empty($_POST["username"])) {
        $error= "Username field is required!";
    } 
	else if (empty($_POST["password"])) {
	$error = "Password field is required!";
	}
	else if (empty($_POST["e-mail"])) {
	$error = "E-mail field is required!";
	}
	else if (empty($_POST["name"])) {
	$error = "Name field is required!";
	}
	else if (empty($_POST["lastname"])) {
	$error = "Lastname field is required!";
	}
	//Podatki so pravilno izpolnjeni, registriraj uporabnika
	else if(register_user($_POST["username"], $_POST["password"], $_POST["e-mail"], $_POST["name"], $_POST["lastname"],$_POST["addres"],$_POST["post"],$_POST["number"],$_POST["gender"],$_POST["age"])){
		header("Location: prijava.php");
		die();
	}
	//Prišlo je do napake pri registraciji
	else{
		$error = "Prišlo je do napake med registracijo uporabnika.";
	}
}










?>









	<h2>Registracija</h2>
	<form action="registracija.php" method="POST">
		<label>Uporabniško ime </label><input type="text" name="username" /> <br/>
		<label>Geslo </label><input type="password" name="password" /> <br/>
		<label>Ponovi geslo </label><input type="password" name="repeat_password" /> <br/>
		<label>E-mail </label><input type="email" name="e-mail" /> <br/>
		<label>Ime </label><input type="text" name="name" /> <br/>
		<label>Priimek </label><input type="text" name="lastname" /> <br/>
		<label>Nalov </label><input type="text" name="addres" /> <br/>                    
		<label>Pošta </label><input type="text" name="post" /> <br/>
		<label>Telefonska številka </label><input type="tel" name="number" /> <br/>
		<label>Spol </label><input type="text" name="gender" /> <br/>
		<label>Starost </label><input type="number" min="15" max="156" name="age" /> <br/>
		
		
		
		<input type="submit" name="poslji" value="Pošlji" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>