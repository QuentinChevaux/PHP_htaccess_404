<?php

    namespace model;

    class ArticleModel extends BaseModel {

        public static function findAllJoinUtilisateur() {
            
            include 'bdd.php';

            $liste = $connexion -> prepare('SELECT * FROM article JOIN utilisateur ON utilisateur.id = article.id_utilisateur');

            $liste -> execute();

            return $liste -> fetchAll();

        }

        public static function findByIdJoinUtilisateur($id) {

            include 'bdd.php';

            $afficher = $connexion -> prepare('SELECT * FROM `article` JOIN utilisateur ON utilisateur.id = article.id_utilisateur 
                                                                       WHERE article.id = ?');

            $afficher -> execute([$id]);

            return $afficher -> fetch();

        }

    }

?>