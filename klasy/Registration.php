<?php

class Registration {
    
    function checkInput($db){
        $args = ['userName' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']], 
            'passwd' =>['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp'=> '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'mail' => ['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^[a-zA-Z0-9_]+@[a-zA-Z0-9\-+\.[a-zA-Z0-9\-\.]+$/']]  
        ];
        
        $dane = filter_input_array(INPUT_POST, $args); //filtr danych
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
            $errors .= $key . " ";
            }
        }

        if ($errors === "") {//Dane poprawne - nowy rekord
            $passwdH = password_hash($dane["passwd"], PASSWORD_DEFAULT); //hash
            $sql = "INSERT INTO blogusers (Id, Username, Passwd, Email) VALUES (NULL, '{$dane["userName"]}', '{$passwdH}', '{$dane["mail"]}')";
            $db->insert($sql);

        } else { //Komunikat z blednymi polami
            $message = "Błędne dane: $errors";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
    
    //HTML rejestracji
    public function __construct() {
        ?>
        <!DOCTYPE html>
                <!-- Navigation-->
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
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="img/slide1.png" class="d-block w-100" alt="slide1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img/slide2.png" class="d-block w-100" alt="slide2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img/slide3.png" class="d-block w-100" alt="slide3">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img/slide4.png" class="d-block w-100" alt="slide4">
                                        </div>
                                    </div>
                                </div></div>
                            <div class="col-md-6">
                                <h1 class="display-5 fw-bolder">Zarejestruj się!</h1>
                                <div class="fs-5 mb-5">
                                    <span>Dołącz do grona fanów. Zyskaj możliwość komentowania artykułów oraz poznaj rady naszych specjalistów.</span>
                                </div>
                                <div class="lead">
                                    <form action="register.php" method="post">
                                        <table>

                                            <tr>
                                                <td>Nazwa użytkownika: </td>
                                                <td><input id="userName" name="userName" type="text"></td>

                                            </tr>
                                            <tr>
                                                <td>Hasło: </td>
                                                <td><input id="passwd" name="passwd" type="password"></td>
                                            </tr>
                                            <tr>
                                                <td>Adres e-mail: </td>
                                                <td><input id="mail" name="mail" type="email"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><a href="login.php">Mam już konto</a></td>
                                            </tr>
                                            <tr class="prawo">
                                                <td colspan="2">
                                                    <input type="submit" value="Rejestruj" name="submit"/>
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
        <?php
    }
}
