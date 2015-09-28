<?php  
require_once 'sql.php';
require_once 'simple_html_dom.php';

$data = array();
$url = 'http://www.ikea.com/ru/ru/catalog/allproducts/';
header("Content-Type: text/html; charset=utf-8");

$curl = curl_init(); 
 curl_setopt($curl, CURLOPT_URL, $url);  
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
 curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
 $str = curl_exec($curl); 
 curl_close($curl);
 $html= str_get_html($str); 
$html = $html->find('body', 0);

$html = $html->find('#allContent #mainPadding #main #allProductsMain #allProductsContainer', 0);

foreach ($html->find('.productCategoryContainer, .productCategoryContainerNoBorder') as $col) {
	$as["text"] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '',$col->find('.header', 0)->innertext);
	$as["href"] = array();
	foreach ($col->find('a') as $a) {
		$url_href = explode("/",str_replace("/ru/ru/catalog/categories/departments/", "", $a->href));
		$href['href'] = $url_href[1];
		$href['name'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '',$a->innertext);
		array_push($as["href"], $href);
	}
	$as["id"] = $url_href[0];
	array_push($data, $as);
}
foreach ($data as $row){
	$text=$text.json_encode($row, JSON_UNESCAPED_UNICODE).",\r\n";
}
$text = "<?php \$bd = json_decode('[\r\n".str_replace('null', '""', str_replace(',null', '', substr_replace($text, '', -3, -2)))."]',true); ?>";
$f = fopen('allproducts_array.php', "w");
fwrite($f,$text);
fclose($f);

echo '<code>'.htmlspecialchars($text).'</code>';
?>