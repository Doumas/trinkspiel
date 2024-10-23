<!DOCTYPE html>
<?php
// Template Spiel, zur Erstellung eines Spiels
// ErrorHandling
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
// Hinzuziehung des Header
require_once APPROOT . '/view/includes/header.php';
?>
<!-- Sektion 1 -->
<div class="jumbotron m-0 d-flex flex-column justify-content-center align-items-center h-auto bg-white">

    <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;"><?= $data['message'] ?></h1>
    <div class="d-flex col-11">
        <p class="col-5 m-auto p-2 small underline" style="width: 530px; text-align:center;"><br>Erstellen Sie ein Spiel</p>
    </div>
    </br>
    <div class="card border-0 mb-3 m-auto text-center" style="max-width: 740px;">
        <div class="row m-0">
            <div class="col-md-10 m-auto">
                <div class="card-body">
                    <h5 class="card-title medium">Tipps</h5>
                    <p class="card-text small">
                        Beginnen Sie mit der einfachen Fragestellung ..Ich haben noch nie.. Und schon werden die Ideen aus Ihnen herraussprudeln!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sektion 2, Formular zu Spielfragen -->
    <div class="col-md-8 col-xl-6">
        <form action="<?= URLROOT ?>/user/newGame" method="post">
            </br>
            <!-- Title & Errorhanding -->
            <div class="error col-12 p-0">
                <span class="red small" style="left:0px;top:0px;">
                    <?= isset($data['titleError']) ? $data['titleError'] : ''; ?></span>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Title</span>
                </div>
                <!-- Falls $_POST existiert, wieder einsetzung der Value -->
                <input type="text" value="<?= isset($_POST['title']) ? helper::cleanString($_POST['title']) : '' ?>" name="title" class="form-control" placeholder="Trinkparty" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <!-- Schleife, Erstellung von 9 Identischen Formular Fehleder. Unterschied durch int Param $i -->
            <?php
            for ($i = 0; $i < 10; $i++) { ?>
                <div class="error col-12 p-0">
                    <span class="red small" style="left:0px;top:0px;">
                        <?= isset($data['question_' . $i . 'Error']) ? $data['question_' . $i . 'Error'] : ''; ?></span>
                </div>

                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><?= $i + 1 ?></span>
                    </div>
                    <input type="text" value="<?= isset($_POST['question_' . $i]) ? helper::cleanString($_POST['question_' . $i]) : '' ?>" name="question_<?= $i ?>" class="form-control" placeholder="Ich hab noch nie.." aria-label="Username" aria-describedby="basic-addon1">
                </div>
            <?php
            } ?>
            <!-- Schleife, Ende -->
            <div class="d-flex col-12 bgwhite">
                <div class="" style="margin:20px auto auto auto;">
                    <button type="submit" name="submit" value="updateUser" class="btn buttonbig m-auto bgblue white">Neues Spiel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Sektion 3. 10 Fragen aus Questions Row -->
<div class="d-flex col-12 hblock bgdarkgrey">
    <h1 class="hobo m-auto big white">Inspiration</h1>
</div>
<div class="col-12 d-flex justify-content-center flex-column align-items-center">
    <div class="m-5 d-flex">
        <li class="list-group-item d-flex  justify-content-between align-items-center">
            Hier sind 10 Fragen zur Inspiration
        </li>
        </ul>
    </div>
    <!-- Schleife, für hinterlegung der Spielfragen und Statistik -->
    <?php $i = 0;
    for ($i = 0; $i < 10; $i++) { ?>
        <span class="text-right col-8 small darkgrey">Public</span>

        <div class="input-group mb-3 col-8">
            <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?= $data['questions'][$i]['question']; ?>">
        </div>
        <div class="col-8 d-flex">
            <div class="column col-1">
                <div class="iconfacenegativ m-0"></div>

                <?php
                echo "<div class='carousel-item d-flex column col-12 active small p-2'>" . $data['statistic'][$i]['negativ'] . "</div>";
                echo "<div class='col-12 carousel-item text-center small p-2'>
         " . $data['statistic'][$i]['negativ'] . "</div>";
                ?>
            </div>
            <div class="column col-1">
                <div class="iconfacepositiv m-0"></div>
                <?php
                echo "<div class='carousel-item col-12 active small p-2'>" . $data['statistic'][$i]['positiv'] . "</div>";
                echo "<div class='col-12 carousel-item text-center small p-2'>" . $data['statistic'][$i]['negativ'] . "</div>";
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Schleife, Ende -->
    </br>
    </br>
    </br>

</div>
<!-- Footer -->
<div class="d-flex col-12 hblock bgdarkgrey">
    <h1 class="hobo m-auto big white">Bye!</h1>
</div>

<?php
require_once APPROOT . '/view/includes/footer.php';
?>



</body>
<script>
    $("input[type=checkbox]").click(function() {
        var a = $(this, "input[type='checkbox']");
        var e = a.val();
        var len = $('input:checkbox:checked').length;
        if (len > 0) {
            $(".badge-pill").text(+len);
            if ($(this, "input[type='checkbox']").prop('checked') == false) {

                $("[class^='question_']").each(function() {
                    if ($(this).val() == e)
                        $(this).val('');

                })
            }
            if ($(this, "input[type='checkbox']").prop('checked') == true) {
                $("[class^='question_']").each(function() {
                    if ($(this).val() == '') {
                        $(this).val(e);
                        return false;
                    }
                })

            }




        } else {
            $(".badge-pill").text(0);
        }
        if ($(".primar-badge").text() >= 10) {
            $('input:checkbox:not(":checked")').prop('disabled', true);
            $('.btn-event').prop('disabled', false);
            $('.btn-event').text('Hochladen');
        } else {
            $('input:checkbox:not(":checked")').prop('disabled', false);
            $('.btn-event').prop('disabled', true);
        }
    })


    $(document).ready(function() {

        // Search text
        var text = $('.errors').val();
        // Hide all content class element
        $('.content').hide();

        // Search and show
        $('.content:contains("' + text + '")').show();

    });
</script>

</html>