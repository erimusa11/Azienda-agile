<?php 
session_start();
include 'function.php';
include 'dbconnection.php' ;
$livello = $_SESSION['livello'];
$userId = $_SESSION['userId'];
logout();
if (!isset($userId) || ($_SESSION['livello'] != 1)) {
    header("Location: index.php");
}

if($_GET['result']==true){
global $connection;  
$user_id = $_SESSION['userId'];
$query_goup_category ="SELECT question_tipology,subcategory_question, SUM(punteggio) AS total FROM save_answer  WHERE id_user='$user_id' GROUP BY question_tipology, subcategory_question";

$result_group_cat = mysqli_query($connection,$query_goup_category);
    while($row_cat_gr = mysqli_fetch_assoc($result_group_cat)){

        //red tipology ***********************************************************
        if($row_cat_gr['question_tipology']==0){

            if($row_cat_gr['subcategory_question']==0){
            //red sub 1 
                $red_sub1_tot= $row_cat_gr['total'];
                $red_sub1_tot = $red_sub1_tot/20;

             }else if($row_cat_gr['subcategory_question']==1){
            //red sub 2 
                $red_sub2_tot= $row_cat_gr['total'];
                $red_sub2_tot = $red_sub2_tot /16;
            }else if($row_cat_gr['subcategory_question']==2){  
            //red sub 3 
                $red_sub3_tot= $row_cat_gr['total'];
                $red_sub3_tot = $red_sub3_tot/8;
            }

                 //yellow tipology **************************************************
        } else if($row_cat_gr['question_tipology']==1){  

            if($row_cat_gr['subcategory_question']==0){
                //yellow sub 1 
                    $yellow_sub1_tot= $row_cat_gr['total']/8;
                
                 }else if($row_cat_gr['subcategory_question']==1){
                //yellow sub 2 
                    $yellow_sub2_tot= $row_cat_gr['total']/8;
    
                }else if($row_cat_gr['subcategory_question']==2){  
                //yellow sub 3 
                    $yellow_sub3_tot= $row_cat_gr['total']/16;
    
                } else if($row_cat_gr['subcategory_question']==3){  
                        //yellow sub 4 
                    $yellow_sub4_tot= $row_cat_gr['total']/8;
        
            
                        }
        
                     //green tipology ****************************************************
    }  else if($row_cat_gr['question_tipology']==2){  
              
        if($row_cat_gr['subcategory_question']==0){
            //green sub 1 
                $green_sub1_tot= $row_cat_gr['total']/12;
                
             }else if($row_cat_gr['subcategory_question']==1){
            //green sub 2 
                $green_sub2_tot= $row_cat_gr['total']/12;

            }else if($row_cat_gr['subcategory_question']==2){  
            //green sub 3 
                $green_sub3_tot= $row_cat_gr['total']/16;

                    }
              
                      //blue tipology ****************************************************
    }  else if($row_cat_gr['question_tipology']==3){  
              
        if($row_cat_gr['subcategory_question']==0){
            //blue sub 1 
                $blue_sub1_tot= $row_cat_gr['total']/8;

             }else if($row_cat_gr['subcategory_question']==1){
            //blue sub 2 
                $blue_sub2_tot= $row_cat_gr['total']/12;

            }else if($row_cat_gr['subcategory_question']==2){  
            //blue sub 3 
                $blue_sub3_tot= $row_cat_gr['total']/12;

        
           }else if($row_cat_gr['subcategory_question']==3){  
             //blue sub 4 
               $blue_sub4_tot= $row_cat_gr['total']/4;
            
                    
          }else if($row_cat_gr['subcategory_question']==4){  
             //blue sub 5
              $blue_sub5_tot= $row_cat_gr['total']/4;
                        
                                            }

      
    }

}

        $red_tot= $red_sub1_tot * 0.33 +  $red_sub2_tot*0.33 +$red_sub3_tot*0.33;
        $red_tot =  round(($red_tot  *100) ,0);

        $yellow_tot= $yellow_sub1_tot*0.2 +  $yellow_sub2_tot*0.4 +$yellow_sub3_tot* 0.2+ $yellow_sub4_tot*0.2;
        $yellow_tot = round(($yellow_tot *100),0);

        $green_tot = $green_sub1_tot*0.33 +  $green_sub2_tot*0.33+$green_sub3_tot*0.33;
        $green_tot = round(($green_tot *100),0);
      

        $blue_tot = $blue_sub1_tot *0.25+  $blue_sub2_tot*0.25+$blue_sub3_tot*0.25+$blue_sub4_tot*0.20+$blue_sub5_tot*0.5;
        $blue_tot = round(($blue_tot *100),0);
 
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css"
        integrity="sha512-6g9IGCc67eh+xK03Z8ILcnKLbJnKBW+qpEdoUVD/4hBa2Ghiq5dQgeNOGWJfGoe9tdCRM4GpJMnsRXa2FDJp9Q=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <style>

    </style>
    <script
        src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js">
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.easy-pie-chart/1.0.1/jquery.easy-pie-chart.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha512-I5TkutApDjnWuX+smLIPZNhw+LhTd8WrQhdCKsxCFRSvhFx2km8ZfEpNIhF9nq04msHhOkE8BMOBj5QE07yhMA=="
        crossorigin="anonymous"></script>

</head>
 
<body>
    <div class="col-12 d-flex justify-content-around">
        <!-- global chart -->
        <div class=" col-md-7 col-sm-12">
            <h3> AGILE AVERAGE INDEX <?php echo ( $blue_tot +  $green_tot + $yellow_tot + $red_tot )/4; ?>%</h3>
            <p>Dalle risposte si evince che l'azienda ha un ottimo orientamento al cliente e un'efficace gestione
                economico-finanziaria. Ha inoltre un forte orientamento all'innovazione, non supportato da un analogo
                livello di attenzione sullo sviluppo delle competenze L'area di attenzione è quella dei Processi, dove
                però occorre comprendere quanto siano importanti le chiavi di analisi per lo specifico Risulta
                necessario approfondire le seguenti Aree di Performance:
                '- Digital marketing (ogni settore oggi dovrebbe presidiare quest'area) '- Clima aziendale e sviluppo di
                tech skills e soft skills (al riguardo occorrerebbe conoscere la struttura organizzativa). </p>
            <div class="row col-12 "  >
            <form action="result.php" method="POST">   
                <button type="submit" name ="logout"   class="btn btn-dark bg-dark   "><i class="fas fa-long-arrow-alt-left"> Logout</i>  
                   
                </button> </form>
                <button class="nav-link btn btn-md btn-info  bg-info  printMe" href="javascript:void(0)">
                <i class="fas fa-print"></i>

                  Print  </button>
            </div>
      
        </div>
        <div id="columnchart_values" class="border shadow" style="width: auto px; height: 350;"></div>
        <br><br>
    </div>
    <div class="col-12 mt-5 row  ">


        <div class="col-md-3 col-sm-12  border  ">
            <!--red chart economica finaziaria  -->
            <label for="" style=" margin-bottom: 0px;" class="col-12">ECON.-FINANZ.</label>

            <div class="chart chart1 border shadow" data-percent="<?php echo $red_tot;?>"><span><?php echo $red_tot;?></span>%</div>

            <div id="columnchart_values1" class="border shadow" style="width: 10% px; height: 250px;"></div>

        </div>
        <div class="col-md-3 col-sm-12 border shadow"">
                <!--yeallow chart clienti   -->
                <label for=""  style=" margin-bottom: 0px;" class="col-12">CLIENTI.</label>

            <div class="chart chart2 border shadow" data-percent="<?php echo $yellow_tot ;?>"><span><?php echo $yellow_tot ;?></span>%</div>

            <div id="columnchart_values2" class=" border shadow" style="width: 10% px; height: 250px;"></div>

        </div>
        <div class="col-md-3 col-sm-12 border shadow">
            <!--blue chart prochessi   -->
            <label for="" style=" margin-bottom: 0px;" class="col-12">PROCESSI.</label>

            <div class="chart chart3 border shadow" data-percent="<?php echo $blue_tot;?>"><span><?php echo $blue_tot;?></span>%</div>

            <div id="columnchart_values3" class="border shadow" style="width: 10% px; height: 250px;"></div>

        </div>
        <div class="col-md-3 col-sm-12  border shadow" >
                <!--green chart form inovazione   -->
                <label for=""  style=" margin-bottom: 0px;" class="col-12">FORM. E INNOV.</label>

            <div class="chart chart4 border shadow" data-percent="<?php echo $green_tot;?>"><span><?php echo $green_tot;?></span>%</div>

            <div id="columnchart_values4" class="border shadow" style="width: 10% px; height: 250px;"></div>

        </div>

               
    </div>

</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
$(function() {
    $('.printMe').click(function() {
        window.print();
    });
    $('.chart1').easyPieChart({

        // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
        barColor: '#ef1e25',
        // The color of the track for the bar, false to disable rendering.
        trackColor: '#f2f2f2',
        // The color of the scale lines, false to disable rendering.
        scaleColor: '#dfe0e0',
        // Defines how the ending of the bar line looks like. Possible values are: butt, round and square.
        lineCap: 'round',
        // Width of the bar line in px.
        lineWidth: 12,
        // Size of the pie chart in px. It will always be a square.
        size: 110,
        // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
        animate: 1000,
        // Callback function that is called at the start of any animation (only if animate is not false).
        onStart: $.noop,
        // Callback function that is called at the end of any animation (only if animate is not false).
        onStop: $.noop
    });

    $('.chart2').easyPieChart({
        // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
        barColor: '#ffd700',
        // The color of the track for the bar, false to disable rendering.
        trackColor: '#f2f2f2',
        // The color of the scale lines, false to disable rendering.
        scaleColor: '#dfe0e0',
        // Defines how the ending of the bar line looks like. Possible values are: butt, round and square.
        lineCap: 'round',
        // Width of the bar line in px.
        lineWidth: 12,
        // Size of the pie chart in px. It will always be a square.
        size: 110,
        // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
        animate: 1000,
        // Callback function that is called at the start of any animation (only if animate is not false).
        onStart: $.noop,
        // Callback function that is called at the end of any animation (only if animate is not false).
        onStop: $.noop
    });

    $('.chart3').easyPieChart({
        // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
        barColor: '#0c62bd',
        // The color of the track for the bar, false to disable rendering.
        trackColor: '#f2f2f2',
        // The color of the scale lines, false to disable rendering.
        scaleColor: '#dfe0e0',
        // Defines how the ending of the bar line looks like. Possible values are: butt, round and square.
        lineCap: 'round',
        // Width of the bar line in px.
        lineWidth: 12,
        // Size of the pie chart in px. It will always be a square.
        size: 110,
        // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
        animate: 1000,
        // Callback function that is called at the start of any animation (only if animate is not false).
        onStart: $.noop,
        // Callback function that is called at the end of any animation (only if animate is not false).
        onStop: $.noop
    });
    $('.chart4').easyPieChart({
        // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
        barColor: '#1e7331',
        // The color of the track for the bar, false to disable rendering.
        trackColor: '#f2f2f2',
        // The color of the scale lines, false to disable rendering.
        scaleColor: '#dfe0e0',
        // Defines how the ending of the bar line looks like. Possible values are: butt, round and square.
        lineCap: 'round',
        // Width of the bar line in px.
        lineWidth: 12,
        // Size of the pie chart in px. It will always be a square.
        size: 110,
        // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
        animate: 1000,
        // Callback function that is called at the start of any animation (only if animate is not false).
        onStart: $.noop,
        // Callback function that is called at the end of any animation (only if animate is not false).
        onStop: $.noop
    });
});


// global chart
google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "Density", {
            role: "style"
        }],
        ["ECON.-FINANZ.", <?php echo $red_tot;?>, "#ef1e25"],
        ["CLIENTI.", <?php echo $yellow_tot;?>, "#ffd700"],
        ["PROCESSI.", <?php echo $blue_tot;?>, "#0c62bd"],
        ["FORM. E INNOV.", <?php echo $green_tot; ?>, "color: #1e7331"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2
    ]);

    var options = {
        title: "LIVELLI DI PERFORMANCE PER PROSPETTIVA AZIENDALE",
        width: 500,
        height: 350,
        bar: {
            groupWidth: "95%"
        },
        legend: {
            position: "none"
        },
        hAxis: {
            direction: -1,
            slantedText: true,
            slantedTextAngle: 68 // here you can even use 180 
                ,
        },
        chartArea: {
            top: 28,
            height: '40%'
        },

    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}
</script>
<script type="text/javascript">
//economica finaziaria  chart
google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "Density", {
            role: "style"
        }],
        ["Controllo di gestione",<?php echo $red_sub1_tot*100;?>, "#ef1e25"],
        ["Gestione finanziaria dei rischi", <?php echo $red_sub2_tot*100;?>, "#ef1e25"],
        ["Crescita", <?php echo $red_sub3_tot*100;?>, "#ef1e25"],
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2
    ]);

    var options = {
        title: "KPA - ECONOMICO-FINANZIARIE",

        bar: {
            groupWidth: "95%"
        },
        legend: {
            position: "none"
        },
        hAxis: {
            direction: -1,
            slantedText: true,
            slantedTextAngle: 68 // here you can even use 180 
        },
        chartArea: {
            top: 28,
            height: '40%'
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values1"));
    chart.draw(view, options);
}
</script>
<script type="text/javascript">
//clienti chart

google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "Density", {
            role: "style"
        }],
        ["Prezzo",<?php echo $yellow_sub1_tot*100;?>, "#ffd700"],
        ["Soddisfazione del cliente", <?php echo $yellow_sub2_tot*100;?>, "#ffd700"],
        ["Marketing", <?php echo $yellow_sub3_tot*100;?>, "#ffd700"],
        ["Customer service", <?php echo $yellow_sub4_tot*100;?>, "color: #ffd700"],

    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2
    ]);

    var options = {
        title: "KPA - CLIENTI",

        bar: {
            groupWidth: "95%"
        },
        legend: {
            position: "none"
        },
        hAxis: {
            direction: -1,
            slantedText: true,
            slantedTextAngle: 68 // here you can even use 180 
        },
        chartArea: {
            top: 28,
            height: '40%'
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
    chart.draw(view, options);
}
</script>
<script type="text/javascript">
//procesi chart

google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "Density", {
            role: "style"
        }],
        ["Furnitori eccellenti", <?php echo $green_sub1_tot;?>, "#0c62bd"],
        ["Produzione efficaci", <?php echo $green_sub2_tot;?>, "#0c62bd"],
        ["Vendite efficace", <?php echo $green_sub3_tot;?>, "#0c62bd"],
        ["Marketing online efficace", <?php echo $green_sub4_tot;?>, "color: #0c62bd"],
        ["Logistica officace", <?php echo $green_sub5_tot;?>, "color: #0c62bd"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2
    ]);

    var options = {
        title: "KPA - PROCESSI",

        bar: {
            groupWidth: "95%"
        },
        legend: {
            position: "none"
        },
        hAxis: {
            direction: -1,
            slantedText: true,
            slantedTextAngle: 68 // here you can even use 180 
        },
        chartArea: {
            top: 28,
            height: '40%'
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values3"));
    chart.draw(view, options);
}
</script>

<script type="text/javascript">
//form inoazione chart

google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["Element", "Density", {
            role: "style"
        }],
        ["Clima aziendale", <?php echo $green_sub1_tot*100;?>, "#1e7331"],
        ["Inovazione continuita",<?php echo $green_sub2_tot*100;?>, "#1e7331"],
        ["Competenze aziendali",<?php echo $green_sub3_tot*100;?>, "#1e7331"],
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        },
        2
    ]);

    var options = {
        title: "KPA - FORMAZIONE E INNOVAZIONE",

        bar: {
            groupWidth: "95%"
        },
        legend: {
            position: "none"
        },
        hAxis: {
            direction: -1,
            slantedText: true,
            slantedTextAngle: 68 // here you can even use 180 
        },
        chartArea: {
            top: 28,
            height: '40%'
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values4"));
    chart.draw(view, options);
}
</script>

</html>