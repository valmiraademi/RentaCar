<?php
    include_once('includes/sqlFunctions.php');

        $rezervimiid = $_GET['rezervimiid'];
        $statusi = $_GET['statusi'];

        $dbconn = connection();
        $sql = "UPDATE rezervimet SET statusi = '$statusi' WHERE rezervimiid = '$rezervimiid' ";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: rezervimet.php');
        }else{
            die("Deshtuat ne ndryshimin e statusit te rezervimit: " .mysqli_error($dbconn));
        }
?>