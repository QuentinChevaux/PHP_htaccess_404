<?php

    namespace controleur;

    class BaseControleur {

        public function afficherVue($parametres = [], $affichage = 'liste') {

            extract($parametres);

            include 'affichage/' . strtolower(substr(get_class($this), 11, -10)) . '/' . $affichage . '.php';

        }

    }

?>