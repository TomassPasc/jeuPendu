<?php
//todo gerer majuscule minuscule 

//$list_de_mot = array('mystere', 'toto', 'test', 'aaaaaa');
$list_de_mot = file("dico.txt");
array_walk($list_de_mot, 'trim_value');
$mot_a_trouver = $list_de_mot[array_rand($list_de_mot)]; //retourne un mot de la liste
$rappel = []; //liste des mots et lettre déjà proposé hormis doublons
$vie = 5;




//ajout mot dictionnaire
$ajoutMot = readline('Voulez vous ajouter un mot? Tapez o pour oui');
if ($ajoutMot == 'o'){
    //$mot = readline('quel est votre mot?');
    // $fp = fopen('dico.txt', 'a+');
    // fputs($fp, $mot);
    //fclose($fp);
    file_put_contents('dico.txt', 'vert');
}










$result = str_repeat('_ ' , strlen($mot_a_trouver)); //permet d'afficher le motif à trouver ex: _ _ _ _ pour test

//boucle principal du programme
for ($vie; $vie >=0; $vie--){

    affichage_saisie_existante($rappel);
    mot_a_trouver_cache($rappel, $vie, $result);


    $reponse = readline('Entrer une lettre ou le mot si vous pensez l\'avoir trouver: ');
    while(in_array($reponse, $rappel)){ //verifie que la valeur n'est pas identique
        $reponse = readline('Vous avez déjà entrer cette valeur entrer une nouveele valeur: ');
    }
    
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
                echo 'gagné le mot était bien '.$mot_a_trouver; 
                break;
            }
            if ($doublon > 1) {
                $vie ++; // permet de ne pas perdre de vie lorsque la lettre se trouve plus d'une fois dans le mot.
            }    
        }

        if ($vie == 0){
                echo 'perdu le mot était bien '.$mot_a_trouver;
        }

    }
    //l'utilisateur entre un mot:
    else {
        if($mot_a_trouver != $reponse) {
            echo 'raté'.PHP_EOL;
            if ($vie == 0){
                echo 'perdu le mot était bien '.$mot_a_trouver;
            }
        }
        else {
            echo 'gagné le mot était bien '.$mot_a_trouver;
            break;
        }

    }
    echo '-----------------'.PHP_EOL;
    echo '#################'.PHP_EOL;
    echo '-----------------'.PHP_EOL;

}



function affichage_saisie_existante($arr){
        if (!empty($arr)) {
        echo 'Vous avez essayer les valeurs suivantes: ';
    foreach ($arr as $valeur) { //affichage des valeurs déjà tapé
            echo $valeur.' ';
        }  
        echo PHP_EOL;
    }
}

function mot_a_trouver_cache($arr, $vie, $result){
    echo 'MOT A TROUVER: '.$result.PHP_EOL;
    $vie > 1 ? printf('vous avez %d vies'.PHP_EOL, $vie) : printf('vous avez %d vie'.PHP_EOL, $vie); // affiche et gère le s de vie

}

function trim_value(&$value)
{
    $value = trim($value);
}

