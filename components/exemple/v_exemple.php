<?php
class VExemple extends VBase {
    function __construct($appli, $model) {
        parent::__construct($appli, $model);
    }
	
	
public function formConnect(){
	$html='';
	$html.='<form method="POST"  action="?component=exemple&action=login">';
	$html.='<table>';
	$html.='<tr><td><input type="text" id="login" name="login" placeHolder="Identifiant" required autofocus></td></tr>';
	$html.='<tr><td><input type="password" id="pass" name="pass" placeHolder="Mot de passe" required></td></tr>';
	$html.='<tr><td><input type="submit" value="Connecter"></td></tr>';
	$html.='</table>';
	$html.='</form>';
	
	$this->appli->content=$html;
}
public function connected($data){
	if($data){
		$html='Vous &ecirc;tes identifi&eacute;.<br />';
		$html.='<a href="?component=user&action=modifUserById">Modifier mes donn&eacute;es</a>';
		
	}	
	else{
		$html='Login et / ou mot de passe &eacute;rron&eacute;<br /><a href="?component=exemple&action=homepage">Retour</a>';
	}
	$this->appli->content=$html;
}
}
?>