#!/usr/bin/php
<?PHP

	if ($argc < 2)
		return;
	preg_match_all("/[\S]+/", $argv[1], $tab);
	if (!$tab[0] || $tab[0][0] === null)
		return;
	$elem = array_shift($tab[0]);
	echo $elem;
	if ($tab[0] !== null)
	{
		foreach($tab[0] as $elem)
			echo " ".$elem;
	}
	echo "\n";
?>
