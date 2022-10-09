<?php

require __DIR__ . D . 'kint.phar';

Kint::$app_root_dirs = [PATH => '.'];
Kint::$display_called_from = false;

function kint(...$var) {
    Kint::dump(...$var);
}

if (defined('TEST') && TEST && ($kint = $_REQUEST['kint'] ?? null)) {
    if (is_string($kint)) {
        // `?kint=asdf:20`
        if (false !== strpos($kint, ':')) {
            [$id, $stack] = explode(':', $kint, 2);
            $stack = is_numeric($stack) ? (float) $stack : 10000;
        // `?kint=asdf`
        } else {
            $id = $kint;
            $stack = 10000; // Make the stack value as large as possible so that it will be executed as late as possible
        }
        Hook::set($id, function (...$v) {
            kint(...$v);
        }, $stack);
    // `?kint=true`
    } else if (true === $kint) {
        Kint::dump(
            $_COOKIE,
            $_ENV,
            $_GET,
            $_POST,
            $_REQUEST,
            $_SERVER,
        );
    }
    exit;
}