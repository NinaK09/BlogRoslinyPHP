<?php

class LoginFunc {

    //==========LOGOWANIE=============
    function login($db) {
        //funkcja sprawdza poprawność logowania  
        //zwracana wartosc - id użytkownika zalogowanego lub -1 
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'passwd' => FILTER_SANITIZE_ADD_SLASHES
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "blogusers"); //funkcja zwracajaca id!=-1 gdy uzytkownik istnieje
        if ($userId >= 0) { //Gdy zostaly podane poprawne dane  
            session_start();
            $_SESSION['userId']=$userId;
            //usuń wszystkie wpisy historyczne dla użytkownika o $userId 
            $sql = "DELETE FROM loggedusers WHERE userId= $userId;";

            $db->delete($sql);
            $data = new DateTime();
            $date = $data->format("Y-m-d H:i:s");

            $SessionId = session_id();
            $sql2 = "INSERT INTO loggedusers (sessionId, userId, lastUpdate) VALUES ('{$SessionId}', '{$userId}', '{$date}');";
            $db->insert($sql2);    
        }
        return $userId;
    }
    
    function logout($db) {
        session_start();
        $id = session_id();
        //usuń sesję (łącznie z ciasteczkiem sesyjnym) 
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        //usuń wpis z id bieżącej sesji z tabeli
        $sql = "DELETE FROM loggedusers WHERE sessionId = '{$id}';";
        $db->delete($sql);
    }
    
        function getLoggedInUser($db, $sessionId) {
        $sql = "SELECT userId FROM loggedusers WHERE sessionId = '{$sessionId}';";

        $id = -1;
        if ($result = $db->getMysqli()->query($sql)){ //$db to uchwyt; $db->getMysqli() bo mysgli jest private
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem 
                $id = $row->userId; //zwracane id
            }
        }
        return $id; //user Id

    }
    
    //==========DIFF FUNC======
    public function powitanie($idUser, $db) {
        $nazwaUz = ["Username"];
        $sql = "SELECT Username FROM blogusers WHERE Id = {$idUser};";
        $name = $db->selectNoTable($sql, $nazwaUz);
        echo "<p>Witaj {$name}!</p>";
    }

    public function loggedUsersCount($db) {
        $sql="SELECT sessionId FROM loggedusers;";
        $online = $db->onlineUsersNum($sql);
        return $online;
    }
    
    function Ehtml($postId, $db){
        echo '
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container px-4 px-lg-5">
                        <a class="navbar-brand" href="index.html">Ogród pełen żab</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                               
                                <li class="nav-item"><a class="nav-link" href="SuccessLogin.php">Strona główna dla uzytkownika</a></li>
                                <li class="nav-item"><a class="nav-link" href="postsArch.php">Nowy post</a></li>
                                <li class="nav-item"><a class="nav-link active" aria-current="page" href=\'login.php?akcja=wyloguj\'>Wyloguj</a></li>
                            </ul>

                        </div>
                    </div>
                </nav>
<section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
        
        <form action="EditPage.php" method="post">
        <input name="postId" value="'.$_GET["postId"].'" type = "hidden">
            <h5>Tytuł: </h5> <!-- uzupelnij -->
            <input id="titleE" name="titleE" type="text" class = "fullT" value="';
        
        $sql = "SELECT title FROM posts WHERE postId ={$postId};";
        $pola = ["title"];
        $tresc = $db->selectNoTable($sql, $pola);
                echo "{$tresc}";
        
        echo'">
            <h5>Treść: </h5>
            <input id="postWE" name="postWE" type="text" class = "fullW" value="';
                
        $sql2 = "SELECT text FROM posts WHERE postId ={$postId};";
        $pola2 = ["text"];
        $tresc2 = $db->selectNoTable($sql2, $pola2);
                echo "{$tresc2}";
        echo'">
            <input type="submit" value="Zatwierdź edycję" name="confEditPost"/></br>
        </form>
        <form action ="SuccessLogin.php">
            <input type="submit" value="Wroc do konta" name="returnP"/>
            </form>
                            </div>
                        </div>
                    </div>
                    <div id="admin" class="row gx-4 gx-lg-5 align-items-center">
   
        
            </div>
                </section>';
                
    }
    
    function verifyEdit($db, $postId){
        $args = ['titleE' =>['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[\s\S]{2,255}$/']],
                'postWE' =>['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[\s\S]{2,255}$/']] 
            ];
        
        $dane = filter_input_array(INPUT_POST, $args); //filtr danych
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
            $errors .= $key . " ";
            }
        }

        if ($errors === "") {//Dane poprawne -> do bazy danych
            $sql = "UPDATE posts SET title =\"{$dane['titleE']}\", text =\"{$dane['postWE']}\" WHERE postId={$postId};";
            $db->update($sql);
            header("location:SuccessLogin.php");
        } 
        else {
            $message = "Błędne dane: $errors";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
    
    //=========ZAWARTOSCI STRONY===============
    //strona dla zalogowanego:
    public function loggedInPage($idUser, $db, $lp) {

        echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container px-4 px-lg-5">
                        <a class="navbar-brand" href="index.html">Ogród pełen żab</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                               
                                <li class="nav-item"><a class="nav-link" href="SuccessLogin.php">Strona główna dla uzytkownika</a></li>
                                <li class="nav-item"><a class="nav-link" href="postsArch.php">Nowy post</a></li>
                                <li class="nav-item"><a class="nav-link active" aria-current="page" href=\'login.php?akcja=wyloguj\'>Wyloguj</a></li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6">
                                <div>
                                <h3 class="center-by-me">Artykuły które mogą cię zainteresować: </h3>
                                <img src="img/placeholder.png" class="d-block w-100" alt="artykuly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                            <h1 class="display-5 fw-bolder">';
        $lp->powitanie($idUser, $db);

        echo '</h1>
                                <div class="fs-5 mb-5">
                                    <span></span>
                                </div>
                                <div class="lead">
                                    <div><p>Użytkowników Online: ';

        $onlineUsers = $lp->loggedUsersCount($db);
        echo "{$onlineUsers}";
        echo'</p></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="admin" class="row gx-4 gx-lg-5 align-items-center">
                    <h3>Twoje posty:</h3>';
        
        $sql = "SELECT * FROM posts WHERE userId = {$idUser};";
        $pola = ["postId","title", "text", "postDate"];
        $tresc = $db->selectDeleteButton($sql, $pola);
                echo "{$tresc}";    
        
        echo '<form action ="postsArch.php">
            <input type="submit" value="Nowy Post" name="NewPost"/>
            </form>
            </div>
                </section>
                <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Nina Krawczak 2022</p></div>
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->';
    }

    //strona z formularzem do logowania:
    public function mainPage() {
        ?>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container px-4 px-lg-5">
                        <a class="navbar-brand" href="index.html">Ogród pełen żab</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Strona główna</a></li>
                                <li class="nav-item"><a class="nav-link" href="register.php">Zarejestruj się</a></li>
                                <li class="nav-item"><a class="nav-link" href="login.php">Zaloguj się</a></li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6">
                                <img src="img/slide2.png" class="d-block w-100" alt="slide3">
                            </div>
                            <div class="col-md-6">
                                <h1 class="display-5 fw-bolder">Zaloguj się</h1>
                                <div class="fs-5 mb-5">
                                    <span></span>
                                </div>
                                <div class="lead">
                                    <form action="login.php" method="post">
                                        <table>

                                            <tr>
                                                <td>Login: </td>
                                                <td><input id="userName" name="login" type="text"></td>

                                            </tr>
                                            <tr>
                                                <td>Hasło: </td>
                                                <td><input id="passwd" name="passwd" type="password"></td>
                                            </tr>
                                            
                                            <tr class="prawo">
                                                <td colspan="2">
                                                    <input type="submit" value="Zaloguj" name="zaloguj"/>
                                                </td>
                                            </tr>

                                        </table>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="admin" class="row gx-4 gx-lg-5 align-items-center">
                    </div>
                </section>
                <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Nina Krawczak 2022</p></div>
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
        <?php
    }

}
