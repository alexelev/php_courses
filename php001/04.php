<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body  style="text-align: center;">
    <h1>Массивы</h1>

    <div style="display: inline-block;">
        <?php
            $arr1 = [11, 22, 33, 44];
        ?>

        <b>1.</b> В массиве <b>$arr1</b> 4 элемента. Индексация начинается с нуля и не прерывается: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr1) ?></pre> <br/>

        <?php
            $arr1[] = 55;
            $arr1[] = 56
        ?>

        <b>2.</b> Добавили в конец массива два элемента: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr1) ?></pre> <br/> <br/>

        <?php
            $arr2 = [
                1 => 11,
                5 => 22,
                3 => 33,
                7 => 44,
                4 => 55
            ];
        ?>

        <b>3.</b> В массиве <b>$arr2</b> 5 элементов. Индексация задана вручную и не по порядку: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr2) ?></pre> <br/>

        <?php
        $arr2[0] = 66;
        $arr2[1] = 77;
        ?>

        <b>4.</b> Добавили элемент под индексом 0, изменили значение элемента с индексом 1: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr2) ?></pre> <br/>

        <?php
            $arr2[] = 88;
            $arr2[] = 99;
        ?>

        <b>5.</b> Добавили в конец массива 2 элемента: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr2) ?></pre> <br/> <br/>

        <?php
            $arr3 = [
                'элемент1' => 11,
                'элемент2' => 22,
                'элемент3' => 33
            ]
        ?>

        <b>6.</b> Элементам массива <b>$arr3</b> заданы строковые ключи: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr3) ?></pre> <br/>

        <?php
            $arr3[] = 44;
            $arr3['элемент4'] = 55;
            $arr3[5] = 66;
            $arr3['элемент5'] = 77;
            $arr3[3] = 88;
            $arr3[] = 99;
        ?>

        <b>7.</b> Добавили в массив несколько элементов: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr3) ?></pre> <br/> <br/>


        <?php
            $arr4 = [
                11,
                22,
                [
                    111,
                    222,
                ],
                [
                    111,
                    222,
                    [
                        1111,
                        2222
                    ]
                ]
            ]
        ?>

        <b>8.</b> Массив <b>$arr4</b> содержит элементы, которые тоже массивы: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($arr4) ?></pre> <br/> <br/>

        <?php
            $bus = [
                'route' => [
                    'station1',
                    'station2',
                    'station3',
                    'station4',
                ],
                'passengers' => [
                    [
                        'name' => 'Mike',
                        'endpoint' => 'station3'
                    ],
                    [
                        'name' => 'Smith',
                        'endpoint' => 'station2'
                    ],
                    [
                        'name' => 'Roger',
                        'endpoint' => 'station3'
                    ],
                    [
                        'name' => 'Bruce',
                        'endpoint' => 'station4'
                    ],
                ],
                'driver' => 'Albert'
            ]
        ?>

        <b>9.</b> Массив <b>bus</b> содержит структурированные данные о маршруте, пассажирах и водителе автобуса: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($bus) ?></pre> <br/> <br/>

        <?php
            $classroom = [
                'lector' => 'George',
                'students' => [
                    [
                        'name' => 'Roman',
                        'lastname' => '',
                        'avg' => null,
                        'marks' => []
                    ],
                    [
                        'name' => 'Igor',
                        'lastname' => '',
                        'avg' => null,
                        'marks' => []
                    ],
                    [
                        'name' => 'Ivan',
                        'lastname' => '',
                        'avg' => null,
                        'marks' => []
                    ],
                    [
                        'name' => 'Ivan',
                        'lastname' => '',
                        'avg' => null,
                        'marks' => []
                    ],
                    [
                        'name' => 'Dimitry',
                        'lastname' => '',
                        'avg' => null,
                        'marks' => []
                    ]
                ],
                'subject' => 'PHP',
                'topic' => 'begining',
            ];
        ?>
        <b>10.</b> Массив <b>classroom</b> содержит структурированные данные о сегодняшнем занятии: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($classroom) ?></pre> <br/> <br/>

    </div>
</body>
</html>