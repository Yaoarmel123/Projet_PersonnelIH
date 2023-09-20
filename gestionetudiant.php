<?php
// 1. Paramètres de connexion a la base de données
$PARAM_hote='localhost';
$PARAM_nom_bd='bd_etudiants';
$PARAM_utilisateur='root';
$PARAM_mot_passe='';
$PARAM_charset='utf8';

// 2. Creation de la connexion
try
{
	$bdd= new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd.';charset='.$PARAM_charset,$PARAM_utilisateur,$PARAM_mot_passe);
}
catch( Exception $e )
{
	die('Erreur de connexion à la base de données : <br>'.$e->getMessage().'<br>');
}
//Appel de la page connexion
include('connexion1.php');
//Récupérer l'action a exécuter
$action='details'; // par défaut, on essais d'afficher des détails
if(isset($_GET['action'])){$action=$_GET['action']; }
// Récupérion l'identifiant de l'etudaint envoyé en paramètre
$idetudiant=$_GET['idetudiant']
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Liste des étudiants de la classe </title>
</head>
<body><center>
<?php if($action=='details'){
    	$req_etd="SELECT * FROM etudiants WHERE id_etd=:idetudiant";
    	$select_etd= $bdd->prepare($req_etd);
    	try{
    	$select_etd->bindValue(':idetudiant',$idetudiant);
    	$liste_etd = $select_etd->execute();
    	$letudiant=$select_etd->fetch(); // Il s'agit d'un seul enregistrement donc on fait le fetch() directement à l'Exception
    	}
    	catch( Exception $e ){
        echo 'Erreur de selection sur les données : ', $e->getMessage();
    	}
    ?>
	<h3>Affichage des détails</h3>
	<strong>Nom : </strong> <?php echo $letudiant['nom_etd']; ?><br />
	<strong>Prénom(s) : </strong> <?php echo $letudiant['prenoms_etd'] ?><br />
	<strong>Sexe : </strong> <?php echo $letudiant['sexe_etd'] ?><br />
	<strong>Télephone :</strong> <?php echo $letudiant['tel_etd'] ?><br />
	<strong>E-mail : </strong> <?php echo $letudiant['email_etd'] ?><br />
	<?php } ?>
	<?php if($action=='modifier'){
		// 1. On selectionne l'enregistrement modifié
		$req_etd="SELECT * FROM etudiants WHERE id_etd=:idetudiant";
    	$select_etd= $bdd->prepare($req_etd);
    	try {
    	$select_etd->bindValue(':idetudiant', $idetudiant);
    	$liste_etd = $select_etd->execute();
    	$letudiant=$select_etd->fetch(); // Il s'agit d'un seul enregistrement donc on fait le fetch() directement à l'Exception
    	}
    	catch( Exception $e ){
        	echo 'Erreur de selection sur les données : ', $e->getMessage();
    	}
		//3. On concoit le formulaire en rapelant les anciennes valeurs avec la propriété "value="
// Le formulaire est traité dans la même page d'ou on a action=" "
    	?>
		<form method="POST" action=" ">
			<h2>Formulaire de Modification des informations de l'étudiant</h2>
			<fieldset style="width:500px">
			<p>Nom : <input type="text" name="nom" required="required" value="<?php 
			echo $letudiant['nom_etd']; ?>"></p>
			<p>Prénoms :<input type="text" name="prenoms" required="required" value="
			<?php echo $letudiant['prenoms_etd']; ?>"></p>	
			<p>Sexe : <select id="sexe" name="sexe" required="required">
			<option value="">Selectionnez une option</option>
			<option value="<?php echo $letudiant['sexe']; ?>" selected>Valeur actuelle
	</option>
			<option value="M">Homme</option>
			<option value="F">Femme</option>
	</select>
	</p>
	<p>Télephone : <input type="text" name="tel" placeholder="99-99-99-99"
required="required" value="<?php echo $letudiant['tel_etd']; ?>"></p>
	<p>E-mail : <input type="email" name="email" required="required" value="
	<?php echo $letudiant['email_etd']; ?>"></p>
	<p>Mot de passe : <input type="password" name="motdepasse" value="<?php echo 
	$letudiant['password_etd']; ?>"></p>
	<input type="submit" name="btn_Submit" value="Enregister les modification"
/>	
	</fieldset>
</form>
<?php
// On vérifie si l'utilisateur a cliqué sur le bouton d'enregistrement
/* Vous remarquez que nous avons donné un nom a ce bouton pour ne pas créer de confusion au cas ou vous avez plusieurs boutons submit sur la page*/
if(isset($_POST['btn_Submit'])){
	// On recupere les connées modifiées
	$nom=htmlentities($_POST['nom']);
	$prenoms=htmlentities($_POST['prenoms']);
	$sexe=htmlentities($_POST['sexe']);
	$telephone=htmlentities($_POST['tel']);
	$mail=htmlentities($_POST['email']);
	$mdp=htmlentities($_POST['motdepasse']);
	// On enregistre les modifications dans la base
	$req="UPDATE etudiants SET nom_etd=:nom,
prenoms_etd=:prenoms,sexe_etd=:sexe,tel_etd=:tel,email_etd=:email,password_etd=:password WHERE id_etd=:idetudiant";
	$modif_etd= $bdd->prepare($req);
try{
	$modif_etd->bindValue(':nom',$nom);
	$modif_etd->bindValue(':prenoms',$prenoms);
	$modif_etd->bindValue(':sexe',$sexe);
	$modif_etd->bindValue(':tel',$telephone);
	$modif_etd->bindValue(':email',$mail);
	$modif_etd->bindValue(':password',$mdp);
	$modif_etd->bindValue(':idetudiant',$idetudiant);
	$resultat = $modif_etd->execute();
		if($resultat){
			echo 'Modification réussi <br />';
			echo '<a href="liste_etd.php">Retour à la liste des étudiants </a>';
		}
	}
	catch( Exception $e ){
		echo 'Erreur de requete : ', $e->getMessage();
	}
}
 } ?>
  <?php if($action=='supprimer'){
 echo '<h3>Suppression de l\'étudiant</h3>';
 $req_etd="DELETE FROM etudiants WHERE id_etd=:idetudiant" ;
 $select_etd= $bdd->prepare($req_etd); 
 try {
 $select_etd->bindValue(':idetudiant', $idetudiant); 
 $resultat = $select_etd->execute();
 if($resultat){
 echo 'Suppression effectuée avec succès<br />';
 echo '<a href="liste_etd.php">Retour à la liste des étudiants </a>';
 }
 }
 catch( Exception $e ){
 echo 'Erreur de suppression des données : ', $e->getMessage();
 }
 ?>
 
 <?php } ?>
 <?php
// Désactiver l'affichage les erreurs à l'écran
ini_set('display_errors', 0);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
?>

</center></body>
</html>