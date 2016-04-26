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
			$_SESSION['idUser']=$row['id_user'];
			$this->getNivUser();
			return true;
		}
	}
	else return false;
	}

public function getNivUser(){
	$sql='SELECT a.id_type,
	b.denomination AS denomApp
	FROM user_type a
	LEFT JOIN module b ON b.id_module = a.id_module
	LEFT JOIN type c ON c.id_type = a.id_type
	WHERE a.id_user = :idUser';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->bindValue('idUser',$_SESSION['idUser'],PDO::PARAM_INT);
	$req->execute();
	foreach($req as $key => $row){
		$_SESSION[$row['denomApp']]=$row['id_type'];;
	}
	
}

}
?>