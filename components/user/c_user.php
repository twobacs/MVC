<?php

class CUser extends CBase {

    public function __construct($appli) {
        parent::__construct($appli);
    }
public function modifUserById(){
	if(isset($_SESSION['idUser'])){
		$user=$this->model->getInfosUserById($_SESSION['idUser']);
		$communes=$this->model->getCommunes();
		$this->view->formInfosUser($user,$communes);
	}
}

public function updateUserById(){
	if(isset($_SESSION['idUser'])){
		$this->model->updateUserById();
		$this->modifUserById();
	}
}

public function formAddUser(){
	if(isset($_SESSION['idUser'])){
		$communes=$this->model->getCommunes();
		$this->view->formAddUser($communes);
	}
}

public function addNewUser(){
	if(isset($_SESSION['idUser'])){
		$communes=$this->model->getCommunes();
		$result=$this->model->addNewUser();
		$this->view->resultAddNewUser($result,$communes);
	}
}

public function modifPassById(){
	if(isset($_SESSION['idUser'])){
		if(isset($_POST['newPwd'])){
			if($this->model->modifPassById()){
				header('location: index.php?component=exemple&action=login&step=mdfp');
			}
			else $this->view->formModifPwd(1);
		}
		else{
			$this->view->formModifPwd();
		}
	}
}

public function formAttribDroitsdUsers(){
	if(isset($_SESSION['idUser'])){
		$users=$this->model->getUsers();
		$appli=$this->model->getApplis();
		$droits=$this->model->getDroits();
		$this->view->formAttribDroitsdUsers($users,$appli,$droits);
	}
}

public function listUsers(){
	if(isset($_SESSION['idUser'])){
		$data=$this->model->getUsers();
		$this->view->listUsers($data);
	}
}

}
?>
