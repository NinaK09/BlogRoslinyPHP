<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Zarejestruj sie</title>
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
        include('klasy/Registration.php');
        include('klasy/Baza.php');
        $reg = new Registration();
        $db = new Baza("localhost", "root", "", "blog");

        if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) { //jak zostanie nacisniety button name='submit'
            $user = $reg->checkInput($db);
            if ($user != NULL) {
                //komunikat z checkUser informuje jak cos zostalo zle wprowadzone
                $message = "Konto zostało stworzone";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        ?>
    </body>
</html>
