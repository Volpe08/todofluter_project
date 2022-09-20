<?php

function verification_saisi($donnees){
    //Enleve tous les espace en début et fin du string
        $donnees = trim($donnees);
        //On enleve tous les slash
        $donnees = stripslashes($donnees);
        //On enleve tous les tag
        $donnees = strip_tags($donnees);
        //On enleve tous les caractère html
        $donnees = htmlspecialchars($donnees);
        //On retourne toutes les donner après avoir enleve tous ce qu'on avait
        return $donnees;

}
