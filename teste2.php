<?php 

function countSentences($palavras,$frases)
{
    $novas = $frases;
    foreach ($frases as $f) {
        foreach ($palavras as $p) {
            $novas[] = str_replace($palavras,$p,$f);
        }
    }

    foreach ($frases as $f) {
        $frase = str_replace($palavras,"",$f);
        $reversed = array_reverse($palavras);
        $novas[] = implode(" " . trim($frase) . " ", $reversed);
    }


    return array(
        'result' => $novas,
        'total' => count($novas)
    );
}


$palavras = ["listen","silent"];
$frases = ["listen it is silent"];

$resultado = countSentences($palavras,$frases);
echo '<pre>';
var_dump($resultado);