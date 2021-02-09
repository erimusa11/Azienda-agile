<?php
global $connection;
$query = "SELECT * FROM users WHERE id_admin = '$userId' ORDER BY username ";

if ($livello == 3) {
    $query .= " AND livello = 2";
} else if ($livello == 2) {
    $query .= " AND livello = 1";
}
$result = mysqli_query($connection, $query);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    assumiIdentita($username, $password);
}

if (isset($_POST['delete'])) {
    $userId = $_POST['userId'];
    deleteUser($userId);
    header("Refresh:0");
}

if (isset($_POST['lockOpen'])) {
    $userId = $_POST['userId'];
    deactivateUser($userId);
    header("Refresh:0");
}

if (isset($_POST['lockClose'])) {
    $userId = $_POST['userId'];
    activateUser($userId);
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard</title>
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
                    <!--            <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title m-b-0">Dashboard</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul> -->
                    <div class="section-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Client</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport"
                                                style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Nome</th>
                                                        <th>Cognome</th>
                                                        <th>Email</th>
                                                        <th>Ragione <br>Sociale</th>
                                                        <th>Regione</th>
                                                        <th>Status</th>
                                                        <?php if ($livello == 3) { ?>
                                                        <th>Nr <br>Anagrafica</th>
                                                        <th>Assumi <br>Identita</th>
                                                        <th>Disattiva</th>
                                                        <th>Elimina</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $idUser = $row['id_users'];
                                                        $username = $row['username'];
                                                        $password = $row['password'];
                                                        $nome = $row['nome'];
                                                        $cognome = $row['cognome'];
                                                        $email = $row['email'];
                                                        $ragioneSociale = $row['ragione_sociale'];
                                                        $regione = $row['regione'];
                                                        $nrAnagrafiche = $row['nr_anagrafiche'];
                                                        $status = $row['status'];
                                                        $statusString = "";
                                                        $statusForm = "";
                                                        if ($status == 1) {
                                                            $statusString = "Attivo";
                                                            $statusForm = '<form action="" method="POST">
                                                            <input hidden type="text" name="userId" value="' . $idUser . '">
                                                            <button id="button" class="btn btn-success" name="lockOpen"><i
                                                                    class="fas fa-lock-open"></i></button>
                                                                    </form>';
                                                        } else {
                                                            $statusString = "Disattivo";
                                                            $statusForm = '<form action="" method="POST">
                                                            <input hidden type="text" name="userId" value="' . $idUser . '">
                                                            <button id="button" class="btn btn-danger" name="lockClose"><i
                                                                    class="fas fa-lock"></i></button>
                                                                    </form>';
                                                        }

                                                        echo "<tr>";
                                                        echo "<td>" . $username . "</td>";
                                                        echo "<td>" . $nome . "</td>";
                                                        echo "<td>" . $cognome . "</td>";
                                                        echo "<td>" . $email . "</td>";
                                                        echo "<td>" . $ragioneSociale . "</td>";
                                                        echo "<td>" . $regione . "</td>";
                                                        echo "<td>" . $statusString . "</td>";
                                                        if ($livello == 3) {
                                                            echo "<td>" . $nrAnagrafiche . "</td>";
                                                            echo "<td>";
                                                            echo '<form action="" method="POST">';
                                                            echo '<input hidden type="text" name="username" value="' . $username . '">';
                                                            echo '<input hidden type="text" name="password" value="' . $password . '">';
                                                            echo '<button id="button" class="btn btn-info" name="submit"><i
                                                                    class="fas fa-user-circle"></i></button>';
                                                            echo '</form>';
                                                            echo "</td>";
                                                            echo "<td>" . $statusForm . "</td>";
                                                            echo '<td><form action="" method="POST">
                                                            <input hidden type="text" name="userId" value="' . $idUser . '">
                                                            <button id="button" class="btn btn-danger" name="delete"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                                    </form></td>';
                                                        }


                                                        echo "</tr>";
                                                    } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <?php include '../../footer.php' ?>
        </div>
    </div>

    <?php include '../../jsScriptTheme.php' ?>
    <script>
    $(document).ready(function() {
        var table = $('#tableExport').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
</body>

</html>