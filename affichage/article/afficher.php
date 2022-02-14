<article>

    <img src="<?= Config::IMAGE . $article['image'] ?>" alt="José L'Astronaute" />

    <h1><?= $article['titre'] ?></h1>
    <p class="card-text"><?= $article['contenu'] ?></p>

</article>

<a href="<?= Config::INDEX ?>" class="btn btn-primary">Retour a la Liste d'Article</a>