#!/usr/bin/php
<?PHP
$fd = fopen("/var/run/utmpx", "r");
$utmp = array();
$i = 0;

date_default_timezone_set("Europe/Paris");

while ($i < 1256)
{
    fgetc($fd);
    $i += 1;
}

while (($tmp = fgets($fd, 629)))
{
    $tmp2 = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/@", $tmp);
    array_push($utmp, $tmp2);
}

foreach ($utmp as $e)
{
	if ($e["type"] == 7)
    {
        $true_shit[$e["line"]] = $e;
    }
}

ksort($true_shit);

foreach ($true_shit as $e)
{
	if (strlen($e["user"]) > $lu)
		$lu = strlen($e["user"]);
	if (strlen($e["line"]) > $ll)
		$ll = strlen($e["line"]);
}
foreach ($true_shit as $e)
{
	$i = 0;
	$usr = $e["user"];
	while($i < $lu)
	{
		if (isset($usr[$i]))
			echo($usr[$i]);
		else
			echo(" ");
		$i++;
	}
	echo(" ");
	$i = 0;
	$usr = $e["line"];
	while($i < $ll)
	{
		if (isset($usr[$i]))
			echo($usr[$i]);
		else
			echo(" ");
		$i++;
	}
	echo("  ");
	echo date("M j H:i \n", $e["time1"]);
}
?>
