<?php

    namespace model;

    class CategorieArticleModel extends BaseModel {

        public static function findByIdArticle($id) {

            include 'bdd.php';

            $requete = $connexion -> prepare('SELECT * FROM `categorie_article`
                                                  JOIN categorie ON categorie.id = categorie_article.id_categorie
                                                  WHERE id_article = ?');

            $requete -> execute([$id]);

            return $requete -> fetchAll();

        }

        public static function create($idArticle, $checkbox) {

            include 'bdd.php';

            $requete = $connexion -> prepare('INSERT INTO categorie_article (`id_article`, `id_categorie`) VALUES (?, ?)');
            $requete -> execute([ $idArticle, $checkbox ]);

        }

    }

?>