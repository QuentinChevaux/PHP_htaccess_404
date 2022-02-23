<form class='form-group mt-5' method="POST" enctype="multipart/form-data">

    <div class="form-floating mb-3">

        <input type='text' name='titre' id='floatingtitre'class="form-control" required/>
        <label for="floatingtitre">Titre de L'Article : </label>

    </div>

    <div class="form-group mb-3">

        <label for="content" class="form-label mt-4">Contenu de L'Article : </label>
        <textarea name='content' class="form-control" required></textarea>

    </div>

    <div class="form-group">
                    
        <label for="file" class="form-label mt-4">Image : </label>
        <input class="form-control" type="file" name='image' required/>

    </div>

    <?php
    
        foreach($categories as $categorie) {
            ?>

            <label for=""><?= $categorie['nom'] ?></label>
            <input type="checkbox" value="<?= $categorie['id'] ?>" name="checkbox[]"/>
            <br />
            
            <?php
            
        }
    
    ?>

    <input type="submit" name='valider' value='Valider' />

</form>

<a href="<?= Config::INDEX ?>">Retourner à la page principale</a>