<?php

if(isset($_GET['idUser'])){
	$old=$_GET['old'];
	include('autoload.php');
	$sql='SELECT password FROM users WHERE id_user="'.$_GET['idUser'].'" AND password="'.md5($old).'"';
	$req=$pdo->prepare($sql);
	$req->execute();
	$count=$req->rowCount();
	echo $count;
}

?>