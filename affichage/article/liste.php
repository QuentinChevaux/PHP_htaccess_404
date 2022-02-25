<?php

    foreach($articles as $article) {
        ?>

<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
    <div class="card-body">

                    <?php
                        if((isset($_SESSION['droit']) && $_SESSION['droit'] == "admin") || (isset($_SESSION['id']) && $_SESSION['id'] == $article['id_utilisateur'])) {
                            ?>
                    
                                <a class='btn btn-danger' href="<?= Config::DELETE . $article['id'] ?>">&#10007;</a>

                                <a class="btn btn-warning" href='<?= Config::UPDATE . $article['id'] ?>'>&phone;</a>

                            <?php

                        }
                        
                    ?>

                    <h4 class="card-title"><?= $article['titre'] ?></h4>
                    
                    <img src="<?= Config::IMAGE . $article['image'] ?>" alt="" class="img-fluid">
                    
                    <p class="card-text"><?= htmlentities($article['contenu']) ?></p>

                    <p>Auteur : <?= $article['login'] ?></p>
                    
                    <a class='btn btn-primary' href="<?= Config::AFFICHER . $article['id'] ?>">Voir plus</a>

    </div>
</div>

        <?php             

    }

    if(isset($_SESSION['logged'])) {
?>

<a href="<?= Config::INSERT ?>">Page Insertion Article</a>

<?php

    }

?>