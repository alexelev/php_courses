<?php

$filename = 'employees';
$fields = ['name', 'birth', 'phone', 'post'];

include 'load_file.php';

$employees = [];
foreach ($lines as $line) {
    if (!empty($filter['num']) && $line['num'] != $filter['num']) {
        continue;
    }

    if (!empty($filter['name']) && strpos($line['name'], $filter['name']) === false) {
        continue;
    }

    if (!empty($filter['birth']) && $line['birth'] != $filter['birth']) {
        continue;
    }

    if (!empty($filter['phone']) && $line['phone'] != $filter['phone']) {
        continue;
    }

    if (!empty($filter['post']) && strpos($line['post'], $filter['post']) === false) {
        continue;
    }

    $employees[] = $line;
}
