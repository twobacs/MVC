<?php

if(isset($_GET['idRow'])){
	include('autoload.php');
	$sql='DELETE FROM user_type WHERE id=:idR';
	$req=$pdo->prepare($sql);
	$req->bindValue('idR',$_GET['idRow'],PDO::PARAM_INT);
	$req->execute();
	$count=$req->rowCount();
	echo $count;
}

?>