<?php

$positieveWoorden = convertFileToArray("positive-words.txt");
$neutraleWoorden = convertFileToArray("neutral-words.txt");
$negatieveWoorden = convertFileToArray("negative-words.txt");
$lyrics = file_get_contents("lyrics.txt");
$lyrics = str_replace("\n", " ", $lyrics);
$lyrics = explode(" ", $lyrics);

function convertFileToArray($file)
{
    $array = file_get_contents($file);
    $array = explode("\n", $array);
    return $array;
}

for ($i = 0; $i < count($lyrics); $i++) {

    // Aantal positieve woorden
    for($x = 0; $x < count($positieveWoorden); $x++) {
        if($positieveWoorden[$x] === $lyrics[$i]) {
            $aantalPositieveWoorden++;
        }
    }
    // Aantal negatieve woorden
    for($y = 0; $y < count($negatieveWoorden); $y++) {
        if($negatieveWoorden[$y] === $lyrics[$i]) {
            $aantalNegatieveWoorden++;
        }
    }
    // Aantal neutrale woorden
    for($z = 0; $z < count($neutraleWoorden); $z++){
        if($neutraleWoorden[$z] === $lyrics[$i]){
            $aantalNeutraleWoorden++;
        }
    }
}
// Sentiment score
$sentiment = round(($aantalNeutraleWoorden + $aantalPositieveWoorden - $aantalNegatieveWoorden) / $aantalNeutraleWoorden ,2);

echo "Positieve woorden: $aantalPositieveWoorden" . PHP_EOL;
echo "Neutrale woorden: $aantalNeutraleWoorden" . PHP_EOL;
echo "Negatieve woorden: $aantalNegatieveWoorden" . PHP_EOL;
echo "Het sentiment van de tekst krijgt een score van: $sentiment" . PHP_EOL;
