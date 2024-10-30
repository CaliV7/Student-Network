
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="info.php">
    <title>Inscription</title>
</head>

<body>
    <div></div>
    <form action="" method="post">
        <h1>Formulaire d'Inscription</h1>
        <label id="login" for="login">Login:</label>
        <input name="login" placeholder="Votre Login" type="text" require>
        <br>
        <label id="nom" for="name">Nom:</label>
        <input name="name" placeholder="Votre Nom" type="text" require>
        <br>
        <label id="prenom" for="firstname">Prenom:</label>
        <input name="firstname" placeholder="Votre Prenom" type="text" require>
        <br>
        <label id="email" for="email">Email :</label>
        <input name="email" type="email" placeholder="Votre Email" require>
        <br>
        <label id="password" for="password">Password:</label>
        <input name="password" placeholder="Votre mot de passe" type="password" require>
        <br>
        <button>Valider</button>
    </form>
    <a href="http://"></a>
    </div>

    <?php

    $login = $_POST['login'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Creation variable pour serveur
    $host="localhost";
    $bddname="Reseau.So";
    $username="root";
    $password="root";



    try {
        $pdo = new PDO("mysql:host=$host;dbname=$bddname;charset=utf8", $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        echo "Erreur de connexion : " . $e->getMessage();
    }

    $requete_sql = "INSERT INTO users (login_users,name_users,firstname_users,email_users,password_users) 
    VALUES ( :login_users,:name_users,:firstname_users,:email_users,:password_users)";

        $secure_requete = $pdo->prepare($requete_sql);
   
    $secure_requete->bindParam(":login_users", $login);
    $secure_requete->bindParam(":name_users", $name);
    $secure_requete->bindParam(":firstname_users", $firstname);
    $secure_requete->bindParam(":email_users", $email);
    $secure_requete->bindParam(":password_users", $password);

        try {
            if ($secure_requete->execute()) {
                echo "Inscription réussie !";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
        }
        
   ?>
</body>

</html>
