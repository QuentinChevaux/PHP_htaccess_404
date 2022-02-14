<?php

    namespace controleur;

    class UtilisateurControleur extends BaseControleur {

        public function liste() {

                include 'bdd.php';
    
                $liste = $connexion -> prepare('SELECT * FROM utilisateur');
    
                $liste -> execute();
    
                $utilisateur = $liste -> fetchAll();
    
                $parametres = compact('utilisateur');
    
                $this -> afficherVue($parametres);

        }

    }

?>