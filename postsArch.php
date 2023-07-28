<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Archiwum postów</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles2.css" rel="stylesheet" />
        <link href="css/moje.css" rel="stylesheet" />
    </head>
    <body>
        <?php
        include('klasy/Baza.php');
        include('klasy/Posts.php');
        include('klasy/LoginFunc.php');
        $db = new Baza("localhost", "root", "", "blog");
        $lp = new LoginFunc();
        $pa = new Posts();

        session_start();
        $idSession = session_id();
        $idUser = $lp->getLoggedInUser($db, $idSession);
        
        if (filter_input(INPUT_GET, "akcja")=="wyloguj") { 
            $lp->logout($db); 
        }
        
        if ($idUser > -1) {
            $pa->NewPost();
            if (filter_input(INPUT_POST, 'newPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                $pa->verify($idUser, $db); //weryfikacja i dodanie do tabeli 
            }
        }
        else{
            header("location:login.php"); //gdy sie nie zaloguje (nie ma go w loggedusers) to wraca do login
        }
        ?>
    </body>
</html>
