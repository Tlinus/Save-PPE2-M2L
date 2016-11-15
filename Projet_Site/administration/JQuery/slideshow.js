
// Dur�e des diapos (en millisecondes)
var diapoDuration = 800000;

// Position actuelle du diaporama
var diapoPosition = 1;

// Identifiant d'intervale du diaporama
var diapoInterval;

// Mise en place au chargement
$(function() {
	// On r�cup�re le bloc principal
	var blocDiapo = $('#diaporama');

	// On duplique le premier et le dernier �l�ment pour permettre la rotation infinie
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
	
	// Mise en position sur la premi�re diapo
	blocDiapo.scrollLeft(width);
	
	// D�marrage
	diapoInterval = setTimeout('diaposScroll(1)', diapoDuration);
	
});

// Fonction de d�filement du diaporama
function diaposScroll(value)
{
	//Index
	var TableIndex = [$('#bouton_defil1'),$('#bouton_defil2'),$('#bouton_defil3'),$('#bouton_defil4'),$('#bouton_defil5')];
	
	// On r�cup�re le bloc principal
	var blocDiapo = $('#diaporama');	
	
	// Arr�t des effets en cours
	blocDiapo.stop(true,true);
	
	// Si un timeout est en cours, on l'arr�te
	if (diapoInterval > 0)
	{
		clearTimeout(diapoInterval);
	}
	
	// Largeur du diaporama et nombre de diapos
	var width = blocDiapo.innerWidth();
	var nbChilds = blocDiapo.children().length-2;
	
	
	TableIndex[diapoPosition-1].attr('src','img/index_defil_off.png');
	// On met � jour la position
	diapoPosition += value;
	
	// D�filement suivant la valeur
	if (diapoPosition < 1)
	{
		// Saut � la fin
		diapoPosition += nbChilds;
		blocDiapo.scrollLeft((diapoPosition+1)*width);
	}
	else if (diapoPosition > nbChilds)
	{
		// Retour au d�but
		diapoPosition -= nbChilds;
		blocDiapo.scrollLeft((diapoPosition-1)*width);
	}
	
	TableIndex[diapoPosition-1].attr('src','img/index_defil_on.png');
	blocDiapo.animate({scrollLeft:(diapoPosition*width)}, 500);
	
	// On lance le timeout suivant
	diapoInterval = setTimeout('diaposScroll(1)', diapoDuration);
}