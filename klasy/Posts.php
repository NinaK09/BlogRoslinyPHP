<?php

class Posts {
    
    public function NewPost() {
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container px-4 px-lg-5">
                        <a class="navbar-brand" href="index.html">Ogród pełen żab</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                               
                                <li class="nav-item"><a class="nav-link" href="SuccessLogin.php">Strona główna dla uzytkownika</a></li>
                                <li class="nav-item"><a class="nav-link" href="postsArch.php">Nowy post</a></li>
                                <li class="nav-item"><a class="nav-link active" aria-current="page" href='login.php?akcja=wyloguj'>Wyloguj</a></li>
                            </ul>

                        </div>
                    </div>
                </nav>
<section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
        
        <form action="postsArch.php" method="post">
            <h5>Tytuł: </h5>
            <input id="title" name="title" type="text" class = "fullT">
            <h5>Treść: </h5>
            <input id="postW" name="postW" type="text" class = "fullW">
            <input type="submit" value="Dodaj Post" name="newPost"/></br>
        </form>
        <form action ="SuccessLogin.php">
            <input type="submit" value="Wroc do konta" name="returnP"/>
            </form>
                            </div>
                        </div>
                    </div>
                    <div id="admin" class="row gx-4 gx-lg-5 align-items-center">
   
        
            </div>
                </section>
                <?php
    }
    
    function verify($idUser, $db){
        $args = ['title' =>['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[\s\S]{2,255}$/']],
                'postW' =>['filter' => FILTER_VALIDATE_REGEXP,
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
            $data = new DateTime();
            $date = $data->format("Y-m-d H:i:s");
            $sql = "INSERT INTO `posts` (postId, userId, title, text, postDate) VALUES (NULL, {$idUser}, \"{$dane['title']}\", \"{$dane['postW']}\", \"{$date}\");";
            echo "{$sql}";
            $db->insert($sql);
            header("location:SuccessLogin.php");

        } 
        else {
            $message = "Błędne dane: $errors";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
    
    function removePost($db, $postId){
        $sql = "DELETE FROM posts WHERE postId = '{$postId}';";
        $db->delete($sql);
    }
}
