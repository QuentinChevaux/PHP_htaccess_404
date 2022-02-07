<?php

    class Personne {

        private $nom;
        private $prenom;

        function nom_complet() {

            echo ucfirst($this->nom) . ' ' . ucfirst($this->prenom) . '<br />';

        }

        function __construct($nom, $prenom = 'root')
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
        }

        /**
         * Get the value of nom
         */ 
        public function getNom()
        {
                return strtoupper($this->nom);
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }

    }

?>