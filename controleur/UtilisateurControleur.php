<?php

    namespace controleur;

    use Config;
use model\DroitModel;
use model\UtilisateurModel;

    class UtilisateurControleur extends BaseControleur {

        public function liste() {

            // if(isset($_SESSION['droit']) && $_SESSION['droit'] == 'admin') {

                $utilisateur = UtilisateurModel::findAllJoinDroit();

                $parametres = compact('utilisateur');
    
                $this -> afficherVue($parametres);

            // }

        }

        public function inscription() {

            $this -> afficherVue([], 'inscription');

            if(isset($_POST['valider_inscription'])) {

                if($_POST['password'] == $_POST['password_verify']) {

                    UtilisateurModel::insert($_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT));

                    $_SESSION['registered'] = 'Vous vous êtes bien Inscrit !';

                    header('Location: ' . Config::USER_LIST);

                } else {

                    echo '<script>';
                    echo 'Les Mots de Passe ne Correspondent pas !';
                    echo '</script>';

                }


            }

        }

        public function connexion() {

            $this -> afficherVue([], 'connexion');

            if(isset($_POST['valider_connexion'])) {

                $login = UtilisateurModel::findByLogin($_POST['login']);

                if($login) {

                    if (password_verify($_POST['password'], $login['password'])) {

                        if($login['id_droit'] == 1){

                            $_SESSION['droit'] = 'admin';
                            $_SESSION['logged'] = $_POST['login'];

                        } else {

                            $_SESSION['logged'] = $_POST['login'];
                            $_SESSION['id'] = $login['id'];
                            $_SESSION['droit'] = $_POST['denomination'];

                        }

                        header('Location: ' . Config::USER_LIST);

                    }

                } else {

                    echo '<script>';
                    echo 'alert("Login ou MDP incorrect !")';
                    echo '</script>';

                }

            }

        }

        public function deconnexion() {

            if(isset($_SESSION['logged'])) {
    
                session_destroy();
    
                header('Location: ' . Config::USER_LIST);

            }

        }

        public function edition($parametre) {

            $log = UtilisateurModel::findById($parametre);

            $droits = DroitModel::findAll();

            $parametres = compact('log', 'droits');

            $this -> afficherVue($parametres, 'edition');

            if(isset($_POST['valider_update'])) {

                if(isset($_SESSION['logged']) && $_POST['password'] == $_POST['password_confirm']) {
    
                    if($_POST['password'] == $log['password']) {

                        include 'bdd.php';

                        $request2 = $connexion -> prepare('UPDATE utilisateur SET `login` = ?, `password` = ?, `id_droit` = ? WHERE id = ?');

                        $request2 -> execute([ $_POST['login'], $_POST['password'], $_POST['droit'], $parametre ]);
 
                    } else {
                        
                        $request2 -> execute([ $_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['droit'], $parametre ]);

                    }
    
                    $_SESSION['logged'] = $_POST['login'];

                    if($_POST['login'] == $log['login'] && $_POST['password'] == $log['password']) {

                        $_SESSION['modified'] = 'Aucune Modification n\'a été faite !';

                    } else {

                        $_SESSION['modified'] = 'Mot de Passe et Login Modifié !';

                    }

                    header('Location: ' . Config::USER_LIST);
    
                }

            }
            
        }

        public function admin() {

            include 'bdd.php';

            $this -> afficherVue([], 'admin');

        }

        public function supprimer($id) {

            if(isset($_SESSION['droit']) && $_SESSION['droit'] == 'admin' || $_SESSION['droit'] == 'redacteur') {

                UtilisateurModel::deleteById($id);

                header('Location: ' . Config::USER_LIST);

            } else {

                header('Location: ' . Config::USER_LIST);

            }

        }

    }

?>