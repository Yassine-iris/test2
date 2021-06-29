<?php
require_once "../api/app/assets/includes/header.php"
?>

<?php require_once './objects/user.php'; ?>
<?php require_once './config/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Users</title>
    <link href="./app/assets/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="container">
        <div class="top">
            <h1>Bienvenue sur la page des utilisateurs</h1>
            <h1>ici vous pouvrrez ajouter, modifier, supprimer ou afficher les tâches d'un utilisateur.</h1>
            <h1>Add a new User</h1>
        </div>
        <div class="formulaire">
            <form action="" method="post">
                <input type="text" id="name" name="name" value="">
                <input type="email" id="email" name="email" value="">
                <button class="btn" type="button" id="create">Save</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>ada</td>
                    <td><span><a href="tache.php?id=">Afficher les taches</a></span></td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>ada</td>
                    <td><span><a href="tache.php?id=">Afficher les taches</a></span></td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>ada</td>
                    <td><span><a href="tache.php?id=">Afficher les taches</a></span></td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>ada</td>
                    <td><span><a href="tache.php?id=">Afficher les taches</a></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>


<?php
require_once "../api/app/assets/includes/footer.php"
?>
</html>