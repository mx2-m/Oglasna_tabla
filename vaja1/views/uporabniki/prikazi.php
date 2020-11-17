<!--enostaven pogled za prikaz enega oglasa -->
<!-- ta se nahaja v spremenljivki $oglas, ki smo jo pripravili v kontrolerju -->

 <div class="panel panel-default">
  <div class="panel-heading">
	<h2><?php echo $uporabnik->username; ?></h2>
  </div>
  
  <div class="panel-body"><?php echo $uporabnik->email; ?></div>
  <div class="panel-body"><?php echo $uporabnik->name; ?></div>
  <div class="panel-body"><?php echo $uporabnik->surname; ?></div>
  <div class="panel-body"><?php echo $uporabnik->address; ?></div>
  <div class="panel-body"><?php echo $uporabnik->post; ?></div>
  <div class="panel-body"><?php echo $uporabnik->phone; ?></div>
  <div class="panel-body"><?php echo $uporabnik->gender; ?></div>
  <div class="panel-body"><?php echo $uporabnik->age; ?></div>
</div> 
