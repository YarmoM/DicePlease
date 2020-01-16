<?php

include __DIR__ . '/constants.php';
include_once __DIR__ . '/vendor/autoload.php';
use Pagerange\Markdown\MetaParsedown;

function getIssues($params) {
    $Parsedown = new Parsedown();
    $mp = new MetaParsedown();
    
    $issues = array();
    
    $files = scandir('issues/');
    foreach($files as $file) {
        // Skip . and ..
        if (($file == '.') || ($file == '..')) {
            continue;
        }
        
        $content = file_get_contents('issues/' . $file);
        $meta = $mp->meta($content);
        $id = intval(substr($file, 0, -3));

        $iss = array("id" => $id,
                    "title" => $meta["title"],
                    "status" => $meta["status"],
                    "type" => $meta["type"],
                    "game" => $meta["game"],
                    "content" => $mp->text($content));
        
        switch ($iss['game']) {
            case 'bfv':
                $iss['game_expanded'] = 'Battlefield V';
                break;
            case 'bf1':
                $iss['game_expanded'] = 'Battlefield 1';
                break;
            default:
                $iss['game_expanded'] = '-';
        }
        
        if (isset($params['id']) && $params['id'] != 'all' && $iss['id'] != $params['id']) {
            continue;
        }
        if (isset($params['status']) && $params['status'] != 'all' && $iss['status'] != $params['status']) {
            continue;
        }
        if (isset($params['type']) && $params['type'] != 'all' && $iss['type'] != $params['type']) {
            continue;
        }
        if (isset($params['game']) && $params['game'] != 'all' && $iss['game'] != $params['game']) {
            continue;
        }
        if (isset($params['query']) && $params['query'] != '' && strpos(strtolower($iss['title']), strtolower($params['query'])) === FALSE) {
            continue;
        }

        $issues[] = $iss;
    }

    $issues = array_reverse($issues);

    return $issues;
}