<?php

    namespace controleur;

use Config;

class ArticleControleur {

        public function liste() {

            include 'bdd.php';

            $liste = $connexion -> prepare('SELECT * FROM article');

            $liste -> execute();

            $articles = $liste -> fetchAll();

            include 'affichage/liste.php';

        }

        public function afficher($parametre) {

            include 'bdd.php';

            $afficher = $connexion -> prepare('SELECT * FROM article WHERE id = ?');

            $afficher -> execute([$parametre]);

            $article = $afficher -> fetch();

            if($article) {

                include 'affichage/afficher.php';              

            } else {

                header('Location: ' . \Config::NOTFOUND); 

            }


        } 

        public function insertion() {
            
            include 'affichage/insert.php';
            
            if(isset($_POST['valider'])) {

                include 'bdd.php';

                $insert = $connexion -> prepare('INSERT INTO article (`titre`, `contenu`, `image`) VALUES (?, ?, ?)');
    
                $filename = $_FILES['image']['name'];
    
                $target_file = './assets/image/' . $filename;
    
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
    
                // Verifie si l'extension de l'image est valide
                $valid_extension = array("png","jpeg","jpg");
    
                    if(in_array($file_extension, $valid_extension)){
        
                        if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
        
                            $insert -> execute([ $_POST['titre'], $_POST['content'], $filename ]);
        
                        }
        
                    }

            }

        }

        public function supprimer($parametre) {

            include 'bdd.php';

            $supprimer = $connexion -> prepare('DELETE FROM article WHERE id = ?');

            $supprimer -> execute([$parametre]);

            header('Location: ' . Config::INDEX);

        }

        public function edition($parametre) {

            include 'update.php';

            if(isset($_POST['valider_update'])) {

                include 'bdd.php';
    
                $update = $connexion -> prepare('UPDATE article SET `titre` = ?, `contenu` = ?');

                $update -> execute([$_POST['titre'], $_POST['content']])

                header('Location: ' . Config::UPDATE);
            }


        }

    }

?>