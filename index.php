<?php

    include 'ArticleControleur.php';
    include 'PageControleur.php';

    $chemin = $_GET['chemin'];
    
    $partiechemin = explode("/", $chemin);
    
    $nomcontroleur = ucfirst($partiechemin[0]).'Controleur';

    $nomaction = $partiechemin[1];

    if(!method_exists($nomcontroleur, $nomaction)) {

        $nomcontroleur = 'PageControleur';
        $nomaction = 'PageNonTrouve';

    }

    $controleur = new $nomcontroleur();
    $controleur -> $nomaction();

?>