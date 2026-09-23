<?php

function contarConsultas($agenda) {
    return count($agenda);
}

function contarPacientes($agenda) {
    $pacientes = [];

    foreach ($agenda as $consulta) {
        $pacientes[] = $consulta["paciente"];
    }

    return count(array_unique($pacientes));
}

function contarEspecialidades($agenda) {
    $especialidades = [];

    foreach ($agenda as $consulta) {
        $especialidade = $consulta["especialidade"];

        if (isset($especialidades[$especialidade])) {
            $especialidades[$especialidade]++;
        } else {
            $especialidades[$especialidade] = 1;
        }
    }

    return $especialidades;
}

function ordenarAgenda($agenda) {
    usort($agenda, function($a, $b) {
        return strcmp($a["horario"], $b["horario"]);
    });

    return $agenda;
}

function primeiroAtendimento($agenda) {
    $agenda = ordenarAgenda($agenda);
    return $agenda[0];
}

function ultimoAtendimento($agenda) {
    $agenda = ordenarAgenda($agenda);
    return $agenda[count($agenda) - 1];
}

function pesquisarPaciente($agenda, $nome) {
    $resultado = [];

    foreach ($agenda as $consulta) {
        if (strtolower($consulta["paciente"]) == strtolower($nome)) {
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

function horariosDuplicados($agenda) {
    $horarios = [];

    foreach ($agenda as $consulta) {
        $horario = $consulta["horario"];

        if (isset($horarios[$horario])) {
            return true;
        }

        $horarios[$horario] = true;
    }

    return false;
}

function organizarAgenda($agenda, $paciente) {
    return [
        "total_consultas" => contarConsultas($agenda),
        "pacientes_diferentes" => contarPacientes($agenda),
        "especialidades" => contarEspecialidades($agenda),
        "primeiro_atendimento" => primeiroAtendimento($agenda),
        "ultimo_atendimento" => ultimoAtendimento($agenda),
        "agenda_ordenada" => ordenarAgenda($agenda),
        "pesquisa_paciente" => pesquisarPaciente($agenda, $paciente),
        "horarios_duplicados" => horariosDuplicados($agenda)
    ];
}

$agenda = [
    [
        "paciente" => "Joao",
        "especialidade" => "Cardiologia",
        "data" => "23/09/2026",
        "horario" => "08:00"
    ],
    [
        "paciente" => "Maria",
        "especialidade" => "Dermatologia",
        "data" => "23/09/2026",
        "horario" => "09:00"
    ],
    [
        "paciente" => "Joao",
        "especialidade" => "Cardiologia",
        "data" => "23/09/2026",
        "horario" => "10:00"
    ],
    [
        "paciente" => "Carlos",
        "especialidade" => "Ortopedia",
        "data" => "23/09/2026",
        "horario" => "11:00"
    ]
];

$resultado = organizarAgenda($agenda, "Joao");

echo "Total de consultas: " . $resultado["total_consultas"] . "<br>";
echo "Pacientes diferentes: " . $resultado["pacientes_diferentes"] . "<br>";

echo "<br>Consultas por especialidade:<br>";

foreach ($resultado["especialidades"] as $especialidade => $quantidade) {
    echo $especialidade . ": " . $quantidade . "<br>";
}

echo "<br>Primeiro atendimento: ";
echo $resultado["primeiro_atendimento"]["paciente"] . " - ";
echo $resultado["primeiro_atendimento"]["horario"] . "<br>";

echo "Último atendimento: ";
echo $resultado["ultimo_atendimento"]["paciente"] . " - ";
echo $resultado["ultimo_atendimento"]["horario"] . "<br>";

echo "<br>Agenda ordenada:<br>";

foreach ($resultado["agenda_ordenada"] as $consulta) {
    echo $consulta["horario"] . " - " . $consulta["paciente"] . " - " . $consulta["especialidade"] . "<br>";
}

echo "<br>Pesquisa do paciente:<br>";

foreach ($resultado["pesquisa_paciente"] as $consulta) {
    echo $consulta["paciente"] . " - " . $consulta["especialidade"] . " - " . $consulta["horario"] . "<br>";
}

echo "<br>Horários duplicados: ";

if ($resultado["horarios_duplicados"]) {
    echo "Sim";
} else {
    echo "Não";
}

?>