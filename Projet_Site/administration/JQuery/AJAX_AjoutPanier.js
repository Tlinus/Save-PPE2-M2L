function ajoutPanier(result){
	var produit=result;
	var quantite= $('#quantite').val();
	$.post(
		"scriptPHP/AJAX_boutique_ajoutPanier.php",
		{
			produit:produit,quantite:quantite
		},
		function(data){
			var result=jQuery.parseJSON(data);
			if(result.data=='noQuantite'){
				alert('Veuillez entrer un chiffre entre 1 et 100');
			}
			else if (result.data=='registeredOnBDD'){
				alert('Votre commande a bien été enregistrée!');
				$('#preview_screen').css({"display":"none"});
				$('#preview').css({"display":"none"});
				actualiserPanier();
			}
			else if(result.data=='registeredOnCookie'){
				alert('Votre commande a bien été enregistrée. Pensez à vous enregistrer pour valider votre panier.');
				$('#preview_screen').css({"display":"none"});
				$('#preview').css({"display":"none"});
				actualiserPanier();
			}
			else{
				alert(data);
			}
		}
	);
};
function actualiserPanier(){
	location.reload();
};