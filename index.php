<?php

define('KINT_SKIP_HELPERS', true);
require __DIR__ . D . 'kint.phar';

// <https://kint-php.github.io/kint/settings>
Kint::$app_root_dirs = [PATH => '.'];
Kint::$display_called_from = false;
Kint\Renderer\PlainRenderer::$theme = 'plain.css';
Kint\Renderer\RichRenderer::$theme = 'original.css';

function kint(...$lot) {
    return Kint::dump(...$lot);
}

Kint::$aliases[] = 'kint';