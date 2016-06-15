<?php
 session_name('data');
 session_start();
//set timezone
date_default_timezone_set('America/Argentina/Buenos_Aires');
//database credentials
define('DBHOST','127.0.0.1');
define('DBUSER','root');
define('DBPASS','1234');
define('DBNAME','wordpress');
//application address
//define('DIR','http://domain.com/');
//define('SITEEMAIL','noreply@domain.com');
try {
	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}
//include the user class, pass in the database connection
include('user.php');
include('mail.php');
$user = new User($db);
?>
Status API Training Shop Blog About
© 2016 GitHub, Inc. Terms Privacy 
