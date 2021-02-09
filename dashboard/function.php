<?php
date_default_timezone_set('Europe/Rome');
include "dbconnection.php";
session_start();

//******************************************************* login function *******************************************/
function login()
{
    global $connection;

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        //query to get users from studio
        $query = "SELECT * from users WHERE username = '$username' AND password = '$password' AND status = 1";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            return header("Location: ./index.php?error=1");
        }
        while (($row = mysqli_fetch_array($result))) {
            if ($username === $row['username'] && $password === $row['password']) {
                $_SESSION['userId'] = $row['id_users'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['settore_attivita'] = $row['settore_attivita'];
                $_SESSION['fascia_dipendenti'] = $row['fascia_dipendenti'];
                $_SESSION['ruolo'] = $row['ruolo'];
                $_SESSION['numero_telefono'] = $row['numero_telefono'];
                $_SESSION['ragione_sociale'] = $row['ragione_sociale'];
                $_SESSION['team_assegnato'] = $row['team_assegnato'];
                $_SESSION['livello'] = $row['livello'];


                if ($_SESSION['livello'] == 1) {
                    return header("Location: survey.php");
                } elseif ($_SESSION['livello'] == 2) {
                    return header("Location: ./levels/admin/dashboard.php");
                } elseif ($_SESSION['livello'] == 3) {
                    return header("Location: ./levels/superadmin/dashboard.php");
                }
            }
        }
    }
}
//******************************************************* login function ********************************/


//******************************************************* logout function ********************************/
function logout()
{
    if (isset($_POST['logout'])) {
        $_SESSION = array();
        session_destroy();
        return header("Location: ../../index.php");
        exit();
    }
}
//******************************************************* logout function ********************************/


//******************************************************* create new user function ********************************/
function newUser()
{
    if (isset($_POST['crea'])) {
        global $connection;

        //id user logged in
        $id_admin = $_SESSION['userId'];

        $livello = $_POST['userLevel'];

        $nome = $_POST['nome'];
        $nome = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $nome);

        $cognome = $_POST['cognome'];
        $cognome = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $cognome);

        $username = $_POST['username'];
        $username = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $username);
        $usernamelength = strlen($username);
        if ($usernamelength < 8) {
            /* echo "<script type='text/javascript'>swal('Errore', 'Il username deve contenere più di 8 caratteri!', 'error');</script>"; */
            echo "<script type='text/javascript'>alert('Il username deve contenere più di 8 caratteri!');</script>";
            return $_POST;
        }

        $password = $_POST['password'];
        $password = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $password);
        $passwordlength = strlen($password);
        if ($passwordlength < 8) {
            /* echo "<script type='text/javascript'>swal('Errore', 'Il password deve contenere più di 8 caratteri!', 'error');</script>"; */
            echo "<script type='text/javascript'>alert('Il password deve contenere più di 8 caratteri!');</script>";
            return $_POST;
        }

        $telefono = $_POST['telefono'];
        $telefono = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $telefono);

        $indirizzo = $_POST['indirizzo'];
        $indirizzo = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $indirizzo);

        $azienda = $_POST['azienda'];
        $azienda = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $azienda);

        $regione = $_POST['regione'];
        $regione = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $regione);

        $anagrafiche = $_POST['anagrafiche'];
        $anagrafiche = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $anagrafiche);

        $status = $_POST['status'];
        $status = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $status);

        //check if this username exist
        $queryCheckUsername = "SELECT * FROM users WHERE username = '$username'";
        $resultCheckUsername = mysqli_query($connection, $queryCheckUsername);
        $numCheckUsername = mysqli_num_rows($resultCheckUsername);
        if ($numCheckUsername > 0) {
            /*   echo "<script type='text/javascript'>swal('Errore', 'Questo username esiste! Prova un altro username!', 'error');</script>"; */
            echo "<script type='text/javascript'>alert('Questo username esiste! Prova un altro username!');</script>";
            return $_POST;
        } else {
            $queryInsert = "INSERT INTO users (username, password, nome, cognome, email, regione, numero_telefono, ragione_sociale,";

            if ($livello == 3) {
                $livelloUser = 2;
                $queryInsert .= " nr_anagrafiche, status, livello, id_admin) VALUES ('$username', '$password', '$nome', '$cognome', '$indirizzo', '$regione', '$telefono', '$azienda', '$anagrafiche', '$status', '$livelloUser', '$id_admin') ";
                $resultInsert = mysqli_query($connection, $queryInsert);
            } else if ($livello == 2) {
                $livelloUser = 1;
                $queryInsert .= " status, livello, id_admin) VALUES ('$username', '$password', '$nome', '$cognome', '$indirizzo', '$regione', '$telefono', '$azienda', '$status', '$livelloUser', '$id_admin') ";

                //check ana graficha
                $checkAnaGraficha = "SELECT nr_anagrafiche FROM users WHERE id_users = '$id_admin'";
                $resultAnaGraficha = mysqli_query($connection, $checkAnaGraficha);
                $rowAnaGraficha = mysqli_fetch_assoc($resultAnaGraficha);
                $nrAnagraficha = $rowAnaGraficha['nr_anagrafiche'];


                //count users
                $queryCountUsers = "SELECT COUNT(id_users) AS nrUsers
                FROM users 
                WHERE id_admin = '$id_admin'";
                $resultCountUsers = mysqli_query($connection, $queryCountUsers);
                $rowCountUsers = mysqli_fetch_assoc($resultCountUsers);
                $nrCountUsers = $rowCountUsers['nrUsers'];

                if ($nrCountUsers >= $nrAnagraficha) {
                    /* echo "<script type='text/javascript'>swal('Errore', 'Sei arrivato al limite dell'utente! Contatta l'amministratore per il upgrade!', 'error');</script>"; */
                    echo "<script type='text/javascript'>alert('Sei arrivato al limite dell'utente! Contatta l'amministratore per il upgrade!');</script>";
                    return $_POST;
                } else {
                    $resultInsert = mysqli_query($connection, $queryInsert);
                }
            }

            if ($resultInsert) {
                /*  echo "<script type='text/javascript'>swal('Successo', 'L\'utente è stato creato con successo!', 'success');</script>"; */
                echo "<script type='text/javascript'>alert('L\'utente è stato creato con successo!');</script>";
            } else {
                /*  echo "<script type='text/javascript'>swal('Errore', 'L\'utente non è stato creato!', 'error');</script>"; */
                echo "<script type='text/javascript'>alert('L\'utente non è stato creato!');</script>";
                return $_POST;
            }
        }
    }
}
//******************************************************* create new user function ********************************/

//******************************************************* modifica profilo function ********************************/
function modificaProfile()
{
    global $connection;
    $userId = $_SESSION['userId'];

    $nome = $_POST['nome'];
    $nome = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $nome);

    $cognome = $_POST['cognome'];
    $cognome = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $cognome);

    $username = $_POST['username'];
    $username = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $username);

    $password = $_POST['password'];
    $password = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $password);

    $telefono = $_POST['telefono'];
    $telefono = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $telefono);

    $indirizzo = $_POST['indirizzo'];
    $indirizzo = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $indirizzo);

    $azienda = $_POST['azienda'];
    $azienda = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $azienda);

    $regione = $_POST['regione'];
    $regione = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $regione);

    $anagrafiche = $_POST['anagrafiche'];
    $anagrafiche = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $anagrafiche);

    $status = $_POST['status'];
    $status = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $status);


    $queryUpdate = "UPDATE users SET username = '$username', password = '$password', nome = '$nome', cognome = '$cognome', email = '$indirizzo', regione = '$regione', numero_telefono = '$telefono', ragione_sociale = '$azienda' WHERE id_users = '$userId'";

    $resultUpdate = mysqli_query($connection, $queryUpdate);
    if ($resultUpdate) {
        /*  echo "<script type='text/javascript'>swal('Successo', 'L\'utente è stato creato con successo!', 'success');</script>"; */
        echo "<script type='text/javascript'>alert('L\'utente è stato aggiornato con successo!');</script>";
    } else {
        /*  echo "<script type='text/javascript'>swal('Errore', 'L\'utente non è stato creato!', 'error');</script>"; */
        echo "<script type='text/javascript'>alert('L\'utente non è stato aggiornato!');</script>";
        return $_POST;
    }
}
//******************************************************* modifica profilo function ********************************/


//******************************************************* modifica profilo function ********************************/
function modificaUtente($userId)
{
    global $connection;

    $nome = $_POST['nome'];
    $nome = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $nome);

    $cognome = $_POST['cognome'];
    $cognome = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $cognome);

    $username = $_POST['username'];
    $username = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $username);

    $password = $_POST['password'];
    $password = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $password);

    $telefono = $_POST['telefono'];
    $telefono = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $telefono);

    $indirizzo = $_POST['indirizzo'];
    $indirizzo = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $indirizzo);

    $azienda = $_POST['azienda'];
    $azienda = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $azienda);

    $regione = $_POST['regione'];
    $regione = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $regione);

    $anagrafiche = $_POST['anagrafiche'];
    $anagrafiche = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $anagrafiche);

    $status = $_POST['status'];
    $status = str_replace(array(" ", "'", "’", "“", "”"), array("", "\'", "\'", "\'", "\'"), $status);


    $queryUpdate = "UPDATE users SET username = '$username', password = '$password', nome = '$nome', cognome = '$cognome', email = '$indirizzo', regione = '$regione', numero_telefono = '$telefono', ragione_sociale = '$azienda', nr_anagrafiche = '$anagrafiche', status = '$status' WHERE id_users = '$userId'";

    $resultUpdate = mysqli_query($connection, $queryUpdate);
    if ($resultUpdate) {
        /*  echo "<script type='text/javascript'>swal('Successo', 'L\'utente è stato creato con successo!', 'success');</script>"; */
        echo "<script type='text/javascript'>alert('L\'utente è stato aggiornato con successo!');</script>";
    } else {
        /*  echo "<script type='text/javascript'>swal('Errore', 'L\'utente non è stato creato!', 'error');</script>"; */
        echo "<script type='text/javascript'>alert('L\'utente non è stato aggiornato!');</script>";
        return $_POST;
    }
}
//******************************************************* modifica profilo function ********************************/


//******************************************************* delete user function ********************************/

function deleteUser($userId)
{
    global $connection;
    $query = "DELETE FROM users WHERE id_users = '$userId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script type='text/javascript'>alert('L\'utente è stato eliminato!');</script>";
    } else {
        echo "<script type='text/javascript'>alert('L\'utente non è stato eliminato!');</script>";
    }
}
//******************************************************* delete user function ********************************/


//******************************************************* activate user function ********************************/

function activateUser($userId)
{
    global $connection;

    //activate admin
    $query = "UPDATE users SET status = 1 WHERE id_users = '$userId'";
    $result = mysqli_query($connection, $query);

    //activate user
    $queryUser = "UPDATE users SET status = 1 WHERE id_admin = '$userId'";
    $resultUser = mysqli_query($connection, $queryUser);

    if ($result) {
        echo "<script type='text/javascript'>alert('L\'utente è stato attivato!');</script>";
    } else {
        echo "<script type='text/javascript'>alert('L\'utente non è stato attivato!');</script>";
    }
}
//******************************************************* delete user function ********************************/


//******************************************************* deactivate user function ********************************/

function deactivateUser($userId)
{
    global $connection;

    //activate admin
    $query = "UPDATE users SET status = 0 WHERE id_users = '$userId'";
    $result = mysqli_query($connection, $query);

    //activate user
    $queryUser = "UPDATE users SET status = 0 WHERE id_admin = '$userId'";
    $resultUser = mysqli_query($connection, $queryUser);

    if ($result) {
        echo "<script type='text/javascript'>alert('L\'utente è stato disattivato!');</script>";
    } else {
        echo "<script type='text/javascript'>alert('L\'utente non è stato disattivato!');</script>";
    }
}
//******************************************************* delete user function ********************************/


//******************************************************* assumi identità function *******************************************/
function assumiIdentita($username, $password)
{
    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    //query to get users from studio
    $query = "SELECT * from users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    while (($row = mysqli_fetch_array($result))) {
        if ($username === $row['username'] && $password === $row['password']) {
            $_SESSION['userId'] = $row['id_users'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['cognome'] = $row['cognome'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['settore_attivita'] = $row['settore_attivita'];
            $_SESSION['fascia_dipendenti'] = $row['fascia_dipendenti'];
            $_SESSION['ruolo'] = $row['ruolo'];
            $_SESSION['numero_telefono'] = $row['numero_telefono'];
            $_SESSION['ragione_sociale'] = $row['ragione_sociale'];
            $_SESSION['team_assegnato'] = $row['team_assegnato'];
            $_SESSION['livello'] = $row['livello'];

            return header("Location: ../admin/dashboard.php");
        }
    }
}
//******************************************************* login function ********************************/