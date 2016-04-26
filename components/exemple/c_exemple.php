<?php

class CExemple extends CBase {

    public function __construct($appli) {
        parent::__construct($appli);
    }

public function homepage(){
	$this->view->formConnect();
}

public function login(){
	if(!isset($_SESSION['idUser'])){
		$data=$this->model->login();
	}
	else {
		$nivUser=$this->model->getNivUser();
		$data=true;
	}
	$this->view->connected($data,$nivUser);
}

}
?>
