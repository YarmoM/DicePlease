<?php

include_once __DIR__ . '/vendor/autoload.php';
use Pagerange\Markdown\MetaParsedown;
include 'functions.php';

$variables = [
    'title' => 'Dice Please',
    'issues' => getIssues()
];

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