<?php

    namespace controleur;

    class PageControleur {

        public function pageNonTrouve() {

            echo '404 NOT FOUND :|';
            ?>

                <a href="<?= \Config::INDEX ?>">Retour a la page principale</a>

            <?php

        }

    }

?>