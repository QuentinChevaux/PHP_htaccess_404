<form class='form-group mt-5' method="POST" enctype="multipart/form-data">

    <div class="form-floating mb-3">

        <input type='text' name='titre' id='floatingtitre'class="form-control"/>
        <label for="floatingtitre">Nouveau titre : </label>

    </div>

    <div class="form-group mb-3">

        <label for="content" class="form-label mt-4">Nouveau Contenu : </label>
        <textarea name='content' class="form-control"></textarea>

    </div>

    <div class="form-group">
                    
        <label for="file" class="form-label mt-4">Nouvelle Image : </label>
        <input class="form-control" type="file" name='image'/>

    </div>

    <input type="submit" name='valider_update' value='Valider' />

</form>

<a href="<?= Config::INDEX ?>">Retourner à la page principale</a>