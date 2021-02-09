<?php
$nome = '';
$cognome = '';
$username = '';
$password = '';
$telefono = '';
$indirizzo = '';
$azienda = '';
$regione = '';
$anagrafiche = '';
$status = '';

$borderClassU = '';
$borderClassP = '';
if (isset($_POST['crea'])) {
    $arrPost = newUser();

    if (!empty($arrPost)) {
        /*  $countArrPost = count($arrPost); */
        for ($i = 0; $i < count($arrPost); $i++) {
            $nome = $arrPost['nome'];
            $cognome = $arrPost['cognome'];
            $username = $arrPost['username'];
            $password = $arrPost['password'];
            $telefono = $arrPost['telefono'];
            $indirizzo = $arrPost['indirizzo'];
            $azienda = $arrPost['azienda'];
            $regione = $arrPost['regione'];
            $anagrafiche = $arrPost['anagrafiche'];
            $status = $arrPost['status'];
        }
    }

    //error border color for username input
    if (strlen($username) < 8) {
        $borderClassU = 'border border-danger';
    }

    //error border color for password input
    if (strlen($password) < 8) {
        $borderClassP = 'border border-danger';
    }
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
                                                <h4>Crea nuovo utente </h4>
                                            </center>
                                        </div>
                                        <div class="card-body">
                                            <input type="text" class="form-control" value="<?php echo $livello ?>"
                                                name="userLevel" id="userLevel" hidden>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="nome">Nome</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="<?php echo  $nome ?>"
                                                        name="nome" id="nome" required autofocus>
                                                    <div class="invalid-feedback">
                                                        Il campo nome non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="cognome">Cognome</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $cognome ?>" name="cognome" id="cognome"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo cognome non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="username">Username</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control <?php echo $borderClassU ?>"
                                                        value="<?php echo $username ?>" name="username" id="username"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo username non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control <?php echo $borderClassP ?>"
                                                        value="<?php echo $password ?>" name="password" id="password"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo password non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="telefono">Telefono</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $telefono ?>" name="telefono" id="telefono"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo telefono non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="indirizzo">Indirizzo</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $indirizzo ?>" name="indirizzo" id="indirizzo"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo indirizzo non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="azienda">Azienda</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $azienda ?>" name="azienda" id="azienda"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo azienda non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="regione">Regione</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $regione ?>" name="regione" id="regione"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Il campo regione non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if ($livello == 3) { ?>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="anagrafiche">Nr anagrafiche</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="number" class="form-control"
                                                        value="<?php echo $anagrafiche ?>" name="anagrafiche"
                                                        id="anagrafiche" required min="0" step="1">
                                                    <div class="invalid-feedback">
                                                        Il campo nr anagrafiche non deve essere vuoto
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="status">Status del utente</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <select class="form-control" id="status" name="status"
                                                        value="<?php echo $status ?>" required>
                                                        <option>Seleziona un'opzione</option>
                                                        <option value="1">Attivo</option>
                                                        <option value="0">Disattivo</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" name="crea">Crea</button>
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

    <?php include '../../jsScriptTheme.php';

    ?>


</body>

</html>