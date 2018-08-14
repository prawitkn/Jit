<?php
$is_local = true;

$pdo = null;

if($is_local){
	$serverName="localhost";
	$uid="root";
	$pwd="";
	$db="jit";

    $dtPrefix='jit_';

	$pdo = new PDO('mysql:host='.$serverName.';dbname='.$db.';charset=utf8', $uid, $pwd, array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES => false
	));
}else{
	$serverName="localhost";
	$uid="root";
	$pwd="";
	$db="jit";

	$pdo = new PDO('mysql:host='.$serverName.';dbname='.$db.';charset=utf8', $uid, $pwd, array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES => false
	));
}
