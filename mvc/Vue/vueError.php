<?php
    echo "<h3>Une erreur s'est produite </h3>" ;
    foreach ($model->getError()  as $error) {
        echo "<p>".$error."</p>";
    }
?>
