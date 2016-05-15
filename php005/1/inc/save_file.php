<?php

$file = fopen(__DIR__ . '/../data/' . $filename, 'w');

foreach ($lines as $line) {
    unset($line['num']);
    fwrite($file, implode(' | ', $line) . "\r\n");
}

fclose($file);