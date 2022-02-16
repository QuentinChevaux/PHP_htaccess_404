<?php

    namespace controleur;

    use Config;

class ArticleControleur extends BaseControleur {

        public function liste() {

            include 'bdd.php';

            $liste = $connexion -> prepare('SELECT * FROM article JOIN utilisateur ON utilisateur.id = article.id_utilisateur');

            $liste -> execute();

            $articles = $liste -> fetchAll();

            $parametres = compact('articles');

            $this -> afficherVue($parametres);

        }

        public function afficher($parametre) {

            include 'bdd.php';

            $afficher = $connexion -> prepare('SELECT * FROM `article` JOIN utilisateur ON utilisateur.id = article.id_utilisateur 
                                                                       WHERE article.id = ?');

            $afficher -> execute([$parametre]);

            $article = $afficher -> fetch();
            
            if($article) {
                
                $requete = $connexion -> prepare('SELECT * FROM `categorie_article`
                                                  JOIN categorie ON categorie.id = categorie_article.id_categorie
                                                  WHERE id_article = ?');

                $requete -> execute([$parametre]);

                $categorie = $requete -> fetchAll();

                $parametres = compact('article', 'categorie');

                $this -> afficherVue($parametres, 'afficher');              

            } else {

                header('Location: ' . Config::NOTFOUND); 

            }

        } 

        public function insertion() {

            $this -> afficherVue([], 'insert');
            
            if(isset($_POST['valider'])) {

                if(isset($_SESSION['droit'])) {

                    if($_SESSION['droit'] == 'admin' || $_SESSION['droit'] == 'redacteur') {

                        include 'bdd.php';

                        $insert = $connexion -> prepare('INSERT INTO article (`titre`, `contenu`, `image`, id_utilisateur) VALUES (?, ?, ?, ?)');
            
                        $filename = $_FILES['image']['name'];
            
                        $target_file = './assets/image/' . $filename;
            
                        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                        $file_extension = strtolower($file_extension);
            
                        // Verifie si l'extension de l'image est valide
                        $valid_extension = array("png","jpeg","jpg");
            
                            if(in_array($file_extension, $valid_extension)){
                
                                if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
                
                                    $insert -> execute([ $_POST['titre'], $_POST['content'], $filename, $_SESSION['id']]);
                
                                }
                
                            }

                    } else {

                        header('Location: ' . Config::INDEX);

                    }
                    
                }

            }

        }

        public function supprimer($parametre) {

            include 'bdd.php';

            if(isset($_SESSION['admin'])) {

                $supprimer = $connexion -> prepare('DELETE FROM article WHERE id = ?');
    
                $supprimer -> execute([$parametre]);
    
                header('Location: ' . Config::INDEX);

            }

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