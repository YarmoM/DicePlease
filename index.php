<?php

include_once __DIR__ . '/vendor/autoload.php';
use Pagerange\Markdown\MetaParsedown;
use Ublaboo\DataGrid\DataGrid;
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

// Init router
$router = new AltoRouter();

// Router mapping
$router->map('GET', '/', function() {}, 'home');

// Router matching
$match = $router->match();

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