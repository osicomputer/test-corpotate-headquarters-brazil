<?php
ini_set('error_reporting', E_ALL);
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR');
define("MODE_APP", 0);
if (MODE_APP==0) {
	// Host Name
	$dbhost = 'localhost';
	// Database Name
	$dbname = 'banco_de_dados';
	// Database Username
	$dbuser = 'jgarcia_maxplus';
	// Database Password
	$dbpass = 'jdk25782578';


	if (php_sapi_name()=="cli"){
		echo php_sapi_name();
	}
	else{
		session_save_path($_SERVER['DOCUMENT_ROOT'] . '/sesiones');
	}
	//session_save_path($_SERVER['DOCUMENT_ROOT'] . '/sesiones');

}else{
	$dbhost = 'oscx.site';
	$dbname = 'oscxsite_banco_de_dados';
	$dbuser = 'oscxsite_gen';
	$dbpass = '_VQI9W!U!*6D';
}


define("DBHOST", $dbhost);	
define("DBNAME", $dbname);	
define("DBUSER", $dbuser);	
define("DBPASS", $dbpass);	
define("DB_ENCODE", 'utf8');

define("DECIMAL_POINT", ",");	
define("SEPARATOR", ".");	

if (!defined('BASE_URL')) {

	if (MODE_APP==0) {	
		define("BASE_URL", "http://localhost/test/");	
		define("BASE_URL2", "localhost/test");	
	}else{
		define("BASE_URL", "https://oscx.site/test/");		
		define("BASE_URL2", "oscx.site/test/");	
	}
}

if (!defined('ADMIN_URL')) {
	define("ADMIN_URL", BASE_URL . "app" . "/");
}
try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("SET NAMES ".DB_ENCODE);
	$pdo->exec("SET lc_time_names = 'pt_BR'");

	$i=1;
	$statement = $pdo->prepare("SELECT * FROM tbl_language ORDER BY lang_id");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
	foreach ($result as $row) {
	    define('LANG_VALUE_'.$i,$row['lang_value_es']);
	    $lang_name=str_replace(' ','_', strtoupper($row['lang_name']));
	    define($lang_name, $row['lang_value_es']);    
	    $i++;
	}


	if (!function_exists('EJECUTAR_CONSULTA')) {
		function EJECUTAR_CONSULTA($sql){ 
			global $pdo;
			$query=$pdo->query($sql);
			return $query;
		}

		function EJECUTAR_CONSULTA_SIMPLE_FILA($sql){
			global $pdo;
			$stmt=$pdo->prepare($sql);
	        $stmt->execute();
      		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}

		function EJECUTAR_CONSULTA_RETORNAR_ID($sql){
			global $pdo;
			$query=$pdo->query($sql);
			return $pdo->insert_id;
		}

		function LIMPIAR_CADENA($str){
			global $pdo;
			$str=mysqli_real_escape_string($pdo,trim($str));
			return htmlspecialchars($str);
		}

	}	
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}