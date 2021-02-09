<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav navbar-right mr-auto">
        <li>
            <a href="dashboard.php"> <img alt="image" src="../../assets/img/logo.png" class="header-logo"> <span
                    class="logo-name">Dashboard</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="../../assets/img/user.svg" class="user-img-radious-style"> <span
                    class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title"><?php echo $_SESSION['nome'] . ' ' . $_SESSION['cognome'] ?></div>
                <a href="nuovoutente.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Crea Nuovo Utente
                </a>
                <a href="modificautente.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Modifica Utente
                </a>
                <div class="dropdown-divider"></div>
                <a href="modificaprofile.php" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                    Modifica il tuo profilo
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="">
                    <button name="logout" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt">
                            Logout</i>

                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>