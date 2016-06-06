<?php

class MUser extends MBase {

	private $checkDbPDO = false;

	public function __construct($appli) {
		parent::__construct($appli);
		
	}

public function getInfosUserById($id){
	$sql='SELECT matricule, nom, prenom, telephone, mail, login, adresse, id_commune FROM users
	WHERE id_user=:id';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	// echo $id;
	return $req;
	
	}
	
public function getCommunes(){
	$sql='SELECT id_commune, nom, CP FROM commune ORDER BY nom';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->execute();
	// echo $sql;
	return $req;
}
	
public function updateUserById(){
	$sql='UPDATE users SET nom=:nom, prenom=:prenom, id_commune=:idCom, telephone=:tel, mail=:mail, login=:log, adresse=:adresse WHERE id_user=:iduser';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->bindValue('nom',$_POST['nom'],PDO::PARAM_STR);
	$req->bindValue('prenom',$_POST['prenom'],PDO::PARAM_STR);
	$req->bindValue('idCom',$_POST['commune'],PDO::PARAM_INT);
	$req->bindValue('tel',$_POST['telephone'],PDO::PARAM_STR);
	$req->bindValue('mail',$_POST['mail'],PDO::PARAM_STR);
	$req->bindValue('log',$_POST['login'],PDO::PARAM_STR);
	$req->bindValue('adresse',$_POST['adresse'],PDO::PARAM_STR);
	$req->bindValue('iduser',$_SESSION['idUser'],PDO::PARAM_STR);
	$req->execute();
	return $req->rowCount();
}

public function addNewUser(){
	$sql='INSERT INTO users (nom, prenom, id_commune, telephone, mail, login, password, adresse) VALUES (:nom, :prenom, :commune, :telephone, :mail, :log, :password, :adresse)';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->bindValue('nom',$_POST['nom'],PDO::PARAM_STR);
	$req->bindValue('prenom',$_POST['prenom'],PDO::PARAM_STR);
	$req->bindValue('commune',$_POST['commune'],PDO::PARAM_INT);
	$req->bindValue('telephone',$_POST['telephone'],PDO::PARAM_STR);
	$req->bindValue('mail',$_POST['mail'],PDO::PARAM_STR);
	$req->bindValue('log',$_POST['login'],PDO::PARAM_STR);
	$req->bindValue('adresse',$_POST['adresse'],PDO::PARAM_STR);
	$req->bindValue('password',md5('azerty'),PDO::PARAM_STR);	
	$req->execute();
	return $req->rowCount();
}

public function modifPassById(){
	$old=$_POST['oldPwd'];
	$new=$_POST['newPwd'];
	$new1=$_POST['newPwd1'];
	if($new!=$new1){
		return false;
	}
	else{
		$user=$_SESSION['idUser'];
		$pass=md5($old);	
		$sql='SELECT id_user,password FROM users WHERE id_user=:user AND password=:pass';
		$req=$this->appli->dbPdo->prepare($sql);
		$req->execute(array('user'=>$user,'pass'=>$pass));
		$count=$req->rowCount();
		if($count==1){
			$sql='UPDATE users SET password=:pass WHERE id_user=:user';
			$req=$this->appli->dbPdo->prepare($sql);
			$req->execute(array('user'=>$user,'pass'=>md5($new)));
			$count=$req->rowCount();
			if($count==1){
				return true;
			}
		}
		else return false;
	}
}


public function getUsers(){
	$sql='SELECT id_user, nom, prenom FROM users';
	$req=$this->appli->dbPdo->query($sql)->fetchAll();
	return $req;
}

public function getDroits(){
	$sql='SELECT id_type, denomination FROM type';
	$req=$this->appli->dbPdo->query($sql);
	return $req;
}

public function getApplis(){
	$sql='SELECT id_module, denomination FROM module';
	$req=$this->appli->dbPdo->query($sql);
	return $req;
}

public function getDroitsByApp(){
	$sql='SELECT a.id_user, a.id_type,a.id,
	b.nom, b.prenom, b.id_user,
	c.denomination AS denomType,
	d.denomination AS denomMod
	FROM user_type a
	LEFT JOIN users b ON b.id_user=a.id_user
	LEFT JOIN type c ON c.id_type=a.id_type
	LEFT JOIN module d ON d.id_module=a.id_module
	WHERE a.id_module=:idMod';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->bindValue('idMod',$_GET['appli'],PDO::PARAM_INT);
	$req->execute();
	return $req;
}

public function getTypeUsers(){
	$sql='SELECT id_type, denomination FROM type';
	$req=$this->appli->dbPdo->query($sql);
	return $req;
}

public function getDenomAppli(){
	$sql='SELECT denomination FROM module WHERE id_module = "'.$_GET['appli'].'"';
	// echo $sql;
	$req=$this->appli->dbPdo->query($sql);
	return $req;	
}

public function recDroitsdUsers(){
	$sql='INSERT INTO user_type (id_user, id_type, id_module) VALUES (:user,:type,:module)';
	$req=$this->appli->dbPdo->prepare($sql);
	$req->bindValue('user',$_GET['user'],PDO::PARAM_INT);
	$req->bindValue('type',$_GET['niv'],PDO::PARAM_INT);
	$req->bindValue('module',$_GET['appli'],PDO::PARAM_INT);
	$req->execute();
}
}
?>
