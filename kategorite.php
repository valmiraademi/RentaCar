<?php include_once('includes/header.php'); ?>
<?php include_once('includes/sqlFunctions.php'); ?>

<div id="main">
    <div id="slide-bar">
        <div class="image">
            <h1>Kategorite e automjeteve</h1>
        </div>
    </div>
    <div class="tabela">
        <h1 style="margin-bottom: 50px;">Kategorite</h1>
        <div style="clear: both;"></div>
        <table id="klientet_table">
            <thead>
                <tr>
                    <th style="width: 20%;">Emri</th>
                    <th style="width: 60%;">Pershkrimi</th>
                    <?php if (isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1) : ?>
                        <th style="width: 10%;">Modifiko</th>
                        <th style="width: 10%;">Fshiej</th>
                    <?php else : ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $kategorit =  merrKategorit();
                while ($kategoria = mysqli_fetch_assoc($kategorit)) { 
                    $kategoriaid =  $kategoria['kategoriaid'];
                    ?>
                    <tr>
                        <td><?php echo $kategoria['emri']; ?></td>
                        <td><?php echo $kategoria['pershkrimi']; ?></td>
                        <?php if (isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1) : ?>
                            <td id="modifiko">
                                <?php echo "<a href='modifiko_kategori.php?kategoriaid={$kategoriaid}'><i class='fa fa-pencil-square-o' ></i></a>"?>
                            </td>
                            <td id="fshiej">
                                <form action="fshijKategorine.php" method="post">
                                    <input type="text" name="kategoriaid" hidden value="<?php echo $kategoria['kategoriaid'] ?>">
                                        <button type="submit" style="border: none;background-color:transparent;cursor:pointer;" name="deleteKategorine" onclick="return fshijKategorine()">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                </form>
                                <script>
                                function fshijKategorine() {
                                    $confirm = confirm('A jeni te sigurt qe deshironi te fshini kete kategori ?');
                                    if ($confirm) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
                            </td>
                        <?php else : ?>
                        <?php endif; ?>

                    </tr>
                <?php

                }
                ?>

            </tbody>
        </table>
        <?php if (isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1) : ?>
            <button onclick="window.location.href='shto_kategori.php'" id="shto_klient"><i class="fa fa-plus" aria-hidden="true"></i> Shto kategori</button>
            <div style="clear: both;"></div>
        <?php else : ?>
        <?php endif; ?>

    </div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>
