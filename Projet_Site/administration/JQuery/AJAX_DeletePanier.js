

function deleteProduitBDD(produit){
	$.post(
		'scriptPHP/AJAX_boutique_DeleteProduitBDD.php',
		{
			produit:produit
		},
		function(data){
			actualiserPanier();
		}
		
	)
};
function deleteProduitCookie(produit){
	$.post(
		'scriptPHP/AJAX_boutique_DeleteProduitCookie.php',
		{
			produit:produit
		},
		function(data){
			actualiserPanier();
			
		}
		
	)
};
function deletePanierBDD(){
	$.post(
		'scriptPHP/AJAX_boutique_deletePanierBDD.php',
		{
		},
		function(data){
			actualiserPanier();
		}
		
	)
};
function deletePanierCookie(){
	$.post(
		'scriptPHP/AJAX_boutique_DeletePanierCookie.php',
		{
		},
		function(data){
			actualiserPanier();
		}
		
	)
};