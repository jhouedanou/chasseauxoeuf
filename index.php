<?php include('header.php'); ?>
    <?php
        //get the username and the email from the url 
        $username = htmlspecialchars($_GET['username']);
        $email = htmlspecialchars($_GET['email']);
        //set a php cookie with the username 
        setcookie("username", $username, time() + (86400 * 30), "/");
        //set a php cookie with the email
        setcookie("email", $email, time() + (86400 * 30), "/");
        //get the current date and timer
        $date = date("d-m-Y");
        setcookie('datedujour', $date, time() + (86400 * 30), "/");
        //get the ip adress
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        echo $ip;
        //if $email is empty 
        //verify is username and email are set correctly
        if (!empty($email)) {
            //connect to the database
            $db = new PDO('mysql:host=localhost;dbname=easteregg;charset=utf8', 'root', 'root');
            //verify if the username and email are already in the database for the current date
            $query = $db->prepare('SELECT * FROM joueurs WHERE username = :username AND email = :email AND date = :date OR ip = :ip');
            $query->execute(array(
                'username' => $username,
                'email' => $email,
                'date' => $date,
                'ip' => $ip
            ));
            //if the username and email are already in the database for the current date, make a php redirection to the page adejoue.php
            if ($query->rowCount() > 0) {
                header('Location: iladejajoue.php');
            }else{
                //if the username and email are not the database, let him play by showing the jeu.php include
                include('jeu.php');
                //also add his/her email, username, date to the database if it does not exists already in the database
                $query = $db->prepare('INSERT INTO joueurs (username, email, date,ip) VALUES (:username, :email, :date,:ip)');
                $query->execute(array(
                    'username' => $username,
                    'email' => $email,
                    'date' => $date,
                    'ip' => $ip
                ));

            }
        } else {
            //make  a php redirection to the page reserve.php
            header('Location: reserve.php');
        }
    ?>
<?php include('footer.php'); ?>