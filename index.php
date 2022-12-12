<?php

define('KINT_SKIP_HELPERS', true);
require __DIR__ . D . 'kint.phar';

// <https://kint-php.github.io/kint/settings>
Kint::$aliases[] = 'kint';
Kint::$app_root_dirs = [PATH => '.'];
Kint::$depth_limit = 50;
Kint::$display_called_from = false;
Kint\Renderer\PlainRenderer::$theme = 'plain.css';
Kint\Renderer\RichRenderer::$theme = 'original.css';

function kint(...$lot) {
    return Kint::dump(...$lot);
}