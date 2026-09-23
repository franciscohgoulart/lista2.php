<?php

function contarMaiusculas($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(ctype_upper($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}


function contarMinusculas($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(ctype_lower($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}


function contarNumeros($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(is_numeric($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}

function contarEspeciais($senha){
    $cont = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(!ctype_alnum($senha[$i])){
            $cont++;
        }
    }

    return $cont;
}

function classificarSenha($senha){

    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);
    $tamanho = strlen($senha);

    $requisitos = 0;

    if($tamanho >= 8){
        $requisitos++;
    }

    if($maiusculas > 0){
        $requisitos++;
    }

    if($minusculas > 0){
        $requisitos++;
    }

    if($numeros > 0){
        $requisitos++;
    }

    if($especiais > 0){
        $requisitos++;
    }

    if($requisitos <= 2){
        return "Fraca";
    }elseif($requisitos == 3){
        return "Média";
    }elseif($requisitos == 4){
        return "Forte";
    }else{
        return "Muito Forte";
    }
}

function analisarSenha($senha){

    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Nível" => classificarSenha($senha)
    ];
}

$resultado = analisarSenha("Abc123@#");

print_r($resultado);



?>