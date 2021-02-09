<?php
include 'function.php';
include 'dbconnection.php';
?>

<?php
salvaRisposte();

global $connection;
mysqli_set_charset($connection, "utf8");
$query_questions = "SELECT * FROM tabela_domande";
$result_questions = mysqli_query($connection, $query_questions);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'cssLinks.php' ?>
	<style>
		.disabled {
			pointer-events: none;
		}
	</style>
	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>


	<style>

	</style>
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
		<div class="row row-height">
			<div class="col-lg-6 content-left">
				<div class="content-left-wrapper" style="background-color:background: #373B44;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
;">


					<div>
						<img src="https://www.mappastrategica.it/dashboard/image/logo.png" class="col" alt="">
						<h2>Agile Index Test </h2>
						<label class="text-light">Test di autovalutazione, semplice e gratuito, basato sulla logica della Agile Organization, a
							vostra disposizione per aiutarvi a capire in chiave preliminare, qual è l'indice di agilità
							della vostra organizzazione, quali sono i punti di forza che rendono la vostra azienda
							agile, e quali invece gli ostacoli che possono frenare la performance della vostra
							organizzazione. <br><br>
							Questo test è composto da 36 domande
							<br><br>
							ISTRUZIONI OPERATIVE
							<br><br>
							Per ogni domanda, semplicemente rispondete scegliendo tra le tre opzioni, considerando che:<br>
							- SI significa “risposta affermativa o abbastanza affermativa”;<br>
							- +/- significa “più o meno, tra il SI e il NO”;<br>
							- NO significa "risposta negativa o praticamente negativa".<br>
							<br><br>
							ESONERO DI RESPONSABILITÀ'
							<br><br>
							Con la scelta di effettuare il test esonerate AGILE GROUP Srl e le persone, le aziende a loro correlate o affiliate, da qualsiasi responsabilità e qualsiasi azione o causa legale di qualsiasi tipo, natura e descrizione derivante o connessa alla vostra esecuzione del test, in relazione all'utilizzo del risultato del test da parte dell'azienda. AGILE GROUP Srl non è responsabile di eventuali decisioni prese dall'azienda che ha richiesto di completare il test. Le informazioni contenute nel report non devono essere utilizzate come unico elemento su cui basare le decisioni aziendali. Indicando la vostra e-mail confermate che avete letto e compreso questo accordo. <br><br> </label>

					</div>
					<div class="copy">© 2020 Agile Index Test</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<div id="top-wizard">
						<div id="progressbar"></div>
					</div>
					<!-- /top-wizard -->
					<form action="index.php" method="POST">
						<input id="website" name="website" type="text" value="">
						<!-- Leave for security protection, read docs for details -->
						<div id="middle-wizard">
							<div class="step">
								<h3 class="main_question">Metti i tuoi dati</h3>
								<div class="form-group">
									<label for="">Email </label>
									<input type="email" name="email" class="form-control required" placeholder="E-mail">
								</div>
								<div class="form-group">
									<label for="">Scrivi il tuo nome e il tuo cognome </label>
									<input type="text" name="cognome" class="form-control required" placeholder="Nome Cognome">
								</div>
								<div class="form-group">
									<label for="">Scrivi la ragione sociale della tua azienda </label>
									<input type="text" name="ragione_sociale" class="form-control required" placeholder="Ragione Sociale">
								</div>
								<div class="form-group">
									<label for="">Scrivi il tuo ruolo in azienda</label>
									<input type="text" name="ruolo" class="form-control required">
								</div>
								<div class="form-group terms">
									<label class="container_check">Accetta la gestione dei dati da parte di questo sito in conformità con la nostra politica sulla privacy
										<input type="checkbox" name="terms" value="Yes" class="required">
										<span class="checkmark"></span>
									</label>
								</div>

							</div>
							<div class="step">
								<h3 class="main_question">Seleziona il range numerico corrispondente alla quantità di dipendenti della tua azienda </h3>
								<br>
								<div class="form-group">
									<label class="container_radio version_2">Minore di 15
										<input type="radio" name="range_numerico[]" value="Minore di 15" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">Tra 15 e 100
										<input type="radio" name="range_numerico[]" value="Tra 15 e 100" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">Tra 100 e 500
										<input type="radio" name="range_numerico[]" value="Tra 100 e 500" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">Maggiore di 500
										<input type="radio" name="range_numerico[]" value="Maggiore di 500" class="required">
										<span class="checkmark"></span>
									</label>
								</div>

							</div>

							<div class="step">
								<br><br><br><br>
								<h5 class="main_question">Seleziona il settore d'attività della tua azienda </h5>
								<br>
								<div class="form-group">
									<label class="container_radio version_2">AGRICOLTURA, SILVICOLTURA E PESCA
										<input type="radio" name="settore[]" value="AGRICOLTURA, SILVICOLTURA E PESCA" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">ESTRAZIONE
										<input type="radio" name="settore[]" value="ESTRAZIONE" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">MANIFATTURA
										<input type="radio" name="settore[]" value="MANIFATTURA" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">PRODUZIONE ENERGIA E GAS
										<input type="radio" name="settore[]" value="PRODUZIONE ENERGIA E GAS" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">TRASM. ENERGIA E GAS

										<input type="radio" name="settore[]" value="TRASM. ENERGIA E GAS" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">DISTRIBUZIONE ENERGIA E GAS
										<input type="radio" name="settore[]" value="DISTRIBUZIONE ENERGIA E GAS" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">FORN. ACQUA RETI FOGNARIE
										<input type="radio" name="settore[]" value="FORN. ACQUA RETI FOGNARIE" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">COSTRUZIONE EDIFICI
										<input type="radio" name="settore[]" value="COSTRUZIONE EDIFICI" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">INGEGNERIA CIVILE
										<input type="radio" name="settore[]" value="INGEGNERIA CIVILE" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">COSTRUZ. SPECIALIZZZATE
										<input type="radio" name="settore[]" value="COSTRUZ. SPECIALIZZZATE" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">COMM. INGROSSP E DETT. AUTOVEICOLI
										<input type="radio" name="settore[]" value="COMM. INGROSSP E DETT. AUTOVEICOLI" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">COMM. INGROSSO
										<input type="radio" name="settore[]" value="COMM. INGROSSO" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">COMM. DETTAGLIO
										<input type="radio" name="settore[]" value="COMM. DETTAGLIO" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">TRASPORTO E MAGAZZINAGGIO
										<input type="radio" name="settore[]" value="TRASPORTO E MAGAZZINAGGIO" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">HOTEL
										<input type="radio" name="settore[]" value="HOTEL" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">BAR E RISTORANTI
										<input type="radio" name="settore[]" value="BAR E RISTORANTI" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">SERVIZI ALLE IMPRESE
										<input type="radio" name="settore[]" value="SERVIZI ALLE IMPRESE" class="required">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="form-group">
									<label class="container_radio version_2">SERVIZI ALLE PERSONE
										<input type="radio" name="settore[]" value="SERVIZI ALLE PERSONE" class="required">
										<span class="checkmark"></span>
									</label>
								</div>

							</div>


							<?php while ($row_id_question = mysqli_fetch_array($result_questions)) {
								$id_question = $row_id_question['domand_id']; ?>
								<!-- /step 1-->
								<div class="<?php echo ($id_question == 35) ? 'submit' : ''; ?> step">
									<h3 class="main_question"><strong><?php echo $id_question  ?>/36</strong> <?php echo   $row_id_question['domanda_testo']; ?></h3>
									<input type="text" hidden name="id_qestions[]" class="form-control" value="<?php echo  $id_question;  ?>">
									<br>
									<div class="form-group">
										<label class="container_radio version_2">Si
											<input type="radio" name="question_[<?php echo $id_question ?>]" value="1" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">+/-
											<input type="radio" name="question_[<?php echo $id_question ?>]" value="2" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_[<?php echo $id_question ?>]" value="3" class="required">
											<span class="checkmark"></span>
										</label>
									</div>

								</div>
								<!-- /step-->
							<?php } ?>
						</div>
						<!-- /middle-wizard -->
						<div id="bottom-wizard">
							<button type="button" name="backward" class="backward">Precedente</button>
							<button type="button" name="forward" class="forward" id="forward">Successivo</button>
							<button type="submit" name="process" class="submit">Salva</button>
						</div>
						<!-- /bottom-wizard -->

					</form>
				</div>


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


	<!-- /menu button -->


	<?php include 'scripst.php' ?>

</body>



</html>