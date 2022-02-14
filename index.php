<?php

    include 'AutoLoader.php';
    AutoLoader::start();

    

    $chemin = $_GET['chemin'];
    
    $partiechemin = explode("/", $chemin);
    
    if(isset($partiechemin[0]) && $partiechemin[0] != '') {
        
        $nomcontroleur = 'controleur\\' . ucfirst($partiechemin[0]).'Controleur';

    } else {

        $nomcontroleur = 'controleur\\ArticleControleur';

    }


    if(isset($partiechemin[1]) && $partiechemin[1] != '') {

        $nomaction = $partiechemin[1];

    } else {

        $nomaction = 'liste';

    }

    if(isset($partiechemin[2]) && $partiechemin[2] != '') {
        
        $parametre = $partiechemin[2];

    } else {

        $parametre = null;

    }

    if(!method_exists($nomcontroleur, $nomaction)) {

        $nomcontroleur = 'controleur\\PageControleur';
        $nomaction = 'pageNonTrouve';

    }

    $controleur = new $nomcontroleur();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>

    <link rel="stylesheet" href="/php_pdo/assets/css/bootstrap.css">    
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>
<body>

    <?php

        $controleur -> $nomaction($parametre);

    ?>

</body>
</html>
