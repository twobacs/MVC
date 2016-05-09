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

function removeAcces(idRow){
	var ok=confirm('Etes-vous sur ?');
	if(ok){
		$.ajax({
			type:"GET",
			url:"js/php/removeAcces.php",
			data:{
				idRow:idRow,
			},
			success : function (retour){
				if(retour=='1'){
					location.reload();
					alert('Operation successfull :D');
				}
				else{
					alert('Une erreur s\'est produite');
				}
			},
		});
	}
}