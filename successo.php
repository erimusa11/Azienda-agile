<?php
include 'function.php';
include 'dbconnection.php';
?>

<?php

if ($_GET['result'] == true) {
    global $connection;
    $user_id = $_GET['result'];
    $query_userdat = "SELECT * FROM users WHERE user_id='$user_id '";
    $result_user_dat = mysqli_query($connection, $query_userdat);
    $row_user_dat = mysqli_fetch_assoc($result_user_dat);


    $datas_point = "SELECT tipology,SUM(punteggio) AS points FROM domande_salvate  WHERE user_id='$user_id' GROUP BY tipology";
    $result_point =  mysqli_query($connection, $datas_point);
    while ($row_point = mysqli_fetch_array($result_point)) {

        if ($row_point['tipology'] == 1) {
            $pratiche_stabili = round($row_point['points'] / 18, 1) * 100;
        } else if ($row_point['tipology'] == 0) {
            $pratiche_dinamichi = round($row_point['points'] / 18, 1) * 100;
        }

        if ($pratiche_stabili <= 50 && $pratiche_dinamichi <= 50) {
            $title = "La tua azienda è BLOCCATA";

            $text = "L'azienda BLOCCATA è caratterizzata da livelli di dinamicità e di stabilità
relativamente bassi. <br/><br/>
Spesso è dominata dalla “politica del pompiere”, che si attiva su ogni problema
quando esso divampa come un incendio ma non interviene sulle cause e sulla
prevenzione.<br/><br/>
Generalmente manca di coordinamento, e tende a proteggere lo status quo: le
persone non sono proattive e spesso si nascondono dietro la frase “abbiamo
sempre fatto così”.
<br/><br/>
Per cambiare le cose, questo tipo di azienda ha bisogno di:<br/>
&nbsp;&nbsp• una forte spinta imprenditoriale, incarnata da una leadership che sa
condividere,<br/>
&nbsp;&nbsp• una forte spinta all’apprendimento e alla proattività sulle risorse umane,<br/>
&nbsp;&nbsp• un profondo lavoro sulla cultura della flessibilità, al fine di sviluppare
l'attitudine al cambiamento continuo e all'imprenditorialità individuale e
di gruppo.";
        } else if ($pratiche_stabili > 50 && $pratiche_dinamichi <= 50) {
            $title = "La tua azienda è BUROCRATICA.";

            $text = "L'azienda BUROCRATICA è caratterizzata da<br/>
	&nbsp;&nbsp;1. una buona stabilità, in termini di vision e strategia generale,<br/>
	&nbsp;&nbsp;2. un dinamismo relativamente basso, che si esprime attraverso:<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• metodi di lavoro standard,<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• scarsa propensione al rischio,<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• orientamento funzionale,<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• focus sull'efficienza<br/>
Per migliorare l’agilità di questo tipo di azienda è necessario snellire le strutture
bloccate e soprattutto lavorare con le persone, incoraggiandone la dinamicità e
la proattività.";
        } else if ($pratiche_stabili > 50 && $pratiche_dinamichi > 50) {
            $title = "La tua azienda è AGILE!";

            $text = "L'azienda AGILE unisce la capacità di mantenere <br/>
&nbsp;&nbsp;&nbsp;&nbsp;• un forte e chiaro scopo condiviso, che rappresenta le solide fondamenta
aziendali, e <br/>
&nbsp;&nbsp;&nbsp;&nbsp;• un approccio flessibile, che permette di cogliere rapidamente le
opportunità. <br/>
Le persone all'interno dell'azienda sono proattive, hanno spirito imprenditoriale,
sono aperte ai cambiamenti e attente al mutare delle preferenze dei clienti e
dell'ambiente esterno.";
        } else if ($pratiche_stabili <= 50 && $pratiche_dinamichi > 50) {
            $title = "La tua azienda è START-UP";

            $text = "L'azienda START UP è caratterizzata da<br/>
&nbsp;&nbsp;&nbsp;&nbsp;1. una buona dinamicità, in termini di proattività e imprenditorialità delle
persone,<br/>
&nbsp;&nbsp;&nbsp;&nbsp;2. una stabilità relativamente bassa, in quanto in costante e
imprevedibile cambiamento.<br/>
Questo tipo di azienda tende ad agire rapidamente, ma spesso manca di
disciplina e di esecuzione sistematica.
<br/><br/>
Per migliorare questo tipo di azienda devo sviluppare le pratiche che la rendono
stabile, lavorando sui processi e sulla struttura portante.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'cssLinks.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['DINAMICITÀ', 'STABILITÀ'],

                [<?php echo $pratiche_dinamichi ?>, <?php echo $pratiche_stabili ?>],
            ]);

            var options = {
                hAxis: {
                    title: 'DINAMICITÀ',
                    minValue: 0,
                    maxValue: 100,
                    gridlines: {
                        color: 'transparent'
                    }
                },
                vAxis: {
                    title: 'STABILITÀ',
                    minValue: 0,
                    maxValue: 100,
                    gridlines: {
                        color: 'transparent'
                    }
                },
                legend: 'none',
                backgroundColor: '',
                pointSize: 20,
                pointShape: {
                    type: 'triangle',
                    rotation: 180
                },
                colors: ['#c83e15'],

                chartArea: {
                    backgroundColor: 'transparent',

                }
            };

            var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
            google.visualization.events.addListener(chart, 'ready', function() {
                $('#chartPNGInput').val(chart.getImageURI());
            });

            chart.draw(data, options);
        }
    </script>

</head>

<body>

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->

    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div><!-- /loader_form -->

    <!-- /menu -->

    <div class="container-fluid full-height">
        <form method="POST" action="pdfGenerator.php">
            <div class="row row-height">
                <div class="col-lg-6 content-left">
                    <div class="content-left-wrapper" style="background-color:background: #373B44;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
;">
                     <!--   <a href="index.php" id="logo"><img src="logo.png" alt="" width="49" height="35"></a> -->


                        <div>
                            <!--       <figure><img src="img/info_graphic_1.svg" alt="" class="img-fluid"></figure> -->
                            <h2>Grazie per la pazienza </h2>
                            <p>
                                Questo è il risultato delle tue risposte
                            </p>
                            <center>
                                <!--   <button class="nav-link btn btn-md btn-info  bg-info  printMe" href="javascript:void(0)">
                                    <i class="fas fa-print"></i>

                                    Print </button> </center> -->

                                <button class="nav-link btn btn-md btn-info  bg-info" name="pdfGenerator">
                                    <i class="fas fa-paper-plane"></i>

                                    Ricevi report via email </button> </center>
                        </div>
                        <div class="copy">© 2020 Agile Index</div>
                    </div>
                    <!-- /content-left-wrapper -->
                </div>
                <!-- /content-left -->

                <div class="col-lg-6  " id="start">
                    <center> <img src="logo.png" alt="">
                        <b>
                            <h4>AGILE INDEX REPORT</h4>
                        </b>
                        <div class="col-12">

                            <div style="margin-left: 10%; margin-right: auto">
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">Compilatore:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo strtoupper($row_user_dat['nome_cognome']); ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="compilatore" value="<?php echo strtoupper($row_user_dat['nome_cognome']); ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">Azienda:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo strtoupper($row_user_dat['ragione_sociale']); ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="ragioneSociale" value="<?php echo strtoupper($row_user_dat['ragione_sociale']); ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">Tipologia:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo strtoupper($row_user_dat['settore']); ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="tipologia" value="<?php echo strtoupper($row_user_dat['settore']); ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">Ruolo:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo strtoupper($row_user_dat['ruolo_azienda']); ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="ruolo" value="<?php echo strtoupper($row_user_dat['ruolo_azienda']); ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">Numero di dipendenti:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo strtoupper($row_user_dat['range_numerico']); ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="numeroDipendenti" value="<?php echo strtoupper($row_user_dat['range_numerico']); ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">Email:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo strtoupper($row_user_dat['email']); ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="email" value="<?php echo $row_user_dat['email']; ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">DINAMICITÀ:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b> <?php echo  $pratiche_dinamichi . "%"; ?> </b> </label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="dinamicita" value="<?php echo $pratiche_dinamichi; ?>">
                                </div>
                                <div class="row justify-content-center">
                                    <label for="" class="col-sm-3 col-form-label text-left">STABILITÀ:</label>
                                    <label for="" class="col-sm-5 form-control-plaintext text-left"> <b><?php echo  $pratiche_stabili . "%"; ?> </b></label>
                                    <input type="text" readonly hidden class="form-control-plaintext" id="" name="stabilita" value="<?php echo $pratiche_stabili; ?>">
                                </div>
                            </div>
                            <input type="text" id="chartPNGInput" name="chartPNGInput" hidden />


        </form>
        <br>
        <h3 class="piechartheader">Agile Index</h3>
        <div id="chart_div" style="height:500px; width:500px; background-image: url('image/graphBackground.jpg');   background-size: 450px 450px;  background-repeat: no-repeat;  background-position: center;"></div>
        <h4><?php echo  $title; ?> </h4>
        <p class="text-left"><?php echo  $text; ?> </p>
    </div>
    </form>
    </center>

    <!-- /Wizard container -->
    </div>
    <!-- /content-right-->
    </div>
    <!-- /row-->
    </div>

    <div class="cd-overlay-nav">
        <span></span>
    </div>
    <!-- /cd-overlay-nav -->

    <div class="cd-overlay-content">
        <span></span>
    </div>
    <!-- /cd-overlay-content -->



    <?php include 'scripst.php' ?>

    <script>
        $(document).ready(function() {


            /*   $('.printMe').click(function() {
                  window.print();
              }); */
        });
    </script>
</body>



</html>