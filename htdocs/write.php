<?php

$f = __DIR__ . '/temp.txt';

file_put_contents($f, 'content');

if (file_exists($f)) {
    echo $f;
}
