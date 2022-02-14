<?php

    if(isset($_SESSION['logged']) && $_SESSION['logged'] == $log['login']) {
        ?>

            <form class='form-group mt-5' method="POST" enctype="multipart/form-data">

                <div class="form-floating mb-3">

                    <input type='text' name='login' id='floatingtitre'class="form-control" value="<?= $log["login"] ?>" />
                    <label for="floatingtitre">Modifier Login : </label>

                </div>

                <div class="form-floating mb-3">

                    <input type='password' name='password' id='floatingtitre'class="form-control" />
                    <label for="floatingtitre">Modifier Mot de Passe : </label>

                </div>

                <div class="form-floating mb-3">

                    <input type='password' name='password_confirm' id='floatingtitre'class="form-control" />
                    <label for="floatingtitre">Confirmer nouveau Mot de Passe : </label>

                </div>

                <input type="submit" name='valider_update' value='Valider' />

            </form>

            <a href="<?= Config::USER_LIST ?>">Retourner à la page principale</a>

        <?php

    } else {

        $_SESSION['interdit'] = 'Vous devez vous Connecter pour modifier votre profil !';

        header('Location: ' . Config::USER_LIST);
    }
 
?>