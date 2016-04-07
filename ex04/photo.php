#!/usr/bin/php
<?PHP
if ($argc != 2){
	return ;
}
$lol=array();
$ci=curl_init($argv[1]);
preg_match_all("/(?<=http:\/\/)([^\/]*?)(?:(?=\/)|$|\12)|(?<=https:\/\/)([^\/]*?)(?:(?=\/)|$|\12)|^(?<!http)(?!http:\/\/|https:\/\/)([^\/]+?(?=\12|\/|$))/", $argv[1], $nm);
if (!$nm)
	return;
if ($nm[0][1])
	$pt=$nm[0][1];
else
	$pt=$nm[0][0];
if (!$ci)
	return;
$site=$argv[1];
if (!preg_match_all("/^http[s]?/", $site))
	$site="http://".$site;
if (curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1))
	$str = curl_exec($ci);
else
	RETURN;

preg_match_all("~<[^>]*img.*src[ ]*=[ ]*\"([^\"]+).*>~i", $str, $lol);
if (!$lol)
	return;
$res=array_pop($lol);
if (!$res)
	return;
foreach($res as $k => $xd)
{
	if (!preg_match_all("/^http/", $xd))
		$res[$k]=$site.$xd;
}
foreach($res as $url)
{
	$name = array_pop(explode('/',$url));
	$context = stream_context_create(array('http' => array('ignore_errors' => true),));
	$ct = file_get_contents($url, false, $context);
	if ($ct)
	{
	if (!is_dir("$pt"))
		mkdir($pt);
	$pt="./".$pt."/";
	file_put_contents("$pt$name", $ct);
	}
}
?>
