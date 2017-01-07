<?php

function fn_rapic($data) {
    if (!empty($data['content']) && (!isset($data['rapic']) || $data['rapic'])) {
        $p = explode('</p>', $data['content']);
        ob_start();
        include __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'content.php';
        array_splice($p, array_rand($p), 0, ob_get_clean() . X);
        $data['content'] = str_replace([X . '</p>', X], "", implode('</p>', $p));
    }
    return $data;
}

Hook::set('page.output', 'fn_rapic');