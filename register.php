<?php      
include 'User.php';
var_dump($_POST);
$user = new User ([
'nom' => $_POST['nom'], 
'prenom' => $_POST['prenom'],
'password' => $_POST['password'], 
'email' => $_POST['email']]);
$user->ajouter();


if ($user) {
    session_start();    
    echo "Enregistrement réussi";
    header('Location: index.php');
} else {
    echo "Echec d'enregistrement";
}