<?php
require './database.php';
session_start();
$db = new database;

//modification du status dans la base de donnée
$no_online = 0;
$user = $_SESSION['user_GB']['user_email'];

$query = "UPDATE users SET status ='$no_online' WHERE email = '$user'  ";                        
$result = $db->execute($query, []) or die('Erreur');	

if($result){
    $_SESSION = array();
    // Finalement, détruire la session.
    session_destroy();

   // Rediriger vers la page de principale.
    header('Location: ../index.php');
exit;
}

?>
