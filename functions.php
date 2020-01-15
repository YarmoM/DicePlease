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

        $iss = array("id" => $id, "title" => $meta["title"], "content" => $mp->text($content));
        // $iss->meta = $mp->meta($content);
        // $iss->text = $mp->text($content);
        $issues[] = $iss;
        
        // $meta = $mp->meta($content);
        // echo $mp->text($content);
        // echo $meta['title'];
        // echo $Parsedown->text($content);
    }
    return $issues;
}

// echo $issues[0]["id"];