<?php

include_once __DIR__ . '/vendor/autoload.php';
use Pagerange\Markdown\MetaParsedown;

function getIssues() {
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
        $issues[] = $iss;
    }

    $issues = array_reverse($issues);

    return $issues;
}