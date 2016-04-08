<?php
//header("Refresh: 2;"); 
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://localhost/webservice/project/');
	$client = new SoapClient("../wsdl.wsdl"); 

	try{
		$Id=$_POST['NomClient'];
		$Password=$_POST['MdpClient'];
		$Mac = $client-> Authentification($Id, $Password);
		$donnee=explode(",",$Mac);	

?>
<head>
	<script type="text/javascript" src="//code.jquery.com/jquery-2.0.2.js">$('#trouve').change(function() {$("#textradiomac").html($(this).val());});</script>	
</head>

<body>	
	<p>
		<h2>Modifier mes prises</h2>
		<form action='modifier.php' method="POST">
			<select id="trouve" name="trouve" >
				<?php
					for ($i=0; $i < count($donnee); $i++){
						$Mac=$donnee[$i];
						echo '<option value="'.$Mac.'" selected="selected">' . $Mac . ' </option>';
					}
			    ?>
			</select>
		<p>Test des adresses Mac :</p> 
		<p id="textradiomac"><?php echo "$Mac"; ?></p>
		
			
		<?php
			$etat = $client->Etat_courant($Mac);
		?>
		
		<p id="textradio">
			<input type="button" onclick='window.location.reload(false)' value="Mettre a jour"/></br></br>

			Prise 1: 
				<label>On <input name="prise1" type="radio" value="1" <?php if ($etat[0]==1){ echo ' checked="checked"';} ?>/></label>
				<label>Off<input name="prise1" type="radio" value="0" <?php if ($etat[0]==0){ echo ' checked="checked"'; } ?>/></label></br>
			Prise 2: 
				<label>On <input name="prise2" type="radio" value="1" <?php if ($etat[1]==1){ echo ' checked="checked"';} ?>/></label>
				<label>Off<input name="prise2" type="radio" value="0" <?php if ($etat[1]==0){ echo ' checked="checked"'; } ?>/></label></br>
			Prise 3:
				<label>On <input name="prise3" type="radio" value="1" <?php if ($etat[2]==1){ echo ' checked="checked"';} ?>/></label>
				<label>Off<input name="prise3" type="radio" value="0" <?php if ($etat[2]==0){ echo ' checked="checked"'; } ?>/></label></br>
			Prise 4: 
				<label>On <input name="prise4" type="radio" value="1" <?php if ($etat[3]==1){ echo ' checked="checked"';} ?>/></label>
				<label>Off<input name="prise4" type="radio" value="0" <?php if ($etat[3]==0){ echo ' checked="checked"'; } ?>/></label></br>
			Prise 5:
				<label>On <input name="prise5" type="radio" value="1" <?php if ($etat[4]==1){ echo ' checked="checked"';} ?>/></label>
				<label>Off<input name="prise5" type="radio" value="0" <?php if ($etat[4]==0){ echo ' checked="checked"'; } ?>/></label></br></br></br>
			<input type="submit" value="Enregistrer mes modifications" name="enregistrer"/></a>	
		</p>
		</form>	

		<form method="post" action='ephemeride.php'>
			<input type="submit" value="Effectuer une programmation" name="plannifier"/></a>	
		</form>
	
	</p>	
</body>
<?php
		echo("<br><p><a href='index.php'>Deconnexion</a></p>");
		
	} catch (SoapFault $exception) { 
		echo $exception;       
	}
?>