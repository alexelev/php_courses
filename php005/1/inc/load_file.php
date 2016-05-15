<?php

$lines = [];
$file = fopen(__DIR__ . '/../data/' . $filename, 'r');

$num = 1;
while (!feof($file)) {
    $line = explode(' | ', fgets($file));

    if (!feof($file)) {
        $item = [];
        $item['num'] = $num++;
        foreach ($line as $index => $value) {
            $item[$fields[$index]] = $value;
        }

        $lines[] = $item;
    }
}

fclose($file);