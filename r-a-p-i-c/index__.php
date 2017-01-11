<?php

function fn_rapic($content, $lot) {
    if (isset($lot['rapic']) && !$lot['rapic']) {
        return $content;
    }
    $p = explode('</p>', $content);
    ob_start();
    include __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'content.php';
    array_splice($p, array_rand($p), 0, ob_get_clean() . X);
    return str_replace([X . '</p>', X], "", implode('</p>', $p));
}

Hook::set('page.content', 'fn_rapic');