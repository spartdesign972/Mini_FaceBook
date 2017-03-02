<?php
session_start();

require_once 'inc/connect.php';

#définition de quelques variabl pour gerer les images
$maxSize = (1024 * 1000) * 2; // Taille maximum du fichier
$uploadDir = 'uploads/'; // Répertoire d'upload
$mimeTypeAvailable = ['image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];
$errors = [];   
date_default_timezone_set('America/Martinique');



if(!empty($_POST)){
	
	foreach($_POST as $key => $value){
		
		$post[$key] = $value; 
		
	}
    if(strlen($post['StatutTitle'])<1) 
    {
        $errors[] = 'Rentrez un titre pour votre statut';
    }

    if(strlen($post['StatutText']) < 10)
    {
        $errors[] = 'Votre statut doit comporter au moins 10 caratères';
    }
    /*
    if (empty($post['StatutVideoURL'])  || !filter_var($post['StatutVideoURL'], FILTER_VALIDATE_URL))
    {
        $errors[] = 'L\'url de la vidéo n\'est pas valide';
    }
    */
    if(isset($_FILES['StatutPictureUrl']) && $_FILES['StatutPictureUrl']['error'] === 0)
    {

        $finfo = new finfo(); //déclaration d'un objet de type finfo
        $mimeType = $finfo->file($_FILES['StatutPictureUrl']['tmp_name'], FILEINFO_MIME_TYPE); // récuperation du type mime du fichier, cette façon de faire est la plus sécure

        $extension = pathinfo($_FILES['StatutPictureUrl']['name'], PATHINFO_EXTENSION);//Récuperer l'extension du ficher grace au path info

        if(in_array($mimeType, $mimeTypeAvailable))
        {

            if($_FILES['StatutPictureUrl']['size'] <= $maxSize){

                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0755);//création du dossier via le CHmod, permet d'avoir les droit d'ecriture
                }

                $newPictureName = uniqid('statutImg_').'.'.$extension;//changeent du nom du fichier avec le prefixe avatar et lui donnant un id unique. Adie les remplacement

                if(!move_uploaded_file($_FILES['StatutPictureUrl']['tmp_name'], $uploadDir.$newPictureName)){
                    $errors[] = 'Erreur lors de l\'upload de la photo';
                }
            }

            else 
            {
                $errors[] = 'La taille du fichier excède 2 Mo';
            }

        }
    }else {
     $newPictureName = '';
    }

	if(count($errors) === 0){
		
		if($post['submit'] == 'Publier'){
		
		require_once 'inc/connect.php';
			
		$select = $bdd->prepare('INSERT INTO statut( StatutTitle, StatutPictureUrl, StatutVideoURL, StatutText, StatutDatePublication, Users_idUsers) VALUES (:StatutTitle, :StatutPictureUrl, :StatutVideoURL, :StatutText, now(), :Users_idUsers)');
			
            #now() permet de récuperer la date actuelle  http://stackoverflow.com/questions/9541029/insert-current-date-in-datetime-format-mysql

			$select->bindValue(':StatutTitle',$post['StatutTitle']);
			
			$select->bindValue(':StatutPictureUrl',$newPictureName);
			
			$select->bindValue(':StatutVideoURL',$post['StatutVideoURL']);
			
			$select->bindValue(':StatutText',$post['StatutText']);
			
			//$select->bindValue(':StatutDatePublication',$post['StatutDatePublication']); // inutile...
			
			$select->bindValue(':Users_idUsers',$_SESSION['idUser']);
			
            if($select->execute()){
                $success = 'post créer avec succés';
            }else{
                var_dump($insert->errorInfo());
            }
		
		}
		else{
			
		$select = $bdd->prepare('UPDATE statut SET StatutTitle=:StatutTitle, StatutPictureUrl=:StatutPictureUrl, StatutVideoURL=:StatutVideoURL, StatutText=:StatutText WHERE idStatut=:idStatut');
			
			$select->bindValue(':StatutTitle',$post['StatutTitle']);
			
			$select->bindValue(':StatutPictureUrl',$newPictureName);
			
			$select->bindValue(':StatutVideoURL',$post['StatutVideoURL']);
			
			$select->bindValue(':StatutText',$post['StatutText']);
			
			$select->bindValue(':idStatut',$post['idStatut']);
			
            if($select->execute()){
                $success = 'post modifié avec succés';
            }else{
                var_dump($insert->errorInfo());
            }


		}
	}else{
        $errorsText = implode('<br>', $errors);
    }//Fin de errors=0
}//Fin de !empty($_POST)
?><!DOCTYPE html>
    <html lang="fr">


    <head>
        <meta charset="UTF-8">
        <title>Plublication</title>
        <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
        <?php include 'inc/include-head.php';?>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">WF3 Mini FaceBook</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="publicationTrade.php">Les Postes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="modificationProfile.php">Mon Profile</a></li>
                        <li><a href="confirmLogout.php">Logout</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container">
            <!-- sidebar -->
            <?php require_once 'inc/sidebar.php'; ?>
            
            <div class="content">
                <!-- En-Tête de Présentation -->
                <div class="pageTitle text-center">
                    <h1>Publier</h1>
                </div>

                <?php if(isset($errorsText)): ?>
                <div class="container">
                    <h4 class="error"><?php echo $errorsText; ?></h4>
                </div>
                <?php endif; ?>
                
                <?php if(isset($success)): // La variable $success n'existe que lorsque tout est ok ?>
                <div class="text-center">
                    <div class="page-header success">
                        <h2><?php echo $success; ?></h2>
                    </div>
                </div>
                <?php endif; ?>



				<?php
				
					if(!empty($_GET)){
					
					if(is_numeric($_GET['id'])){
						$select = $bdd->prepare('SELECT * FROM statut WHERE idStatut=:idStatut');
							$select->bindValue(':idStatut',$_GET['id'],PDO::PARAM_INT);
							$select->execute();
							$info = $select->Fetch(PDO::FETCH_ASSOC);

				?>
                <!-- Début Formulaire -->
                    <form id="publier" class="form-horizontal" method="post" enctype="multipart/form-data" role="form" data-toggle="validator">
                        <!-- Titre de la publication -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="title" name="StatutTitle" type="text" placeholder="Titre de la publication" value="<?=$info['StatutTitle'];?>" class="form-control">
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="picture" name="StatutPictureUrl" type="file" placeholder="Image à la une" accept="image/*" value="<?=$info['StatutPictureUrl'];?>" class="form-control">
                                <input type="hidden" name="newPicture" value="<?=$info['StatutPictureUrl'];?>">
                            </div>
                        </div>
                        <br>
                        <p><strong>OU</strong></p>
                        <br>
                        <!-- Url Video -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="UrlVideo" name="StatutVideoURL" type="text" placeholder="Entrez l'Url d'une video" value="<?=$info['StatutVideoURL'];?>" class="form-control">
                            </div>
                        </div>
                        <!-- Publication -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea class="form-control" rows="15" name="StatutText" id="comment" placeholder="Publier" ><?=$info['StatutText'];?></textarea>

                            </div>
                        </div>
						
						<input type="hidden" name="idStatut" value="<?=$info['idStatut'];?>">
						
                        <!-- Bouton d'Envoi -->
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <input type="submit" class="btn btn-primary" name="submit" value="Modifier">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Fin Formulaire -->
		<?php
		
					}//Fin is_numeric
				
			}//Fin !empty $_GET
			else{
		?>
		
				<!-- Début Formulaire -->
                    <form id="publier" class="form-horizontal" method="post" enctype="multipart/form-data" role="form" data-toggle="validator">
                        <!-- Titre de la publication -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="title" name="StatutTitle" type="text" placeholder="Titre de la publication" class="form-control">
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="picture" name="StatutPictureUrl" type="file" placeholder="Image à la une" accept="image/*" class="form-control">
                            </div>
                        </div>
                        <br>
                        <p><strong>OU</strong></p>
                        <br>
                        <!-- Url Video -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="UrlVideo" name="StatutVideoURL" type="text" placeholder="Entrez l'Url d'une video"  class="form-control">
                            </div>
                        </div>
                        <!-- Publication -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea class="form-control" rows="15" name="StatutText" id="comment" placeholder="Publier" ></textarea>

                            </div>
                        </div>
                        <!-- Bouton d'Envoi -->
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <input type="submit" class="btn btn-primary" name="submit" value="Publier">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Fin Formulaire -->
		
		<?php
		
			}//Fin else !empty($_GET)
		
		?>
		
    </div>
    </main>
    <!-- inclusion du fichier qui contient tous les script des pages -->
    <?php include 'inc/include-script.php';?>

    <script>
        $(function(){
                
            $('.success').fadeOut(3000);

        });

    </script>
</body>
</html>