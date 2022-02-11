<?php include_once('includes/header.php'); ?>
<?php include_once('includes/sqlFunctions.php'); ?>

<style>
    #shtoForma {
        width: 90%;
        margin: 50px 40px;
    }

    #hi {
        color: #009933;
        padding: 20px 0px 10px 10px;
        margin: 0px 15px;
        font-size: 25px;
        border-bottom: 2px solid #009933;
    }

    label,
    input, select {
        width: 100%;
        padding: 10px;
    }

    label {
        color: #009933;
        font-weight: bold;
        margin-left: -10px;
    }
    select{
        width: 102%;
    }

    input {
        outline: none;
        margin: 10px 0px;
    }

    input[type='submit'] {
        width: 150px;
        float: right;
        margin: 30px 0px;
        margin-right: -25px;
        color: #fff;
        background-color: #009933;
        border: none;
    }

    input[type='submit']:hover {
        transform: scale(1.1);
    }
</style>
<?php

        if(isset($_GET['automjetiid'])){
            $aid = $_GET['automjetiid'];
            $automjeti = merrAutomjetinId($aid);
            $automjetiid = $automjeti['automjetiid'];
            $emri = $automjeti['emri'];
            $nr_regjistrimit = $automjeti['nr_regjistrimit'];
            $pershkrimi = $automjeti['pershkrimi'];
            $kostoja = $automjeti['kostoja'];
        }

            date_default_timezone_set('Europe/Tirane');
            $data_rezervimit = date('d-m-y h:i:s');

        if(isset($_POST['shtoRezervim'])){
            $klientiid = $_SESSION['klientiid'];
            $automjetiid = $_POST['automjetiid'];

            $data_e_rezervimit = $data_rezervimit;

            $data_e_pranimit = $_POST['data_e_pranimit'];
            $data_e_kthimit = $_POST['data_e_kthimit'];
            $komente = $_POST['komente'];
            $statusi = $_POST['statusi'];

            shtoRezervim($klientiid, $automjetiid, $data_e_rezervimit, $data_e_pranimit, $data_e_kthimit, $komente, $statusi);
        }



?>
<div id="main">
    <div id="slide-bar">
        <div class="image">

            <h1>Shtimi i Rezervimit</h1>

        </div>
    </div>


    <h1 id="hi">Forma per shtimin e rezervimit</h1>
    <form method="post" id="shtoForma">

        <label for="">Klienti</label>
        <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1 ): ?>
            <input type="text" name="klientiid" value="">
        <?php else: ?>
            <input type="text" name="emri" value="<?php if(!empty($emri)){ echo $_SESSION['emri']; } ?>" readonly>
        <?php endif; ?>


        <label for="">Emri i automobilit</label>

        <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1 ): ?>
            <input type="text" name="emri" value="<?php if(!empty($emri)){ echo $emri; } ?>" readonly>
        <?php else: ?>
            <input type="text" name="emri" value="<?php if(!empty($emri)){ echo $emri; } ?>" readonly>
        <?php endif; ?>


        <input type="text" name="automjetiid" value="<?php echo $automjetiid; ?>" hidden>

        <label for="">Numri i regjistrimit</label>
        <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1 ): ?>
            <input type="text" name="nr_regjistrimit" value="<?php if(!empty($nr_regjistrimit)){ echo $nr_regjistrimit; } ?>" readonly>
        <?php else: ?>
            <input type="text" name="nr_regjistrimit" value="<?php if(!empty($nr_regjistrimit)){ echo $nr_regjistrimit; } ?>" readonly>
        <?php endif; ?>


        <label for="">Data e rezervimit</label>
        <input type="text" name="data_e_rezervimit" value="<?php echo $data_rezervimit?>" readonly>

        <label for="">Data e pranimit</label>
        <input type="date" name="data_e_pranimit">

        <label for="">Data e kthimit</label>
        <input type="date" name="data_e_kthimit">

        <label for="">Kostoja</label>
        <input type="text" name="kostoja" value="<?php if(!empty($kostoja)){ echo $kostoja; } ?>">

        <label for="">Komente</label>
        <input type="text" name="komente">
          
        <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1 ): ?>
            <label for="">Statusi</label>
            <input type="text" name="statusi" value="<?php echo $statusi=0; ?>">
        <?php else: ?>
            <input type="text" name="statusi" value="<?php echo $statusi=0; ?>" hidden>
        <?php endif; ?>

        <input type="submit" value="Shto Rezervim" name="shtoRezervim">
    </form>
    <div style="clear: both;"></div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>