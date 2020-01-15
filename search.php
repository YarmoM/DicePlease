<?php

include_once __DIR__ . '/constants.php';

$params = '';

if (isset($_POST['issue_status']) && $_POST['issue_status'] != $DEF_STATUS) {
    $params .= 'status='.$_POST['issue_status'].'&';
}
if (isset($_POST['issue_type']) && $_POST['issue_type'] != $DEF_TYPE) {
    $params .= 'type='.$_POST['issue_type'].'&';
}
if (isset($_POST['issue_game']) && $_POST['issue_game'] != $DEF_GAME) {
    $params .= 'game='.$_POST['issue_game'].'&';
}

if (strlen($params) > 0) {
    $params = '?' . substr($params, 0, -1);
}

header('Location: ' . $BASE_URL . $params);