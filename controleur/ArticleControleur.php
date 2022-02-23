<?php

    namespace controleur;

    use Config;
use model\ArticleModel;
use model\CategorieArticleModel;

class ArticleControleur extends BaseControleur {

        public function liste() {

            $articles = ArticleModel::findAll();

            $parametres = compact('articles');

            $this -> afficherVue($parametres);

        }

        public function afficher($parametre) {

            $article = ArticleModel::findByIdJoinUtilisateur($parametre);
            
            if($article) {

                $categorie = CategorieArticleModel::findByIdArticle($parametre);

                $parametres = compact('article', 'categorie');

                $this -> afficherVue($parametres, 'afficher');              

            } else {

                header('Location: ' . Config::NOTFOUND); 

            }

        } 

        public function insertion() {

            include 'bdd.php';

            $categories = ArticleModel::findAll();

            $parametres = compact('categories');

            $this -> afficherVue($parametres, 'insert');
            
            if(isset($_POST['valider'])) {

                if(isset($_SESSION['droit'])) {

                    if($_SESSION['droit'] == 'admin' || $_SESSION['droit'] == 'redacteur') {

                        // $requete = $connexion -> prepare('SELECT * FROM article WHERE titre = ?');

                        // $requete -> execute([$_POST['titre']]);

                        // $doublon = $requete -> fetch();

                        // if($doublon) {

                            

                        //     echo 'boublon';

                        // } else {

                        $insert = $connexion -> prepare('INSERT INTO article (`titre`, `contenu`, `image`, id_utilisateur) VALUES (?, ?, ?, ?)');
            
                        $filename = $_FILES['image']['name'];
            
                        $target_file = './assets/image/' . $filename . "_" . time();
            
                        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                        $file_extension = strtolower($file_extension);
            
                        // Verifie si l'extension de l'image est valide
                        $valid_extension = array("png","jpeg","jpg");
            
                            if(in_array($file_extension, $valid_extension)){
                
                                if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
                
                                    $insert -> execute([ $_POST['titre'], $_POST['content'], $filename, $_SESSION['id']]);
                
                                }
                
                            }
                        }

                        $id_article = $connexion -> lastInsertId();

                        // Au lieu de faire 40 requete on peux faire lastInsertId pour voir le dernier article inseré

                        CategorieArticleModel::create($id_article, $_POST['checkbox']);

                    } else {

                        header('Location: ' . Config::INDEX);

                    }
                    
                // }

            }

        }

        public function supprimer($parametre) {

            if(isset($_SESSION['admin'])) {

                ArticleModel::deleteById($parametre);
    
                header('Location: ' . Config::INDEX);

            }

        }

        public function edition($parametre) {

            $old = ArticleModel::findById($parametre);

            $parametres = compact('old');

            $this -> afficherVue($parametres, 'edition'); 
    
            if(isset($_POST['valider_update'])) {

                $requete = $connexion -> prepare('SELECT * FROM article WHERE titre = ? AND id != ?');

                $requete -> execute([$_POST['titre'], $parametre]);

                $doublon = $requete -> fetch();

                if($doublon) {

                    echo 'boublon';

                } else {

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

    }

?>