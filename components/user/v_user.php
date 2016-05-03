<?php

class VUser extends VBase {

    function __construct($appli, $model) {
        parent::__construct($appli, $model);
    }
	
public function formInfosUser($user,$communes){
	$html='<h3>Mes informations</h3>';
	while($row=$user->fetch()){
		$html.='
		<form role="form" method="POST" action="?component=user&action=updateUserById" style="margin-left:5px;">
			<div class="form-group">
				<label class="sr-only" for="nom">Nom :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">Nom :</div>
					<input type="text" class="form-control" id="nom" name="nom" placeHolder="Nom" value="'.$row['nom'].'">
				</div>
			</div>
			<div class="form-group">
				<label class="sr-only" for="nom">Pr&eacute;nom :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">Pr&eacute;nom :</div>
					<input type="text" class="form-control" id="prenom" name="prenom" placeHolder="Pr&eacute;nom" value="'.$row['prenom'].'">
				</div>
			</div>
			<div class="form-group">
				<label class="sr-only" for="nom">T&eacute;l&eacute;phone :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">T&eacute;l&eacute;phone :</div>
					<input type="text" class="form-control" id="telephone" name="telephone" placeHolder="T&eacute;l&eacute;phone" value="'.$row['telephone'].'">
				</div>
			</div>
			<div class="form-group">
				<label class="sr-only" for="nom">Mail :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">Mail :</div>
					<input type="mail" class="form-control" id="mail" name="mail" placeHolder="Mail" value="'.$row['mail'].'">
				</div>
			</div>
			<div class="form-group">
				<label class="sr-only" for="nom">Login :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">Login :</div>
					<input type="text" class="form-control" id="login" name="login" placeHolder="Login" value="'.$row['login'].'">
				</div>
			</div>
			<div class="form-group">
				<label class="sr-only" for="nom">Adresse :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">Adresse :</div>
					<input type="text" class="form-control" id="adresse" name="adresse" placeHolder="Adresse" value="'.$row['adresse'].'">
				</div>
			</div>
			<div class="form-group">
				<label class="sr-only" for="nom">Commune :</label>
				<div class="input-group">
					<div class="input-group-addon" style="width:175px;">Commune :</div>
					<select style="width:195px;" class="form-control" id="commune" name="commune"><option disabled>Veuillez choisir</option>';
					while($rowb=$communes->fetch()){
						$html.='<option value="'.$rowb['id_commune'].'"';
						if($row['id_commune']==$rowb['id_commune']){
							$html.=' selected';
						}
						// $html.=($row['id_commune']==$rowb['id_commune']) ? ' selected' : '';
						$html.='>'.$rowb['nom'].' ('.$rowb['CP'].')</option>';
					}
					$html.='
					</select>
				</div>
			</div>
			<button type="submit" style="width:370px;"class="btn btn-primary">Enregistrer les modifications</button><br />
			<a href="?component=exemple&action=login" role="button" style="width:370px;margin-top:15px;" class="btn btn-primary">Retour</a><br />
		</form>';
	}
	$this->appli->content=$html;
}

public function formAddUser($communes){
	$html='<h3>Ajout d\'un utilisateur</h3>';
	$html.='
	<form role="form" method="POST" action="?component=user&action=addNewUser" style="margin-left:5px;">
				<div class="form-group">
					<label class="sr-only" for="nom">Nom :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">Nom :</div>
						<input type="text" class="form-control" id="nom" name="nom" placeHolder="Nom" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="prenom">Pr&eacute;nom :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">Pr&eacute;nom :</div>
						<input type="text" class="form-control" id="prenom" name="prenom" placeHolder="Pr&eacute;nom">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="telephone">T&eacute;l&eacute;phone :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">T&eacute;l&eacute;phone :</div>
						<input type="text" class="form-control" id="telephone" name="telephone" placeHolder="T&eacute;l&eacute;phone">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="mail">Mail :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">Mail :</div>
						<input type="mail" class="form-control" id="mail" name="mail" placeHolder="Mail">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="login">Login :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">Login :</div>
						<input type="text" class="form-control" id="login" name="login" placeHolder="Login">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="nom">adresse :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">Adresse :</div>
						<input type="text" class="form-control" id="adresse" name="adresse" placeHolder="Adresse">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="commune">Commune :</label>
					<div class="input-group">
						<div class="input-group-addon" style="width:175px;">Commune :</div>
						<select style="width:195px;" class="form-control" id="commune" name="commune" required><option disabled selected>Veuillez choisir</option>';
						while($row=$communes->fetch()){
							$html.='<option value="'.$row['id_commune'].'">'.$row['nom'].' ('.$row['CP'].')</option>';
						}
						$html.='
						</select>
					</div>
				</div>
				<button type="submit" style="width:370px;" class="btn btn-primary">Ajouter l\'utilisateur</button><br />
				<a href="?component=exemple&action=login" role="button" style="width:370px;margin-top:15px;" class="btn btn-primary">Retour</a><br />
			</form>';	
	$this->appli->content=$html;
	return $html;
}

public function resultAddNewUser($result,$communes){
	$html=$this->formAddUser($communes);
	$html.=($result==1) ? '<button type="button" style="width:370px;margin-top:15px;margin-left:5px;"class="btn btn-primary btn-lg active">Enregistrement r&eacute;ussi</button>' : '&Eacute;chec de l\ennregsitrement';
	$this->appli->content=$html;
	
}

public function formModifPwd($error=0){
	$html='<h3 style="margin-left:15px;">Modification de mon mot de passe</h3>';
	$html.='
	<form class="form-horizontal" method="POST" action="?component=user&action=modifPassById" style="margin-left:15px;">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Ancien mot de passe</div>
				<input type="password" class="form-control" name="old" id="old" placeHolder="Ancien mot de passe" autofocus onkeyup="verifOldPwd(\''.$_SESSION['idUser'].'\');" required>
			</div>
			<div class="input-group">
				<div class="input-group-addon">Nouveau mot de passe</div>
				<input type="password" class="form-control" name="newPwd" id="newPwd" placeHolder="Nouveau mot de passe" style="display:none;" required>
			</div>
			<div class="input-group">
				<div class="input-group-addon">Nouveau mot de passe</div>
				<input type="password" class="form-control" name="newPwd1" id="newPwd1" placeHolder="Nouveau mot de passe (confirmation)" onkeyup="verifPwd(\''.$_SESSION['idUser'].'\');" style="display:none;" required>
			</div>		
			<div class="input-group">
				<button type="submit" class="btn btn-default" style="display:none;" id="bEnregistrer">Enregistrer</button>
			</div>
		</div>
	</form>
	<a class="btn btn-default" href="?component=exemple&action=login" style="margin-left:15px;">Retour</a><br />
	';
	if($error==1){
		$html.='<h6>Une erreur s\'est produite, veuillez faire un autre essai.</h6>';
	}
	$this->appli->content=$html;
}

public function formAttribDroitsdUsers($users,$appli,$droits){
	// var_dump($droits);
	$i=0;
	$html='<h3 style="margin-left:15px;">Attribution des droits</h3>';
	while($row=$appli->fetch()){
		$html.='<h4>Application '.ucfirst($row['denomination']).'</h4>';
		$html.='<form method="POST" action="?component=user&action=droits&idModule='.$row['id_module'].'">';
		$html.='<table border="1" style="margin-left:15px;">';
		foreach ($users as $key => $rowU){
			$html.='<tr><th>'.$rowU['nom'].' '.$rowU['prenom'].'</th></tr>';
		}
		$html.='</table>';
		$html.='</form><hr>';
	}
	$html.='<a class="btn btn-default" href="?component=exemple&action=login" style="margin-left:15px;">Retour</a><br />';
	$this->appli->content=$html;
}

public function selectAppli($applis){
	$html='<h3>Veuillez s&eacute;lectionner une application</h3>';
	while($row=$applis->fetch()){
		$html.='<a href="?component=exemple&action=attribDroitsdUsers&appli='.$row['id_module'].'" style="margin-left:15px;margin-top:10px;"><button type="button" class="btn btn-primary">'.$row['denomination'].'</button></a><br />';
	}
	$html.='<a class="btn btn-default" href="?component=exemple&action=login" style="margin-left:15px;margin-top:10px;">Retour</a><br />';
	$this->appli->content=$html;
}

public function listUsers($data){
	$html='<h3>Liste des utilisateurs inscrits</h3>';
	foreach($data as $key => $row){
		$html.=$row['nom'].' '.$row['prenom'].'<br />';
	}
	$html.='<a class="btn btn-default" href="?component=exemple&action=login" style="margin-left:15px;padding-top:10px;">Retour</a><br />';
	$this->appli->content=$html;
}
}
?>
