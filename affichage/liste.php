<?php

    foreach($articles as $article) {
        ?>

<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
    <div class="card-body">

                    <a class='btn btn-danger' href="<?= Config::DELETE . $article['id'] ?>">&#10005;</a>

                    <h4 class="card-title"><?= $article['titre'] ?></h4>
                    
                    <img src="<?= Config::IMAGE . $article['image'] ?>" alt="">
                    
                    <p class="card-text"><?= $article['contenu'] ?></p>
                    
                    <a class='btn btn-primary' href="<?= Config::AFFICHER . $article['id'] ?>">Voir plus</a>

                </div>
            </div>

        <?php             

    }

?>

<a href="<?= Config::INSERT ?>">Page Insertion Article</a>