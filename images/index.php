
<?php
// I . Récupération des données du formulaire ajout étudiant
echo '<h4> Récapitulatif des données saisies</h4>';
//Récupuération du nom saisi
$nom=htmlentities($_POST['nom']);
echo 'Nom : '.$nom.'<br>';
//Récupuération du prénom saisi
$prenoms=htmlentities($_POST['prenoms']);
echo 'Prénoms : '.$prenoms.'<br>';
//Récupuération du sexe choisi
$sexe=htmlentities($_POST['sexe']);
echo 'Sexe : '.$sexe.'<br>';
//Récupuération du téléphone saisi
$telephone=htmlentities($_POST['tel']);
echo 'Télephone : '.$telephone.'<br>';
//Récupuération du mail saisi
$mail=htmlentities($_POST['email']);
echo 'E-mail : '.$mail.'<br>';
//Récupuération du mot de passe saisi
$mdp=htmlentities($_POST['motdepasse']);
echo 'Mot de Passe : '.$mdp.'<br>';


// II. Connexion au serveur
// 1. Définir les paramètres de connexion
$PARAM_hote='localhost'; // Nom ou adresse du serveur où se trouve la base de données
$PARAM_nom_bd='bd_etudiants'; // Nom de la base de données
$PARAM_utilisateur='root'; // Nom de l'utilisateur qui se connecte
$PARAM_mot_passe=''; // Mot de passe de l'utilisateur
$PARAM_charset='utf8'; // Jeu de caractère

// 2. Creation de la connexion
try
{
	$bdd= new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd.';charset='.
	$PARAM_charset, $PARAM_utilisateur, $PARAM_mot_passe);
}
catch(Exception $e)
{
die('Erreur de connexion à la base de données : <br>'.$e->getMessage().'<br>');
}

//III. Insertion des données
//1. On défini la reqête (on la mets dans un variable pour faciliter la manipulation)
$req="INSERT INTO etudiants(nom_etd,
prenoms_etd,sexe_etd,tel_etd,email_etd,password_etd) VALUES(:nom,
:prenoms,:sexe_etd,:tel,:email,:password)" ;

//2. On demande au système de préparer la requête ($bdd est le nom de la connexion à BD
$ajout_etd= $bdd->prepare($req);

try {
//3. On donne la valeur de chaque marqueur
$ajout_etd->bindValue(':nom',$nom);
$ajout_etd->bindValue(':prenoms',$prenoms);
$ajout_etd->bindValue(':sexe_etd',$sexe);
$ajout_etd->bindValue(':tel',$telephone);
$ajout_etd->bindValue(':email',$mail);
$ajout_etd->bindValue(':password',$mdp);

//4. Exécution de la requête
$resultat = $ajout_etd->execute();

//5. Si la requete est bien exécutée
if($resultat){
	echo 'Enregistrement réussi <br />';
	echo '<a href="etudiant.php">Retour / Ajouter un autre étudiant </a>';
	}
}

//6. S'il y a eu des erreurs
catch( Exception $e ){
	echo 'Erreur de requête : ', $e->getMessage();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "www.w3.org/TR/html4/loose.dtd">
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"=content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
    <title>Geeks du net - Boutique de l'informatique</title>
</head>

<body><center>

<form action= "etudiant.php" method="POST">
    <section id="connexion" class="connexion">
 <h1 class="connexion">Connexion</h1>
 
 <label><b>Nom d’utilisateur</b></label>
 <input type= "text" placeholder="Entrer le nom d’utilisateur" name="username" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="password" required>

 <input type="submit"  id='submit' value='LOGIN' >

 <?php
 If(isset($_GET['erreur'])){
 $err = $_GET['erreur'] ;
 If($err==1 || $err==2)
 Echo "<p style='color :red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
  </section>
    <section id="home" class="home-container">
        <header id="header" class="header">
            <img src="images/LOGOIH.png" alt="Informatique" class="logo">
            <img class"image-clignote" src"images/logo.png" />
            <ul class="nav-links">
                <li>
                   <h1><a href="#" data-text="Accueil">Accueil</a></h1>
                </li>
                <li>
                    <a href="#informations" data-text="Nos formations">Nos formations</a>
                </li>
                <li>
                    <a href="#plants" data-text="Nos expériences">Nos expériences</a>
                </li>
                <li>
                    <h1><a href="#informatique" data-text="Blog">Blog</a></h1>
                </li>
            </ul>
            <div class="burger-container">
                <div class="burger"></div>
            </div>

        </header>
        <div class="landing">
            <h1 class="big-title">INFORMATIQUE - HACKING</h1>
            <a href="#delivery" class="delivery-link">
                <span class="scroll-text" data-text="Scroll">Scroll</span>
                <i class="scroll-icon fas fa-angle-down"></i>
            </a>
        </div>
    </section>
    <div class="marquee">
       <b>ANNONCE :</b> <span> Bienvenue chez Informatique - Hacking, le site du numérique, du digital et l' Informatique</span>
    </div>
    <section id="delivery" class="delivery-container">

        <div class="shop">
            <i class="delivery-icon fas fa-store"></i>
            <p class="box-content">
                La qualité notre parole
            </p>
        </div>
        <div class="withdrawal">
            <i class="delivery-icon fas fa-people-carry"></i>
            <p class="box-content">
                Formation en ligne
            </p>
        </div>
        <div class="delivery">
            <i class="delivery-icon fas fa-truck"></i>
            <p class="box-content">
                Formation en présentiel
            </p>
        </div>
    </section>
    <section id="best-sales" class="best-sales-container">
        <h1 class="section-title">Notre Expertise</h1>
        <div class="best-plants">
            <a href="#" class="plant-box no-grid plant1">
                <div class="plant-bio">
                    <h1 class="plant-name">Informatiques</h1>
                    <h3 class="plant-price">15,6€</h3>
                </div>
            </a>
            <a href="#" class="plant-box no-grid plant2">
                <div class="plant-bio">
                    <h1 class="plant-name">Sécurité Réseau</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
            <a href="#" class="plant-box no-grid plant3">
                <div class="plant-bio">
                    <h1 class="plant-name">Photoshop & Illustrator</h1><video src="images/L4 Illustrator PART 1.mp4" controls autoplay preload="metadata" poster="images/Capture d’écran (2).png" width="100" height="100"></video>
                    <h3 class="plant-price">17€</h3>
                </div>
            </a>
            <a href="#" class="plant-box no-grid plant4">
                <div class="plant-bio">
                    <h1 class="plant-name">Community Manager</h1>
                    <h3 class="plant-price">17€</h3>
                </div>
            </a>
        </div>

    </section>
    <br />
    <section id="informations" class="formations">
    <p>
        <h1><a href="#best-sales" data-text="Nos formations">A PROPOS DES FORMATIONS</a></h1>
        <br />
    </p>
    <h2><b>Informatique :</h2></b> Au cours de cette formation, vous serez capable de<br />
    <li>Maitriser les concepts de base de l'informatique et de l'ordinateur;</li>
    <li>De connaitre et se familiariser avec l'environnement informatique(materiels et logiciels);</li>
    <li>D'etre en mesure de faire ses traveaux ...;</li>
    <br />
    <p><strong>Quel est l'importance d'apprendre l'informatique?</strong></p>
    <p><strong>L'informatique est</strong> indispensable pour trouver du travail et évoluer profesionnellement. 
        Presque toutes les entreprises exigent que leurs employés puissent utiliser des ordinateurs. De plus de postes nécessitent l'utilisation de l'outil <strong>informatique</strong></p>
    <br />
    <h2><b>Réseau Sécurité :</h2></b> Au cours de cette formation, vous serez capable de déployer des moyens de protection pour que les outils <strong>informatiques</strong> d'une entreprise, d'une administration ou tout simplement d'un particulier ne soient pas infectés.<br />
    <br />
    <p><strong>Quel est l'importance d'apprendre la Sécurité informatique?</strong></p>
    <p><strong>Une formation en cybersécurité</strong> est la solution idéale pour se prémunir contre les attaques <strong>informatiques</strong> en protégeant suffisamment son ordinateur et sa connexion Internet pour constituer une sorte de carapace qui saura assurer la sécurisation de son outil de travail contre les différentes menaces...</p>
    <br />
    <h2><b>Photoshop & Illustrator :</h2></b>Cette formation s'adresse à toutes les personnes voulant obtenir des connaissances dans la création de publication assistée par l'ordinateur pour modifier, retoucher et corriger des photographies, réaliser des créations vectoriels ou encore réaliser des documents interactifs ou pour l'impression. .<br />
    <br />
    <p><strong>Quel est l'importance d'apprendre Photoshop & Illustrator?</strong></p>
    <p><strong>Une formation en Photoshop & Illustrator</strong> <strong>Photoshop</strong> est un logiciel qui sert à la retouche et au traitement d'images.
    Edité par Adobe, on l'utilise principalement pour le traitement des photographies numériques. Apprécié des photographes, graphiste, le logiciel
    permet de travailler essentiellement sur des images matricielles. <strong>Illustrator</strong> c'est l'application d'illustration vectorielle de référence qui permet de créer des logos,
    des icones, des dessins, des typographies et des illustrations complexes pour tout type de support.</p>
    <br />
    <h2><b>Community Manager :</h2></b>Cette formation s'adresse à toutes les personnes, des salariés ou des travailleurs indépendants, à l'utilisation des réseaux sociaux à des fins professionnels.<br />
    <br />
    <p><strong>Quel est l'importance d'apprendre Community Manager ou CM?</strong></p>
    <p><strong>Une formation en Community Manager</strong> Cette formation doit en effet pouvoir aider l'entreprise à atteindre ses objectifs marketing ( et vente), comme par exemple apporter du trafic
        sur votre site Internet, attirer des prospects qualifiés, ou encore transformer ces prospects en clients.
    </section>    
    <section id="plants" class="plants-container">
        <h1 class="section-title">Nos equipements informatiques</h1>
        <div class="grid-plants">
            <a href="#" class="plant-box grid plant-grid1">
                <div class="plant-bio">
                    <h1 class="plant-name">Imprimantes</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
            <a href="#" class="plant-box grid plant-grid2">
                <div class="plant-bio">
                    <h1 class="plant-name">Ecouteurs</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
            <a href="#" class="plant-box grid plant-grid3">
                <div class="plant-bio">
                    <h1 class="plant-name">Souris</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
            <a href="#" class="plant-box grid plant-grid4">
                <div class="plant-bio">
                    <h1 class="plant-name">Claviers</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
            <a href="#" class="plant-box grid plant-grid5">
                <div class="plant-bio">
                    <h1 class="plant-name">Disques durs</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
            <a href="#" class="plant-box grid plant-grid6">
                <div class="plant-bio">
                    <h1 class="plant-name">RAM</h1>
                    <h3 class="plant-price">29,99€</h3>
                </div>
            </a>
        </div>
        <section id="informatique" class="informatique">
            <h1>À propos de l'auteur</h1>
           <figure> <img src="images/bulle.png" alt="" id="fleche_bulle" />
            <p id="photo_admin"><img src="images/yao.jpg" width="200" height="200" alt="#" /></p><figcaption><b><mark>Photo de L'admin</mark></b></figcaption></figure>

            <p><em>Donner moi le temps de me présenter&nbsp;:</em></p><br /><li>Je suis Venceslas Armel Yao,</li> je suis né un 17 février 1995.</p>
            <p>Etudiant en <strong>Réseau Sécurité Informatique</strong>, certifié en infographie, en Community Manager. Je mettrai mon expertise aux personnes désireuses d'apprendre l'informatique et le numérique. <b> Ma Vision est de faire un monde au numérique</b></b></p>
            <p><img src="images/nos_plantes/facebook.png" alt="Facebook" /><img src="images/twitter.png" alt="Twitter" /><img src="images/vimeo.png" alt="LinkindIn" /><img src="images/flickr.png" alt="whatsapp" /><img src="images/rss.png" alt="RSS" /></p>
            <p><a href="mailto:yaoarmel0@gmail.com" title="Envoyer un mail">Envoyer un mail</a></p><p><a href="ZOZOR/Zozor.html" title="Franchissez">La Blog des Geeks</a></p>
      <form method="post" action="">
          <p>
              <label for="ameliorer">Comment pensez-vous que je pourrais améliorer mon site ? </label><br />
              <textarea name="ameliorer" id="ameliorer" rows="10" cols="50" /*required*/></textarea><br />
              <br />
              <input type="submit" value="Envoyer" />
          </p>
      </form>
    </section>
    </section>
    <footer id="footer" class="footer">
        <span class="copyrights">&copy; <strong>2022</strong> - Informatique-Hacking</span>
        <a href="#" class="conditions">Condition générales</a>
    </footer>
    <script>
        const burgerContainer = document.querySelector('.burger-container');
        const navLinks = document.querySelector('.nav-links');

        burgerContainer.addEventListener('click', () => {
            burgerContainer.classList.toggle('active');
            navLinks.classList.toggle('active');
        })
        
 </script>
</form>

</center></body>

</html>
