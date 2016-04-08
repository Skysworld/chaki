<?php
header("Refresh: 2;"); 
$N_prise=5;
$Nb_Ephe=5;

		switch ($N_prise){
			case 1:
				$p=$Nb_Ephe.'0000';
				//$p='10000';
			break;
			case 2:
				$p='0'.$Nb_Ephe.'000';
			break;
			case 3:
				$p='00'.$Nb_Ephe.'00';
			break;
			case 4:
				$p='000'.$Nb_Ephe.'0';
			break;
			case 5:
				$p='0000'.$Nb_Ephe;
			break;
		}
		echo $p;
		
		?>