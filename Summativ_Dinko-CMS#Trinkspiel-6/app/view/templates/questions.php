<!DOCTYPE html>
<?php
// Template für User. Zeigt alle Fragen
// Error Report
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Header miteinbeziehen
require_once APPROOT . '/view/includes/header.php';
?>
<!-- Sektion 1 / Hauptoberfläche -->
<div class="jumbotron m-0 d-flex flex-column justify-content-center align-items-center h-auto bg-white" style="overflow:hidden;">
    <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;">
        <?= isset($data['message']) ? $data['message'] : 'Alle Fragen' ?></h1>
    <br>
    <div class="d-flex col-11">
        <p class="col-5 m-auto p-2 small underline" style="width: 530px; text-align:center;"><br>Hier sind all unsere Fragen</p>
    </div>
    <div class="d-flex col-md-8 col-sm-12" style="justify-content:center;">
        <!-- Formular zur Userdaten Änderung -->
        <form class="col-12 m-auto" id="form" action="<?= URLROOT ?>/user/update#h1" method="post">
            <div class="form-group col-md-12">

            </div>

    </div>
    <div class="row d-flex justify-content-center">

        <?php $i = 0;
        foreach ($data['questions'] as $key => $value) { ?>
            <div class="col-sm-5 flex justify-center">
                <div class="card m-2">
                    <div class="card-body">
                        <h5 class="card-title"><?= $i + 1 ?>.</h5>
                        <p class="card-text text-center"><?= $data['questions'][$i]['question']; ?></p>
                        <div class="col-12 d-flex justify-content-around">
                            <a class="btn btn-danger text-white"><?= $data['statistic'][$i]['negativ'] ?>x Nicht getan</a>
                            <a class="btn btn-success text-white"><?= $data['statistic'][$i]['positiv'] ?>x Getan</a>

                        </div>
                    </div>
                </div>
            </div>

        <?php $i++;
        }
        ?>
    </div>

</div>



</div>

<div class="d-flex col-12 hblock bgyellow">
    <h1 class="hobo m-auto big white">Bye!</h1>
</div>
<div class="d-flex col-12 bgwhite">
    <div class="" style="margin:-20px auto auto auto;">
        <button type="button" class="btn buttonbig m-auto bgblue white"><span>Impressum</span></button>
    </div>
</div>
<?php
require_once APPROOT . '/view/includes/footer.php';
?>