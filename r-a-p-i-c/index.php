<?php namespace fn;

ob_start();

function rapic($content, array $lot = []) {
    global $config;
    if ($this->rapic !== null && !$this->rapic) {
        return $content;
    } else if (!$this->path || strpos($this->path, PAGE . DS) !== 0) {
        return $content;
    } else if ($config->is('pages')) {
        return $content;
    }
    $ad = "";
    \fn(function() use(&$ad) {
        ob_start();
        extract(\Lot::get(), EXTR_SKIP);
        include __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'content.php';
        $ad = ob_get_clean();
    }, [], $this, \Hook::class);
    $parts = explode('</p>', $content);
    array_splice($parts, array_rand($parts), 0, $ad . X);
    return str_replace([X . '</p>', X], "", implode('</p>', $parts));
}

\Hook::set('page.content', __NAMESPACE__ . "\\rapic", 3);