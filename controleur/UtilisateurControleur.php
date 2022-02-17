<?php

    namespace controleur;

    use Config;

    class UtilisateurControleur extends BaseControleur {

        public function liste() {

                include 'bdd.php';

                // if(isset($_SESSION['logged'])) {

                //     $utilisateur_connecte = $connexion -> prepare('SELECT * FROM utilisateur LEFT JOIN droit ON droit.id = utilisateur.id_droit WHERE `login` = ? ');

                //     $utilisateur_connecte -> execute([ $_SESSION['logged'] ]);

                //     $utilisateur = $utilisateur_connecte -> fetchAll();

                // } else {

                    $liste = $connexion -> prepare('SELECT * FROM utilisateur LEFT JOIN droit ON droit.id = utilisateur.id_droit');
        
                    $liste -> execute();
        
                    $utilisateur = $liste -> fetchAll();

                // }
    
                $parametres = compact('utilisateur');
    
                $this -> afficherVue($parametres);

        }

        public function inscription() {

            include 'bdd.php';

            $this -> afficherVue([], 'inscription');

            if(isset($_POST['valider_inscription'])) {

                if($_POST['password'] == $_POST['password_verify']) {

                    $request = $connexion -> prepare('INSERT INTO utilisateur (`login`, `password`) VALUES (?, ?)');
        
                    $request -> execute([ $_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT) ]);

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

            include 'bdd.php';

            $this -> afficherVue([], 'connexion');

            if(isset($_POST['valider_connexion'])) {

                $request = $connexion -> prepare('SELECT * FROM utilisateur 
                                                           LEFT JOIN droit ON droit.id = utilisateur.id_droit 
                                                           WHERE `login` = ?');

                $request -> execute([ $_POST['login'] ]);

                $login = $request -> fetch();

                if($login) {

                    if (password_verify($_POST['password'], $login['password'])) {

                        if($login['id_droit'] == 1){

                            $_SESSION['admin'] = 1;

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

            include 'bdd.php';

            $request = $connexion -> prepare('SELECT * FROM utilisateur WHERE `id` = ?');

            $request -> execute([$parametre]);

            $log = $request -> fetch();

            $parametres = compact('log');

            $this -> afficherVue($parametres, 'edition');

            if(isset($_POST['valider_update'])) {

                if(isset($_SESSION['logged']) && $_POST['password'] == $_POST['password_confirm']) {
    
                    $request2 = $connexion -> prepare('UPDATE utilisateur SET `login` = ?, `password` = ? WHERE id = ?');

                    if($_POST['password'] == $log['password']) {

                        $request2 -> execute([ $_POST['login'], $_POST['password'], $parametre ]);
 
                    } else {
                        
                        $request2 -> execute([ $_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT), $parametre ]);

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

    }

?>