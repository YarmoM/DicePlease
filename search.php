<?php

include __DIR__ . '/constants.php';

$params = '';

if (isset($_POST['status']) && $_POST['status'] != $DEF_STATUS) {
    $params .= 'status='.$_POST['status'].'&';
}
if (isset($_POST['type']) && $_POST['type'] != $DEF_TYPE) {
    $params .= 'type='.$_POST['type'].'&';
}
if (isset($_POST['game']) && $_POST['game'] != $DEF_GAME) {
    $params .= 'game='.$_POST['game'].'&';
}
if (isset($_POST['query']) && $_POST['query'] != $DEF_QUERY) {
    $params .= 'query='.$_POST['query'].'&';
}

if (strlen($params) > 0) {
    $params = '?' . substr($params, 0, -1);
}

header('Location: ' . $BASE_URL . $params);