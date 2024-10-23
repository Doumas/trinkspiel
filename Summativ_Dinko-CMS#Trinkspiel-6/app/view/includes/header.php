<?php
// Wenn User angemeldet, User Navbar.
if (isset($_SESSION['userid']))
    $session = true;
else
    $session = false;
?>
<!DOCTYPE html>

<head>
    <!--  include Stylesheet -->
    <link rel="stylesheet" href="/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/view/css/main.css">
</head>
    <!--  include Body -->
<body>
    <nav class="navbar navbar-expand-lg navbar-light bgyellow col-12 p-0">
        <a class="navbar-brand logo" href="#"></a>
        <button class="navbar-toggler mr-20" style="margin-right: 10px;" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
            <!-- prüfen  -->
        <?php if ($session !== true) { ?>
            <!-- Navbar für Nutzer -->
            <div class="collapse navbar-collapse" id="navbarText" style="z-index: 1455;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/home">Trinkspiel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/passwortVergessen">Passwort
                            vergessen</a>
                    </li>
                </ul>
                <span class="navbar-text text-center">
                    <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/home/impressum">
                        <?= isset($data['counter']) ? '..Mit mehr als ' . $data['counter'] . ' Fragen' : 'Impressum' ?></a>
                </span>
            </div>
        <?php } else { ?>
            <!-- Navbar für User -->
            <div class="collapse navbar-collapse" id="navbarText" style="z-index: 1455;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/user">Home<span class="sr-only">jj(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/user/benutzer">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/user/spiel">Neues Spiel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/user/questions">Alle Fragen</a>
                    </li>
                </ul>
                <span class="navbar-text text-center">
                    <a class="nav-link Helvetica small text-white text-center" href="<?= URLROOT ?>/user/logout">Logout</a>
                </span>
            </div>
        <?php } ?>
    </nav>
