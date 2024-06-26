<?php
if ($_SERVER['REMOTE_ADDR'] == '217.61.62.216')
    file_put_contents(__DIR__ . '/access.log', '___________________________' . "\n", FILE_APPEND);
$message = sprintf('%2$s - %1$s - INIT PHP - session:"%3$s"' . "\n", date('Y-m-d H:i:s'),
    $_SERVER['REQUEST_URI'],
    session_id(),
    $_SERVER['HTTP_USER_AGENT'],
    $_SERVER['REMOTE_ADDR']);
//if ($_SERVER['REMOTE_ADDR'] == '217.61.62.216')
//    file_put_contents(__DIR__ . '/access.log', $msg, FILE_APPEND);
