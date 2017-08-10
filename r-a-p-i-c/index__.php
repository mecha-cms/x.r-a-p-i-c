<?php

ob_start();
include __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'content.php';
Lot::set('r_a_p_i_c', ob_get_clean());

function fn_rapic_replace($content, $lot) {
    if (isset($lot['rapic']) && !$lot['rapic']) {
        return $content;
    }
    if (!isset($lot['path']) || strpos($lot['path'], PAGE) !== 0) {
        return $content;
    }
    $p = explode('</p>', $content);
    array_splice($p, array_rand($p), 0, Lot::get('r_a_p_i_c', "") . X);
    return str_replace([X . '</p>', X], "", implode('</p>', $p));
}

Hook::set('page.content', 'fn_rapic_replace', 3);