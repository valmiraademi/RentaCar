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
            if(isset($_GET['kategoriaid'])){
                $kid = $_GET['kategoriaid'];
                $kategoria = merrKategoriId($kid);
                $kategoriaid = $kategoria['kategoriaid'];
                $emri = $kategoria['emri'];
                $pershkrimi = $kategoria['pershkrimi'];
            }

            if(isset($_POST['modifikoKategorine'])){
                modifikoKategorine($_POST['kategoriaid'], $_POST['emri'], $_POST['pershkrimi']);
            }

            ?>

            
<div id="main">
    <div id="slide-bar">
        <div class="image">

            <h1>Modifikimi i kategorise</h1>

        </div>
    </div>

    <h1 id="hi">Forma per modifikimin e kategorise</h1>
    <form method="post" id="modifikoForma">
        <input type="hidden" name="kategoriaid" id="kategoriaid" value="<?php if(!empty($kategoriaid)){ echo $kategoriaid;} ?>"><br/>

        <label for="emri">Emri</label>
        <input type="text" name="emri" value="<?php if(!empty($emri)){ echo $emri;} ?>" id="emri">

        <label for="pershkrimi">Pershkrimi</label>
        <input type="text" name="pershkrimi" value="<?php if(!empty($pershkrimi)){ echo $pershkrimi;} ?>" id="pershkrimi">

        <input type="submit" name="modifikoKategorine" value="Modifiko kategorine">
    </form>
    <div style="clear: both;"></div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>