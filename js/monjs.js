function verifPwd( id ){
	
	var mdp1 = document.getElementById('newPwd').value;
	var mdp2 = document.getElementById('newPwd1').value;
	if(mdp1==mdp2){
		document.getElementById("bEnregistrer").style.display ="block";
	}
	else{
		document.getElementById("bEnregistrer").style.display ="none";
	}
}

function verifOldPwd( id ){
	var oldPwd=document.getElementById('old').value;
	$.ajax({
		type:"GET",
		url:"js/php/verifOldPwd.php",
		data:{
			idUser:id,
			old:oldPwd,
		},
		success : function(retour){
			if(retour==1){
				document.getElementById("newPwd").style.display ="block";
				document.getElementById("newPwd1").style.display ="block";
			}
			else{
				document.getElementById("newPwd").style.display ="none";
				document.getElementById("newPwd1").style.display ="none";
			}
			
		},
	});
}