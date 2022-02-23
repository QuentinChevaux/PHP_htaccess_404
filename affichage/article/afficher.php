<article>

    <img src="<?= Config::IMAGE . $article['image'] ?>" alt="José L'Astronaute" />

    <h1><?= $article['titre'] ?></h1>
    <p class="card-text"><?= $article['contenu'] ?></p>

    <p>Auteur : <?= $article['login'] ?></p>

    <?php

        foreach($categorie as $ctg) {
            ?>

                <span class="badge rounded-pill bg-info"><?= $ctg['nom'] ?></span>
                
            <?php
        
        }

        ?>
</article>

<a href="<?= Config::INDEX ?>" class="btn btn-primary mt-5">Retour a la Liste d'Article</a>