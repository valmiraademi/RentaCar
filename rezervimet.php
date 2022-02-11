<?php include_once('includes/header.php'); ?>
<?php include_once('includes/sqlFunctions.php'); ?>
<div id="main">
    <div id="slide-bar">
        <div class="image">
            <h1>Rezervimet</h1>
        </div>
    </div>
    <div class="tabela">
        <h1>Rezervimet</h1>
        <table id="klientet_table">
            <tr>
            <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1){ ?>
                <th>ID</th>
            <?php }else{ ?>
                <th>ID</th>
            <?php } ?>
                <th>Klienti</th>
                <th>Numri i regjistrimit</th>
                <th>Automjeti</th>
                <th>Data e rezervimit</th>
                <th>Data e pranimit</th>
                <th>Data e kthimit</th>
                <th>Komente</th>

                <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1){ ?>
                    <th>Statusi</th>
                    <th>Modifiko</th>
                    <th>Fshiej</th>
                <?php } ?>
            </tr>
            <?php if (isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1) : ?>
                <?php $rezervimet = merrRezervimet();
                while ($rezervimi = mysqli_fetch_assoc($rezervimet)) :
                ?>
                <tr>
                    <td><?php echo $rezervimi['rezervimiid']; ?></td>
                    <?php if($rezervimi['statusi'] == 0){
                            echo "<td style='background-color:red;'>" . $rezervimi['klientiid']. "</td>" ;
                        }else{
                            echo "<td style='background-color:green;'>" . $rezervimi['klientiid']. "</td>" ;
                        }
                    ?>
                    </td>
                    <td><?php echo $rezervimi['nr_regjistrimit']; ?></td>
                    <td><?php echo $rezervimi['emri']; ?></td>
                    <td><?php echo $rezervimi['data_e_rezervimit']; ?></td>
                    <td><?php echo $rezervimi['data_e_pranimit']; ?></td>
                    <td><?php echo $rezervimi['data_e_kthimit']; ?></td>
                    <td><?php echo $rezervimi['komente']; ?></td>

                    <td><?php
                            if($rezervimi['statusi'] == 0){
                                echo '<p><a href="status.php?rezervimiid='.$rezervimi['rezervimiid'].'&statusi=1"><i class="fa fa-toggle-off" style="color:red;margin-left:20px;"></i></a></p>';
                            }else{
                                echo '<p><a href="status.php?rezervimiid='.$rezervimi['rezervimiid'].'&statusi=0"><i class="fa fa-toggle-on" style="color:green;margin-left:20px;"></i></a></p>';
                            }        
                        ?>
                    </td>

                    <td id="modifiko">
                        <a href="modifiko_rezervim.php?rezervimiid=<?php echo $rezervimi['rezervimiid']; ?>">
                            <i class="fa fa-pencil-square-o"></i>
                        </a> 
                    </td>
                    <td id="fshiej">
                        <form action="fshijRezervimin.php" method="post">
                            <input type="text" name="rezervimiid" hidden value="<?php echo $rezervimi['rezervimiid'] ?>">
                            <button type="submit" style="border: none;background-color:transparent;cursor:pointer;" name="deleteRezervimin" onclick="return fshijRezervimin()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <script>
                            function fshijRezervimin(){
                                $confirm = confirm("A jeni te sigurt se deshiron te fshini kete rezervim ?");
                                if($confirm){
                                    return true;
                                }else{
                                    return false;
                                }
                            }
                        </script>
                    </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <?php $rezervimet = merrRezervimetId($_SESSION['klientiid']);
                while ($rezervimi = mysqli_fetch_assoc($rezervimet)) :
                    $nr_regjistrimit = $rezervimi['nr_regjistrimit'];
                    $data_e_pranimit = $rezervimi['data_e_pranimit'];
                    $data_e_kthimit = $rezervimi['data_e_kthimit'];
                    $rezervimiid = $rezervimi['rezervimiid'];
                ?>
                <tr>
                    <td><?php echo $rezervimiid; ?></td>
                    <td><?php echo $rezervimi['klientiid']; ?></td>
                    <td><?php echo $nr_regjistrimit; ?></td>
                    <td><?php echo $rezervimi['emri']; ?></td>
                    <td><?php echo $rezervimi['data_e_rezervimit']; ?></td>
                    <td><?php echo $data_e_pranimit; ?></td>
                    <td><?php echo $data_e_kthimit; ?></td>
                    <td><?php echo $rezervimi['komente']; ?></td>
                </tr>
                <?php $kostot = merrKoston($nr_regjistrimit);
                            while($kosto = mysqli_fetch_assoc($kostot)):
                    ?>
                <tr>
                    <th style="border:none;"></th>
                    <th style="border:none;"></th>
                    <th style="border:none;"></th>
                    <th style="border:none;"></th>
                    <th style="border:none;"></th>
                    <th>Totali: </th>
                    <th> 
                        <?php 
                                $autokosto = $kosto['kostoja'];
                                echo $autokosto . "&#x20AC x";
                                ?> 
                        <?php
                            $origin = date_create($data_e_pranimit);
                            $target = date_create($data_e_kthimit);
                            $interval = date_diff($origin, $target);
                            $days = $interval->format('%a dite');
                            print_r($days);
                            ?>
                    </th>
                    <th style="background-color:red;"><?php echo intval($autokosto) * intval($days) . "&#x20AC";?></th>
                </tr>
                <?php endwhile; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            </table>
            <br>
            <table id="klientet_table">
                    
            </table>
        <div style="clear: both;"></div>
    </div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>