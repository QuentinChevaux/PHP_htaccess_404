<form class='form-group mt-5' method="POST">

    <div class="form-floating mb-3">

        <input type='text' name='login' id='floatingtitre'class="form-control" required/>
        <label for="floatingtitre">Nom d'utilisateur : </label>

    </div>

    <div class="form-floating mb-3">

        <input type='password' name='password' id='floatingtitre'class="form-control" required/>
        <label for="floatingtitre">Mot de Passe : </label>

    </div>

    <div class="form-floating mb-3">

        <input type='password' name='password_verify' id='floatingtitre'class="form-control" required/>
        <label for="floatingtitre">Valider Mot de Passe : </label>

    </div>

    <input type="submit" name='valider_inscription' value="S'Inscrire" />

</form>

<a href="<?= Config::USER_LIST ?>">Retourner à la page principale</a>