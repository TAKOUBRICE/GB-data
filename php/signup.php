<?php

require "./database.php";
$db = new database();


function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) ){
    $email = checkInput($_POST["email"]); // variable email
    $pass = checkInput($_POST["password"]);	// variable mot de passe
    $username = checkInput($_POST["name"]); //variable nom
    $no_empty = true; 

    

    if($no_empty == true) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
            if($user){
                echo "Email existe déjà !\n";
            }else{

                if (strlen($pass) < 5){
                    echo "Le mot de passe doit contenir au moins 5 caractère!! \n";
                    
                }else{
                    
                    $date = date('Y-m-d H:i:s');
                    $password = password_hash($pass, PASSWORD_DEFAULT);
                
                    $sql ="INSERT INTO users (username, email,password, status, date_start) VALUES (:username, :email,:password, :status,:date_start)";
                    $stmt = $db->execute($sql, [
                            ':username' => $username,
                            ':email'    =>$email,
                            ':password' => $password,
                            ':status' => 0,
                            ':date_start' => $date      
                    ]);
                     
                   
                    if($stmt){
                        echo 1;
                    }else{
                        echo 'Erreur lors de l\'inscription!' ;
                    }
                    
                }
            }

        }else{
            echo "Email non valide !!\n";
        }
    }
}
    


?>
