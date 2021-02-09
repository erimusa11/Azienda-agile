<?php
include '../function.php';

$userId = $_POST['userId'];

global $connection;
$query = "SELECT * FROM users WHERE id_users = '$userId' ORDER BY username ASC";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $username = $row['username'];
    $password = $row['password'];
    $telefono = $row['numero_telefono'];
    $email = $row['email'];
    $azienda = $row['ragione_sociale'];
    $regione = $row['regione'];
    $nrAnagrafica = $row['nr_anagrafiche'];
    $status = $row['status'];


    $data[] = array(
        'username'  => $username,
        'password'  => $password,
        'nome'  => $nome,
        'cognome'  => $cognome,
        'email' => $email,
        'telefono' => $telefono,
        'azienda' => $azienda,
        'regione' => $regione,
        'nrAnagrafica' => $nrAnagrafica,
        'status' => $status
    );
}
echo json_encode($data);