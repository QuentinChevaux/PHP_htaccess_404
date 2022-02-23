<?php

    if((isset($_SESSION['logged']))) {
        ?>

            <form class='form-group mt-5' method="POST" enctype="multipart/form-data">

                <div class="form-floating mb-3">

                    <input type='text' name='login' id='floatingtitre'class="form-control" value="<?= $log["login"] ?>" />
                    <label for="floatingtitre">Modifier Login : </label>

                </div>

                <div class="form-floating mb-3">

                    <input type='password' name='password' id='floatingtitre'class="form-control" value="<?= $log["password"] ?>" autofocus/>
                    <label for="floatingtitre">Modifier Mot de Passe : </label>

                </div>

                <div class="form-floating mb-3">

                    <input type='password' name='password_confirm' id='floatingtitre'class="form-control" value="<?= $log["password"] ?>"/>
                    <label for="floatingtitre">Confirmer nouveau Mot de Passe : </label>

                </div>

                <select name="droit" id="">

                    <?php

                        foreach($droits as $droit) {
                            ?>

                            <option <?php if($droit['id'] == $log['id_droit']) echo 'selected' ?> value="<?= $droit['id'] ?> "><?= $droit['denomination'] ?> </option>

                        <?php

                        }

                    ?>

                </select>

                <input type="submit" name='valider_update' value='Valider' />

            </form>

                <?php

                    if(isset($_SESSION['admin'])) {
                        ?>



                        <?php

                    }

                ?>

            <a href="<?= Config::USER_LIST ?>">Retourner à la page principale</a>

        <?php

    } else {

        $_SESSION['interdit'] = 'Vous devez vous Connecter pour modifier votre profil !';

        header('Location: ' . Config::USER_LIST);
    }
 
?>