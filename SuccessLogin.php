<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Strona Uzytkownika</title>
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
        
        //parametr z GET – akcja = wyloguj 
        if (filter_input(INPUT_GET, "akcja")=="wyloguj") { 
            $lp->logout($db);    
        }
        
        if(filter_input(INPUT_GET, "akcja")=="usun"){
            if(filter_input(INPUT_GET, "postId")){ //czy zostal ustawiony postId do usuniecia (by nie usuwac z paska)
                $db->usunPost();
            }
        }
  
        session_start();
        $idSession = session_id();
        $idUser = $lp->getLoggedInUser($db, $idSession);
        
         //if(id>-1) jest wazne, bo inaczej mozna wejsc z paska
        if($idUser > -1){
            $lp->loggedInPage($idUser, $db, $lp);
            }

        else{
            header("location:login.php"); //gdy sie nie zaloguje (nie ma go w loggedusers) to wraca do login
        }

        ?>
    </body>
</html>
