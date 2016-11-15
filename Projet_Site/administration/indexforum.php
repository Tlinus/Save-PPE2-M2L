<?php
	include 'includes/head.php';
	//include 'function.php';
	include 'includes/addPost_class.php';
	$bdd = bdd();
if(isset($_SESSION['isAdmin'])){
?>
<div id="forum3">
	<?php
		// SI ON A POSTE UN MESSAGE
		if (isset($_POST['contenu']) AND isset($_POST['topic'])){
			$addPost = new addPost($_POST['topic'],$_POST['contenu']);
			$verif = $addPost->verif();
			// si tout est bon
			if($verif == 'ok'){
				if($addPost->insert()){
				// on reste sur la même page!
				}
			}
			else{ // si on a une erreur
				$erreur =$verif;
			}
		}	
		// SI ON EST DANS UNe CATEGORIE DU FORUM

		if(isset($_GET['forum']) AND!isset($_GET['topic'])){ 	
			
			$forum_titre=$bdd->prepare('SELECT titre FROM forum WHERE forum_id=:id'); // RECUPERE LE TITRE DU FORUM
			$forum_titre->execute(array('id'=>$_GET['forum']));
			$rep=$forum_titre->fetch();

	?>
			 <p class="retour">Vous étes ici:  <a href="indexforum.php"> >Forum </a><a href="indexforum.php?forum=<?php echo utf8_encode($_GET['forum']); ?>"> ><?php echo utf8_encode($rep['titre']); ?></a></p>
			 <p class="retour"> <a href="javascript:history.go(-1)">Retour à la page précédente</a></p> 
	<?php
			
	
	?> 
			<div class="categorie">
				<h3> <?php echo utf8_encode($rep['titre']); ?> </h3>
			</div>
			

	<?php
            $message="réponses";
			$requete = $bdd->prepare('SELECT titre,	topic.topic_id as id,forum_id FROM topic  WHERE  forum_id= :forum'); // RECUPERE LES TOPIC APPARTENANT AU FORUM
			$requete->execute(array('forum' =>$_GET['forum']  ));
			while($reponse =$requete->fetch()){	// On affiche les sujets
	
                $requete2 = $bdd->prepare('SELECT COUNT(*) AS nombre  FROM topic inner join msg_forum ON msg_forum.topic_id = topic.topic_id WHERE  topic.topic_id= :topic GROUP BY topic.topic_id'); // RECUPERE LES TOPIC APPARTENANT AU FORUM
			$requete2->execute(array('topic' =>$reponse['id']  ));
            $res=$requete2->fetch();
            if(!$res['nombre']){
                $res['nombre']=0;
                $message="réponse";
            }
            if($res['nombre']==1){
                $message="réponse";
            }
?>
				<div class="categorie">
					<a href="indexforum.php?forum=<?php echo $_GET['forum']?>&topic=<?php echo $reponse['id']; ?>"> 
						<h1><?php echo utf8_encode($reponse['titre']).' ( '.$res['nombre'].' '.$message.' )'; ?></h1>
					</a>
                    <img src="img/delete.png" class="adminImg" title="Effacer topic" onclick="deleteTopicForum(<?php echo $reponse['id']; ?>)"/>
				</div>
	<?php
			}
			// SI ON EST LOGGER ON PEUT CREER UN SUJET
			if(isset($_SESSION['id'])){
	?>
				<a class="bouton2 "href="addSujet.php?forum=<?php echo $_GET['forum']; ?>"> Ajouter un sujet</a>
	<?php
			}	
		}
		// SI ON EST DANS UN TOPIC
		else if(isset($_GET['topic'])){	
			$requete = $bdd->prepare('SELECT topic.titre,contenu,utilisateur.pseudo AS pseudo,topic.forum_id AS forum_id,forum.titre AS titre 
						FROM topic 
						INNER JOIN utilisateur ON topic.auteur_id=utilisateur.utilisateur_id
						INNER JOIN forum ON topic.forum_id=forum.forum_id
						WHERE topic_id = :topic');
			$requete->execute(array('topic'=> $_GET['topic']));
			$res=$requete->fetch();	

	?>
			<p class="retour">Vous étes ici:<a href="indexforum.php">>Forum</a><a href="indexforum.php?forum=<?php echo utf8_encode($res['forum_id']); ?>">><?php echo utf8_encode($res['titre']); ?></a><a href="indexforum.php?forum=<?php echo utf8_encode($res['forum_id']); ?>&topic=<?php echo utf8_encode($_GET['topic']); ?> ">><?php echo utf8_encode($res['titre']); ?></a></p>
			<p class="retour"> <a href="javascript:history.go(-1)">Retour à la page précédente</a></p>
			<div class="categorie">
				<h1> <?php echo utf8_encode($res['titre']); ?> </h1>
				<div class="categorie" >
					<a href="consulterProfil.php?pseudo=<?php echo $res['pseudo']; ?>"><?php echo $res['pseudo']; ?></a><br>
					<p><?php echo utf8_encode($res['contenu']); ?></p>
				</div>
			</div>
	<?php
			$requete = $bdd->prepare('SELECT message_id,contenu,pseudo,date
						FROM msg_forum 
						INNER JOIN utilisateur ON utilisateur.utilisateur_id=msg_forum.auteur_id
						WHERE topic_id = :topic');
			$requete->execute(array('topic'=> $_GET['topic']));
			while ($reponse = $requete->fetch()){ 
	?>
				<div class="categorie" >
					<div class="categorie" >
						<?php	echo '<h6><a href="consulterProfil.php?pseudo='.$reponse['pseudo'].'">'.$reponse['pseudo'].'</a></h6> <h5>       à '.$reponse['date']. ':</h5><br>';	?>
						<p><?php echo utf8_encode($reponse['contenu']); ?></p>
                        <img src="img/delete.png" class="adminImg" title="Effacer message" onclick="deleteMessageForum(<?php echo $reponse['message_id']; ?>)"/>
					</div>
				</div>
						
	<?php
			}
			// SI ON EST LOGGE ON PEUT ENVOYAER UN MESSAGE
			if(isset($_SESSION['id'])){
	?>
				<form method="post" action="indexforum.php?topic=<?php echo $_GET['topic']; ?>" >
					<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
					<textarea name="contenu" id="sujet" placeholder="votre message" ></textarea>
					<script type="text/javascript">
					    CKEDITOR.replace( 'sujet');
					</script>
					<input type="hidden" name="topic" value="<?php echo $_GET['topic']; ?>">
					<input type ="submit" class="bouton1" value="ajouter à la conversation"> 
	<?php 
					if(isset($erreur)){
						echo $erreur;
					}
	?>
				</form>
	<?php
				}
			}
		// SI ON EST SUR LA PAGE D'INDEX DU FORUM
		else {	
	?>
			<h1>Bienvenue a la page d acceuil</h1>
			<p class="retour"> <a href="javascript:history.go(-1)">Retour à la page précédente</a></p>
             <div class="categorie">
                <a href="javascript:addCategorieForum()">Ajouter une catégorie</a>
                <img src="img/add.png" class="adminImg" title="Ajouter catégorie"/>
            </div>           

	<?php 
			$requete = $bdd->query ('SELECT forum_id,titre FROM forum');
			while ($reponse = $requete->fetch()){	
	?>
				<div class="categorie">
					<a href=" indexforum.php?forum=<?php echo utf8_encode($reponse['forum_id']); ?>"> <?php echo utf8_encode($reponse['titre']); ?> </a>
                    <img src="img/delete.png" class="adminImg" title="Effacer catégorie" onclick="deleteCategorieForum(<?php echo $reponse['forum_id']; ?>)"/>
				</div>
	<?php
			}
		}
			
	?>
	</section>
</div>
    <div id="blackScreen2">
 
    </div>
    <div id="addCategorie">
            <a href="javascript:close()">X FERMER</a>
            <h3>Ajout de categorie</h3>
            Titre <br/>
            <input style="width:100%;" type="text" id="addCat" placeholder="nom de la catégorie"/><br/>
            Description <br/>
            <textarea style="width:100%;" id="descCat" >
                Description du forum.
            </textarea>
            <center><input type="button" value="Valider" onclick="saveCategorie()"/></center>
       </div>    

    <script type="text/javascript">
        function deleteMessageForum(id){
            $.post(
                    'adminQuery/deleteMessageForum.php',
                    {id:id},
                    function(data){
                        alert(data);
                        window.location.reload();
                    }
                );
        }
        function deleteTopicForum(id){
            $.post(
                'adminQuery/deleteTopicForum.php',
                {id:id},
                function(data){
                    alert(data);
                    window.location.reload();
                }
            );
        }
        function deleteCategorieForum(id){
            $.post(
                'adminQuery/deleteCategorieForum.php',
                {id:id},
                function(data){
                    alert(data);
                    window.location.reload();
                }
            );
        }
        function addCategorieForum(){
            $('#blackScreen2').show();
            $('#addCategorie').show();
        }
        function close(){
           $('#blackScreen2').hide();
            $('#addCategorie').hide(); 
        }
        function saveCategorie(){
            var label = $('#addCat').val();
            var description = $('#descCat').val();
            if(label.length >0){
                if(description.length>0){
                    $.post(
                        'adminQuery/addCategorieForum.php',
                        {titre:label,description:description},
                        function(data){
                            alert(data);
                            window.location.reload();
                        }
                    );
                }
                else{
                    alert('Entrez une description valide');
                }
            }
            else{
                alert('Entrez un titre valide');
                
            }
        }
    </script>
<?php }
   else{
       echo "Vous n'avez pas les droit pour accèder à cette page";
   }?>
	</body>

</html>
		