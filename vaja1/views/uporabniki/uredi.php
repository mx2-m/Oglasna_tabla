<p>Spremeni podatke uporabnika</p>
<!-- pogled za dodajanje novega oglasa.-->
<!-- Gre za enostavno formo, ki podatke pošilja na kotroler oglasi, z akcijo shrani-->
<form action="?controller=uporabniki&action=shrani1&id=<?php echo $_GET["id"]; ?>" method="post">
<div class="form-group">

<label>Uporabniško ime:</label>
<input type="text" class="form-control" name="uporabnisko" placeholder="Uporabniško ime" />

<label>Geslo:</label>
<input type="password" class="form-control" name="geslo" placeholder="Geslo" />

<label>Elektronski naslov:</label>
<input type="text" class="form-control" name="elektronski" placeholder="Elektronski naslov" />

<label>Ime:</label>
<input type="text" class="form-control" name="ime" placeholder="Ime" />

<label>Priimek:</label>
<input type="text" class="form-control" name="priimek" placeholder="Priimek" />

<label>Naslov:</label>
<input type="text" class="form-control" name="naslov" placeholder="Naslov" />

<label>Pošta:</label>
<input type="text" class="form-control" name="posta" placeholder="Pošto" />

<label>Telefonsko število:</label>
<input name="telefon" class="form-control" placeholder="Telefonsko število" />

<label>Spol</label> </br>
<label>Moški</label>
<input type="radio" name="spol" class="form-control" id="male" value="moški">
<label>Ženska</label>
<input type="radio" name="spol" class="form-control" id="female" value="ženska">

<label>Starost</label>
<input type="number" name="starost" class="form-control" min="1" max="100" value="1">

<input class="btn btn-primary" type="submit" name="Uredi" value="Uredi"/>
<!-- po pritisku submit gumba, se bo klicala akcija shrani, torej moremo v telesu metode shrani, v našem kontrolerju, ustrezno prebrati podatke ($_POST)-->
</div>
</form>