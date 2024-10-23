<!DOCTYPE html>
<?php
// Home Template für Nutzer
// Error Reporting
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
// Für Reload der Webseite, Wir fangen den $_POST wieder auf und geben Sie zurück in die Input Felder 
if (isset($_POST));
// Helferklasse methode, rückgabe als sauberer Array
$post = helper::cleanArray($_POST);
require_once APPROOT . '/view/includes/header.php';
require_once APPROOT . '/backend/src/statistic.php';
// Ersten Sektion
?>

<div class="jumbotron m-0 d-flex flex-column justify-content-center align-items-center h-auto bg-white" style="overflow:hidden;">
    <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;"><?=isset($data['message']) ? $data['message'] : 'Ich hab noch nie..'?></h1>
    <br>
    <div class="d-flex col-8" style="justify-content:center;">
<!-- Spiel Start. Verwende Bootstrap Carousel, Erste Fragerunde  -->
        <div id="carouselExampleIndicators" style="height: 120px;" class="carousel slide m-auto" data-ride="carousel">
            <div class="carousel-inner col-12">
                <div class="carousel-item active">
                    <?php
echo "<span class='small darkgrey col-12 support'>Runde 1/10</span><p class='d-flex text-center underline w-100' style='height: 70px;margin: auto;align-content: center;align-items: center;justify-content: center;'><span class='d-block w-100 medium darkgrey'>
                " . $data['questions'][0]['question'] . "<input type='hidden' name='id' value='" . $data['questions'][0]['id'] . "'></span></p>";
?>
                </div>
<!-- Spiel, Verwende Bootstrap Carousel, Alle Weitere Fragerunden -->
                <?php
                // Params als Galarie Zähler. Verwende Schleife für 10 Fragen
$a = 2;
for ($i = 1; $i < 10; $i++) {
    echo "<div class='carousel-item'>
         <span class='small darkgrey support col-12'>Runde $a/10</span>
        <p class='d-flex text-center underline w-100' style='height: 70px;margin: auto;align-content: center;align-items: center;justify-content: center;'><span class='d-block w-100 medium darkgrey'>
        " . $data['questions'][$i]['question'] . "<input type='hidden' name='id' value='" . $data['questions'][$i]['id'] . "'></span></p></div>";
    $a++;
}?>
            </div>
        </div>
    </div>
    <!--  Statistik Start  -->
    <div class="d-flex col-6 justify-content-center align-self-center">
        <div class="col-md-4 m-auto d-flex"><button type="button" id="no" value="negativ" class="answer btn buttonsmall m-auto bgblue white">Noch nie</button>
        </div>
        <div class="col-md-3 m-auto" style="height:110px;">
            <div class="card-text m-auto statistic text-center">Statistic</div>
            <div class="d-flex justify-content-center align-self-center ">
                <div class="col-8">
                    <div class=" iconfacenegativ"></div>
<!--  Statistik, verwende Bootstrap Carousel | Verwende Schleife für 10 Statistiken -->
                    <?php
                    // Statistik, negative Reaktionen
echo "<div class='carousel-item col-12 active text-center small p-2 '>" . $data['statistic'][0]['negativ'] . "</div>";
for ($i = 1; $i < 10; $i++) {
    echo "<div class='col-12 carousel-item text-center small p-2 '>
         " . $data['statistic'][$i]['negativ'] . "</div>";
}
?>
</div>
<div class="col-8">
    <div class="iconfacepositiv"></div>
    <?php
    // Statistik, positive Reaktionen
echo "<div class='carousel-item col-12 active text-center small p-2'>" . $data['statistic'][0]['positiv'] . '</div>';
for ($i = 1; $i < 10; $i++) {
    echo "<div class='carousel-item col-12 text-center small p-2'>
         " . $data['statistic'][$i]['positiv'] . "</div>";
}
?>
</div>
</div>
</div>
<div class="col-md-4 m-auto d-flex"><button type="button" id="yes" value="positiv" class="answer btn buttonsmall m-auto bgblue white">Getan</button>
</div>
</div>
<!--  Ende des Spiels -->
</div>
<!--  Sektion 2, Die Regeln -->

<div class="column">
    <div class="d-flex hblock bgyellow">
        <h1 class="hobo m-auto big white">Das Spiel</h1>
    </div>
    <div class=" sektion-2 d-flex flex-column m-auto">
        <!--  Verwende Bootstrap Cards für anzeige der Regeln -->
        <div class="card border-0 mb-3 m-auto" style="max-width: 740px;">
            <div class="row g-0">
                <div class="col-2 m-auto">
                    <img src="view/image/friends.jpg" alt="..." class="img-fluid" />
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title medium">Zusammengefasst</h5>
                        <p class="card-text small">
                            Reihum wirft jeder Mitspieler eine Behauptung in die Runde, die mit "Ich hab noch nie"
                            beginnt und mit einer möglichst unangenehmen Aussage endet. So kommen die peinlichen und
                            unanständigen Geheimnisse eurer Freunde ans Licht.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-2 m-auto">
                    <img src="view/image/rule.jpg" alt="..." class="img-fluid" />
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title medium">Regeln</h5>
                        <p class="card-text small">
                            Nachdem eine "Ich hab noch nie"-Frage in die Runde geworfen wurde, muss jeder, der mit "Ich
                            schon" antworten könnte, eins bis 6 Schluck seines Getränks nehmen und sich somit vor seinen
                            Freunden "schuldig" bekennen. Dazu zählt auch die Person, die die Frage gestellt hat.

                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-2 m-auto">
                    <img src="view/image/beer.png" alt="..." class="img-fluid" />
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title medium">Schlusswort</h5>
                        <p class="card-text small">
                            Ob derjenige gewonnen hat, der am Ende des Spiels sein Glas geleert hat oder derjenige,
                            dessen Glas noch voll ist, bleibt reine Interpretationssache eurer Spielrunde.

                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<br><br><br>
<!--  Sektion 3 -->
<div class="d-flex hblock bggrey">
    <h1 class="hobo m-auto big white">Lust auf mehr?</h1>
</div>
<div class="row bgwhite m-auto" style="padding-bottom: 50px;">
    <div class="p-2 small darkgrey col-12" style="margin: 50px auto auto auto;text-align:center;">Möchtest du uns unstützen & eigene Fragen für ein Spiel hinterlegen?</div>
    <div class="d-flex flex-wrap" style="margin: 30px auto auto auto;">
    <!--  Mit Bootstrap Cards ein kurzer überblick zu uns -->
        <div class="row col-md-10 col-sm-12 m-auto">
            <div class="card border-0 col-sm-6 col-md-4 m-auto" style="width: 12rem;">
                <img src="view/image/register.jpg" class="card-img-top" alt="register" />
                <div class="card-body">
                    <p class="card-text">
                        Erstellen Sie einen Account um Spaß am Trinken wieder zu entdecken, SignUp!
                    </p>
                </div>
            </div>
            <div class="card border-0 col-sm-6 col-md-4 m-auto" style="width: 12rem;">
                <img src="view/image/login.jpg" class="card-img-top" alt="SignIn" />
                <div class="card-body">
                    <p class="card-text">
                        Sie haben bereits ein Account? Dann gehen Sie bitte <a href="<?= URLROOT?>/login">zum Login</a>!
                    </p>
                </div>
            </div>
            <div class="card border-0 col-sm-6 col-md-4 m-auto" style="width: 12rem;">
                <img src="view/image/macher.jpg" class="card-img-top" alt="Macher" />
                <div class="card-body">
                    <p class="card-text">
                        Eure Fragen gehören vorerst ganz euch, über die Zukunft der HomePage wird noch diskutiert. Sie erhalten von uns selbstverständlich noch Feedback!.
                    </p>
                </div>
            </div>
            <div class="card border-0 col-sm-6 col-md-4 m-auto" style="width: 12rem;">
                <img src="view/image/questionnaire.png" class="card-img-top" alt="Fragebogen" />
                <div class="card-body">
                    <p class="card-text">
                        Als Feature erstellen Sie ihre Playliste für verschiedene Anlässe.
                    </p>
                </div>
            </div>
            <div class="card border-0 col-sm-6 col-md-4 m-auto" style="width: 12rem;">
                <img src="view/image/beer.png" class="card-img-top" alt="Bier" />
                <div class="card-body">
                    <p class="card-text">
                        Trinken Sie dabei mit Vernunft.
                    </p>
                </div>
            </div>
            <div class="card border-0 col-sm-6 col-md-4 m-auto" style="width: 12rem;">
                <img src="view/image/support.jpg" class="card-img-top" alt="Dankes Bild" />
                <div class="card-body">
                    <p class="card-text">
                        Danke für Ihre Unterstützung!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Sektion 4 / RegistrierungsFormular-->
<div class="d-flex container-fluid flex-wrap bgyellow" style="padding-bottom:100px;">
    <div class="" style="margin:-20px auto auto auto;">
        <button type="button" class="btn buttonbig m-auto bgblue white"><span>Los gehts</span></button>
    </div>
    <div class=" col-md-12">
        <div class="d-flex hblock bgyellow " id="register" style="margin-top: 80px;">
            <h1 class="hobo m-auto big white underline">Account</h1>
        </div>
        <div class="p-2 white medium text-center">Bereits ein Account? Weiter <a class="blue" href="<?= URLROOT?>/login">zum Login</a>
        </div>
        <br>
        <!--  SignUp Formular -->
        <form class="col-8 m-auto" id="form" action="<?=URLROOT?>/home/register#form" method="post">
            <div class="form-group col-md-6" style="padding-left: 0px ;">
            <!--  Gender-->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="male">
                    <label class="form-check-label" for="inlineRadio1"><span class="small white">Herr</span></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="female">
                    <label class="form-check-label" for="inlineRadio2"><span class="small white">Frau</span>
                    </label>
                </div>
                <!--  Gender Errormeldung, vom Controller mitvergegeben-->
                <div class="error col-12 p-0">
                    <span class="red small" style="left:0px;top:0px;">
                        <?=isset($data['inlineRadioOptionsError']) ? $data['inlineRadioOptionsError'] : '';?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                        <!--  Land & Land Errormeldung, vom Controller mitvergegeben-->
                    <label for="input4Land"><span class="small white">Land</span>
                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;"><?=isset($data['landError']) ? $data['landError'] : '';?></span>
                        </div>
                    </label>
                    <select name="land" id="inputLand" class="form-control">
                        <option selected disabled><span class="small white">-- Bitte auswählen --</span>
                        </option>
                        <?php $folderland = array('Deutschland', 'England', 'Österreich');
foreach ($folderland as $value) {
    echo "<option value='$value' name='land'>$value</option>";
}?>
                    </select>
                </div>
                <!--  Land & Land Errormeldung, vom Controller mitvergegeben-->
                <div class="form-group col-md-6">
                    <label for="input4Nutzername"><span class="small white">Nutzername</span>
                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;"><?=isset($data['usernameError']) ? $data['usernameError'] : '';?></span>
                        </div>
                    </label>
                    <input type="name" class="form-control" id="inputusername" name="username" value="<?=isset($post['username']) ? $post['username'] : ''?>">

                </div>
            </div>
            <!--  Email & Email Errormeldung, vom Controller mitvergegeben-->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4"><span class="small white">Email</span>

                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;"><?=isset($data['emailError']) ? $data['emailError'] : '';?></span>
                        </div>
                    </label>
                    <input type="email" class="form-control" id="inputemail" name="email" value="<?=isset($post['email']) ? $post['email'] : ''?>">
                </div>
                <!--  password & password Errormeldung, vom Controller mitvergegeben-->
                <div class="form-group col-md-6">
                    <label for="inputEmail4"><span class="small white">Password</span>
                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;"><?=isset($data['passwordError']) ? $data['passwordError'] : '';?></span>
                        </div>
                    </label>
                    <input type="password" class="form-control" id="inputpasswordRequire" name="password" value="<?=isset($post['password']) ? $post['password'] : ''?>">
                </div>
            </div>
            <!--  password wiederholung &  Errormeldung, vom Controller mitvergegeben-->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4"><span class="small white">Password
                            wiederholen</span>
                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;"><?=isset($data['passwordRequireError']) ? $data['passwordRequireError'] : '';?></span>
                        </div>
                    </label>
                    <input type="password" class="form-control" id="inputpasswordRequire" name="passwordRequire" value="<?=isset($post['passwordRequire']) ? $post['passwordRequire'] : ''?>">
                </div>
            </div>
            <div class="form-group">
                <div class="error col-12 p-0">
                    <!-- AGB Fehlermeldung / Ausgabe -->
                    <span class="red small" style="left:0px;top:0px;"><?=isset($data['agbError']) ? $data['agbError'] : '';?></span>
                </div>
                <div class="form-check form-check-inline col-md-6">

                    <input class="form-check-input" type="radio" name="agb" id="inlineRadio1" value="accept">

                    <label class="form-check-label" for="gridCheck">

                        <span class="small white"> Hiermit akzeptiere ich die Nutzung meiner Daten die nicht für dritte vorgesehen sind Agbs</a>

                    </label>

                </div>

            </div>
            <button type="submit" name="submit" value="register" class="btn buttonsmall btn-primary">Weiter</button>
        </form>
        <!--  Ende Formular-->
    </div>
</div>
<!--  Footer-->
<div class="d-flex col-12 hblock bgdarkwhite">
    <h1 class="hobo m-auto big darkgrey">Tschüss!</h1>
</div>
<div class="d-flex col-12 bgwhite">
</div>
<?php
require_once APPROOT . '/view/includes/footer.php';
?>