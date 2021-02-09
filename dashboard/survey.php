
<?php 
session_start();
include 'function.php';
include 'dbconnection.php' ;

$userId = $_SESSION['userId'];
if (!isset($userId) || ($_SESSION['livello'] != 1)) {
    header("Location: index.php");
}

   global $connection;
   
	$query_toti = "SELECT COUNT(id_answer) AS FirstTime FROM save_answer WHERE id_user='$userId'";
	$result_toti=mysqli_query($connection,$query_toti);
	$row_toti=mysqli_fetch_assoc($result_toti);


		if($row_toti['FirstTime'] > 0 ){
            return header("Location: result.php?result=1");
				exit;
		}
   if (isset($_POST['process'])) {
   
		$email = $_POST['email'];
		$nome_cognome = $_POST['nome_cognome'];
		$numero_telefono = $_POST['telefono'];
		$ruolo = $_POST['ruolo'];
		$ragione_sociale = $_POST['ragione_sociale'];
		$dipendenti = $_POST['dipendenti'];
		$settore = $_POST['settore'];

        $radio = $_POST['question_'];
        $id_qestions = $_POST['id_qestions'];
		$user_id = $_SESSION['userId'];


//add to array selected answers
$Array = array();
        foreach($_POST['question_'] as $key=>$arr)
{
    $Array[] = $arr;
}


//insert the answers
for ($i=0; $i<count($Array); $i++) {
$id_question=$id_qestions[$i];
$answer=$Array[$i];

$query_get_tipology="SELECT * FROM questions_table WHERE id='$id_question'";
   $result_get_tipology=mysqli_query($connection,$query_get_tipology);
$row_get_tipology=mysqli_fetch_assoc($result_get_tipology);


$tipology=$row_get_tipology['question_tipology'];
$subcategory=$row_get_tipology['sub_category'];

if($answer == 1 ){

	$punteggio=0;

} else if( $answer == 2){

	$punteggio=1;
}

else if( $answer == 3){

	$punteggio=2;
}
else if( $answer == 4){

	$punteggio=3;
}
else if( $answer == 5){

	$punteggio=4;
}

  $query="INSERT INTO save_answer (id_question,answer_questions,question_tipology,subcategory_question,punteggio,id_user) VALUES ( '$id_question','$answer','$tipology','$subcategory',$punteggio,'$user_id')";
 
 $result_query=mysqli_query($connection,$query);
}
       
        if ($result_query) {
            return header("Location: result.php?result=1");
            
        }


        if (!$result_query) {
            echo "error ".mysqli_error($connection);

            exit();
        }
        
    }


global $connection;
mysqli_set_charset($connection, "utf8");
$query_questions="SELECT * FROM questions_table";
$result_questions=mysqli_query($connection,$query_questions);

?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'cssLinks.php' ?>
<style>

/*  notes custom dimension and custom ofverflow */
.notesscroll {
    height: 110px;
    overflow: auto;
}

/* scroll bar custom style for all the pages */
::-webkit-scrollbar {
    width: 7px;
    height: 7px;
}

/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #3cd9cc;
    -webkit-box-shadow: inset 0 0 6px #3cd9cc;
}

::-webkit-scrollbar-thumb:window-inactive {
    background: #3cd9cc;
}
</style>
</head>

<body class="style_1">
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->

	<header>

	    <!-- /container -->
	</header>
	<!-- /header -->

	<div class="wrapper_centering">
	    <div class="container_centering" >
	        <div class="container" >
	            <div class="row justify-content-between" >
	                <div class="col-xl-6 col-lg-6 d-flex align-items-center">
					<div>
					<img src="https://www.mappastrategica.it/dashboard/image/logo.png" class="col" alt="">
					<br>
						<h4 class="text-light">Agile Index Test </h4>
						<label class="text-light">Test di autovalutazione, semplice e gratuito, basato sulla logica della Agile Organization, a
                            vostra disposizione per aiutarvi a capire in chiave preliminare, qual è l'indice di agilità
                            della vostra organizzazione, quali sono i punti di forza che rendono la vostra azienda
                            agile, e quali invece gli ostacoli che possono frenare la performance della vostra
                            organizzazione. <br><br>
                            Questo test è composto da 36 domande  
							<br><br>
                         
							<br>
                            ESONERO DI RESPONSABILITÀ
							<br><br>
                            Con la scelta di effettuare il test esonerate Olivero Andrea e le persone, le aziende a lui
                            correlate o affiliate, da qualsiasi responsabilità e qualsiasi azione o causa legale di
                            qualsiasi tipo, natura e descrizione derivante o connessa alla vostra esecuzione del test,
                            in relazione all'utilizzo del risultato del test da parte dell’azienda. Olivero Andrea non è
                            responsabile di eventuali decisioni prese dall'azienda che ha richiesto di completare il
                            test. Le informazioni contenute nel report non devono essere utilizzate come unico elemento
                            su cui basare le decisioni aziendali. 
                            Indicando la vostra e-mail confermate che avete letto e compreso questo accordo. </label>
					
					</div>
	                </div>
	                <!-- /col -->
	                <div class="col-xl-5 col-lg-5"style="overflow-y:scroll;" >
	                    <div id="wizard_container" >
	                        <div id="top-wizard">
	                            <div id="progressbar"></div>
	                        </div>
	                        <!-- /top-wizard -->
	                        <form id="wrapped" action="survey.php" method="POST" autocomplete="off">
	                            <input id="website" name="website" type="text" value="">
	                            <!-- Leave for security protection, read docs for details -->
	                            <div id="middle-wizard" >
						
					
								<?php while ($row_id_question = mysqli_fetch_array($result_questions)) { 
                                    $id_question=$row_id_question['id']; ?>

	                                <div class=" <?php echo ($id_question==40)? 'submit':''; ?>  step">
	                                    <h3 class="main_question"><strong><?php echo $id_question  ?> / 40</strong> <?php echo   $row_id_question['question_text']; ?></h3>
										<input type="text" hidden name="id_qestions[]" class="form-control" value="<?php echo  $id_question;  ?>" >
	                                    <div class="review_block">
	                                        <ul>
	                                            <li>
	                                                <div class="checkbox_radio_container">
	                                                    <input type="radio" id="1_[<?php echo $id_question?>]" name="question_[<?php echo $id_question?>]" class="required" value="1" >
	                                                    <label class="radio" for="1_[<?php echo $id_question?>]"></label>
	                                                    <label for="1_[<?php echo $id_question?>]" class="wrapper">1</label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="checkbox_radio_container">
	                                                    <input type="radio" id="2_[<?php echo $id_question?>]" name="question_[<?php echo $id_question?>]" class="required" value="2" >
	                                                    <label class="radio" for="2_[<?php echo $id_question?>]"></label>
	                                                    <label for="2_[<?php echo $id_question?>]" class="wrapper">2</label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="checkbox_radio_container">
	                                                    <input type="radio" id="3_[<?php echo $id_question?>]" name="question_[<?php echo $id_question?>]" class="required" value="3">
	                                                    <label class="radio" for="3_[<?php echo $id_question?>]"></label>
	                                                    <label for="3_[<?php echo $id_question?>]" class="wrapper">3</label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="checkbox_radio_container">
	                                                    <input type="radio" id="4_[<?php echo $id_question?>]" name="question_[<?php echo $id_question?>]" class="required" value="4" >
	                                                    <label class="radio" for="4_[<?php echo $id_question?>]"></label>
	                                                    <label for="4_[<?php echo $id_question?>]" class="wrapper">4</label>
	                                                </div>
	                                            </li>
												<li>
	                                                <div class="checkbox_radio_container">
	                                                    <input type="radio" id="5_[<?php echo $id_question?>]" name="question_[<?php echo $id_question?>]" class="required" value="5" >
	                                                    <label class="radio" for="5_[<?php echo $id_question?>]"></label>
	                                                    <label for="5_[<?php echo $id_question?>]" class="wrapper">5</label>
	                                                </div>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                
	                                </div>
									<?php }?>
	                                
	                            </div>
	                            <!-- /middle-wizard -->

	                            <div id="bottom-wizard">
	                                <button type="button" name="backward" class="backward">Precedente</button>
	                                <button type="button" name="forward" class="forward">Successivo</button>
	                                <button type="submit" name="process" class="submit">Salva</button>
	                            </div>
	                            <!-- /bottom-wizard -->

	                        </form>
	                    </div>
	                    <!-- /Wizard container -->
	                </div>
	                <!-- /col -->
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container_centering -->
	    <footer>
	        <div class="container-fluid">
	            <div class="row">
	                <div class="col-md-3">
	                    ©2020 
	                </div>
	          
	            </div>
	            <!-- /row -->
	        </div>
	        <!-- /container-fluid -->
	    </footer>
	    <!-- /footer -->
	</div>
	<!-- /wrapper_centering -->

	
	<!-- COMMON SCRIPTS --><?php include 'scipts.php' ?>


</body>
</html>