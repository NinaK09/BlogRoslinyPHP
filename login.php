<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Zaloguj sie</title>
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
        include('klasy/LoginFunc.php');
        $db = new Baza("localhost", "root", "", "blog");
        $lp = new LoginFunc();
        session_start();
        
        //parametr z GET – akcja = wyloguj 
        if (filter_input(INPUT_GET, "akcja")=="wyloguj") { 
            $lp->logout($db); 
        }
        
        if(isset($_SESSION['userId'])){ //gdy user jest zalogowany
            header("location:SuccessLogin.php");
        }
        else{
       //kliknięto submit z name = zaloguj 
            if (filter_input(INPUT_POST, "zaloguj")) { 
                $userId=$lp->login($db);
                if ($userId > 0) { 
                    header("location:SuccessLogin.php"); //gdy logowanie sie powiodlo
                } 
                else { 
                    $message = "Błędny login bądź hasło";
                    echo "<script type='text/javascript'>alert('$message');</script>"; 
                    $lp->mainPage(); //Pokaż ponownie formularz logowania  
                } 
            } 
            else { 
                //Html strony (pierwszy raz)
                $lp->mainPage(); 
            } 
        }
        ?>
    </body>
</html>
