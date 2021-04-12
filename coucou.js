coucou = document.querySelector("#coucou"); // On récupère l'élément HTLM,
											// qui a pour id 'coucou'


// On crée la fonction qui va afficher un alerte sur le navigateur de l'utilisateur 
function coucouAlert(){
    window.alert("Coucou !!!")
}

// On crée la fonction qui va changer la couleur de fond
function coucouBackground(){
	colorMtn = document.querySelector("body").style["backgroundColor"]

	if (colorMtn=="red") {
		document.querySelector("body").style["backgroundColor"] = "black"
	}else {
		document.querySelector("body").style["backgroundColor"] = "red"
	}
}


//On dit au bouton, que quand on 'click' dessus en exectute la fonction 'coucouAlert'
// coucou.addEventListener("click", coucouBackground);


// // On sort et on rentre, on appelle coucouBackground
// coucou.addEventListener("mouseenter", coucouBackground);
// coucou.addEventListener("mouseleave", coucouBackground);


// PARAMETRE 

// On crée la fonction qui va changer la couleur de fond
function coucouBackgroundWithParam(ev){
	console.log(ev);
	colorMtn = document.querySelector("body").style["backgroundColor"]

	if (colorMtn=="red") {
		document.querySelector("body").style["backgroundColor"] = "black"
	}else {
		document.querySelector("body").style["backgroundColor"] = "red"
	}
}
// coucou.addEventListener("click", coucouBackgroundWithParam);


allDeleteButton = document.querySelectorAll(".delete_button") // tous les boutons delete
//lists 

function deleteMe(ev){
	target = ev.target 
	console.log("DELETE_ME")
	console.log(ev);
	console.log(target)
}

// for (var i = 0; i < allDeleteButton.length; i++) {
// 	elem=allDeleteButton[i]
// 	elem.addEventListener("click", deleteMe);
// }


//JQUERY $ ->  raccourci ver document.querySelectorAll !!! 
//		 -> pleins de raccourci


//$ ou jQuery 
//
 // tous les boutons delete
 // $(".delete_button")
 // le bouton avec l'id coucou
 // $("#coucou")
function coucouAlert2(){
    window.alert("Coucou !!!")
}

$("#coucou").on("click",coucouAlert2); 
// LA MEME CHOSE  
//document.querySelector("#coucou").addEventListener("click", coucouAlert);

//MAIS C FAUX !!  PCK jquery, il fait automatiquement les boucles 

$(".delete_button").on("click",deleteMe);
// LA MEME CHOSE 
//allDeleteButton = document.querySelectorAll(".delete_button")
// for (var i = 0; i < allDeleteButton.length; i++) {
// 	elem=allDeleteButton[i]
// 	elem.addEventListener("click", deleteMe);
// }



