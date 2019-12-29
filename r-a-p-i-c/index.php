<?php namespace _\lot\x;

function r_a_p_i_c($content) {
    $hash = \P . ($path = $this->path) . \P;
    if (!$path || 0 !== \strpos($path, \LOT . \DS . 'page' . \DS)) {
        return $content;
    }
    $test = $this->get('state.r-a-p-i-c') ?? $hash;
    if ($test !== $hash && !$test) {
        return $content;
    }
    if (\State::is('pages')) {
        return $content;
    }
    $ads = "";
    \fire(function() use(&$ads) {
        \ob_start();
        extract($GLOBALS, \EXTR_SKIP);
        include __DIR__ . \DS . 'engine' . \DS . 'r' . \DS . 'layout' . DS . 'ads.php';
        $ads = \ob_get_clean();
    }, [], $this);
    $parts = \explode('</p>', $content);
    \array_splice($parts, \array_rand($parts), 0, $ads . \P);
    return \str_replace([\P . '</p>', \P], "", \implode('</p>', $parts));
}

\Hook::set('page.content', __NAMESPACE__ . "\\r_a_p_i_c", 3);
