<?php
header("Content-Type:text/html; charset=UTF-8");

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';



use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$contxt = stream_context_create([
	'ssl' => [
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true,
	],
]);

if (isset($_POST['pdfGenerator'])) {

	$compilatore = $_POST['compilatore'];
	$ragioneSociale = $_POST['ragioneSociale'];
	$tipologia = $_POST['tipologia'];
	$numeroDipendenti = $_POST['numeroDipendenti'];
	$ruolo = $_POST['ruolo'];
	$email = $_POST['email'];
	$dinamicita = $_POST['dinamicita'];
	$stabilita = $_POST['stabilita'];
	$graphSrc = $_POST['chartPNGInput'];




	if ($stabilita <= 50 && $dinamicita <= 50) {
		$title = "BLOCCATA";

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
	} else if ($stabilita > 50 && $dinamicita <= 50) {
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
	} else if ($stabilita > 50 && $dinamicita > 50) {
		$title = "La tua azienda è AGILE!";

		$text = "L'azienda AGILE unisce la capacità di mantenere <br/>
&nbsp;&nbsp;&nbsp;&nbsp;• un forte e chiaro scopo condiviso, che rappresenta le solide fondamenta
aziendali, e <br/>
&nbsp;&nbsp;&nbsp;&nbsp;• un approccio flessibile, che permette di cogliere rapidamente le
opportunità. <br/>
Le persone all'interno dell'azienda sono proattive, hanno spirito imprenditoriale,
sono aperte ai cambiamenti e attente al mutare delle preferenze dei clienti e
dell'ambiente esterno.";
	} else if ($stabilita <= 50 && $dinamicita > 50) {
		$title = "La tua azienda è START-UP";

		$left = 10;
		$top = 10;

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



	//hr style
	$hr = '<tr><td><hr style="color: #002060; background-color: #002060; height: 5px; margin-top: 30px !important;"></td></tr>';

	//fotter
	$footerImages = '<tr>
						<td bgcolor="#ffffff" style="padding: 10px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="https://azienda-agile.it/image/logoAgile.png" alt="" width="150px" style="display: block;" />
															</td>
														</tr>
													</table>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">
													&nbsp;
												</td>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="https://azienda-agile.it/image/logo.jpg" alt="" width="200px" style="float: right;" />
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>';


	$dompdf->setHttpContext($contxt);

	$htmlBody = '
<html>
<style>
 @page { margin:0px; }
</style><body style="  margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="">
					<tr>
						<td align="" bgcolor="" style="">
							<img src="https://azienda-agile.it/image/firstImage1.png" alt="Wallpaper" width="100%"/>
						</td>
					</tr>
					<tr>
						<td align="" bgcolor="" style="height:100px">
						</td>
					</tr>
					<tr>
						<td align="" bgcolor="" style="color: #153643; font-size: 40px; font-weight: bold; font-family: Montserrat, sans-serif;">
							<span style=" margin-left: 50px">AGILE INDEX</span>
							<br>
							<span style=" margin-left: 50px">Report ' . $ragioneSociale . '</span>
							<br/><br/><br/>
						</td>
					</tr>
					<tr>
						<td align="" bgcolor="" style="height:80px">
						</td>
					</tr>';

	$htmlBody .= $footerImages;


	$htmlBody .= '					
	<tr>
		<td align="" bgcolor="" style="height:50px">
		</td>
	</tr>
	<div style="page-break-before:always">&nbsp;</div>';
	$htmlBody .= $hr;




	$htmlBody .=   '<tr>
						<td style="padding: 30px 30px 0 30px; color: #5584cf; font-family: Montserrat, sans-serif; font-size: 18px;">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="15%">
                                        <label>Compilatore:</label>
									</td>
									<td>
                                        <span style=""><b>' . $compilatore . '</b></span>
									</td>
								</tr>
								<tr>
									<td width="15%">
                                        <label>Azienda:</label>
                                    </td>
                                    <td>
                                    <span><b>' . $ragioneSociale . '</b></span>
                                    </td>
								</tr>
								<tr>
									<td width="15%">
                                        <label>Tipologia:</label>
                                    </td>
                                    <td>
                                    <span style=""><b>' . $tipologia . '</b></span>
                                    </td>
								</tr>
								<tr>
									<td width="15%">
                                        <label>Numero dipendenti:</label>
                                    </td>
                                    <td>
                                     <span><b>' . $numeroDipendenti . '</b></span>
                                    </td>
								</tr>
								<tr>
									<td width="15%">
                                        <label>Ruolo:</label>
                                    </td>
                                    <td>
                                    <span><b>' . $ruolo . '</b></span>
                                    </td>
                                </tr>
                                <tr>
									<td width="15%">
                                        <label>Email:</label>
                                    </td>
                                    <td>
                                      <span><b>' . $email . '</b></span>
                                    </td>
								</tr>
                                <tr>
									<td width="15%">
                                        <label>Dinamicità:</label>
                                    </td>
                                    <td>
                                      <span><b>' . $dinamicita . '%</b></span>
                                    </td>
								</tr>
                                <tr>
									<td width="15%">
                                        <label>Stabilita:</label>
                                    </td>
                                    <td>
                                      <span><b>' . $stabilita . '%</b></span>
                                    </td>
								</tr>
							</table>
						</td>
                    </tr>


						<tr>
	    <td bgcolor="#ffffff" style="">
	        <table border="0" cellpadding="0" cellspacing="0" width="100%">
	            <tr>
	                <td>
	                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
	                        <tr>
	                            <td valign="top">
	                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
	                                    <tr>
											<td width="500px">
												   <div style="possition: relative; margin-left: 20%; margin-right: auto; height:400px; width:400px; overflow: hidden; background-image: url(https://azienda-agile.it/image/graphBackground.jpg); background-size: 350px;  background-repeat: no-repeat;  background-position: center;" >
												   <div style="possition: absolute; height:400px; width:400px; overflow: hidden; background-image: url(' . $graphSrc . '); background-size: 400px;  background-repeat: no-repeat;  background-position: center;" ></div>
												   </div>
	                                        </td>
	                                    </tr>
	                                </table>
	                            </td>
	                        </tr>
	                    </table>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>



	<tr>
	    <td width="260" valign="top" style="">
	        <table border="0" cellpadding="0" cellspacing="0" width="80%" style="padding-left: 30px;">
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td>
	                    <b>IN BREVE</b>: ' . $title . ' 
	                </td>
	            </tr>
				<tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 16px;">
	                <td><br/>
	                   ' . $text . '
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr>';

	$htmlBody .= $hr;

	$htmlBody .= $footerImages;
	$htmlBody .= '</table>
							<table>
								<tr>
	    <td style="padding: 30px 30px 30px 30px;">
	        <table border="0" cellpadding="0" cellspacing="0">
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 25px;">
	                <td width="15%">
	                    <strong><label>LEONIDA CONSULTING</label></strong>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <strong><label>Controllo e Consulenza Aziendale</label></strong>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <label>Contrada Campiglione 20,</label>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <label>63900 Fermo (FM)</label>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <br>
	                    <label>Tel.: 0734-605020</label>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <label>Mobile: 335-7589095</label>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <label>N° verde: 800-135-806</label>
	                </td>
	            </tr>
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 20px;">
	                <td width="15%">
	                    <label>email: studio@imprenditoreitaliano.it</label>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr></table>
	<table>
								<tr>
	    <td style="padding: 30px 30px 30px 30px;">
	        <table border="0" cellpadding="0" cellspacing="0">
	            <tr style="color: #5584cf; font-family: Montserrat, sans-serif; font-size: 25px;">
	                <td width="15%">
	                   <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	                </td>
	            </tr>
	        </table>
	    </td>
	</tr></table>
	';
	$htmlBody .= $footerImages;
	$htmlBody .= '</td></tr></table>
	</body></html>';


	$dompdf->loadHtml($htmlBody);

	//set page size and orientation

	$dompdf->setPaper('A4', 'portrait');

	//Render the HTML as PDF
	$dompdf->render();

	//save to server
	$output = $dompdf->output();
	$today = date('d-m-Y');
	$pdfFileName = $ragioneSociale . '_' . $today . '.pdf';
	$pdfPath = './pdfFile/' . $pdfFileName;

	//save file to server
	file_put_contents($pdfPath, $output);

	//if file is saved to server send email
	if (file_put_contents($pdfPath, $output)) {
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = 0;
			// (0): Disable debugging (you can also leave this out completely, 0 is the default).
			// (1): Output messages sent by the client.
			// (2): as 1, plus responses received from the server (this is the most useful setting).
			// (3): as 2, plus more information about the initial connection - this level can help diagnose STARTTLS failures.
			// (4): as 3, plus even lower-level information, very verbose, don't use for debugging SMTP, only low-level problems.

			$mail->isSMTP();
			$mail->Host = 'mail.175del2016.it';
			$mail->CharSet = "utf-8";
			$mail->SMTPAuth = true;
			$mail->Username = 'report@175del2016.it';
			$mail->Password = 'X8iSkpwVoZsK';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->SMTPOptions = array(
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true,
				],
			);

			// Content
			$mail->isHTML(true);

			$subject = "Report livello di agilità della tua organizzazione";
			$mail->Subject = $subject;
			$mail->AddAttachment($pdfPath, $name = $pdfFileName,  $encoding = 'base64', $type = 'application/pdf');
			$mail->Body .= '
			<!DOCTYPE html>
<html>
<head>
  
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
	<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
          <td valign="middle" class="hero bg_white" style="background:#ffffff; position: relative; z-index: 0;">
          	<div class="overlay"></div>
            <table>
            	<tr>
            		<td>
            			<div class="text" style="padding: 0 4em; text-align: center;">
            				<h1>Congratulazioni!</h1>
            				<p>Hai fatto il primo, essenziale passo per comprendere meglio la tua azienda e portarla quindi al successo che meriti.
In allegato trovi il tuo report con l\'indicazione del livello di agilità della tua organizzazione.
Adesso che sai qual è il tuo punto di partenza, puoi mettere in atto le necessarie azioni per portare la tua attività al livello successivo.
In particolare, puoi approfondire quali aree migliorare e come leggendo questo articolo:
<p><a href="https://agile-group.it/insights/organizzazioni/" class="btn btn-primary" style="padding: 5px 15px; display: inline-block; border-radius: 30px; background: #448ef6; color: #ffffff;">Leggi di più</a></p>
E, per qualsiasi informazione, non esitare a contattarci!
Ci trovi qui: <p><a href="https://agile-group.it/contattaci-per-il-tuo-successo-aziendale/" class="btn btn-primary" style="padding: 5px 15px; display: inline-block; border-radius: 30px; background: #448ef6; color: #ffffff;">Leggi di più</a></p>
<h3>Ti auguriamo una splendida giornata!
A presto!</h3></p>
            			</div>
            		</td>
            	</tr>
            </table>
          </td>
    </div>
  </center>
</body>
</html>';
			//Recipients
			$mail->setFrom('report@175del2016.it', 'Azienda Agile');
			$mail->addAddress($email, $compilatore);

			// $mail->AltBody = 'Questo è un messaggio informativo.';

			$mail->send();
			//redirect to previous page
			$previous = $_SERVER['HTTP_REFERER'];
			echo '<script language="javascript">';
			echo 'alert("Grazie per la collaborazione! Riceverai il tuo report personalizzato via email.")
			window.location.href = "' . $previous . '"';
			echo '</script>';
		} catch (Exception $e) {
			/* 	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; */
			echo '<script language="javascript">';
			echo 'alert("Si è verificato un errore durante il salvataggio dei dati")';
			echo '</script>';
		}
	}
	// file_put_contents($pdfPath, $output);

	// //return to previous page
	// if (file_put_contents($pdfPath, $output)) {
	// 	$previous = $_SERVER['HTTP_REFERER'];
	// 	header("Location: " . $previous);
	// }


	//Get output of generated pdf in Browser
	// $dompdf->stream('Webslesson', ['Attachment' => 0]);
}