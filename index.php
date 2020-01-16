<?php

include_once __DIR__ . '/constants.php';
include_once __DIR__ . '/vendor/autoload.php';
use Pagerange\Markdown\MetaParsedown;
use Ublaboo\DataGrid\DataGrid;
include 'functions.php';


// Init router
$router = new AltoRouter();

// Router mapping
$router->map('GET', '/', function() {}, 'home');

// Router matching
$match = $router->match();

// Search params
$params = array();
$params['status'] = isset($_GET['status']) ? $_GET['status'] : $DEF_STATUS;
$params['type'] = isset($_GET['type']) ? $_GET['type'] : $DEF_TYPE;
$params['game'] = isset($_GET['game']) ? $_GET['game'] : $DEF_GAME;
$params['query'] = isset($_GET['query']) ? $_GET['query'] : $DEF_QUERY;

// Template engine settings and variables
$options = [
    'paths' => [
        'views/',
    ],
];
$variables = [
    'title' => 'Dice Please',
    'issues' => getIssues($params),
    'params' => $params
];

// Render the appropriate route
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
    // No route was matched
    Phug::displayFile('404', $variables, $options);
}