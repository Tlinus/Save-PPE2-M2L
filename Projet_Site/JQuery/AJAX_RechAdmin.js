function recherche_admin(){
	var req=$("input[type='radio'][name=rec_adm]:checked").val();
	var opt=$("#text_rech").val();
	$.post(
		'scriptPHP/AJAX_Recherche_Admin.php',
		{
			req:req,opt:opt
		},
		function(data){
			var result = jQuery.parseJSON(data);
			var i=0;
			var j=0;
			var conteneur;
			var tcol;
			var trow;
			switch(req){
				case 'user':
					conteneur="<caption>Utilisateurs</caption><tr><td>ID</td><td>Pseudo</td></tr>"
				break;
				case 'forum':
					conteneur="<caption>Liste des Forums</caption><tr><td>ID</td><td>Titre</td></tr>"
				break;
				case 'sujet':
					conteneur="<caption>Sujets des Forums</caption><tr><td>ID</td><td>Titre</td></tr>"
				break;
				case 'message':
					conteneur="<caption>Messages postés</caption><tr><td>ID</td><td>Auteur</td><td>Sujet</td><td>Contenu</td></tr>"
				break;
				case 'produit':
					conteneur="<caption>Liste des produits de la boutique</caption><tr><td>ID</td><td>Designation</td></tr>"
				break;
				case 'tva':
					conteneur="<caption>Liste des TVA</caption><tr><td>ID</td><td>Valeur</td></tr>"
				break;
				case 'categorie':
					conteneur="<caption>Liste des catégories</caption><tr><td>ID</td><td>Label</td></tr>"
				break;
				case 'article':
					conteneur="<caption>Liste des articles</caption><tr><td>ID</td><td>titre</td><td>date</td></tr>"
				break;
			}
			$('rec_adm').html();
			if(result[i]){
				while(result[i]){
					j=0;
					tcol="";
					while(result[i][j]){
						tcol=tcol+"<td>"+result[i][j]+"</td>";
						j=j+1;
					}
					trow="<tr>"+tcol+"</tr>";
					conteneur=conteneur+trow;
					i=i+1;
					$('#resultat').html(conteneur);
				}
			}
			else{
				$('#resultat').html('Aucun résultat ne correspond à votre recherche');
			}
		}
		
	)
};