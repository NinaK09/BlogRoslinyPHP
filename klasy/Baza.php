<?php

class Baza {

    private $mysqli; //uchwyt

    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n", $this->mysqli->connect_error);
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
            //udało sie :)        
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    //========SELECTS============
    public function select($sql, $pola) {      
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól             
            $ile = $result->num_rows; //ile wierszy             
            // pętla biegnąca po wyniku zapytania $results             
            $tresc .= "<table><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close();
        }
        return $tresc;
    }
    
    public function selectDeleteButton($sql, $pola) {       
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól             
            $ile = $result->num_rows; //ile wierszy             
            // pętla po wyniku zapytania $results             
            $tresc .= "<table>"."<th>Tytuł:</th><th>Treść:</th><th>Data dodania:</th>"."<tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    if($i==0){
                        $b =$pola[$i];
                    }
                    if($p != "postId"){ //postId jest zbedny dla uzytkownika
                    $tresc .= "<td>" . $row->$p . "</td>";}
                }
                $rec = $row->$b;
                $tresc .="<td><a class='Abutton' href='SuccessLogin.php?akcja=usun&postId={$rec}'>Usuń</a></td>";
                $tresc .="<td><a class='Abutton' href='EditPage.php?akcja=edit&postId={$rec}'>Edytuj</a></td>";
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close();
        }
        return $tresc;
    }
    
    function usunPost(){
        
        $sql="DELETE FROM posts WHERE postId=".$_GET["postId"].';';
        $this->delete($sql);
        header("location:SuccessLogin.php");
    }

    public function selectNoTable($sql, $pola) {       
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól             
            $ile = $result->num_rows; //ile wierszy             

            while ($row = $result->fetch_object()) {
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= $row->$p;
                }
            }
            $result->close();
        }
        return $tresc;
    }
    
    //================================== 
    public function onlineUsersNum($sql){
        $users = 0;
        if ($result = $this->mysqli->query($sql)) {
            $users=mysqli_num_rows($result);
        }
        return $users;
    }

    public function delete($sql) {
        if ($this->mysqli->query($sql))
            return true;
        else
            return false;
    }
    
    public function update($sql) {
        if ($this->mysqli->query($sql))
            return true;
        else
            return false;
    }

    public function insert($sql) {
        if ($this->mysqli->query($sql))
            return true;
        else if ($this->mysqli->query($sql))
            return false;
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function selectUser($login, $passwd, $tabela) {
        //$login -> Username
        //$passwd -> Passwd
        //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami 
        //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne 
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE Username='$login';";
        if ($result = $this->mysqli->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem 
                $hash = $row->Passwd; //pobierz zahaszowane hasło użytkownika  
                //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych: 
                if (password_verify($passwd, $hash))
                    $id = $row->Id; //jeśli hasła się zgadzają - pobierz id użytkownika 
            }
        }
        return $id;   //id zalogowanego użytkownika(>0) lub -1 
    }

}
