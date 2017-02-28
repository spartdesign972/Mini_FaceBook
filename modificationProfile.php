<?php
session_start();

require_once 'inc/connect.php';

$errors = [];
$success = '';
require_once 'inc/connect.php';

	$user = $bdd->prepare('SELECT * FROM users WHERE idUser=:idUser');
	$user->bindValue(':idUser',$_SESSION['idUser'],PDO::PARAM_INT);
	$user->execute();
	$user = $user->Fetch(PDO::FETCH_ASSOC);

if(!empty($_POST)){
	
	foreach($_POST as $key => $value){
		
		$post[$key] = $value; 
		
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

    if(!filter_var($post['UserEmail'],FILTER_VALIDATE_EMAIL))
    {
        $errors[] = 'Il y a une erreur au niveau du mail...';
    }

    if(empty($post['UserPassword'])){
        $errors[] = 'Veuillez entrer votre MDP';
    }else{
        $passwordHash = password_hash($post['UserPassword'], PASSWORD_DEFAULT);
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
        $newPictureName = $_SESSION['UserAvatar'];
    }
	if(count($errors) === 0){
		
		$update = $bdd->prepare('UPDATE users SET UserLastName=:UserLastName, UserFirstName=:UserFirstName, UserEmail=:UserEmail, UserBirthday=:UserBirthday, UserAvatar=:UserAvatar, UserDescription=:UserDescription WHERE 	idUser=:idUser');
			
			$update->bindValue(':UserLastName',$post['UserLastName']);

			$update->bindValue(':UserFirstName',$post['UserFirstName']);
			
			$update->bindValue(':UserEmail',$post['UserEmail']);

			$update->bindValue(':UserBirthday',$post['UserBirthday']);

			$update->bindValue(':UserAvatar',$newPictureName);

			$update->bindValue(':UserDescription',$post['UserDescription']);
			
			$update->bindValue(':idUser',$_SESSION['idUser'],PDO::PARAM_INT);

		if($update->execute()){
          $success = "Modifications Effectuer";
        }else{
            die(print_r($update->errorInfo()));
        }
		
	}else{
        $errorsText = implode('<br>', $errors);
    }//Fin de errors=0
}//Fin de !empty($_POST)
	
?><!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modification de votre Profil</title>

    <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
    <?php include 'inc/include-head.php';?>

    <link rel="stylesheet" type="text/css" href="assets/css/modification.css">
    
</head>

<body>

    <!-- Menu -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <!-- Gestion du Menu Burger : Version Mobile -->
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
                    <!-- <li><a href="#">Mon Profile</a></li> -->
                  
                    <li><a href="confirmLogout.php">Logout</a></li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- Fin du Menu -->

    <?php require_once 'inc/sidebar.php'; ?>

      <div class="content">
        <div class="pageTitle text-center">
            <h1>Modifier votre Profile</h1>
        </div>
        <?php if(isset($errorsText)): ?>
            <div class="container">
                <h4 class="error"><?php echo $errorsText; ?></h4>
            </div>
        <?php endif; ?>

        
        <!-- Choix image -->
        <div class="image">
            <div class="row">
                <div class="col-xs-8">
                    <div class="form-group">
                        <label for="exampleInputFile">Image de profil</label>
                        <input type="file" name="UserAvatar" id="exampleInputFile">
                    </div>
                </div>

                <div class="col-xs-4">
      
					<img src="./uploads/<?php echo $_SESSION['UserAvatar']; ?>" class="img-responsive img-circle" alt="Image Avatar">

                </div>
            </div>
        </div>

        <?php if(!empty($success)): ?>
            <div class="container">
                <h4 class="success"><?php echo $success; ?></h4>
            </div>
        <?php endif; ?>
    <!-- Début Formulaire -->
    <form id="modification" class="form-horizontal" action="#" method="post" role="form" data-toggle="validator">

        <!-- Nom -->
        <div class="form-group has-feedback">
            <div class="col-xs-12">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <input id="nom" name="UserLastName" required class="form-control" data-error="N'oubliez pas de saisir votre nom" type="text" value="<?=$user['UserLastName'];?>">
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <!-- Prénom -->
        <div class="form-group has-feedback">
            <div class="col-xs-12">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <input id="prenom" name="UserFirstName" required class="form-control" data-error="N'oubliez pas de saisir votre prenom" type="text" value="<?=$user['UserFirstName'];?>">
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <!-- Email -->
        <div class="form-group has-feedback">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <input id="email" name="UserEmail" required class="form-control" data-error="N'oubliez pas de saisir votre email" type="email" value="<?=$user['UserEmail'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>

        <!-- mot de passe -->
        <div class="form-group has-feedback">
            <div class="col-xs-12">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <input type="password" class="form-control" name="UserPassword" id="UserPassword" data-error="N'oubliez pas de saisir votre mot de passe">
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <!-- Date de Naissance -->
        <div class="form-group has-feedback">
            <div class="col-xs-12">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <input id="date de naissance" name="UserBirthday" required class="form-control" data-error="N'oubliez pas de saisir votre date de naissance" type="text" value="<?=$user['UserBirthday'];?>">
                <div class="help-block with-errors"></div>
            </div>
        </div>
		
		<!-- Textarea ne supporte pas l'attribut value -->
        <!-- Description -->
        <div class="form-group has-feedback">
            <div class="col-xs-12">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <textarea id="description" name="UserDescription" rows="5" value="<?=$user['UserDescription'];?>" class="form-control"></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <!-- Bouton d'Envoi -->
        <div class="col-xs-12">
            <div class="form-group has-feedback text-center">
                <input type="submit" class="btn btn-primary" name="contact" value="Modifier"><!--Modifier</button>--> 
            </div>
        </div>
    </form>
</div>

<!-- inclusion du fichier qui contient tous les script des pages -->
<?php include 'inc/include-script.php';?>

<script>
    // -- Initialisation de jQuery
    // $(function () {

    //     $('#modification').validator().on('submit', function (e) {

    //         if (!e.isDefaultPrevented()) {
    //             $(this).replaceWith('<div class="alert alert-success">Votre Modification à bien été effectuer.</div>');
    //         }

    //         return false;

    //     });

    // });
</script>

</body>

</html>