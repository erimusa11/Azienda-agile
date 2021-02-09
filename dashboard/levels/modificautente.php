<?php
global $connection;
$query = "SELECT * FROM users ";
if ($livello == 3) {
    $query .= "WHERE livello = 2";
} else if ($livello == 2) {
    $query .= "WHERE livello = 1 and id_admin = '$userId'";
}
$query .= " ORDER BY username ASC";
$result = mysqli_query($connection, $query);


if (isset($_POST['modifica'])) {
    $userId = $_POST['selectUtente'];
    modificaUtente($userId);
    header("Refresh:0");
}

logout();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>Modifica Utente</title>
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
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="card-header">
                                            <center>
                                                <h4>Modifica utente</h4>
                                            </center>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">

                                                <div class="col-md-9 col-sm-9 col-9">
                                                    <label>Seleziona utente</label>
                                                    <select class="form-control selectpicker" id="selectUtente"
                                                        name="selectUtente" title="Seleziona utente...">
                                                        <?php while ($row = mysqli_fetch_array($result)) {
                                                            $utenteId = $row['id_users'];
                                                            $fullName = $row['nome'] . ' ' . $row['cognome'];
                                                            echo '<option value="' . $utenteId . '">' . $fullName . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-3" style="margin-top: 33px">
                                                    <button id="cerca" type="button"
                                                        class="btn btn-info btn-icon icon-left"><i
                                                            class="fas fa-search"></i> Cerca</>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="nome">Nome</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="nome"
                                                        id="nome" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="cognome">Cognome</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="cognome"
                                                        id="cognome">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="username">Username</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="username"
                                                        id="username">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="password"
                                                        id="password">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="telefono">Telefono</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="telefono"
                                                        id="telefono">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="indirizzo">Indirizzo</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="indirizzo"
                                                        id="indirizzo">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="azienda">Azienda</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="azienda"
                                                        id="azienda">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="regione">Regione</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="text" class="form-control" value="" name="regione"
                                                        id="regione">
                                                </div>
                                            </div>

                                            <?php if ($livello == 3) { ?>
                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="anagrafiche">Nr anagrafiche</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <input type="number" class="form-control" value=""
                                                        name="anagrafiche" id="anagrafiche" min="0" step="1">
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <div class="form-group row">
                                                <div class="col-md-4 col-sm-4 col-8">
                                                    <label for="status">Status del utente</label>
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-12">
                                                    <select class="form-control" id="status" name="status" value="">
                                                        <option>Seleziona un'opzione</option>
                                                        <option value="1">Attivo</option>
                                                        <option value="0">Disattivo</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
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

    <script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();

        $("#cerca").click(function() {
            var adminLevel = $('#level').val();
            var adminId = $('#idAdmin').val();
            var userId = $('#selectUtente').val();
            if (userId) {
                $.ajax({
                    url: '../showUtente.php',
                    type: 'POST',
                    dataType: 'Json',
                    data: {
                        'userId': userId,
                    },
                    success: function(data) {
                        var username = data[0].username;
                        var password = data[0].password;
                        var nome = data[0].nome;
                        var cognome = data[0].cognome;
                        var email = data[0].email;
                        var telefono = data[0].telefono;
                        var azienda = data[0].azienda;
                        var regione = data[0].regione;
                        var nrAnagrafica = data[0].nrAnagrafica;
                        var status = data[0].status;

                        $('#nome').val(nome);
                        $('#cognome').val(cognome);
                        $('#username').val(username);
                        $('#password').val(password);
                        $('#telefono').val(telefono);
                        $('#indirizzo').val(email);
                        $('#azienda').val(azienda);
                        $('#regione').val(regione);
                        $('#telefono').val(telefono);
                        $('#anagrafiche').val(nrAnagrafica);

                        $("#status > option").each(function() {
                            if (this.value == status) {
                                $(this).attr("selected", "selected");
                            }
                        });

                    }
                })
            } else {
                swal('Errore', 'Devi selezionare un utente!', 'error');
            }
        })
    });
    </script>

</body>

</html>