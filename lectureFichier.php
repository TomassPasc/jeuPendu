<?php 
$list_de_mot = [];

$fichier = file("dico.txt");

$total = count($fichier);
for($i = 0; $i < $total; $i++) 
{ 
    array_push($list_de_mot, $fichier[$i]);

} 
var_dump($fichier);

?>
