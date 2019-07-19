<?php namespace _\lot\x;

function r_a_p_i_c($content) {
    $hash = P . ($path = $this->path) . P;
    if (!$path || \strpos($path, PAGE . DS) !== 0) {
        return $content;
    }
    $test = $this->get('state.r-a-p-i-c') ?? $hash;
    if ($test !== $hash && !$test) {
        return $content;
    }
    if (\Config::is('pages')) {
        return $content;
    }
    $ads = "";
    \fire(function() use(&$ads) {
        \ob_start();
        extract($GLOBALS, \EXTR_SKIP);
        include __DIR__ . DS . 'engine' . DS . 'r' . DS . 'content' . DS . 'ads.php';
        $ads = \ob_get_clean();
    }, [], $this);
    $parts = \explode('</p>', $content);
    \array_splice($parts, \array_rand($parts), 0, $ads . P);
    return \str_replace([P . '</p>', P], "", \implode('</p>', $parts));
}

\Hook::set('page.content', __NAMESPACE__ . "\\r_a_p_i_c", 3);
\Language::set('o:page-state.r-a-p-i-c', ['Hide advertisements in page content?', 0]);