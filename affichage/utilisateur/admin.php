<?php   

    if(isset($_SESSION['logged']) && isset($_SESSION['admin'])) {

        echo 'Page Admin';

    } else {

        header('Location: ' . Config::USER_LIST);

    }

?>