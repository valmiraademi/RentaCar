<?php include_once('includes/header.php'); ?>
<?php include_once('includes/sqlFunctions.php'); ?>
<div id="main">
    <div id="slide-bar">
        <div class="image">
            <h1>Automjetet</h1>
        </div>
    </div>
    <div class="tabela">
        <h1>Automjetet</h1>
        <table id="klientet_table">
            <tr>
                <th>Emri</th>
                <th>Kategoria </th>
                <th>Numri i regjistrimit</th>
                <th>Pershkrimi</th>
                <th>Kostoja</th>
                <?php if(isset($_SESSION['klientiid'])){ ?>
                    <th>Rezervo</th>
                <?php } ?>
                <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1){ ?>
                <th>Modifiko</th>
                <th>Fshiej</th>
                <?php } ?>
            </tr>
                <?php
                $automjetet = merrAutomjetet();
                while($automjeti = mysqli_fetch_assoc($automjetet)) :
                ?>
                <tr id="<?php echo $automjeti['id']?>">
                    <td><?php echo $automjeti['emri']; ?></td>
                    <td><?php echo $automjeti['kategoria']; ?></td>
                    <td><?php echo $automjeti['nr_regjistrimit']; ?></td>
                    <td><?php echo $automjeti['pershkrimi']; ?></td>
                    <td><?php echo $automjeti['kostoja']; ?> &euro; / per dite </td>
                    <?php if(isset($_SESSION['klientiid'])){ ?>
                        <td id="rezervo">
                            <a href="shto_rezervim.php?automjetiid=<?php echo $automjeti['automjetiid']; ?>">
                                <i class="fa fa-car" style="position:relative; margin-left:20px;text-decoration:none;color:purple;"></i>
                            </a>
                        </td>
                    <?php } ?>
                    <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1 ){ ?>
                    <td id="modifiko">
                        <a href="shto_modifiko_automjet.php?automjetiid=<?php echo $automjeti['automjetiid']; ?>">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                    </td>
                    <td id="fshiej">
                                <form action="fshijAutomjetin.php" method="post">
                                    <input type="text" name="automjetiid" hidden value="<?php echo $automjeti['automjetiid'] ?>">
                                        <button type="submit" style="border: none;background-color:transparent;cursor:pointer;" name="deleteAutomjetin" onclick="return fshijAutomjetin()">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                </form>
                                <script>
                                function fshijAutomjetin() {
                                    $confirm = confirm('A jeni te sigurt qe deshironi te fshini kete automjet ?');
                                    if ($confirm) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
                            </td>
                    <?php } ?>
                </tr>
                <?php endwhile; ?>
        </table>
        <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1) { ?>
        <button id="shto_klient" onclick="window.location.href='shto_modifiko_automjet.php'" ><i class="fa fa-plus" aria-hidden="true"></i> Shto automjet</button>
        <?php } ?>
        <div style="clear: both;"></div>
    </div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>
