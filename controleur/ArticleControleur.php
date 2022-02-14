<?php

    namespace controleur;

    use Config;

class ArticleControleur extends BaseControleur {

        public function liste() {

            include 'bdd.php';

            $liste = $connexion -> prepare('SELECT * FROM article');

            $liste -> execute();

            $articles = $liste -> fetchAll();

            $parametres = compact('articles');

            $this -> afficherVue($parametres);

        }

        public function afficher($parametre) {

            include 'bdd.php';

            $afficher = $connexion -> prepare('SELECT * FROM article WHERE id = ?');

            $afficher -> execute([$parametre]);

            $article = $afficher -> fetch();

            if($article) {

                $parametres = compact('article');

                $this -> afficherVue($parametres, 'afficher');              

            } else {

                header('Location: ' . Config::NOTFOUND); 

            }

        } 

        public function insertion() {

            $this -> afficherVue([], 'insert');
            
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

            include 'bdd.php';
                        
            $oldcard = $connexion -> prepare('SELECT * FROM article WHERE id = ?');

            $oldcard -> execute([$parametre]);

            $old = $oldcard -> fetch();

            $parametres = compact('old');

            $this -> afficherVue($parametres, 'edition'); 
    
            if(isset($_POST['valider_update'])) {

                $update = $connexion -> prepare('UPDATE article SET `titre` = ?, `contenu` = ?, `image` = ? WHERE id = ?');

                $filename = $_FILES['image']['name'];
    
                $target_file = './assets/image/' . $filename;
    
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
    
                // Verifie si l'extension de l'image est valide
                $valid_extension = array("png","jpeg","jpg");
    
                    if(in_array($file_extension, $valid_extension)){
        
                        if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
        
                            $update -> execute([$_POST['titre'], $_POST['content'], $filename, $parametre]);
        
                        }
        
                    }

                header('Location: ' . Config::INDEX);
                
            }


        }

    }

?>