<?php
$titre = 'M2LLigue de Tennis';
	include 'includes/head.php';
	include 'includes/inscription_class.php';
	?>
<style>
*
{
	margin:0px;
	padding:0px;
}
html
{
	background:linear-gradient(#665776,white);
}

.tennis 
{
	margin:auto;
	width:1000px;
	float: right;
	margin-right: 18%;
}
footer
{
	text-align:center;
	line-height:40px;
	width:1000px;
}

header img
{
	float:left;
	width:600px;
	height:150px;
}
.cb
{
	clear:both;
}

#panneau_login
{
	float:left;
	width:200px;
}
#cat_element
{
	width:323px;
	height:200px;
	background:white;
	margin:5px;
	float:left;
	font-family:Helvetica;
	text-align:center;
}
#cat_element h1
{
	line-height:30px;
	font-size:20px;
	border:1px solid black;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
	color:white;
	text-align:center;
	font-family:Helvetica;
}
#cat_element img
{
	margin-top:6px;
	height:60px;
	width:180px;

}
#cat_element p
{
	padding:5px;
}
#cat_element a
{
	text-decoration:none;
	padding:5px;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
	color:white;
	border-radius:5px;
	margin-top:5px;
}
#cat_element a:hover
{
	background:#ababab;
}

#slider
{
	width:1000px;
	margin-top:10px;
	height:430px;
	background:white;
	overflow:hidden;
}
#slide_element
{
	position:relative;
	background:white;
	height:420px;
	width:970px;
	padding:15px;
	-moz-animation-name:Slider;
	-moz-animation-duration:40s;
	-moz-animation-iteration-count:infinite;
}
#slide_element a
{
	text-decoration:none;
	padding:5px;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
	color:white;
	border-radius:5px;
	margin-top:5px;
}
#slide_element h1
{
	text-align:center;
	color:#57565c;

}
#slide_element p
{
	float:left;
}
#slide_element img
{
	float:left;
	margin-right:15px;
	height:400px;
	width:600px;
}
#categorie
{
	margin-top:5px;
}

#scroll_menu
{
	position:absolute;
	color:#ffffff;
	background:linear-gradient(#2f2f2f,#505151);
	padding:15px;
	transform:translate(0px,-190px);
	opacity:0;
	transform:scale(1,0);
}
#scroll_menu a
{
	color:white;
	font-family:Helvetica;
	text-decoration:none;
}
#scroll_menu a:hover
{
	background:#db981b;
}
li:hover #scroll_menu
{
	opacity:1;
	transition: all 1s;
	transform: translate(0px,1px) scale(1);
}
@-moz-keyframes Slider
{
	0%{top:0px;}
	10%{top:0px;}
	15%{top:-450px;}
	30%{top:-450px;}
	35%{top:-900px;}
	50%{top:-900px;}
	55%{top:-450px;}
	70%{top:-450px;}
	75%{top:0px;}
	100%{top:0px;}
}
#contenu
{
	margin-top:10px;
	padding:15px;
	background:white;
	font-family:helvetica;
}
#contenu a
{
	text-decoration:none;
	padding:5px;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
	color:white;
	border-radius:5px;
	margin-top:5px;
}
#contenu h1
{
	color:#c32727;
}
#contenu h2
{
	text-align:center;
	color:#ee9125;
	line-height:40px;
	text-decoration:underline;
}
#contenu h3
{
	color:#7278b2;
	line-height:40px;
}
#contenu img
{
	height:300px;
	width:400px;
}

#description
{
	float:right;
	width:540px;
	padding:10px;
}
#defil
{
	margin-top:10px;
	font-weight: bold;
	overflow: hidden;
	color:white;
	font-family:Helvetica;
}
#infos_leg
{
	margin-top:10px;
	padding:15px;
	background:white;
	font-family:helvetica;
}
#infos_leg h1
{
	color:#c32727;
}
#infos_leg h2
{
	text-align:center;
	color:#ee9125;
	line-height:40px;
	text-decoration:underline;
}
#infos_leg h3
{
	color:blue;
	line-height:40px;
}
</style>
<div class="tennis">
		<section id="defil" class="cb">
			Derniers Résultats:	<marquee direction="left" scrollamount="2" >FC Lorraine 4-2 AC-Bretagne / Le Tennis club de Lorraine à remportée la coupe départementale! / Wimbledon: 5-7 6-4 5-7 Djokovitch remporte le Quart de finale de Wimbledon!</marquee>
		</section>
		<section id="slider">
			<div id="slide_element">
				<img src="img/RollandGaros.jpg"/>
				<p>
					<h1> Rolland Garros 2014</h1>
					La 84e édition des Internationaux de France restera dans les mémoires : 
					du neuvième titre remporté par l’Espagnol Rafael Nadal à Roland-Garros, 
					au deuxième sacre parisien de la Russe Maria Sharapova, en passant notamment
					par la joie et l’émotion de Julien Benneteau et Edouard Roger-Vasselin, vainqueurs 
					du double messieurs… Autant d’exploits sportifs qui ont marqué le tournoi cette 
					année. Ce document chiffré vous invite à revivre ces grands moments des Internationaux
					de France 2014, et vous propose d’en découvrir tous les à-côtés.
				</p>
				<br/>
				<br/>
				<a href="">Lire la suite</a>
				
			</div>
			<div id="slide_element">
				<img src="img/RogerFederer.jpg"/>
				<p>
					<h1> Roger Federer, sur les traces des légendes</h1>
					Roger lance sa saison 2015 à Brisbane, où il espère enlever le titre. 
					L’an dernier, il avait atteint la finale, battu en trois sets par Lleyton Hewitt. 
					"J'adorerais gagner ce tournoi. Je suis passé très proche l'année passée, après 
					avoir connu une bonne semaine. Il me plaît toujours de lever des trophées là où 
					je n'ai jamais pu le faire avant. Je suis gonflé à bloc pour cette semaine. C'est 
					un grand tournoi avec beaucoup de joueurs prometteurs, » a déclaré notre champion. 
					En cas de 83e titre ATP, il atteindrait les 1000 victoires sur le circuit. 
					Seuls deux joueurs ont franchi cette barre, Jimmy Connors (1253) et Ivan Lendl (1071).
				</p>
				<br/>
				<br/>
				<a href="">Lire la suite</a>
			</div>
			<div id="slide_element">
				<img src="img/couperegionale.jpg"/>
				<p>
					<h1> Félicitations au membres de la ligue de Tennis!</h1>
					Ce sont deux de nos chers membres de la Ligue de Tennis de Lorraine qui se sont affronté 
					en finale samedi dernier lors de la coupe départementale Junior.
					C'est après un long match de quatres heures que les deux champions en herbe se sont départagé 
					au terme d'un set épique 9-7!
					Nous étions bien évidemment présents pour les encourager, et nous avons receuilli pour vous leurs
					réactions à chaud.
				</p>
				<br/>
				<br/>
				<a href=""> Lire la suite</a>
			</div>
		</section>
		<div id="contenu" class="cb">
			<img src="img/classement_atp.png">
			<div id="description">
				<h2>Le classement ATP</h2>
				Le coup d’envoi de la saison a été donné ce dimanche. Après une année 2014 finalement assez hors norme, l’an 2015 va-t-il nous réserver de nouvelles surprises ? Dit autrement, le Big Four, enfin plutôt le Big Three en ce moment, va-t-il encore laisser échapper des titres majeurs. Et côté français ? C’est assez flou pour le moment. Venez découvrir les avis des passionés de la Ligues qui analysent et décryptent les performances et vous donnent leur pronostiques!
				<br/>
				<br/>
				<a href="">Lire la suite</a>
			</div>
		</div>
		<div id="contenu" class="cb">
			<img src="img/calendriertournois.jpg">
			<div id="description">
			<h2> Les tournois régionaux à venir</h2>
			Venez vous inscrire pour les prochains tournois avenirs, venez vous mesurer à tous les talents de la région et gagnez de nombreux lots!
			<br/>
			<br/>
			<a href=""> En savoir plus</a>
			</div>
			
		</div>
		<footer>
			©Maison des ligues de Lorraine 2014
		</footer>
		</div>
	</body>
</html>