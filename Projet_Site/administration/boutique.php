<?php
 include("function.php"); 
 session_start(); 

if(isset($_SESSION['isAdmin'])){
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="main.css">
		<meta charset="UTF-8"/>
		<title>Bienvenue!</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_convertPanier.js"></script>
	</head>
	<body>
		<?php include("includes/menu_principal.php");?>
		<?php include("includes/menu_ligues.php"); ?>
<?php 
        $bdd = bdd();
?>
		<section id="boutique">
			<nav id="categorie">
				<ul>
					<?php 
						$bdd=bdd();
						$res = $bdd->query('SELECT * FROM categorie');
                        $donnees=$res->fetchAll();
                        
                        $res2 = $bdd->query('SELECT * FROM tva');
                        $donnees2=$res2->fetchAll();

						foreach($donnees as $donnee){	
					?>
						<a href="javascript:changeCat('<?php echo utf8_encode($donnee['label'])?>')">
							<li>
								<?php echo utf8_encode("$donnee[label]"); ?><img onclick ="deleteCategorie(<?php echo $donnee['categorie_id'] ?>)" style="width:30px;height:30px;" src="img/delete.png"/>
							</li>
						</a>
					<?php
						}
					?>
                    <li><img onclick="$('#addCategorie').show()" style="width:30px;height:30px;"src="img/add.png"/> Ajouter une catégorie</li>
				</ul>	
			</nav>

			<section id="content">
                    <div id="produit" onclick="addArticle()">
						<h1> Ajouter Produit</h1>
						<img src="img/add.png"/>
					</div>
					<?php 
						$res2 = $bdd->query('SELECT photo.url AS URL,designation,prix_unitaire,produit_id,description,tva.tva_id AS TVA 
											FROM produit 
											INNER JOIN tva ON produit.tva_id=tva.tva_id
											INNER JOIN photo ON produit.produit_id=photo.id_produit
											');
						while($donnee2=$res2->fetch()){
					?>	
					<div id="produit" >
						<h1> <?php echo "$donnee2[designation]";?></h1>
						<img src="<?php echo "$donnee2[URL]"; ?>"/>
						<div id="description">
							<p>
								Prix: <?php echo "$donnee2[prix_unitaire]";?>€<br/>
							</p>
				            <img style="width:30px;height:30px;cursor:pointer;" onclick="editArticle(<?php echo $donnee2['produit_id'];?>)" src="img/edit.png" title="editer un article"/>
                            <img style="width:30px;height:30px;cursor:pointer;" onclick="deleteArticle(<?php echo $donnee2['produit_id'];?>)" src="img/delete.png" title="supprimer"/>
						</div>
					</div>
					<?php
						}
					?>
                    
			</section>
		</section>
		<section id="preview_screen">
		</section>
        <div id="addCategorie">
            <a href="javascript:close()">X FERMER</a>
            <h4>Ajout de categorie</h4>
            Titre <br/>
            <input type="text" id="addCat" placeholder="nom de la catégorie"/>
            <center><input type="button" value="Valider" onclick="saveCategorie()"/></center>
       </div>
        <div id="addArticle">
            <a href="javascript:close()">X FERMER</a>
            <center><h3>Editer article</h3></center>
            <form id="ajoutArticle">
            <h4>Désignation</h4>
            <input type="text" name="nom" id="nom" placeholder="Désignation"/>
            <h4>Description</h4>
            <textarea type="text" name="description" id="desc" placeholder="Déscription">
            </textarea>
            <h4>Image</h4>
            <input type="text" name="image" id="image" placeholder="URL image"/>
            <h4>Prix</h4>
            <input type="text" name="prix" id="prix" placeholder="ex: 5.5"/>
            
            <h4>Catégorie</h4>
            <select name="category" id="category" style="color:black;"/>
            <?php
                foreach($donnees as $donnee){
                    echo '<option value="'.$donnee['categorie_id'].'">'.utf8_encode($donnee['label']).'</option>';   
                }
            ?>
            </select>
            <h4>TVA</h4>
            <select name="tva" id="tva" style="color:black;"/>
            <?php
                foreach($donnees2 as $donnee2){
                    echo '<option value="'.$donnee2['tva_id'].'">'.utf8_encode($donnee2['taux']).'</option>';   
                }
            ?>
            </select>
            <input type="hidden" value="" name="articleID" id="articleID"/>
            <center><input type="submit" id="subArticle" value="Editer"/></center>
            </form>
        </div>
		<script type="text/javascript" src="JQuery/AJAX_boutique.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_produit_preview.js" ></script>
		<script type="text/javascript" src="JQuery/AJAX_AjoutPanier.js"></script>
		<script type="text/javascript" src="JQuery/AJAX_DeletePanier.js"></script>
		<script type="text/javascript" src="JQuery/gestionDivPanier.js"></script>
        <script type="text/javascript">
            function deleteCategorie(id){
                $.post(
                    'adminQuery/deleteCategorie.php',
                    {id:id},
                    function(data){
                        alert(data); 
                        window.location.reload();
                    }
                )
            }
            function saveCategorie(){
                var text=$('#addCat').val();
               $.post(
                    'adminQuery/ajoutCategorie.php',
                    {text:text},
                    function(data){
                        alert(data); 
                        window.location.reload();
                    }
                ) 
            }
            function deleteArticle(id){
                 $.post(
                    'adminQuery/deleteProduit.php',
                    {id:id},
                    function(data){
                        alert(data);
                        window.location.reload();
                    }
                );
            }
            function editArticle(id){
                $('#subArticle').val('Editer');
                $('#articleID').val(id);
                
                $.post(
                    'adminQuery/loadProduit.php',
                    {id:id},
                    function(data){
                        var result = $.parseJSON(data);
                        $('#nom').val(result.designation);
                        $('#desc').val(result.description);
                        $('#image').val(result.url);
                        $('#prix').val(result.prix_unitaire);
                    }
                );
                $('#addArticle').show();
                $('#preview_screen').show();
            }
            function addArticle(){
                $('#subArticle').val('Ajouter');
                $('#addArticle').show();
                $('#preview_screen').show();
            }
            function close(){
                $('#addArticle').hide();
                $('#addCategorie').hide();
                $('#preview_screen').hide();
                $('#nom').val('');
                $('#desc').val('');
                $('#prix').val('');
                $('#image').val('');
                $('#subArticle').val();
            }
            $('#ajoutArticle').submit(function(e){ 
                
                var titre=$('#nom').val();
                var description=$('#desc').val();
                var prix = $('#prix').val();
                var image = $('#image').val();
                var type = $('#subArticle').val();
                
                if(titre.length>0){
                    if(description.length>0){
                        if(prix.length>0){
                            if(image.length>0){
                                var formData = new FormData($(this)[0]);
                               
                                if(type=="Editer"){
                                    
                                    $.ajax({
                                        url: 'adminQuery/editerProduit.php',
                                        type: 'POST',
                                        data: formData,
                                        cache:false,
                                        processData: false,
                                        contentType:false,
                                        success: function(data,textStatus,jqXHR){
                                            if(typeof data.error === 'undefined'){
                                                $('#editor').hide();
                                               alert(data);
                                                window.location.href="boutique.php";
                                            }
                                            else{
                                                alert('lol');
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown){
                                            console.log('ERRORS:' +textStatus);
                                        }       
                                    });
   
                            }else{
                                 $.ajax({
                                        url: 'adminQuery/ajoutProduit.php',
                                        type: 'POST',
                                        data: formData,
                                        cache:false,
                                        processData: false,
                                        contentType:false,
                                        success: function(data,textStatus,jqXHR){
                                            if(typeof data.error === 'undefined'){
                                                $('#editor').hide();
                                               alert(data);
                                                window.location.href="boutique.php";
                                            }
                                            else{
                                                alert('lol');
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown){
                                            console.log('ERRORS:' +textStatus);
                                        }       
                                    });  
                            }
                        }else{
                            alert('Insérez une image');
                        }
                    }else{
                        alert('Insérez un contenu');
                    }
                }else{
                    alert('Insérez une description');
                }
            }else{
                alert('Indiquez un titre');
            }
            return false;
        });
        </script>
<?php }
   else{
       echo "Vous n'avez pas les droit pour accèder à cette page";
   }?>
	</body>
</html>