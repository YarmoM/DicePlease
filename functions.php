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
                    "content" => $mp->text($content));
        $issues[] = $iss;
    }

    return $issues;
}