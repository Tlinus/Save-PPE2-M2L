function preview(donnee){   
	$.post(
		"scriptPHP/AJAX_boutique_preview.php",
		{
			donnee:donnee
		},
		function(data){
			var result=jQuery.parseJSON(data);
			$('#preview_screen').css({"display":"block"});
			$('#preview').css({
				"display":"block",
				"animation":"preview",
				"animation-duration":"1.5s"
			});
			$('#preview').html(
				"<article id=\"contenu_preview\">"+
					"<a href=\"javascript:fermerPreview()\">FERMER</a>"+
					"<h1>"+result.designation+ "</h1>"+
					"<img src=\""+result.url+"\"/>"+
					"<div id=\"description\">"+
						"<p>"+
							"<b>Prix:</b> "+result.prix_unitaire+"€<br/>"+
							"<b>Description:</b><p>"+result.description+"</p><br/>"+
					
					"<p>Quantité:<input type=\"text\" name=\"quantite\" id=\"quantite\" placeholder=\"Ex:4\"/><br/>"+ 
					"<a href=\"javascript:ajoutPanier("+result.produit_id+")\"><input type=\"button\" id=\"ajout_panier\" value=\"Ajouter au panier\"/></a></p>"+ 
					"</p>"+
					"</div>"+
				"</article>"
			);
		}
	)
};

function fermerPreview(){
	$('#preview_screen').css({"display":"none"});
	$('#preview').css({
		"display":"none"
	});
	$('#preview').removeAttr("animation");
};

