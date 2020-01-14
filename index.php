<?php

include_once __DIR__ . '/vendor/autoload.php';

$variables = [
    'title' => 'Dice Please',
    'issues' => array()
];

$variables['issues'][1] = (object) ['id' => 1, 'title' => 'Test', 'added' => '2020-01-13'];
$variables['issues'][2] = (object) ['id' => 2, 'title' => 'Testing', 'added' => '2020-01-13'];
$variables['issues'][3] = (object) ['id' => 3, 'title' => 'Testable', 'added' => '2020-01-13'];

$options = [
    'paths' => [
        'views/',
    ],
];

$router = new AltoRouter();

// map homepage
$router->map('GET', '/', function() {}, 'home');


$match = $router->match();
// $match['target'], $match['params'], $match['name']

if(is_array($match) && is_callable($match['target'])) {
    switch ($match['name']) {
        case 'home':
            Phug::displayFile('index', $variables, $options);
            break;
        
        default:
            Phug::displayFile('404', $variables, $options);
            break;
    }
} else {
    // no route was matched
    Phug::displayFile('404', $variables, $options);
}