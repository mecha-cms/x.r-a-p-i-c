<?php

ob_start();
include __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'content.php';
Lot::set('r_a_p_i_c', ob_get_clean(), __DIR__);

function fn_rapic($content, $lot = [], $that = null) {
    if (isset($lot['rapic']) && !$lot['rapic'] || isset($that->rapic) && !$that->rapic) {
        return $content;
    }
    if (!isset($lot['path']) || strpos($lot['path'], PAGE) !== 0) {
        return $content;
    }
    $p = explode('</p>', $content);
    array_splice($p, array_rand($p), 0, Lot::get('r_a_p_i_c', "", __DIR__) . X);
    return str_replace([X . '</p>', X], "", implode('</p>', $p));
}

Hook::set('page.content', 'fn_rapic', 3);