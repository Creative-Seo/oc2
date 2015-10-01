<?php  
require_once 'sql.php';
function creat_table_product() {
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$sql = "DROP TABLE IF EXISTS tovar ".
			"CREATE TABLE tovar ".
			"(id  smallint unsigned NOT NULL, ".
  			"publicationDate date NOT NULL, ".
  			"title  varchar(255) NOT NULL, ".
 			"cat1  smallint NOT NULL, ".
  			"cat2  smallint NOT NULL, ".
  			"opisanie  text NOT NULL, ".
  			"cena  smallint NOT NULL, ".
			"PRIMARY KEY (id));";
	$st = $conn->prepare( $sql );
	$st->execute();
	$conn = null;
}

function creat_table_cat1() {
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$sql = "DROP TABLE IF EXISTS cat1 ".
			"CREATE TABLE cat1 ".
			"(id  smallint unsigned NOT NULL, ".
  			"publicationDate date NOT NULL, ".
  			"title  varchar(255) NOT NULL, ".
			"PRIMARY KEY (id));";
	$st = $conn->prepare( $sql );
	$st->execute();
	$conn = null;
}

function creat_table_cat2() {
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$sql = "DROP TABLE IF EXISTS cat2 ".
			"CREATE TABLE cat2 ".
			"(id  smallint unsigned NOT NULL, ".
  			"publicationDate date NOT NULL, ".
  			"title  varchar(255) NOT NULL, ".
 			"cat1  smallint NOT NULL, ".
			"PRIMARY KEY (id));";
	$st = $conn->prepare( $sql );
	$st->execute();
	$conn = null;
}
creat_table_product();
creat_table_cat1();
creat_table_cat2();
?>