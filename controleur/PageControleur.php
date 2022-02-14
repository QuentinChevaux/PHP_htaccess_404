<?php

    namespace controleur;

    class PageControleur extends BaseControleur {

        public function pageNonTrouve() {

            echo '404 NOT FOUND :|';
            ?>

                <a href="<?= \Config::INDEX ?>">Retour a la page principale</a>

            <?php

        }

    }

?>