<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/moje.css" rel="stylesheet" />
    </head>
    <body>
        <?php
        include('klasy/FrontPage.php');
        $front = new FrontPage();
        ?>
    </body>
</html>
