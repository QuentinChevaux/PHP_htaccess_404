<nav>

    <?php

        if(!isset($_SESSION['logged'])) {
            ?>

                <li><a href="<?= Config::INSCRIPTION ?>">S'inscrire</a></li>

                <li><a href="<?= Config::CONNEXION ?>">Se Connecter</a></li>

            <?php
                        
        } else {
            ?>

                <li>Connecté en tant que : <?= $_SESSION['logged'] ?></li>

                <li><a href="<?= Config::DECONNEXION ?>">Se Deconnecter</a></li>

            <?php

        }

    ?>

</nav>

<?php

    if(isset($_SESSION['registered'])) {

        echo $_SESSION['registered'];

        unset($_SESSION['registered']);

    }

    if(isset($_SESSION['interdit'])) {

        echo $_SESSION['interdit'];

        unset($_SESSION['interdit']);

    }

    if(isset($_SESSION['modified'])) {

        echo $_SESSION['modified'];

        unset($_SESSION['modified']);

    }

        foreach($utilisateur as $user) {
            
            ?>
    
                <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                    <div class="card-body">
    
                        <h2 class="card-title">Utilisateur :</h2>
    
                        <p class="card-text"><?= $user['login'] ?></p>

                        <a class="card-link" href="<?= Config::EDITION . $user['id'] ?>" style='text-decoration: none; color: white'>&#9998;</a>

                        <?php



                            if($user['id_droit'] == 1 ) {


                                ?>

                                    <a class='card-link' href="<?= Config::ADMIN ?>">&#128273;</a>

                                    <p class='card-text'> <?= $user['denomination'] ?> </p>

                                <?php

                            }

                        ?>
    
                    </div>
                </div>
    
            <?php             
    
        }

?>

