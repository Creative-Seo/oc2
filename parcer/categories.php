<?php  require_once 'simple_html_dom.php';
$data = array();
$url = 'http://www.ikea.com/ru/ru/catalog/categories/departments/living_room/16239/';
header("Content-Type: text/html; charset=utf-8");

$curl = curl_init(); 
 curl_setopt($curl, CURLOPT_URL, $url);  
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
 curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
 $str = curl_exec($curl); 
 curl_close($curl);
 $html= str_get_html($str); 
$html = $html->find('body', 0);

$html = $html->find('#allContent #mainPadding #main #productLists', 0);

foreach ($html->find('.gridRow script') as $key => $col) {
	$script = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '',$col->innertext);
	$script = explode(")",explode("(",$script)[1])[0];
	$script = json_decode($script,true);
	if (count($script)>0) {
		foreach ($script as $a)
			array_push($data, $a);
	} else {
		$script = explode("/",str_replace('/ru/ru/catalog/products/', '', $html->find('.gridRow .productLink')[$key]->href))[0];
		array_push($data, $script);
	}
}
foreach ($data as $row){
	$text=$text.json_encode($row, JSON_UNESCAPED_UNICODE).",\r\n";
}
$text = "<?php \$bd = json_decode('[\r\n".str_replace('null', '""', str_replace(',null', '', substr_replace($text, '', -3, -2)))."]',true); ?>";
$f = fopen('categories_array.php', "w");
fwrite($f,$text);
fclose($f);

echo '<code>'.htmlspecialchars($text).'</code>';
?>