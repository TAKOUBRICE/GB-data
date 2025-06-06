<?php
require "./database.php";
session_start();
$db = new database;


function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
 if(isset($_POST['email']) && isset($_POST['password']) ){
    $email = checkInput($_POST['email']);
    $password = checkInput($_POST['password']);
    // verification du numéro d'utilisateur
     
    $sql = "SELECT * FROM users WHERE email = :email";
    $user = $db->query($sql,['email' => $email]);
    if ($user){
       if(password_verify($password, $user['password'])){
            $_SESSION['user_GB']['user_id'] = $user['id']; 
            $_SESSION['user_GB']['user_email'] =  $user['email'];
            $_SESSION['user_GB']['user_name'] = $user['username'];
            $_SESSION['user_GB']['user_status'] = "En ligne";
            $_SESSION['user_GB']['user_date'] = $user['date_start'];
            
            $online = 1;
           
            $query = "UPDATE users SET status= '$online' WHERE email ='$email' "; 
            $stat = $db->execute($query, []) or die('Errorr, un problème est survenu lors de la connexion!');
           
           echo 1;
        }else{
           echo 'mot de passe est incorrecte';
       }
        
    } else {
        echo 'email incorrete';
    }
}
    
    
    

    
    //cas ou le numéro et le mot de passe est vide

//if(isset($_COOKIE['userid'])){
//$userid = $_COOKIE['userid'];
//$useremail = $_COOKIE['useremail'];}
?>
