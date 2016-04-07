#!/usr/bin/php
<?PHP

	date_default_timezone_set('Europe/Paris');
	if ($argc != 2)
		return;
	if (preg_match_all("/(^[a-z, A-Z][a-z]+) ([0-9]{1,2}) ([a-z, A-Z][a-z, û, é]+) ([0-9]{4}) ([0-1][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9]$)/", $argv[1], $tab) == 0)
	{
		echo "Wrong Format\n";
		return;
	}
	else 
	{
		$jour=array("lundi" => "monday", "mardi" => "tuesday", "mercredi" => "wednesday", "jeudi" => "thursday", "vendredi" => "friday", "samedi" => "saturday", "dimanche" => "sunday");
		$mois=array("janvier" => "01", "fevrier" => "02", "février" => "02", "mars" => "03", "avril" => "04", "mai" => "05", "juin" => "06", "juillet" => "07", "aout" => "08", "août" => "08", "septembre" => "09", "octobre" => "10", "novembre" => "11", "décembre" => "10", "decembre" => "11", "Janvier" => "01", "Fevrier" => "02", "Février" => "02", "Mars" => "03", "Avril" => "04", "Mai" => "05", "Juin" => "06", "Juillet" => "07", "Aout" => "08", "Août" => "08", "Septembre" => "09", "Octobre" => "10", "Novembre" => "11", "Décembre" => "10", "Decembre" => "11");
;
		foreach ($tab as $key => $elem)
			$res[$key] = $elem[0];
		array_shift($res);
		$tab = $res;
		if ($tab[1] <= 9 && $tab[1][0] != "0")
			$tab[1] = "0".$tab[1];
		$mois = $mois[($tab[2])];
		if (($jour = $jour[strtolower($tab[0])]) && $mois !== null)
		{
			$res = strtotime($tab[3].":".$mois.":".$tab[1]." ".$tab[4].":".$tab[5].":".$tab[6]);
			if ($res === false)
			{
				echo "Wrong Format\n";
				return;
			}
			echo $res."\n";
		}
		else
		{
			echo "Wrong Format\n";
			return;
		}
	}
?>
