<?php
//header("Refresh: 2;"); 
	ini_set("soap.wsdl_cache_enabled", "0");  

	$options = array('uri'=> 'http://localhost/webservice/project/');
	$client = new SoapClient("../wsdl.wsdl"); 	
	try{
		
		?>
<head>
<script type="text/javascript" >

var i = 255
function rgb(r, g, b) {
	function hex(num) {
		function lettre(c) {
			switch (c) {
				case 10 : return 'A'
					break
				case 11 : return 'B'
					break
				case 12 : return 'C'
					break
				case 13 : return 'D'
					break
				case 14 : return 'E'
					break
				case 15 : return 'F'			
					break
				default : return c+''
			}
		}
		dizaine = lettre(Math.floor(num/16))
		unite = lettre(num%16)
		return dizaine + unite
	}
	return '#'+hex(r)+hex(g)+hex(b)
}
// Change la couleur du fond en fonction de la position de la souris
function change(evt) {
	couleur = Math.floor((evt.layerX/window.innerWidth)*255)
	document.bgColor = rgb(200,200,200) //couleur
}

// Capture les dŽplacements de souris
window.captureEvents(Event.MOUSEMOVE)
// Associe la fonction change au dŽplacement de la souris
window.onmousemove=change


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function choix_ephe(id,n) {
	switch(n) {
		case 1:
			document.getElementById("N_ephe").innerHTML = "1";
			break;
		case 2:
			document.getElementById("N_ephe").innerHTML = "2";
			break;
		case 3:
			document.getElementById("N_ephe").innerHTML = "3";
        break;	
	    case 4:
			document.getElementById("N_ephe").innerHTML = "4";
        break;
	    case 5:
			document.getElementById("N_ephe").innerHTML = "5";
        break;

}
}

</script>
</head>		
		
<body>		
		
	<input type="button" onclick='window.location.reload(false)' value="Refresh" name="1"/><br/><br/>
		
	<form method="POST">	

		<input type="button" class="ephemeride" value="1" onclick="choix_ephe('slot',1);" />
		<input type="button" class="ephemeride" value="2" onclick="choix_ephe('slot',2);" />
		<input type="button" class="ephemeride" value="3" onclick="choix_ephe('slot',3);" />
		<input type="button" class="ephemeride" value="4" onclick="choix_ephe('slot',4);" />
		<input type="button" class="ephemeride" value="5" onclick="choix_ephe('slot',5);" /><p id="N_ephe"></p>
		
		
		<select id="prises" name="prises" >
			<option value="1" selected="selected">Prise 1</option>
			<option value="2">Prise 2</option>
			<option value="3">Prise 3</option>
			<option value="4">Prise 4</option>
			<option value="5">Prise 5</option>
		</select>
		<select id="slot" name="slot" >
			<option value="1" selected="selected">Emplacement 1</option>
			<option value="2">Emplacement 2</option>
			<option value="3">Emplacement 3</option>
			<option value="4">Emplacement 4</option>
			<option value="5">Emplacement 5</option>
		</select>
		<select id="jour" name="jour" >
			<option value="1" selected="selected">Lundi</option>
			<option value="2">Mardi</option>
			<option value="3">Mercredi</option>
			<option value="4">Jeudi</option>
			<option value="5">Vendredi</option>
			<option value="6">Samedi</option>
			<option value="7">Dimanche</option>
		</select>


	</br><p>	Heure debut : <input type="text" placeholder="exemple: 09:00" name="HeureDebut" required></p>
	<p>	Heure fin :   <input type="text" placeholder="exemple: 12:00" name="HeureFin" required> </p>
		<br/><br/><input type="submit" name="Envoyer" value="Enregistrer" <?php  ?>><br />
	</form>
		
		
	
	<INPUT type="button" value="Revenir a la page principale" onClick="window.history.back()">
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</body>
<?php 



	if (!empty($_POST)){
		if(empty($_POST['jour']) && empty($_POST['HeureDebut']) && empty($_POST['HeureFin'])){
			$message = 'fail';
		}
		else{
			
			$Mac='18:fe:34:e4:c1:47';
			//$Mac=$_POST['recup'];
			$N_prise=$_POST['prises'];
			$Nb_Ephe=$_POST['slot'];
			$Plannif=$_POST['jour'].$_POST['HeureDebut'].$_POST['HeureFin'];
			echo $client->Ephemeride($Mac, $N_prise, $Nb_Ephe, $Plannif);
			echo "<br>Adresse Mac prise : $Mac <br> Plannifier : $Plannif <br> prise num : $N_prise <br> slot : $Nb_Ephe <br>";
			echo "<br>";
			
		}
	 
	}
	} catch (SoapFault $exception) { 
		echo $exception;       
	}
?>



