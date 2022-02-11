<?php 
    global $dbconn;

    function connection()
    {
        $dbconn = mysqli_connect('localhost', 'root', '', 'rentacardb');
        if(!$dbconn){
            die(mysqli_error($dbconn));
        }
        return $dbconn;
    }

    connection();

    function register($emri, $mbiemri, $nr_personal, $email, $telefoni, $adresa, $username, $password, $roli)
    {
        $dbconn = connection();
        $sql = "INSERT INTO klientet (emri, mbiemri, nr_personal, email, telefoni, adresa, username, password, roli)
        VALUE ('$emri', '$mbiemri', '$nr_personal', '$email', '$telefoni', '$adresa', '$username', '$password', '$roli')";
        $result = mysqli_query($dbconn, $sql);
        return $result;
        if($result){
            header('Location: login.php');
        }else{
            die("Nuk u realizua regjistrimi me sukses: " . mysqli_error($dbconn));
        }
    }


    function login($username, $password)
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            if(mysqli_num_rows($result)==1){
                $res = mysqli_fetch_assoc($result);
                if(password_verify($password, $res['password'])){
                    header("Location: index.php");
                    session_start();
                    $_SESSION['klientiid'] = $res['klientiid'];
                    $_SESSION['emri'] = $res['emri'];
                    $_SESSION['mbiemri'] = $res['mbiemri'];
                    $_SESSION['roli'] = $res['roli'];
                } else {
                    echo "<script>alert('Username ose password nuk jane ne rregull!');</script>";
                }
            }
        }
    }

    function checkUsername($username){
        $dbconn = connection();
        $sql = "SELECT * FROM klientet WHERE username = '$username'";
        $result = mysqli_query($dbconn,$sql);
        return $result;
    }

    function checkEmail($email){
        $dbconn = connection();
        $sql = "SELECT * FROM klientet WHERE email = '$email'";
        $result = mysqli_query($dbconn,$sql);
        return $result;
    }

    function merr5KlientetEFundit()
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet ORDER BY klientiid DESC LIMIT 5";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function merrKlientet()
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet Where roli = 0";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function merrKlientiId($id)
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet Where klientiid = ".$id;
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }


    function modifikoKlient( $id, $emri, $mbiemri, $email, $telefoni ,$nr_personal, $adresa )
    {
        $dbconn = connection();
        $sql = "UPDATE klientet SET emri = '$emri', mbiemri = '$mbiemri', nr_personal = '$nr_personal', email = '$email', telefoni = '$telefoni', adresa = '$adresa' WHERE klientiid = $id";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: klientet.php');
        }   
    }

    function shtoKlient($emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa, $roli)
    {
        $dbconn = connection();
        $sql = "INSERT INTO klientet (emri, mbiemri, nr_personal, email, telefoni, adresa, roli)
        VALUE ('$emri', '$mbiemri', '$nr_personal', '$email', '$telefoni', '$adresa', '$roli')";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: klientet.php');
        }   
    }

    function merrKategorit(){
        $dbconn = connection();
        $sql = "SELECT * FROM kategorite";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function merrKategoriId($kategoriaid){
        $dbconn = connection();
        $sql = "SELECT * FROM kategorite WHERE kategoriaid = '$kategoriaid' ";
        $result = mysqli_query($dbconn,$sql);
        return mysqli_fetch_assoc($result);
    }
    
    function shtoKategori($emri, $pershkrimi){
        $dbconn = connection();
        $sql = "INSERT INTO kategorite(emri, pershkrimi) VALUES('$emri', '$pershkrimi')";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: kategorite.php');
        }else{
            die("Nuk arriti te shtoj kategorin " . mysqli_error($dbconn));
        }
    }
    
    function modifikoKategorine($id, $emri, $pershkrimi )
    {
        $dbconn = connection();
        $sql = "UPDATE kategorite SET emri = '$emri', pershkrimi = '$pershkrimi' WHERE kategoriaid = $id";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: kategorite.php');
        }else{
            die("Nuk mund te modifikonte kategorine " . mysqli_error($dbconn));
        }
    }

    function fshijKategorine(){
        $kategoriaid = $_POST['kategoriaid'];
        $dbconn = connection();
        $sql = "DELETE FROM kategorite WHERE kategoriaid = '$kategoriaid'";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            Header("Location: kategorite.php");
        }else{
            die("Nuk mund te fshihej kategoria " . mysqli_error($dbconn));
        }
    }

    function merrAutomjetet(){
        $dbconn = connection();
        $sql = "SELECT a.*, k.emri as kategoria FROM automjetet a LEFT JOIN kategorite k ON a.kategoriaid = k.kategoriaid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function merrAutomjetetUnique(){
        $dbconn = connection();
        $sql = "SELECT DISTINCT a.*, k.emri as kategoria FROM automjetet a LEFT JOIN kategorite k ON a.kategoriaid = k.kategoriaid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function shtoAutomjet($emri, $kategoriaid, $nr_regjistrimit, $pershkrimi, $kostoja){
        $dbconn = connection();
        $sql = "INSERT INTO automjetet(emri, kategoriaid, nr_regjistrimit, pershkrimi, kostoja) VALUES('$emri', $kategoriaid, '$nr_regjistrimit', '$pershkrimi', $kostoja)";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: automjetet.php');
        }
    }
    
    function merrAutomjetinId($automjetiid){
        $dbconn = connection();
        $sql = "SELECT * FROM automjetet WHERE automjetiid = $automjetiid";
        $result = mysqli_query($dbconn, $sql);
        return $automjeti = mysqli_fetch_assoc($result);
    }
    
    function modifikoAutomjet($automjetiid, $emri, $kategoriaid, $nr_regjistrimit, $pershkrimi, $kostoja){
        $dbconn = connection();
        $sql = "UPDATE automjetet SET emri = '$emri', kategoriaid = $kategoriaid, nr_regjistrimit = '$nr_regjistrimit', pershkrimi = '$pershkrimi', kostoja = $kostoja where automjetiid = $automjetiid" ;
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: automjetet.php');
        }
    }

    function fshijAutomjetin(){
        $automjetiid = $_POST['automjetiid'];
        $dbconn = connection();
        $sql = "DELETE FROM automjetet WHERE automjetiid = '$automjetiid'";
        $result = mysqli_query($dbconn,$sql);
        if($result){
            header('Location:automjetet.php');
        }else{
            die("Fshirja nuk eshte realizuar me sukses: " . mysqli_error($dbconn));
        }
    }

    function merrRezerviminId($rezervimiid){
        $dbconn = connection();
        $sql = "SELECT * FROM rezervimet WHERE rezervimiid = $rezervimiid";
        $result = mysqli_query($dbconn, $sql);
        return mysqli_fetch_assoc($result);
    }

    function merrRezervimetId($klientiid){
        $dbconn = connection();
        $sql = "SELECT r.*, a.* FROM rezervimet r INNER JOIN automjetet a ON r.automjetiid = a.automjetiid WHERE klientiid = '$klientiid'";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function merrRezervimet(){
        $dbconn = connection();
        $sql = "SELECT r.*, a.* FROM rezervimet r INNER JOIN automjetet a ON r.automjetiid = a.automjetiid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function shtoRezervim($klientiid, $automjetiid, $data_e_rezervimit, $data_e_pranimit, $data_e_kthimit, $komente, $statusi){
        $dbconn = connection();
        $sql = "INSERT INTO rezervimet(klientiid, automjetiid, data_e_rezervimit, data_e_pranimit, data_e_kthimit, komente, statusi) VALUES('$klientiid', '$automjetiid', '$data_e_rezervimit', '$data_e_pranimit', '$data_e_kthimit','$komente', '$statusi')";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: rezervimet.php');
        }else{
            die("Deshtuat ne shtimin e nje rezervimi tjeter: " .mysqli_error($dbconn));
        }
    }

    function modifikoRezervim($rezervimiid, $klientiid, $automjetiid, $data_e_rezervimit, $data_e_pranimit, $data_e_kthimit, $komente, $statusi){
        $dbconn = connection();
        $sql = "UPDATE klientet k 
                INNER JOIN rezervimet r ON r.klientiid = k.klientiid
                INNER JOIN automjetet a ON r.automjetiid = a.automjetiid
                SET r.rezervimiid = '$rezervimiid', k.klientiid = '$klientiid', a.automjetiid = '$automjetiid', r.data_e_rezervimit = '$data_e_rezervimit',
                    r.data_e_pranimit = '$data_e_pranimit', r.data_e_kthimit = '$data_e_kthimit', r.komente = '$komente', r.statusi = '$statusi'
                WHERE r.rezervimiid = '$rezervimiid'";
        $result = mysqli_query($dbconn,$sql);
        if($result){
            header('Location: rezervimet.php');
        }
    }

    function fshijRezervimin(){
        $rezervimiid = $_POST['rezervimiid'];
        $dbconn = connection();
        $sql = "DELETE FROM rezervimet WHERE rezervimiid = '$rezervimiid' ";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location:rezervimet.php');
        }else{
            die("Fshirja e ketij rezervimi nuk u realizua: " .mysqli_error($dbconn));
        }
    }

    function merrKoston($nr_regjistrimit){
        $dbconn = connection();
        $sql = "SELECT kostoja FROM automjetet WHERE nr_regjistrimit = '$nr_regjistrimit' ";
        $result = mysqli_query($dbconn,$sql);
        return $result;
    }
    
?>