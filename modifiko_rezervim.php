<?php include_once('includes/header.php'); ?>
<?php include_once('includes/sqlFunctions.php'); ?>


<style>
    #modifikoForma {
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
    input {
        width: 100%;
        padding: 10px;
    }

    label {
        color: #009933;
        font-weight: bold;
        margin-left: -10px;
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
            if(isset($_GET['rezervimiid'])){
                $rid = $_GET['rezervimiid'];
                $rezervimi = merrRezerviminId($rid);
                $rezervimiid = $rezervimi['rezervimiid'];
                $klientiid = $rezervimi['klientiid'];
                $automjetiid = $rezervimi['automjetiid'];
                $data_e_rezervimit = $rezervimi['data_e_rezervimit'];
                $data_e_pranimit = $rezervimi['data_e_pranimit'];
                $data_e_kthimit = $rezervimi['data_e_kthimit'];
                $komente = $rezervimi['komente'];
                $statusi = $rezervimi['statusi'];
            }

            if(isset($_POST['modifikoRezervim'])){
                modifikoRezervim($_POST['rezervimiid'], $_POST['klientiid'],$_POST['automjetiid'],$_POST['data_e_rezervimit'],$_POST['data_e_pranimit']
                ,$_POST['data_e_kthimit'],$_POST['komente'],$_POST['statusi']);
            }

            ?>

            
<div id="main">
    <div id="slide-bar">
        <div class="image">

            <h1>Modifikimi i rezervimit</h1>

        </div>
    </div>

    <h1 id="hi">Forma per modifikimin e rezervimit</h1>
    <form method="post" id="modifikoForma">
        <input type="hidden" name="rezervimiid" id="rezervimiid" value="<?php if(!empty($rezervimiid)){ echo $rezervimiid;} ?>"><br/>

        <label for="klientiid">Klienti</label>
        <input type="text" name="klientiid" value="<?php if(!empty($klientiid)){ echo $klientiid;} ?>" id="klientiid">

        <label for="automjetiid">Automjeti</label>
        <input type="text" name="automjetiid" value="<?php if(!empty($automjetiid)){ echo $automjetiid;} ?>" id="automjetiid">

        <label for="data_e_rezervimit">Data e rezervimit</label>
        <input type="text" name="data_e_rezervimit" value="<?php if(!empty($data_e_rezervimit)){ echo $data_e_rezervimit;} ?>" id="data_e_rezervimit" readonly>
        
        <label for="data_e_pranimit">Data e pranimit</label>
        <input type="text" name="data_e_pranimit" value="<?php if(!empty($data_e_pranimit)){ echo $data_e_pranimit;} ?>" id="data_e_pranimit">

        <label for="data_e_kthimit">Data e kthimit</label>
        <input type="text" name="data_e_kthimit" value="<?php if(!empty($data_e_kthimit)){ echo $data_e_kthimit;} ?>" id="data_e_kthimit">

        <label for="komente">Komente</label>
        <input type="text" name="komente" value="<?php if(!empty($komente)){ echo $komente;} ?>" id="komente">

        <label for="statusi">Statusi</label>
        <input type="text" name="statusi" value="<?php if(!empty($statusi)){ echo $statusi;} ?>" id="statusi">

        <input type="submit" name="modifikoRezervim" value="Modifiko rezervimin">
    </form>
    <div style="clear: both;"></div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>