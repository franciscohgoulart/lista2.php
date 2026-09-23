```php
<?php

function limparEspacos($texto) {
    return trim(preg_replace('/\s+/', ' ', $texto));
}

function pegarPalavras($texto) {
    return explode(' ', limparEspacos($texto));
}

function contarFrases($texto) {
    return substr_count($texto, '.') + substr_count($texto, '!') + substr_count($texto, '?');
}

function maiorPalavra($texto) {
    $palavras = pegarPalavras($texto);
    $maior = '';

    foreach ($palavras as $palavra) {
        $palavra = trim($palavra, '.,!?');

        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }
    }

    return $maior;
}

function menorPalavra($texto) {
    $palavras = pegarPalavras($texto);
    $menor = $palavras[0];

    foreach ($palavras as $palavra) {
        $palavra = trim($palavra, '.,!?');

        if (strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return $menor;
}

function palavrasRepetidas($texto) {
    $palavras = pegarPalavras(strtolower($texto));
    $contagem = array_count_values($palavras);
    $repetidas = 0;

    foreach ($contagem as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

function processarTexto($texto) {

    $textoLimpo = limparEspacos($texto);
    $palavras = pegarPalavras($texto);
    $contagem = array_count_values($palavras);
    arsort($contagem);

    return [
        "caracteres" => strlen($texto),
        "palavras" => count($palavras),
        "frases" => contarFrases($texto),
        "maior" => maiorPalavra($texto),
        "menor" => menorPalavra($texto),
        "repetidas" => palavrasRepetidas($texto),
        "frequentes" => array_slice($contagem, 0, 5, true),
        "texto_limpo" => $textoLimpo,
        "texto_formatado" => ucwords(strtolower($textoLimpo))
    ];
}

$texto = "php   é uma linguagem muito usada. php é simples e fácil de aprender!";

$resultado = processarTexto($texto);

echo "Caracteres: " . $resultado["caracteres"] . "<br>";
echo "Palavras: " . $resultado["palavras"] . "<br>";
echo "Frases: " . $resultado["frases"] . "<br>";
echo "Maior palavra: " . $resultado["maior"] . "<br>";
echo "Menor palavra: " . $resultado["menor"] . "<br>";
echo "Palavras repetidas: " . $resultado["repetidas"] . "<br>";

echo "5 palavras mais frequentes:<br>";

foreach ($resultado["frequentes"] as $palavra => $quantidade) {
    echo $palavra . " = " . $quantidade . "<br>";
}

echo "Texto sem espaços duplicados: " . $resultado["texto_limpo"] . "<br>";
echo "Texto formatado: " . $resultado["texto_formatado"];

?>