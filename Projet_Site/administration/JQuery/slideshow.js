
// Durée des diapos (en millisecondes)
var diapoDuration = 800000;

// Position actuelle du diaporama
var diapoPosition = 1;

// Identifiant d'intervale du diaporama
var diapoInterval;

// Mise en place au chargement
$(function() {
	// On récupère le bloc principal
	var blocDiapo = $('#diaporama');

	// On duplique le premier et le dernier élément pour permettre la rotation infinie
	var first = blocDiapo.children(':first');
	var firstNode = first.get(0).nodeName;
	var last = blocDiapo.children(':last');
	var lastNode = first.get(0).nodeName;
	blocDiapo.prepend('<'+lastNode+'>'+last.html()+'</'+lastNode+'>');
	blocDiapo.append('<'+firstNode+'>'+first.html()+'</'+firstNode+'>');
	
	// On positionne les diapos en ligne
	var width = blocDiapo.innerWidth();
	blocDiapo.children().each(function(i) {
		$(this).css('left', (i*width)+'px');
	});
	
	// Mise en position sur la première diapo
	blocDiapo.scrollLeft(width);
	
	// Démarrage
	diapoInterval = setTimeout('diaposScroll(1)', diapoDuration);
	
});

// Fonction de défilement du diaporama
function diaposScroll(value)
{
	//Index
	var TableIndex = [$('#bouton_defil1'),$('#bouton_defil2'),$('#bouton_defil3'),$('#bouton_defil4'),$('#bouton_defil5')];
	
	// On récupère le bloc principal
	var blocDiapo = $('#diaporama');	
	
	// Arrêt des effets en cours
	blocDiapo.stop(true,true);
	
	// Si un timeout est en cours, on l'arrête
	if (diapoInterval > 0)
	{
		clearTimeout(diapoInterval);
	}
	
	// Largeur du diaporama et nombre de diapos
	var width = blocDiapo.innerWidth();
	var nbChilds = blocDiapo.children().length-2;
	
	
	TableIndex[diapoPosition-1].attr('src','img/index_defil_off.png');
	// On met à jour la position
	diapoPosition += value;
	
	// Défilement suivant la valeur
	if (diapoPosition < 1)
	{
		// Saut à la fin
		diapoPosition += nbChilds;
		blocDiapo.scrollLeft((diapoPosition+1)*width);
	}
	else if (diapoPosition > nbChilds)
	{
		// Retour au début
		diapoPosition -= nbChilds;
		blocDiapo.scrollLeft((diapoPosition-1)*width);
	}
	
	TableIndex[diapoPosition-1].attr('src','img/index_defil_on.png');
	blocDiapo.animate({scrollLeft:(diapoPosition*width)}, 500);
	
	// On lance le timeout suivant
	diapoInterval = setTimeout('diaposScroll(1)', diapoDuration);
}