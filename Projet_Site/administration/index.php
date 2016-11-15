<?php session_start();
if(isset($_SESSION['isAdmin'])){
?>
<!DOCTYPE html>
<html class="scroller">
	<head>
		<link rel="stylesheet" type="text/css" href="main.css">
		<meta charset="UTF-8"/>
		<title>Bienvenue!</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="JQuery/slideshow_boutons.js"></script>
		<script type="text/javascript" src="JQuery/slideshow.js"></script>
	</head>
	<body>
		<?php include("function.php"); ?>
		<?php include("includes/menu_principal.php");?>
		<?php include("includes/menu_ligues.php"); ?>
			<section id="wrapper">
                <img style ="width:30px;height:30px;" src="img/add.png" onclick="addArticle()" title="Ajouter un article"/>
				<ul id="diaporama">
			<?php
				$bdd=bdd();
				$query=$bdd->query('SELECT * FROM article ORDER BY date DESC LIMIT 0,5');
				for($i=0;$i<5;$i++){
					$result=$query->fetch();
			?>
					<li>
						<a href="displayArticle.php?id=<?php echo $result['id'];?>"><img src="img/<?php echo $result['img_url'];?>"/></a>
                        <div class="admintools">
                            <div><img onclick="deleteArticle(<?php echo $result['id']; ?>)" src="img/delete.png" title="supprimer"/></div>
                            <div><img onclick="editArticle(<?php echo $result['id']; ?>)" src="img/edit.png" title="Editer l'article"/></div>
                        </div>
						<p>
                            
							<?php echo utf8_encode($result['extrait']);?>
						</p>
					</li>
			<?php
				}
			?>
				</ul>
				<ul id="index_defilement">
					<li><img src="img/index_defil_on.png" id="bouton_defil1"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil2"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil3"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil4"/></li>
					<li><img src="img/index_defil_off.png" id="bouton_defil5"/></li>
				</ul>
				<div id="defilement">
					<a href="javascript:diaposScroll(-1)" title="Diapo précédente" class="precedente"> <img src="img/precedent_diap.png" id="img_prec"/></a>
					<a href="javascript:diaposScroll(1)" title="Diapo suivante" class="suivante"><img src="img/suivant_diap.png" id="img_suiv"/> </a>
				</div>
			</section>
        <div id="editor">
            <a href="javascript:close()">X FERMER</a>
                <form id="articleEdit" method="post">
                    <center><h2>Edition d'article</h2></center>
                        <h4>Titre</h4>
                        <input type="text" name="titre" id="titre"/>
                    <h4>Description</h4>
                        <textarea type="text" name="description" id="description"></textarea>
                    <h4>Contenu</h4>
                        <textarea type="text" name="contenu" id="contenu"></textarea>

                    <h4>Image</h4>
                        <input type="text" name="image" id="image"/>
                    <center><input type="submit" id="submitArticleIndex" value=""/></center>
                    <input type="hidden" name="id" id="id" value=""/>
                </form>

        </div>
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            var instance = false;
            function deleteArticle(id){
                $.post(
                    'adminQuery/deleteArticleIndex.php',
                    {id:id},
                    function(data){
                        alert(data);
                        window.location.reload();
                    }
                )
            }
            function addArticle(){
                
                $('#id').val();
                if(!instance){
                    CKEDITOR.replace( 'description');
                    CKEDITOR.replace( 'contenu');
                    instance=true;
                }
                $('#submitArticleIndex').val('Ajouter');
                $('#titre').val('');
                $('#description').val('');
                $('#contenu').val('');
                $('#image').val('');
                $('#editor').show();
                
            }
            function editArticle(id){
                if(!instance){
                    CKEDITOR.replace( 'description');
                    CKEDITOR.replace( 'contenu');
                    instance =true;
                }
                $('#id').val(id);
                $('#editor').show();
                $.post(
                    'adminQuery/loadArticleIndex.php',
                    {id:id},
                    function(data){
                        var result = $.parseJSON(data);
                        $('#submitArticleIndex').val('Editer');
                        $('#titre').val(result.titre);
                        $('#description').val(result.extrait);
                        $('#contenu').val(result.contenu);
                        $('#image').val(result.img_url);
                    }
                );
                
            }
            function close(){
                $('#editor').hide();   
            }
            $('#articleEdit').submit(function(e){ 
                $('#description').val(CKEDITOR.instances.description.getData());
                $('#contenu').val(CKEDITOR.instances.contenu.getData());
                
                var titre=$('#titre').val();
                var description=$('#description').val();
                var contenu = $('#contenu').val();
                var image = $('#image').val();
                var type = $('#submitArticleIndex').val();
                
                if(titre.length>0){
                    if(description.length>0){
                        if(contenu.length>0){
                            if(image.length>0){
                                var formData = new FormData($(this)[0]);
                               
                                if(type=="Editer"){
                                    
                                    $.ajax({
                                        url: 'adminQuery/editArticleIndex.php',
                                        type: 'POST',
                                        data: formData,
                                        cache:false,
                                        processData: false,
                                        contentType:false,
                                        success: function(data,textStatus,jqXHR){
                                            if(typeof data.error === 'undefined'){
                                                $('#editor').hide();
                                               alert(data);
                                                window.location.href="index.php";
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
                                        url: 'adminQuery/ajoutArticleIndex.php',
                                        type: 'POST',
                                        data: formData,
                                        cache:false,
                                        processData: false,
                                        contentType:false,
                                        success: function(data,textStatus,jqXHR){
                                            if(typeof data.error === 'undefined'){
                                                $('#editor').hide();
                                               alert(data);
                                                window.location.href="index.php";
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
	</body>
<?php }
   else{
       echo "Vous n'avez pas les droit pour accèder à cette page";
   }?>
</html>