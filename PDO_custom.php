<?php

    class PDO_custom extends PDO{

        function __construct($host = 'localhost',
                             $dbname = 'poo_franck_php',
                             $user = 'root', 
                             $password = '') 
        {
            
            parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=UTF8', $user, $password);

        }

    }

?>