<?php
/*
Créer l'algo qui permettra de calculer une estimation de temps par rapport à un jeu de données envoyées.

Ouvre ce fichier dans ton navigateur, ou lance un serveur php avec la commande : "php -S localhost:8000 -t ." en étant placé dans ce dossier.

Analyse le résultat attendu. Les contenus d'exemple seront automatiquement enlevés dès que tu fourniras des valeurs dans les tableaux `lines` et `additional`.

Chaque entrée dans `lines` et `additional` devra avoir cette form : 

    [
        "name" => "Nom du dev",
        "time" => "temps en minute", // => 340
    ]

Les temps sont exprimés en minutes.

- "total_percentage" correspond au pourcentage à appliquer sur le total
- "startup_time" correspond au temps nécessaire à la mise en place du projet. Ce temps de mise en place devra être en première ligne du tableau.

Dans la partie "additional", il faudra ajouter des entrées pour les temps supplémentaires en fonction du type de design et type de projet, même si ces temps additionnels sont égal à "0". On ne veut pas ici le pourcentage de temps supplémentaire, mais le temps supplémentaire occasionné, en minutes.

*/


/**
 * Règles de gestion
 */
$designTypes = [
    'simple' => [
        'total_percentage' => 0
    ],
    'complex' => [
        'total_percentage' => 10
    ],
    'complex_animations' => [
        'total_percentage'  => 15
    ]
];

$projectTypes = [
    'laravel' => [
        'startup_time' => 240,
        'total_percentage' => 0
    ],
    'laravel_vuejs' => [
        'startup_time' => 360,
        'total_percentage' => 15
    ]
];

$genericDevelopments = [
    'homepage' => 420,
    'events' => 840,
    'blog' => 600,
    'jobs' => 960,
    'editorial' => 300,
];
// fin des règles de gestion


/**
 * Jeux de données de test
 */
$dataSentArray = [
    [
        'designType' => 'complex',
        'projectType' => 'laravel_vuejs',
        'genericDevelopments' => [
            'homepage', 'editorial', 'blog', 'jobs'
        ]
    ],
    [
        'designType' => 'complex_animations',
        'projectType' => 'laravel_vuejs',
        'genericDevelopments' => [
            'homepage', 'jobs'
        ]
    ],
    [
        'designType' => 'simple',
        'projectType' => 'laravel',
        'genericDevelopments' => [
            'homepage', 'jobs', 'events', 'blog', 'editorial'
        ]
    ]
];


/**
 * Algo
 */

/* 
Change l'index ici si tu veux tester avec un autre jeu de donnée du tableau ci-dessus.

L'index "0" correspond à :
[
    'designType' => 'complex',
    'projectType' => 'laravel_vuejs',
    'genericDevelopments' => [
        'homepage', 'editorial', 'blog', 'jobs'
    ]
],

*/
$dataSent = $dataSentArray[0];

// -------------- Ton algo ici --------------


$total = 0;
$lines = [];
$additional = [];

// Get project and design types from input data~
$projectType = $dataSent['projectType'];
$designType = $dataSent['designType'];

// Compute additional percentages based on project and design types~
$projectPercentage = $projectType ? $projectTypes[$projectType]['total_percentage'] : 0;
$designPercentage = $designType ? $designTypes[$designType]['total_percentage'] : 0;
$additionalPercentage = $projectPercentage + $designPercentage;

// Add startup time for project type if specified~
$startupTime = $projectTypes[$projectType]['startup_time'];
$lines[] = ['name' => 'Mise en place du projet', 'time' => $startupTime];
$total += $startupTime;

// Add generic development times from input data~
foreach ($dataSent['genericDevelopments'] as $development) {
    $devTime = $genericDevelopments[$development] ?? 0;
    $total += $devTime;
    $lines[] = ['name' => $development, 'time' => $devTime];
}

// Add additional times based on percentages~
$additional[] = ['name' => "Type de projet : $projectType", 'time' => $total * $projectPercentage / 100];
$additional[] = ['name' => "Type de design : $designType", 'time' => $total * $designPercentage / 100];

// Add additional times to total~
$total *= (100 + $additionalPercentage) / 100;
$total = round($total);

// Return result object with total, lines, and additional arrays~
$result = ['total' => $total, 'lines' => $lines, 'additional' => $additional];

// -------------- Fin de ton algo ------------

// Ne pas toucher ci-dessous
include('functions.php');
display_result($result);
