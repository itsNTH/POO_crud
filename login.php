<?php
include 'User.php';
var_dump($_POST);
$user = new User([
    'email' => $_POST['email'],
    'password' => $_POST['password']


]);


$user->connexion();


if ($user) {

    session_start();         
    echo "Connexion réussie";
    header('Location: index.php');
} else {
    echo "Echec d'enregistrement";
}