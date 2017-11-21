<?php

if(!isset($_POST['username'], $_POST['password']))
{
    $message = 'Vul je gebruikersnaam en wachtwoord in!';
}

elseif (strlen( $_POST['username']) > 12 || strlen($_POST['username']) < 4)
{
    $message = 'Je gebruikersnaam moet minimaal 4 en mag maximaal 12 karakters bevatten!';
}

elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 6)
{
    $message = 'Je wachtwoord moet minimaal 6 en mag maximaal 20 karakters bevatten!';
}

elseif (ctype_alnum($_POST['username']) != true)
{
    $message = "Je gebruikersnaam mag alleen alfanumerieke karakters bevatten!";
}

elseif (ctype_alnum($_POST['password']) != true)
{
    $message = "Je wachtwoord mag alleen alfanumerieke karakters bevatten!";
}

else
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $password = hash('sha512', $password);

        $stmt = $conn->prepare("INSERT INTO users (username, password ) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 128);

        $check_if_exists = $conn->prepare("SELECT username FROM users WHERE username=:username");
        $check_if_exists->bindParam(':username', $username, PDO::PARAM_STR);
        $check_if_exists->execute();
        $result = $check_if_exists->fetchAll();

        if (count($result) > 0) {
          $message = "Gebruiker bestaat al!";
        }
        else{
          $stmt->execute();
          $message = "Je bent geregistreerd!";
        }
}
  echo '<p id="message">'. $message .'<p>';

 ?>
