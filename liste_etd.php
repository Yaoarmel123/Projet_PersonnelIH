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

// 3. Selection des données dans la base
$req_etd="SELECT * FROM etudiants ORDER BY nom_etd ASC";
$select_etd= $bdd->prepare($req_etd);
try {
	$liste_etd = $select_etd->execute();
}
catch( Exception $e ){
	echo 'Erreur de selection des données : ',$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel= "stylesheet" href= "style.css" media= "screen" type= "text/css" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Liste des étudiants de la classe </title>
</head>
<body><center>
	<h2>Liste des étudiants de la classe par ordre alphabétique</h2>
	<?php echo '<h4>Effectif Total : '.$select_etd->rowCount().' étudiants </h4>';
?>
	<table width="50%" >
		<tr>
			<th>N°</th>
			<th>Nom</th>
			<th>Prénom(s)</th>
			<th>Sexe</th>
			<th colspan=2> </th>
		</tr>
	<?php
	$i=1; // initialisons notre numéro d'ordre
	while($etudiant = $select_etd->fetch()){
	?>
		<tr>
			<td><?php echo $i; ?> </td>
			<td><a href="gestionetudiant.php?action=details&idetudiant=<?php echo $etudiant ['id_etd']; ?>"><?php echo $etudiant['nom_etd']; ?></a></td>
			<td><?php echo $etudiant ['prenoms_etd']; ?></td>
			<td><?php echo $etudiant ['sexe_etd']; ?></td>
			<td><a href="gestionetudiant.php?action=modifier&idetudiant=<?php echo $etudiant ['id_etd']; ?>">Modifier</a></td>
			<td><a href="gestionetudiant.php?action=supprimer&idetudiant=<?php echo $etudiant ['id_etd']; ?>">Supprimer</a></td>
		</tr>
	<?php
	$i++;
	} // fin de la boucle while qui est aussi la fin d'une ligne
?>

	</table>
	
</center></body>
</html>