<?php

    namespace model;

    class UtilisateurModel extends BaseModel {

        public static function findAllJoinDroit() {

            include 'bdd.php';

            $liste = $connexion -> prepare('SELECT utilisateur.id as id, `login`, `password`, denomination FROM utilisateur 
                                                                            LEFT JOIN droit ON droit.id = utilisateur.id_droit');
        
            $liste -> execute();
                    
            return $liste -> fetchAll();

        }

        public static function insert($login, $password) {

            include 'bdd.php';

            $request = $connexion -> prepare('INSERT INTO utilisateur (`login`, `password`) VALUES (?, ?)');
        
            return $request -> execute([ $login, $password ]);

        }

        public static function findByLogin($id) {

            include 'bdd.php';

            $request = $connexion -> prepare('SELECT * FROM utilisateur 
                                                       LEFT JOIN droit ON droit.id = utilisateur.id_droit
                                                       WHERE `login` = ?');

            $request -> execute([ $id ]);

            return $request -> fetch();

        }

        

    }

?>