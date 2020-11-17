<p>Seznam vseh uporabnikov</p>
<!-- pogled za pregeld vseh oglasov-->
<!-- na vrhu damu uporabniku gumb, s katerim proži akcijo dodaj, da lahko dodaja nove uporabnike -->
<a href="?controller=uporabniki&action=dodaj" class="btn btn-primary">Dodaj <i class="fas fa-plus"></i></a>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Uporabniško ime</th>
        <th>Elektonski naslov</th>
        <th>Ime</th>
		<th>Priimek</th>
		<th>Naslov</th>
		<th>Pošta</th>
		<th>Telefon</th>
		<th>Spol</th>
		<th>Starost</th>
      </tr>
    </thead>
    <tbody>
 
 <!-- tukaj se sprehodimo čez array oglasov in izpisujemo vrstico posameznega oglasa-->

<?php foreach($uporabniki as $uporabnik) { ?>
  <tr>
  <td><?php echo $uporabnik->username; ?></td>
  
 
	<td><?php echo $uporabnik->email; ?></td>
	<td><?php echo $uporabnik->name; ?></td>
	<td><?php echo $uporabnik->surname; ?></td>
	<td><?php echo $uporabnik->address; ?></td>
	<td><?php echo $uporabnik->post; ?></td>
	<td><?php echo $uporabnik->phone; ?></td>
	<td><?php echo $uporabnik->gender; ?></td>
	<td><?php echo $uporabnik->age; ?></td>
	 <td>
    <!-- pri vsakem oglasu dodamo povezavo na akcijo prikaži, z idjem oglasa. Uporabnik lahko tako proži novo akcijo s pritiskom na gumb.-->
    <td><a href='?controller=uporabniki&action=prikazi&id=<?php echo $uporabnik->id; ?>'>Poglej uporabnika</a></td>
	
	<td><a href='?controller=uporabniki&action=uredi&id=<?php echo $uporabnik->id; ?>'>Uredi uporabnika</a></td>
	
 </tr>
<?php } ?>
    </tbody>
  </table>