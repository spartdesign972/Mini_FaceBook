<?php
session_start();

require_once 'inc/connect.php';


#définition de quelques variabl pour gerer les images
$maxSize = (1024 * 1000) * 2; // Taille maximum du fichier
$uploadDir = 'uploads/'; // Répertoire d'upload
$mimeTypeAvailable = ['image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];
$errors = [];	
date_default_timezone_set('America/Martinique');
#verification de l'existance de l'envoi des données puis vérificatio de celle ci
if(!empty($_POST))
{
	foreach ($_POST as $key => $value)
	{
		$post[$key] = (trim(strip_tags($value))); //netoyage des données, on enlève les balise HTML et autres ainsi que les espaces en début et fin de chaine
	}
	if(strlen($post['UserLastName'])<5 || strlen($post['UserLastName'])>50)
	{
		$errors[] = 'Votre nom doit faire entre  5 et 50 caratères';
	}

	if(strlen($post['UserFirstName'])<5 || strlen($post['UserFirstName'])>50)
	{
		$errors[] = 'Votre prénom doit faire entre  5 et 50 caratères';
	}

	if(strlen($post['UserDescription']) < 20){
		$errors[] = 'La description doit comporter au moins 20 caractères, soyez plus bavard :)';
	}

	if(strlen($post['UserPassword'])<5)
	{
		$errors[] = 'Le mot de passe doit faire au minimum 5 caractères';
	}
	
	if(!empty($post['UserBirthday']))
	{

		if (!preg_match("/\d{4}\-\d{2}-\d{2}/", $post['UserBirthday'])) {
		    $errors[] = 'La date doit etre au format Année-mois-jours';
		}
	}else{
		$errors[] = 'veuillez entrer une date sous la forme année-mois-jour';

	}
	
	if(!filter_var($post['UserEmail'],FILTER_VALIDATE_EMAIL))
	{
		$errors[] = 'Il y a une erreur au niveau du mail...';
	}

	if(empty($post['UserPassword'])){
		$errors[] = 'Veuillez entrer votre MDP';
	}else{
		$passwordHash = password_hash($post['UserPassword'], PASSWORD_DEFAULT);
		
	}
	if(!isset($post['UserGender']))
	{
		$errors[] = 'Précisez si vous êtes une femme ou un homme...';
	}

	if(isset($_FILES['UserAvatar']) && $_FILES['UserAvatar']['error'] === 0){

		$finfo = new finfo(); //déclaration d'un objet de type finfo
		$mimeType = $finfo->file($_FILES['UserAvatar']['tmp_name'], FILEINFO_MIME_TYPE); // récuperation du type mime du fichier, cette façon de faire est la plus sécure

		$extension = pathinfo($_FILES['UserAvatar']['name'], PATHINFO_EXTENSION);//Récuperer l'extension du ficher grace au path info

		if(in_array($mimeType, $mimeTypeAvailable)){

			if($_FILES['UserAvatar']['size'] <= $maxSize){

				if(!is_dir($uploadDir)){
					mkdir($uploadDir, 0755);//création du dossier via le CHmod, permet d'avoir les droit d'ecriture
				}

				$newPictureName = uniqid('avatar_').'.'.$extension;//changeent du nom du fichier avec le prefixe avatar et lui donnant un id unique. Adie les remplacement

				if(!move_uploaded_file($_FILES['UserAvatar']['tmp_name'], $uploadDir.$newPictureName)){
					$errors[] = 'Erreur lors de l\'upload de la photo';
				}
			}

			else {
				$errors[] = 'La taille du fichier excède 2 Mo';
			}

		}

		else {
			$errors[] = 'Le fichier n\'est pas une image valide';
		}
	}

	else {
		$errors[] = 'Aucune photo sélectionnée';
	}
	if(count($errors) === 0){
		
		$insert = $bdd->prepare('INSERT INTO users( UserLastName, UserFirstName, UserEmail, UserPassword, UserBirthday, UserGender, UserAvatar, UserDescription, UserSubscribeDate) VALUES (:UserLastName, :UserFirstName, :UserEmail, :UserPassword, :UserBirthday, :UserGender, :UserAvatar, :UserDescription, :UserSubscribeDate)');
			
			$insert->bindValue(':UserLastName',$post['UserLastName']);

			$insert->bindValue(':UserFirstName',$post['UserFirstName']);
			
			$insert->bindValue(':UserEmail',$post['UserEmail']);
			
			$insert->bindValue(':UserPassword',$passwordHash);

			$insert->bindValue(':UserBirthday',$post['UserBirthday']);

			$insert->bindValue(':UserGender',$post['UserGender']);

			$insert->bindValue(':UserAvatar',$newPictureName);

			$insert->bindValue(':UserDescription',$post['UserDescription']);

			$insert->bindValue(':UserSubscribeDate',$post['UserSubscribeDate']);
		
		if($insert->execute()) { 
            session_start();
                $_SESSION['isConnected'] = true;
                $_SESSION['lastname']    = $user['UserLastName'];
                $_SESSION['firstname']   = $user['UserFirstName'];
                $_SESSION['idUser']      = $user['idUser'];
                $_SESSION['UserAvatar']  = $user['UserAvatar'];
        
        
        header("location:auth_inscription.php");
        } var_dump($rinsert->errorInfo());
	}else{
		$errorsText = implode('<br>', $errors);
	}//Fin de errors=0
}//Fin de !empty($_POST)

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
        <?php include 'inc/include-head.php';?>
    </head>

    <body>
        <!-- La topbar de nav -->
        <nav class="navbar navbar-default text-center navAuth" role="navigation">
            <div class="container">
                <a class="navbar-auth-inscription" href="#">WF3 Mini FaceBook</a>
            </div>
            <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- fin topBar -->
        <!-- Contenu principal -->
        <main class="container suscribe-body">

            <!-- titre du formulaire qui donne l'impression d'etre le titre de la page -->
            <section class="text-center page-header container-full">
                <h1>Inscription</h1>
            </section>
            <?php if(isset($errorsText)): ?>
                <div class="container">
                    <h4 class="error"><?php echo $errorsText; ?></h4>
                </div>
                <?php endif; ?>
                    <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row" style="margin: 0;">
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <input type="text" class="form-control" name="UserLastName" id="UserLastName" placeholder="Nom">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <input type="text" class="form-control" name="UserFirstName" id="UserFirstName" placeholder="Prenom">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <input type="email" class="form-control" name="UserEmail" id="UserEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <input type="password" class="form-control" name="UserPassword" id="UserPassword" placeholder="Mot de passe">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <input type="text" class="form-control" name="UserBirthday" id="datepicker" placeholder="Date de naissance =>année-mois-jour">

                                <input type="hidden" name="UserSubscribeDate" value="<?php echo date('Y-m-d'); ?>">

                            </div>
                            <div class="form-group text-right col-lg-12 col-md-12">
                                <span class="btn btn-primary btn-file btn-block">
						<input name="UserAvatar" id="UserAvatar" type="file">
					</span>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 text-center">
                                <textarea class="form-control" name="UserDescription" id="UserDescription" cols="30" rows="10" placeholder="Parlez nous de vous"></textarea>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 text-left">
                                <label class="radio-inline">
                                    <input type="radio" name="UserGender" value="Homme">Homme</label>
                                <label class="radio-inline">
                                    <input type="radio" name="UserGender" value="femme">Femme</label>
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary text-center">
                            </div>

                        </div>
                    </form>
        </main>

        <!-- inclusion du fichier qui contient tous les script des pages -->
        <?php include 'inc/include-script.php';?>
            <script>
                // $(function () {
                //     $("#datepicker").datepicker();
                // });
            </script>
    </body>

    </html>