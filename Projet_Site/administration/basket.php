<?php
$titre = 'Ligue de basket';
	include 'includes/head.php';
	include 'includes/inscription_class.php';
	?>
	<section id="content">
		<style> 
		.cb
{
	clear:both;
}
#content{
	padding-top: 50px;
}

#menu
{	
	position:relative;
	z-index:5;
	border:1px black solid;
	margin-top:20px;
	background:linear-gradient(#2f2f2f,#505151);
	color:white;
	font-family:Helvetica;
}

#menu ul
{
	text-align:center;
}
.long
{
width: 210px}
.short
{
width: 150px;}
#menu ul li
{
	list-style-type:none;
	display:inline-block;
	font-size:20px;
	line-height:40px;
	
}

#menu a
{
	color:white;
	font-family:Helvetica;
	text-decoration:none;
}
#panneau_login
{
	float:left;
	width:200px;
}
.cat_element
{
	width:323px;
	height:200px;
	background:white;
	margin:5px;
	float:left;
	font-family:Helvetica;
	text-align:center;
}
.cat_element h1
{
	line-height:30px;
	font-size:20px;
	border:1px solid black;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
	color:white;
	text-align:center;
	font-family:Helvetica;
}
.cat_element img
{
	margin-top:6px;
	height:110px;
	width:180px;

}
.cat_element p
{
	padding:5px;
}
.cat_element a
{
	text-decoration:none;
	padding:5px;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
	color:white;
	border-radius:5px;
	margin-top:5px;
}
.cat_element a:hover
{
	background:#ababab;
}
#calendrier table
{
margin: 20px;}
.mois{
display: inline-block;
margin-left: 30px;}
.image_slider{
max-width: 900px;
margin: 0px;}
#calendrier td{
min-height: 35px;
min-width: 30px;
text-align: center;
color: white;
	background:linear-gradient(#2f2f2f,#505151,#2f2f2f);
}
#slider
{
	width:1000px;
	margin-top:10px;
	height:430px;
	background:white;
	overflow:hidden;
}
.image_slider2{
margin-top: 50px;
max-width: 900px;}
#results
{
	width:1000px;
	padding-top: 50px;
	margin-top:10px;
	height:1100px;
	background:white;
	overflow:hidden;
	padding-bottom: 50px;
}
#results h1
{
	font-size:2em;
	text-align:center;
	color:#57565c;
	padding-bottom: 20px;
	text-decoration: underline;
	}
#boutique{
margin-top: 75px;}
#boutique h1
{
	font-size:2em;
	text-align:center;
	color:#57565c;
	padding-bottom: 20px;
	text-decoration: underline;
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


@-moz-keyframes Slider
{
	0%{top:0px;}
	10%{top:0px;}
	20%{top:-450px;}
	30%{top:-450px;}
	40%{top:-900px;}
	50%{top:-900px;}
	60%{top:-450px;}
	70%{top:-450px;}
	80%{top:0px;}
	100%{top:0px;}
}
</style>
				<div id="calendrier">
				
					<table>
					<tr > <td class="mois"><h1> mai 2015</h1>
					<table>
						<tr>
						<td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td><td>D</td>
						</tr>
						<tr>
						<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
						</tr>
						<tr>
						<td>8</td><td>9</td><td><input type="button" value="10" onclick="alert('Rencontre Nime/SLUC Nancy au complexe Coubertin.')"></td><td>11</td><td>12</td><td>13</td><td>14</td>
						<tr>
						<td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td>
						<tr>
						<td>22</td><td>23</td><td>24</td><td><input type="button" value="25" onclick="alert('rencontre strasbourg/paris')"></td><td>26</td><td>27</td><td><input type="button" value="28" onclick="alert('Rencontre maiziers les metzs/SLUC Nancy au complexe de Boulange.')"</td>
						<tr id="1">
						<td>29</td><td>30</td><td>31</td><td></td><td></td><td></td><td></td>
						</tr>
						</table> 
					</td>
					<td class="mois">
									<h1> juin 2015</h1>
						<table>
						<tr>
						<td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td><td>D</td>
						</tr>
						<tr>
						<td>1</td><td>2</td><td>3</td><td><input type="button" value="4" onclick="alert('Rencontre Maiziers les Metzs/Nantere au complexe Jules Mazillot.')"</td><td>5</td><td>6</td><td>7</td>
						</tr>
						<tr>
						<td>8</td><td>9</td><td>10</td><td>11</td><td><input type="button" value="12" onclick="alert('Rencontre Avignon club/SLUC Nancy au complexe Coubertin.')"></td><td>13</td><td>14</td>
						<tr>
						<td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td>
						<tr>
						<td>22</td><td>23</td><td>24</td><td><input type="button" value="25" onclick="alert('Rencontre maiziers les metzs/Sarrebourg au complexe de Boulange.')"</td><td>26</td><td>27</td><td>28</td>
						<tr>
						<td>29</td><td></td><td></td><td></td><td></td><td></td><td></td>
						</table> 
					</td>
					<td class="mois">
						<h1> juillet 2015</h1>
						<table>
						<tr>
						<td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td><td>D</td>
						</tr>
						<tr>
						<td>1</td><td>2</td><td><input type="button" value="3" onclick="alert('Rencontre Maiziers les Metzs/Nantere au complexe Jules Mazillot.')"</td><td>4</td><td>5</td><td>6</td><td>7</td>
						</tr>
						<tr>
						<td><input type="button" value="8" onclick="alert('Rencontre Avignon club/SLUC Nancy au complexe Coubertin.')"></td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td>
						<tr>
						<td>15</td><td><input type="button" value="16" onclick="alert('Rencontre maiziers les metzs/Sarrebourg au complexe de Boulange.')"</td></td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td>
						<tr>
						<td>22</td><td>23</td><td>24</td><td><input type="button" value="25" onclick="alert('Rencontre maiziers les metzs/Sarrebourg au complexe de Boulange.')"</td><td>26</td><td>27</td><td>28</td>
						<tr>
						<td>29</td><td>30</td><td></td><td></td><td></td><td></td><td></td>
						</table> 
					</td>
					</tr>
					</table>
					</div>
					
			<nav id="menu" class="cb">
				<ul>
					<li class="short"><a href="#menu_top">Haut de page</a></li>
					<li class="short"><a href="#calendrier">Calendrier</a></li>
					<li class="short"><a href="#slider">Actualités</a></li>
					<li class="long"><a href="#results">Resultat de la coupe</a></li>
					<li class="long"><a href="#boutique">Boutique de la ligue</a></li>
				</ul>
			</nav>
					
				<div id="slider">
			<div id="slide_element">
				<img src="img/basket3.jpg"/>
				<p>
					<h1> ILS SONT DE RETOUR !</h1>
Suite à quelques jours de repos bien mérités, les joueurs du SLUC Nancy Basket sont revenus à l’entrainement ce dimanche 04 janvier 2015 avec leur nouveau meneur : Keydren Clark.
Le meneur US, qui évoluait depuis le début de saison à la JSF Nanterre en tant que remplaçant de TJ Campbell, remplace donc Darius Adams, parti à Vitoria (Espagne).
Kee-Kee, comme on le surnomme, représente 12,4 pts; 2,4 pds pour 11,4 d’évaluation cette saison en Pro A.
Le 17 octobre dernier, lors du match opposant le SLUC Nancy à la JSF Nanterre, il s’était offert un match de haute qualité : 20 pts à 6/7 à 3pts, 4 pas pour 21 d’évaluation !
Après un périple parisien couronné de deux succès contre le Paris-Levallois et le SPO Rouen,
 les Couguars sont de retour dans leur antre du PDS Jean Weille afin de préparer leur prochaine échéance, qui ne sera pas plus tard que mardi contre Valence,
 pour ce qui sera le premier match du Last 32 de l’Eurocup pour la bande à Florent Pietrus.
				</p>
			</div>
			<div id="slide_element">
				<img src="img/basket2.jpg"/>
				<p>
					<h1> Bienvenue sur le site de la Maison des Ligues de Lorraine!</h1>
La Finale ayant eu lieu le samedi 01 Janvier dans la salle Laloubère, et opposant l'équipe de Haut-Mauco/Basket Alsace à celle de BLAC.
Les BLAC ont réalisé une très belle perf en finissant 1èr du championnat, bien qu'étant benjamins première année!!
Remerciements à toutes les finalistes pour ce joli match, aux supporters du Basket Metz AC Club pour leur fair-play..
				</p>
			</div>
			<div id="slide_element">
				<img src="img/basket1.jpg"/>
				<p>
					<h1>Entre deux matchs</h1>
					Jusqu’en décembre, les mardi ou mercredi soir vont donc occuper les Couguars et leurs fans à temps plein !

Entre deux matches de championnat, les hommes d’Alain Weisz n’auront pas le temps de beaucoup se reposer et replongeront rapidement dans cette Eurocup qui a vu la victoire de Valence l’an dernier. Dans l’histoire de l’Eurocup (anciennement ULEB Cup), les formations ibériques et russes ont été les meilleures (8 titres à elles seules). Bon signe pour Séville (ou pour Saragosse, Las Palmas, le Zenit St-Pétersbourg, Khimki, le Lokomotiv Kouban qui disputent aussi l’Eurocup cette année) ? On le saura dans quelques mois (la finale se disputera en match aller-retour les 24 et 29 avril 2015).

En attendant, les Couguars joueront tous leurs matches à fond ! Tous les joueurs seront sollicités et tous devront apporter leur pierre à l’édifice. Les spectateurs de Gentilly devront aussi jouer leur rôle de 6e homme. A Charleroi, Oldenburg ou Nymburk, ça pousse fort !
Go SLUC !
				</p>
			</div>
		</div>
		
					<nav id="menu" class="cb">
				<ul>
					<li class="short"><a href="#menu_top">Haut de page</a></li>
					<li class="short"><a href="#calendrier">Calendrier</a></li>
					<li class="short"><a href="#slider">Actualités</a></li>
					<li class="long"><a href="#results">Resultat de la coupe</a></li>
					<li class="long"><a href="#boutique">Boutique de la ligue</a></li>
				</ul>
			</nav>
			
		<div id="results">
			<h1> Derniers resultats <h1>
			<img src="img/FINALES FEMININES.jpg" alt="Resultat coupe de moselle" class="image_slider" />		
			
			<img src="img/FINALES MASCULINES.jpg" alt="image" class="image_slider2" class="image_slider" />

		</div>
				
				<div id="autre">   </div>
			</section>
			
			<footer id="footer">
								<nav id="menu" class="cb">
				<ul>
					<li class="short"><a href="#menu_top">Haut de page</a></li>
					<li class="short"><a href="#calendrier">Calendrier</a></li>
					<li class="short"><a href="#slider">Actualités</a></li>
					<li class="long"><a href="#results">Resultat de la coupe</a></li>
					<li class="long"><a href="#boutique">Boutique de la ligue</a></li>
				</ul>
			</nav>