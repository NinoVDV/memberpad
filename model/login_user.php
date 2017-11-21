<?php
if(isset( $_SESSION['user_id'] ))
{
    $message = 'Je bent al ingelogd!';
}

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

        $stmt = $conn->prepare("SELECT id, username, password FROM users
                    WHERE username = :username AND password = :password");

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 128);

        $stmt->execute();
        $user_id = $stmt->fetchColumn();

        if(count($user_id) == 0)
        {
            $message = 'Inloggen is niet gelukt!';
        }
        else
        {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            header('Location: ?page=account');
        }
}
echo '<p id="message">'. $message .'<p>';

 ?>
