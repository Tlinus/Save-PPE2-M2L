function convertPanier(){
	$.post(
		'scriptPHP/AJAX_boutique_convertPanier.php',
		{
			
		},
		function(data){			
			actualiserPanier();
		}
		
	)
};