<?php
   function salvaRisposte(){
   global $connection;
   if (isset($_POST['process'])) {
   
		$email = $_POST['email'];
		$cognome = $_POST['cognome'];
		$ragione_sociale = $_POST['ragione_sociale'];
		$ruolo = $_POST['ruolo'];
		$range_numerico = $_POST['range_numerico'];
		$settore = $_POST['settore'];
		

        $radio = $_POST['question_'];
        $id_qestions = $_POST['id_qestions'];



//add to array selected answers
$Array = array();
        foreach($_POST['question_'] as $key=>$arr)
{
    $Array[] = $arr;
}
$query1="INSERT INTO users (email,nome_cognome,ragione_sociale,ruolo_azienda) VALUES ( '$email','$cognome','$ragione_sociale','$ruolo')";
$result_query1=mysqli_query($connection,$query1);
$last_id = mysqli_insert_id($connection);
//insert the 2 data radiobuttons
for ($i=0; $i<count($range_numerico); $i++) {
$query2="UPDATE users SET settore='$settore[$i]' , range_numerico='$range_numerico[$i]' WHERE user_id='$last_id'";
$result_query2=mysqli_query($connection,$query2);
}

//insert the answers
for ($i=0; $i<count($Array); $i++) {
$id_question=$id_qestions[$i];
$answer=$Array[$i];
if($answer==1){
    $punteggio = 1;
} else if ($answer==2){
    $punteggio = 0.5;
} else if($answer==3){
    $punteggio = 0;
}

    $find_tipology= "SELECT tipology FROM tabela_domande WHERE domand_id='$id_question'";
    $result_tipology=mysqli_query($connection,$find_tipology);
    $row_tipology = mysqli_fetch_assoc($result_tipology);
    $tipology =$row_tipology['tipology'];
   

  $query="INSERT INTO domande_salvate (domanda_id,risposte,user_id,punteggio,tipology) VALUES ( '$id_question','$answer','$last_id','$punteggio','$tipology')";
 
 $result_query=mysqli_query($connection,$query);
}
       
        if ($result_query) {
            return header("Location: successo.php?result=".$last_id);
            
        }


        if (!$result_query) {
            echo "error ".mysqli_error($connection);

            exit();
        }
        
    }
}
 ?>