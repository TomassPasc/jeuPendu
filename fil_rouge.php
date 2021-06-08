<?php

/*

###############PENDU 1################
//exercice 1
$mystere = 'mystere';
$reponse = readline('Entrer un mot: ');

echo $mystere == $reponse ? 'bien joué c\'est le bon mot' : 'raté';


//exercice 2
$list_de_mot = array('mystere', 'toto', 'test', 'aaaaaa');
$index = array_rand($list_de_mot, 1); //choisit un index parmi la liste
$mot_a_trouver = $list_de_mot[$index]; //retourne un mot de la liste
$reponse = readline('Entrer un mot: ');
echo $mot_a_trouver == $reponse ? 'bien joué c\'est le bon mot' : 'raté';



###############PENDU 2################
$list_de_mot = array('mystere', 'toto', 'test', 'aaaaaa');
$index = array_rand($list_de_mot, 1); //choisit un index parmi la liste
$mot_a_trouver = $list_de_mot[$index]; //retourne un mot de la liste

do{
    $reponse = readline('Entrer un mot: ');
    echo $mot_a_trouver != $reponse? 'raté' : 'trouvé';
}while($mot_a_trouver != $reponse);


###############PENDU 3################
//exercice 1
$list_de_mot = array('mystere', 'toto', 'test', 'aaaaaa');
$index = array_rand($list_de_mot, 1); //choisit un index parmi la liste
$mot_a_trouver = $list_de_mot[$index]; //retourne un mot de la liste

for ($i = 5; $i >=0; $i--){
    $i > 1 ? printf('vous avez %d vies'.PHP_EOL, $i) : printf('vous avez %d vie'.PHP_EOL, $i); // affiche et gère le s de vie
    $reponse = readline('Entrer un mot: ');
    if($mot_a_trouver != $reponse) {
        echo 'raté'.PHP_EOL;
        if ($i == 0){
            echo 'perdu';
        }
    }
    else {
        echo'gagné';
        break;
    }

*/

//exercice 2
$list_de_mot = array('mystere', 'toto', 'test', 'aaaaaa');
$index = array_rand($list_de_mot, 1); //choisit un index parmi la liste
$mot_a_trouver = $list_de_mot[$index]; //retourne un mot de la liste
$rappel = []; //liste des mots et lettre déjà proposé hormis doublons

$mot_a_trouver = 'aabc';

$result = str_repeat('_ ' , strlen($mot_a_trouver)); //permet d'afficher le motif à trouver ex: _ _ _ _ pour test


for ($vie = 5; $vie >=0; $vie--){
    //var_dump($rappel);
    echo $result.PHP_EOL;
    $vie > 1 ? printf('vous avez %d vies'.PHP_EOL, $vie) : printf('vous avez %d vie'.PHP_EOL, $vie); // affiche et gère le s de vie
    $reponse = readline('Entrer une lettre ou le mot si vous pensez l\'avoir trouver: ');

    //l'utilisateur entre une lettre:
    if(strlen($reponse) == 1){ 
        if (strpos($mot_a_trouver, $reponse) === false) { //la lettre ne se trouve pas dans le mot
            echo 'raté';
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
 
}







