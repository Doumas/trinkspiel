<!DOCTYPE html>
<?php
// Template für Benutzer / Userdaten
// Error Report
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
// Header miteinbeziehen
require_once APPROOT . '/view/includes/header.php';
?>
<!-- Sektion 1 / Hauptoberfläche -->
<div class="jumbotron m-0 d-flex flex-column justify-content-center align-items-center h-auto bg-white" style="overflow:hidden;">
    <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;">
        <?= isset($data['message']) ? $data['message'] : 'Ihre Daten' ?></h1>
    <br>
    <div class="d-flex col-11">
        <p class="col-5 m-auto p-2 small underline" style="width: 530px; text-align:center;"><br>Hier können Sie ihre Daten Ändern</p>
    </div>
    <div class="d-flex col-md-8 col-sm-12" style="justify-content:center;">
        <!-- Formular zur Userdaten Änderung -->
        <form class="col-12 m-auto" id="form" action="<?= URLROOT ?>/user/update#h1" method="post">
            <div class="form-group col-md-12">
                <!-- Form Email -->
                <label for="inputEmail"><span class="small white">Email</span>
                    <div class="error col-12 p-0">
                        <span class="red small" style="left:0px;top:0px;"><?= isset($data['emailError']) ? $data['emailError'] : ''; ?></span>
                    </div>
                </label>
                <p>Email</p>
                <input type="text" class="form-control" id="inputEmail" name="email" value="<?= isset($data['email']) ? $data['email'] : helper::cleanString($_POST['email']); ?>">
                <!-- Form Nutzername -->
                <label for="inputUsername"><span class="small white">Nutzername</span>
                    <div class="error col-12 p-0">
                        <span class="red small" style="left:0px;top:0px;">
                            <?= isset($data['usernameError']) ? $data['usernameError'] : ''; ?>
                        </span>
                    </div>
                </label>
                <p>Nutzername</p>
                <input type="text" class="form-control" id="inputUsername" name="username" value="<?= isset($data['username']) ? $data['username'] : helper::cleanString($_POST['username']); ?>">


                <div class="d-flex col-12 bgwhite">
                    <div class="" style="margin:20px auto auto auto;">
                        <button type="submit" name="submit" value="updateUser" class="btn buttonbig m-auto bgblue white">Ändern</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Formular zur Userdaten Änderung zu Ende* -->
    </div>
</div>
<!--  Sektion 2 Account Löschung-->
<div class="column">
    <div class="d-flex hblock bgred">
        <h1 class="hobo m-auto big white ">Unzufrieden?</h1>
    </div>
    <div class=" sektion-2 d-flex flex-column m-auto">
        <div class="card border-0 mb-3 m-auto" style="max-width: 740px;">
            <div class="row g-0">
                
                <div class="col-md-10 m-auto">
                    <div class="card-body">
                        <h5 class="card-title medium">Es tut uns leid</h5>
                        <p class="card-text small">
                            Die Homepage steht derzeit noch im Aufbau. Sollte Sie nicht mehr teil unsere Geschichten sein möchten können Sie hier Ihren Account löschen.
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!--  Löschung per Button -->

<div class="d-flex justify-content-center col-12 bgwhite">
    <form action="<?= URLROOT ?>/user/accountDelete" method="post">
        <div style="margin:20px auto auto auto;">
            <button href="" type="submit" name="submit" value="updateUser" class="btn buttonbig m-auto bgred white">Löschen</button>
        </div>
    </form>
</div>

<br><br><br>
<!--  Footer-->
<div class="d-flex col-12 hblock bgdarkgrey">
    <h1 class="hobo m-auto big white">Bye!</h1>
</div>
<?php
require_once APPROOT . '/view/includes/footer.php';
?>