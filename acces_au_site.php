<body><center>

<form action= "index.php" method="POST">
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