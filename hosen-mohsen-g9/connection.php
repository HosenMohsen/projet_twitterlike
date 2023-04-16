
<?php


$pdo = new PDO('mysql:host=localhost;dbname=esport-blog', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>MyEsportBlog - Connexion </title>
</head>

<body id="Body1">
    <main>
        <div id="Formulaire" class="form_formulaire">
            <div>
                <img class="form_logo" src="./images/MyEsportBlog.png" alt="Logo MyEsportBlog">
            </div>
            <div class="form_titre">MyEsportBlog</div>
            <div class="inputs">
                <form method="post">
                    <label class="form-label"> PSEUDO </label>
                    <input  class="form-control" type="text" placeholder="Ident123" name="pseudo" minlength="2" required />
                    <label class="form-label"> ADRESSE MAIL</label>
                    <input  class="form-control" type="email" placeholder="example@gmail.com" name="adresse_mail" minlength="6" required />
                    <label>MOT DE PASSE</label>
                    <input class="form-label" type="password" placeholder="Min 6 caractères" minlength="6" name="mot_de_passe" required />
                    <button class="form_button button_submit" type="submit" name="connexion"> CONNEXION</button>
                </form>
            </div>
        </div>
               


    </main>
    <script src="https://kit.fontawesome.com/30e89f8594.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>

<?php

if (isset($_POST['connexion'])){
  $adresse_mail = $_POST['adresse_mail'];
  $mot_de_passe = $_POST['mot_de_passe'];
  $pseudo = $_POST['pseudo'];

  $query = "SELECT * FROM utilisateur WHERE adresse_mail = :adresse_mail AND  pseudo = :pseudo ";
  $stmt =  $pdo->prepare($query);
  $stmt->execute([
    "adresse_mail" => $adresse_mail,
    "pseudo" => $pseudo
  ]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
/*   var_dump($user); */

  if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {

    $pseudo = $user['pseudo'];
    $user_id = $user['id_utilisateur'];

    $_SESSION['nom'] = $user['nom'];
    $_SESSION['pseudo'] = $user['pseudo'];
    $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
    $_SESSION['age'] = $user['age'];
    $_SESSION['adresse_mail'] = $user['adresse_mail'];
    

   

    $_SESSION["pseudo"] = $pseudo;
/*     var_dump($_SESSION); */
    header('Location: index.php');
    exit; 
  } else {
    $erreur = "Identifians incorrects";
        echo "<div class=' alert alert-danger'>";
         echo  $erreur; 
        echo "</div>"; 
  } }
 
     ?>   
  
 
