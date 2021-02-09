<?php
global $connection;
$query = "SELECT * FROM users WHERE id_users = '$userId'";
$result = mysqli_query($connection, $query);


if (isset($_POST['modifica'])) {
    modificaProfile();
    header("Refresh:0");
}

logout();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>Nuovo Utente</title>
    <!-- General CSS Files -->
    <?php include '../../cssLinkTheme.php' ?>
</head>

<body class="layout-3">
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper container-fluid">
            <div class="navbar-bg"></div>

            <?php include '../../navbar.php' ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <!--  <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title m-b-0">Dashboard</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="dahboard.php">
                                <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Nuovo Utente</li>
                    </ul> -->
                    <div class="section-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                        class="needs-validation" novalidate="">
                                        <div class="card-header">
                                            <center>
                                                <h4>Modifica il tuo profilo</h4>
                                            </center>
                                        </div>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            $idUser = $row['id_users'];
                                            $username = $row['username'];
                                            $password = $row['password'];
                                            $nome = $row['nome'];
                                            $cognome = $row['cognome'];
                                            $email = $row['email'];
                                            $telefono = $row['numero_telefono'];
                                            $ragioneSociale = $row['ragione_sociale'];
                                            $regione = $row['regione'];
                                            $nrAnagrafiche = $row['nr_anagrafiche'];
                                            $status = $row['status'];
                                        ?>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="nome">Nome</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="<?php echo  $nome ?>"
                                                        name="nome" id="nome" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="cognome">Cognome</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $cognome ?>" name="cognome" id="cognome">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="username">Username</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $username ?>" name="username" id="username">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $password ?>" name="password" id="password">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="telefono">Telefono</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $telefono ?>" name="telefono" id="telefono">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="indirizzo">Indirizzo</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="<?php echo $email ?>"
                                                        name="indirizzo" id="indirizzo">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="azienda">Azienda</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $ragioneSociale ?>" name="azienda"
                                                        id="azienda">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="regione">Regione</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $regione ?>" name="regione" id="regione">
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" name="modifica">Modifica</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include '../../footer.php' ?>
        </div>
    </div>

    <?php include '../../jsScriptTheme.php'; ?>

</body>

</html>