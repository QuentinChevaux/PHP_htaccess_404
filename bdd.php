<?php

    $connexion = new PDO('mysql:host=localhost;dbname=poo_franck_php;charset=UTF8', 'root', '');

    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>