<?php

//model za oglas, ki vsebuje lasntosti, ki definirajo strukturo oglasa 
//in metode, ki vračajo podatke iz trajne hrambe ali jih tja zapisujejo
//v tem razredu so vse metode statične, lahko pa bi bile tudi običajne, pri čemer bi potrem bilo potrebno vsakič ustvarjat objekt


class Uporabnik {
  
  public $id;
  public $username;
  public $email;
  public $name;
  public $surname;
  public $address;
  public $post;
  public $phone;
  public $gender;
  public $age;
  
  //konstruktor
  public function __construct($id, $username, $email, $name, $surname, $address, $post, $phone, $gender, $age) {
    $this->id      = $id;
	$this->username     = $username;
	$this->email     = $email;
	$this->name      = $name;
	$this->surname      = $surname;
	$this->address      = $address;
	$this->post      = $post;
	$this->phone      = $phone;
	$this->gender     = $gender;
	$this->age      = $age;
  }


    //metoda, ki iz baze vrne vse oglase
  public static function vsi() {
    $list = [];
      //dobimo objekt, ki predstavlja povezavo z bazo
    $db = Db::getInstance();
      //izvedemo query
    $result = mysqli_query($db,'SELECT * FROM users');

//v zanki ustvarjamo nove objekte in jih dajemo v seznam
    while($row = mysqli_fetch_assoc($result)){
      $list[] = new Uporabnik($row['id'], $row['username'], $row['email'], $row['name'], $row['surname'], $row['address'], $row['post'], $row['phone'], $row['gender'], $row['age']);
    }
    
        //statična metoda vrača seznam objektov iz baze
    return $list;
  }

  //metoda, ki vrne en oglas z specifičnim id-jem iz baze
  public static function najdi($id) {

    $id = intval($id);
    
    $db = Db::getInstance();
    $result = mysqli_query($db,"SELECT * FROM users where id=$id");
    $row = mysqli_fetch_assoc($result);
    return new Uporabnik($row['id'], $row['username'], $row['email'], $row['name'], $row['surname'], $row['address'], $row['post'], $row['phone'], $row['gender'], $row['age']);
  }
  

    //metoda, ki doda nov oglas v bazo

  public static function dodaj($username, $pass, $email, $name, $surname, $address, $post, $phone, $gender, $age) {
    $db = Db::getInstance();
    $pass = sha1($pass);
	  //primer query-a s prepared statementom

    if ($stmt = mysqli_prepare($db, $query = "INSERT INTO users (username, password, email, name, surname, address, post, phone, gender, age) VALUES ('$username', '$pass', '$email', '$name', '$surname', '$address', '$post', '$phone', '$gender', '$age');")) {
			//dodamo parametre po vrsti namesto vprašajev
			//s string, i integer ,d double, b blob
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
   }
   
   //dobimo nazaj informacijo o ID-ju, ki ga je generiral SQL strežnik
   $id=mysqli_insert_id($db);
   
    //z uporabo metode najdi, najdemo celoten, na novo ustvarjen oglas, in ga vrnemo kontrolerju
   return Uporabnik::najdi($id);
	}

	public static function uredi($id, $username, $pass, $email, $name, $surname, $address, $post, $phone, $gender, $age){
		$id = intval($id); 
		$db = Db::getInstance();
		if ($stmt = mysqli_prepare($db,"UPDATE users SET username='$username', password='$pass', email='$email', name='$name', surname='$surname', address='$address', post='$post', phone='$phone', gender='$gender',age='$age' WHERE id=$id;")) {
			//dodamo parametre po vrsti namesto vprašajev
			//s string, i integer ,d double, b blob
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		}
		return Uporabnik::najdi($id);
	}
}
?>