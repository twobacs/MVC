<?php
class MExemple extends MBase {
	private $checkDbPDO = false;
	public function __construct($appli) {
		parent::__construct($appli);
		
	}
	
public function login(){
	$login=$_POST['login'];
	$pass=md5($_POST['pass']);	
	$sql='SELECT id_user,password FROM users WHERE login=:login AND password=:pass';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->execute(array('login'=>$login,'pass'=>$pass));
	$count=$req->rowCount();
	if($count==1){
	while($row=$req->fetch()){
			$_SESSION['idUser']=$idUSer;
			return true;
		}
		else return false;
	}
	else{
		return false;
	}
}
}
?>