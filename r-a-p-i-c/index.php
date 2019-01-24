<?php namespace fn;

function r_a_p_i_c($content, array $lot = []) {
    $hash = X . ($path = $this->path) . X;
    if (!$path || \strpos($path, PAGE . DS) !== 0) {
        return $content;
    }
    $test = $this->get('state.r-a-p-i-c', $hash);
    if ($test !== $hash && !$test) {
        return $content;
    }
    if (\Config::get('is.pages')) {
        return $content;
    }
    $adv = "";
    \fn(function() use(&$adv) {
        \ob_start();
        extract(\Lot::get(), \EXTR_SKIP);
        include __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'content.php';
        $adv = \ob_get_clean();
    }, [], $this, \Page::class);
    $parts = \explode('</p>', $content);
    \array_splice($parts, \array_rand($parts), 0, $adv . X);
    return \str_replace([X . '</p>', X], "", \implode('</p>', $parts));
}

\Hook::set('page.content', __NAMESPACE__ . "\\r_a_p_i_c", 3);