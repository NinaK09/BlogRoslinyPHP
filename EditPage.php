<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edycja postu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                <meta name="author" content="" />
                <!-- Favicon-->
                <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
                <!-- Bootstrap icons-->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
                <!-- Core theme CSS (includes Bootstrap)-->
                <link href="css/moje.css" rel="stylesheet" />
                <link href="css/styles2.css" rel="stylesheet" />
    </head>
    <body>
        <?php
        include('klasy/Baza.php');
        include('klasy/LoginFunc.php');
        $db = new Baza("localhost", "root", "", "blog");
        $lp = new LoginFunc();
        
               
        if(filter_input(INPUT_GET, "akcja")=="edit"){
            if(filter_input(INPUT_GET, "postId")){ //czy jest ustawiony postId do usuniecia (by nie usuwac z paska)
                $postId2 = $_GET["postId"];
                $lp->Ehtml($postId2, $db);
            }
        }
        
        session_start();
        $idSession = session_id();
        $idUser = $lp->getLoggedInUser($db, $idSession);
        
        if ($idUser > -1) {
            if (filter_input(INPUT_POST, 'confEditPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                //weryfikacja i update
                $postId2 = $_POST["postId"];
                $lp->verifyEdit($db, $postId2);
            }
        }
        else{
            header("location:login.php"); //gdy sie nie zaloguje (nie ma go w loggedusers) to wraca do login
        }
        ?>
    </body>
</html>
