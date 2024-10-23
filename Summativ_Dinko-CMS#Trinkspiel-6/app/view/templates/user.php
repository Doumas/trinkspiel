<!DOCTYPE html>
<?php
// Template für User
// Error Report
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
// Include Header/Nav
require_once APPROOT . '/view/includes/header.php';
?>
<!-- Sektion 1, Das Spiel. Hierfür verwende kein Reaktnative, das wird in die WebApp eingebaut. Hier wird als Überganglösung 
ein einfache Postprüfung, Eine sehr Unschöne lösung mit Php Existiert als JS React Anfrage im Home.php Template. Derzeit deaktiviert. Hinzuziehung der unpraktische 
Statistic.php Skript zur funktionskontrolle.    -->
<div class="jumbotron m-0 d-flex flex-column justify-content-center align-items-center h-auto bg-white">
    <?php if (!isset($_POST['game'])) { ?>
<!-- Wenn ein Post von einer Spielanfrage empfangen wird.. -->

        <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;"><?= isset($data['message']) ? $data['message'] : 'Hi, ' . $data['user'] ?></h1>
        <div class="d-flex col-11">
            <p class="col-5 m-auto p-2 small underline" style="width: 530px; text-align:center;"><br><?= isset($data['questions']) ? 'Wählen Sie ein Spiel aus' : 'Sie haben noch kein Spiel erstellt!' ?></p>
        </div>
        </br>
        <!-- Wenn keine Fragen vorhanden sind, Kein Spiel hinterlegt -->
        <?php if (empty($data['questions'])) { ?>
            <div class="row  d-flex justify-content-center">
                <div class="col-sm-5 flex justify-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Erstellen Sie ein Spiel</h5>
                            <p class="card-text">Schreibe selbst 10 Fragen nieder für die nächste Runde.</p>
                            <a href="<?= URLROOT ?>/user/spiel" class="btn btn-primary">Selber schreiben!</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Oder sehen Sie sich unsere Fragen an</h5>
                            <p class="card-text">All unsere Fragen gibt es..</p>
                            <a href="<?= URLROOT ?>/user/questions" class="btn btn-primary">Hier!</a>
                        </div>
                    </div>
                </div>
            </div>
<!-- wenn kein Post empfangen wird -->
        <?php } else {
            $i = 0;
        ?>
        <!-- Wenn EMpfangen wird, Zeig das Spiel ohne Statistik. Die fragen gehören nur zum User und werden nur vom Ihm gewertet -->

            <div class="row  d-flex justify-content-center">
                <?php
                foreach ($data['questions'] as $key => $value) { ?>
                    <div class="col-sm-8 col-md-5 m-3 flex justify-center">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value['title'] ?></h5>
                                <p class="card-text">1. <?= $value['question_0'] ?>..</p>
                                <form action="<?= URLROOT ?>/user/spielen" method="post">
                                    <input type="hidden" value="<?= $i ?>" name="game">
                                    <button type="submit" class="btn btn-primary">Spielen</button>
                                </form>
                            </div>
                        </div>
                    </div>

        <?php $i++;
                }
            }
        } ?>
        <!-- Sektion 3, Das Spiel  -->
        <?php if (isset($_POST['game'])) { ?>
            <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;"><?= isset($data['questions'][isset($_POST['game']) ? $_POST['game'] : 0]['title']) ? $data['questions'][isset($_POST['game']) ? $_POST['game'] : 0]['title'] : 'Ich hab noch nie..' ?></h1>
            <br>
            <div class="d-flex col-8 m-auto" style="justify-content:center;">

                <div id="carouselExampleIndicators" style="height: 120px;" class="carousel slide m-auto" data-ride="carousel">
                    <div class="carousel-inner col-12">
                        <div class="carousel-item active">
                            <span class='small darkgrey col-12 support'>Runde 1/10</span>
                            <p class='d-flex text-center underline w-100' style='height: 70px;margin: auto;align-content: center;align-items: center;justify-content: center;'><span class='d-block w-100 medium darkgrey'>
                                    <?= $data['questions'][$_POST['game']]['question_' . 0] ?></span></p>

                        </div>
                        <?php
                        for ($i = 1; $i < 10; $i++) { ?>
                            <div class='carousel-item'>
                                <span class='small darkgrey support col-12'>Runde <?= $i ?>/10</span>
                                <p class='d-flex text-center underline w-100' style='height: 70px;margin: auto;align-content: center;align-items: center;justify-content: center;'><span class='d-block w-100 medium darkgrey'>
                                        <?= $data['questions'][$_POST['game']]['question_' . $i] ?></span></p>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
            <!-- Yes & No Buttons. Nur zur Show. Es wird hier nichts hinterlegt -->

            <div class="d-flex col-6 justify-content-center align-self-center m-auto">
                <div class="col-md-4 m-auto d-flex"><button type="button" id="no" value="negativ" class="answer btn buttonsmall m-auto bgblue white">Noch nie</button>
                </div>
                <div class="col-md-4 m-auto d-flex"><button type="button" id="yes" value="positiv" class="answer btn buttonsmall m-auto bgblue white">Getan</button>
                </div>
            </div>
            </div>
            <!-- Sektion 4 -->

            <div class="d-flex col-12 hblock bgyellow">
                <h1 class="hobo m-auto big white">Neue Runde?</h1>
            </div>
            <?php
            $i = 0;
            ?>
            <div class="row m-5 d-flex justify-content-center">
                <!-- Schleife, Alle Spiele werden aufgelistet -->
                <?php
                foreach ($data['questions'] as $key => $value) { ?>
                    <div class="col-sm-8 col-md-5 m-3 flex justify-center">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value['title'] ?></h5>
                                <p class="card-text">1. <?= $value['question_0'] ?>..</p>
                                <!-- Formular, angepasst mit Count Param $i -->
                                <form action="<?= URLROOT ?>/user/spielen" method="post">
                                    <input type="hidden" value="<?= $i ?>" name="game">
                                    <button type="submit" class="btn btn-primary">Spielen</button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php $i++;
                }
                ?>
            <?php } ?>

            </div>
</div>
<!-- Footer -->

<div class="d-flex col-12 hblock bgdarkgrey">
    <h1 class="hobo m-auto big white">Tschüss!</h1>
</div>

<?php
require_once APPROOT . '/view/includes/footer.php';
?>