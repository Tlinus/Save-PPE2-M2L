function changeCat(donnee){
	var req=donnee;
	$.post(
		"scriptPHP/AJAX_boutique_bdd.php",
		{
			req:req
		},
		function(data){
			$('#content').empty();
			if(data){
				var result = jQuery.parseJSON(data);
				var i=0;
				var conteneur;
				while(result[i]){
                    $('#content').html('<div id="produit" onclick="addArticle()">'+
						'<h1> Ajouter Produit</h1>'+
						'<img src="img/add.png"/>'+
					'</div>');
					conteneur=$('#content').html();
					var ctext=	
						'<div id="produit" >'+
						'<h1>'+result[i].designation+'</h1>'+
						'<img src="'+result[i].url_photo+'"/>'+
						'<div id="description">'+
							'<p>'+
								'Prix:'+result[i].prix_unitaire+'€<br/>'+
							'</p>'+
				            '<img style="width:30px;height:30px;cursor:pointer;" onclick="editArticle('+result[i].produit_id+')" src="img/edit.png" title="editer un article"/>'+
                            '<img style="width:30px;height:30px;cursor:pointer;" onclick="deleteArticle('+result[i].produit_id+')" src="img/delete.png" title="supprimer"/>'+
						'</div>'+
					'</div>';
					i=i+1;
					$('#content').html(conteneur+ctext);
				}	
			}
		}
	);
};