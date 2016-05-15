<?php

$file = fopen(__DIR__ . '/../data/' . $filename, 'a');

fwrite($file, implode(' | ', $line) . "\r\n");

fclose($file);