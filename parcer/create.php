<?php  include('array.php');
$text2 ='$bd = array(';
$path = 'projects/';
$images = scandir($path);
$self = explode("/", $_SERVER['PHP_SELF']);
$host = $_SERVER['DOCUMENT_ROOT'].'/'.$self[1].'/'.$self[2].'/';
foreach ($bd as $row) {
	if (!is_dir('new/'.$row['id'])) {mkdir('new/'.$row['id'], 0777, true);}
	if (!is_dir('new/'.$row['id'].'/img')) {mkdir('new/'.$row['id'].'/img', 0777, true);}
	$a = file('old/'.$row['id'].'/index.php');
$text = $a[0].$a[1].$a[2].'<?php $bd = json_decode('."'{\r\n";
	$text = $text.'"breadcrumb": "'.$row["p2"]["bread"].'",'."\r\n ";
	$text = $text.'"nomer": "'.$row["p2"]["img"].'",'."\r\n ";
	$text = $text.'"etazhey": "'.$row["p1"][4].'",'."\r\n ";
	$text = $text.'"h1": "'.$row["p2"]["h1"].'",'."\r\n ";
	$text = $text.'"obshchayaPloshchad": "'.$row["p2"]["dd"][0].'",'."\r\n ";
	$text = $text.'"zhilayaPloshchad": "'.$row["p2"]["dd"][1].'",'."\r\n ";
	$text = $text.'"gabarity": "'.$row["p2"]["dd"][2].'",'."\r\n ";
	$text = $text.'"arhitekturnyyStil": '.json_encode($row["p2"]["dd"][15], JSON_UNESCAPED_UNICODE).",\r\n ";
	$text = $text.'"dopolnitelno": ['."\r\n ";
		foreach ($row["p2"]["dl"] as $row2) {$text = $text.json_encode($row2, JSON_UNESCAPED_UNICODE).",\r\n ";}
		if (count($row["p2"]["dl"]) > 0) {$text = substr_replace($text, '', -4, -3)."],\r\n";} else {$text = $text."],\r\n";}
	$text = $text.'"opisanie": "'.$row["p2"]["text"][0].'",'."\r\n ";
	$text = $text.'"expl": ['."\r\n ";
		foreach ($row["p2"]["expl"] as $row2) {$text = $text.json_encode($row2, JSON_UNESCAPED_UNICODE).",\r\n ";}
		if (count($row["p2"]["expl"]) > 0) {$text = substr_replace($text, '', -4, -3)."]\r\n";} else {$text = $text."]\r\n";}
$text = $text."}',true);\r\n".'include("../proekt.php");'."\r\n?>";
	$f = fopen('new/'.$row['id'].'/index.php', "w");
		fwrite($f,$text);
	fclose($f);
	$a = file('old/'.$row['id'].'/block.php');
	$text = $a[0].$a[1].$a[2].$a[3].$a[4].$a[5].substr_replace($a[6],"'".$row["p2"]["pricebl"]."'",14,-4).'<?php include($root."/blocks/block_proekt.php");?>';
	$f = fopen('new/'.$row['id'].'/block.php', "w");
		fwrite($f,$text);
	fclose($f);

	$pieces = explode("-", $row["p2"]["img"]);
$nameTpl = '/'.$pieces[0].'_'.$pieces[1].'/';
if (false !== $images) {
    $imgarray = preg_grep($nameTpl, $images);
	foreach($imgarray as $row2) {
		$pieces = explode("_", $row2);
		if ($pieces[2]=='gl.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'.jpg');}
		if ($pieces[2]=='f1.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-1.jpg');}
		if ($pieces[2]=='f2.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-2.jpg');}
		if ($pieces[2]=='f3.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-3.jpg');}
		if ($pieces[2]=='f4.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-4.jpg');}
		if ($pieces[2]=='1.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-1e.jpg');}
		if ($pieces[2]=='2.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-2e.jpg');}
		if ($pieces[2]=='3.jpg') {copy($host.'projects/'.$row2, $host.'new/'.$row["id"].'/img/'.$row["p2"]["img"].'-3e.jpg');}
	}
}

}
	$text2=$text2.'"'.$row["p2"]["img"].'", ';
	$text2=$text2.');';
	$f = fopen('new/bb.php', "w");
		fwrite($f,$text2);
	fclose($f);
?>