<?php

require __DIR__ . D . 'kint.phar';

Kint::$app_root_dirs = [PATH => '.'];
Kint::$display_called_from = false;

function kint($lot) {
    $fn = new ReflectionMethod('Kint::dump');
    $fn->invokeArgs((object) [], [$lot]);
}

if (defined('TEST') && TEST && ($kint = $_REQUEST['kint'] ?? null)) {
    if (is_string($kint)) {
        [$id, $stack] = explode(':', $kint . ':');
        // `?kint=asdf:20`
        if (false !== strpos($kint, ':')) {
            [$id, $stack] = explode(':', $kint, 2);
            $stack = is_numeric($stack) ? (float) $stack : 10000;
        // `?kint=asdf`
        } else {
            $id = $kint;
            $stack = 10000; // Make hook stack value as large as possible so that it will be executed last!
        }
        Hook::set($id, function (...$lot) {
            kint(...$lot); // Why this is not working? :(
        }, $stack);
    // `?kint=true`
    } else if (true === $kint) {
        kint($GLOBALS);
    }
    exit;
}