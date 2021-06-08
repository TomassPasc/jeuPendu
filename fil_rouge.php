<?php


$list_de_mot = array('mystere', 'toto', 'test', 'aaaaaa');
$mot_a_trouver = $list_de_mot[array_rand($list_de_mot)]; //retourne un mot de la liste
$rappel = []; //liste des mots et lettre déjà proposé hormis doublons

$mot_a_trouver = 'aaaaaaaabc';

$result = str_repeat('_ ' , strlen($mot_a_trouver)); //permet d'afficher le motif à trouver ex: _ _ _ _ pour test

//boucle principal du programme
for ($vie = 5; $vie >=0; $vie--){
    if (!empty($rappel)) {
        echo 'Vous avez essayer les valeurs suivantes: ';
    foreach ($rappel as $valeur) { //affichage des valeurs déjà tapé
            echo $valeur.' b';
        }  
        echo PHP_EOL;
    }
    echo 'MOT A TROUVER: '.$result.PHP_EOL;
    $vie > 1 ? printf('vous avez %d vies'.PHP_EOL, $vie) : printf('vous avez %d vie'.PHP_EOL, $vie); // affiche et gère le s de vie
    $reponse = readline('Entrer une lettre ou le mot si vous pensez l\'avoir trouver: ');
    array_push($rappel, $reponse); //met la valeur dans une liste pour pouvoir afficher les valeurs déjà essayées

    //l'utilisateur entre une lettre:
    if(strlen($reponse) == 1){ 
        if (strpos($mot_a_trouver, $reponse) === false) { //la lettre ne se trouve pas dans le mot
            echo 'raté'.PHP_EOL;
        }
        else {
            $doublon = 0;
            for ($c = 0; $c < strlen($mot_a_trouver); $c++){ //on parcourt les lettres du mot à trouver
                if($mot_a_trouver[$c] === $reponse) { //quand la lettre tapée correspond on la remplace
                    $result[$c*2] = $reponse; // c*2 correspond à l'indice comme le motif de result est '_ '
                    $doublon++;                  
                }
            }  
            if (strpos($result, '_') === false){ // plus de tiret donc le mot est trouvé
                echo 'gagné';
                break;
            }
            if ($doublon > 1) {
                for($d =0; $d <= $doublon; $d++){
                    array_pop($rappel); //retire les doublons du rappel
                }
                $vie ++; // permet de ne pas perdre de vie lorsque la lettre se trouve plus d'une fois dans le mot.
            }    
        }
    }
    //l'utilisateur entre un mot:
    else {
        if($mot_a_trouver != $reponse) {
            echo 'raté'.PHP_EOL;
            if ($vie == 0){
                echo 'perdu';
            }
        }
        else {
            echo'gagné';
            break;
        }

    }
    echo '-----------------'.PHP_EOL;
    echo '#################'.PHP_EOL;
    echo '-----------------'.PHP_EOL;

}




