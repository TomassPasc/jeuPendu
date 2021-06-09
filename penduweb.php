<?php 
session_start();

//déclaration variable
if(!isset($_SESSION['list_de_mot'])){
    $_SESSION['list_de_mot'] = array('mystere', 'toto', 'test', 'aaaaaa');
}
if(!isset($_SESSION['mot_a_trouver'])){
    $_SESSION['mot_a_trouver'] = $_SESSION['list_de_mot'][array_rand($_SESSION['list_de_mot'])];
}
if(!isset($_SESSION['rappel'])){
    $_SESSION['rappel'] = array();
}
if(!isset($_SESSION['vie'])){
    $_SESSION['vie'] = 5;
}
if(!isset($_SESSION['result'])){
    $_SESSION['result'] = str_repeat('_ ' , strlen($_SESSION['mot_a_trouver']));
}
if(isset($_POST['tentative'])){
    $_SESSION['reponse'] = $_POST['tentative']; //pas besoin de mettre en session
} else {
    $_SESSION['reponse'] = '';
}


$gagne = false; //si le joueur gagne passe à true
$rate = false; //si le joueur se trompe passe à true
$perdu = false; // si le joeur perd passe à true


//$_SESSION['list_de_mot'] = array('mystere', 'toto', 'test', 'aaaaaa');
//$_SESSION['mot_a_trouver'] = $_SESSION['list_de_mot'][array_rand($_SESSION['list_de_mot'])];
//$_SESSION['mot_a_trouver'] = 'test';
//$_SESSION['rappel'] = array();
//$_SESSION['vie'] = 5;
//$_SESSION['result'] = str_repeat('_ ' , strlen($_SESSION['mot_a_trouver']));
//$_SESSION['reponse'] = $_POST['tentative']; 

array_push($_SESSION['rappel'], $_SESSION['reponse']); //met la valeur dans une liste pour pouvoir afficher les valeurs déjà essayées


//l'utilisateur entre une lettre:
if(strlen($_SESSION['reponse']) == 1){ 
    if (strpos($_SESSION['mot_a_trouver'], $_SESSION['reponse']) === false) { //la lettre ne se trouve pas dans le mot
        $rate = true;
        $_SESSION['vie'] = $_SESSION['vie'] - 1;
    }
    else {
        $doublon = 0;
        for ($c = 0; $c < strlen($_SESSION['mot_a_trouver']); $c++){ //on parcourt les lettres du mot à trouver
            if($_SESSION['mot_a_trouver'][$c] === $_SESSION['reponse']) { //quand la lettre tapée correspond on la remplace
                $_SESSION['result'][$c*2] = $_SESSION['reponse']; // c*2 correspond à l'indice comme le motif de result est '_ '
                $doublon++;                  
            }
        }  
        if (strpos($_SESSION['result'], '_') === false){ // plus de tiret donc le mot est trouvé
            $gagne = true; 

        }
    }
}

//l'utilisateur entre un mot:
else {
    if($_SESSION['mot_a_trouver'] != $_SESSION['reponse']) {
        $rate =true;
    }
    else {
        $gagne = true;
    }

    }
if ($_SESSION['vie'] == 0){
    $perdu = true;
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

function mot_a_trouver_cache($arr, $result){
    echo 'MOT A TROUVER: '.$result.PHP_EOL;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le pendu</title>
</head>
<body>
    <h1>Le super jeu du pendu.</h1>
    
    <?php if(!$gagne && !$perdu){?>
        <div >
            <h2><?php mot_a_trouver_cache($_SESSION['rappel'], $_SESSION['result']);?></h2>
            <h3><?php affichage_saisie_existante($_SESSION['rappel']); ?></h3>
            <h4> <?php  $_SESSION['vie'] > 1 ? printf('vous avez %d vies'.PHP_EOL, $_SESSION['vie']) : printf('vous avez %d vie'.PHP_EOL, $_SESSION['vie']);  ?></h4>
            <form method="POST">
                <div>
                    <label for="tentative">Tentative</label>
                    <input type="text" id="tentative" name="tentative" value="">
                </div>
                <input type="submit" value="Entrer une lettre ou une phrase">
            </form>
            <?php if ($rate && $_SESSION['reponse'] != '') {echo 'raté essaie encore';} //reponse initialiser à ''?> 
        </div>
    <?php } else if($gagne){?>
        <div><?php echo 'gagné le mot était bien '.$_SESSION['mot_a_trouver']; ?></div>
        <?php } else if($perdu){?>
        <div><?php echo 'perdu le mot était '.$_SESSION['mot_a_trouver']; ?></div>
        <?php }?>


</body>
</html>