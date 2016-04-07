#!/usr/bin/php
<?PHP
if ($argc != 2)
	return ;
$fd=fopen($argv[1], "r");
if (!$fd)
	return;
$temp;
while ($temp=fgets($fd))
	$res.=$temp;
$read=$res;
preg_match_all("/<a.*?<\/a>/si", $res, $temp);
$tr=$temp[0];
$raw=$tr;
function ft_upp($p1)
{
	foreach ($p1 as $k => $l)
	{
		$p1[$k]=strtoupper($l);
	}
	return($p1[0]);
}
function ft_upp1($p1)
{
	foreach ($p1 as $k => $l)
	{
		if ($k == 0)
			$oldp=$l;
		else
		{
			$olds=$p1[$k];
			$olds=str_replace("\\", "\\\\", $olds);
			$olds="|title".$olds."|si";
			$p1[$k]=strtoupper($p1[$k]);
			$p1[$k]=str_replace("\\\\", "\\\\\\\\", $p1[$k]);
			$p1[$k]="title".$p1[$k];
			$p1[0] = preg_replace("$olds", "$p1[$k]" , $p1[0], 1);
		}
	}
	return($p1[0]);
}

function ft_spec($p1)
	{
		$p1=str_replace(".", "[.]", $p1);
		$p1=addslashes($p1);
		return ($p1);
	}

foreach($tr as $k => $elem)
{
	$elem=preg_replace_callback("/<[^>]*(?<=title)(=\"[^\"]*\").*?>/si", "ft_upp1", $elem);
	$tr[$k]=$elem;
}
foreach($tr as $k => $elem)
{
	$elem=preg_replace_callback("/(?<=>)[^<]+/si", "ft_upp", $elem);
	$tr[$k]=$elem;
}
foreach ($raw as $k => $e)
{
	$tr[$k]=str_replace("\\\\", "\\\\\\\\", $tr[$k]);
	$tmp = "|".ft_spec($e)."|";
	$read = preg_replace("$tmp", "$tr[$k]", $read, 1);
}
echo $read;
?>
