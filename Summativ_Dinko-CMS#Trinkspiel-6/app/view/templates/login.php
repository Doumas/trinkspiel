<?php
// Template Login Formular
# Hinzuziehung der Head/Header-->
require_once APPROOT.'/view/includes/header.php';
?>
<!-- BLOCK 1 -->
<div class="jumbotron m-0  bg-white">
    <div class=" d-flex flex-column justify-content-center align-items-center h-auto" id="formular">
        <h1 class=" hobo big dark " style="margin-top: 50px;text-align:center;"><?= $data['message']?></h1>
    </br>
        <div class="d-flex col-11">
            <p class="col-5 m-auto p-2 small underline" style="width: 530px; text-align:center;"><br>Bitte geben Sie ihre Daten an</p>
        </div>
        <!-- Formular -->
        <form class="col-8 m-auto" action="/login/signIn" method="post">
            <div class="error col-12 p-0">
                <span class="red small" style="left:0px;top:0px;">
                </span>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="inputEmail4"><span class="small dark">Email</span>
                    <!-- email / error handling -->
                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;">
                                <?= isset($data['emailError'])? $data['emailError'] : '';?></span>      
                            </span>
                        </div>
                    </label>
                    <input type="email" class="form-control" id="inputemail" name="email"
                        value="<?=isset($_POST['email']) ? helper::cleanString($_POST['email']) : ''?>">
                </div>
                <!-- password / error handling -->
                <div class="form-group col-md-12">
                    <label for="inputEmail4"><span class="small dark">Password</span>
                        <div class="error col-12 p-0">
                            <span class="red small" style="left:0px;top:0px;">
                                <?= isset($data['passwordError'])? $data['passwordError'] : '';?></span>

                            </span>
                        </div>
                    </label>
                    <input type="password" class="form-control" id="inputpasswordRequire" name="password"
                        value="<?=isset($_POST['password']) ? $_POST['password'] : ''?>">
                </div>
            </div>
            <button type="submit" name="submit" value="login" class="btn buttonsmall btn-primary">Weiter</button>
<!-- Formular Ende -->
        </form>
    </div>
</div>
<!-- Footer -->
<div class="d-flex col-12 hblock bgdarkgrey">
    <h1 class="hobo m-auto big white">Bye!</h1>
</div>
<?php
require_once APPROOT.'/view/includes/footer.php';
?>