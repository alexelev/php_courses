<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body  style="text-align: center;">
<h1>Цыкличные конструкции</h1>

<div style="display: inline-block;">
    <form method="get" action="07.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
        <label>param</label> <input type="text" name="param" /> <br/><br/>
        <button type="submit">Отправить</button>
    </form>

    <br/><hr/><br/>

    Конструкция <b>for</b> <br/>
    <p style="color: red;">
        <?php
            for ($i = 1; $i <= $_GET['param']; $i++) {
                ?>Итерация номер <b><?= $i ?></b> <br/><?php
            }
        ?>
    </p>

    <br/><hr/><br/>

    Конструкция <b>while</b> <br/>
    <p style="color: red;">
        <?php
        $i = 1;
        while ($i <= $_GET['param']) {
            ?>Итерация номер <b><?= $i ?></b> <br/><?php
            $i++;
        }
        ?>
    </p>

    <br/><hr/><br/>

    Конструкция <b>do - while</b> <br/>
    <p style="color: red;">
        <?php
        $i = 1;
        do {
            ?>Итерация номер <b><?= $i ?></b> <br/><?php
            $i++;
        } while ($i <= $_GET['param']);
        ?>
    </p>

    <br/><hr/><br/>

    <form method="post" action="07.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
        <label>param[]</label> <input type="text" name="param[]" /> <br/><br/>
        <label>param[]</label> <input type="text" name="param[]" /> <br/><br/>
        <label>param[]</label> <input type="text" name="param[]" /> <br/><br/>
        <label>param[]</label> <input type="text" name="param[]" /> <br/><br/>
        <label>param[]</label> <input type="text" name="param[]" /> <br/><br/>
        <button type="submit">Отправить</button>
    </form>

    <br/><hr/><br/>

    Конструкция <b>foreach</b> перебирает елементы массива (индексы и соотвествующие им значения)<br/>
    <p style="color: red;">
        <?php
            if (!empty($_POST['param'])) {
                foreach ($_POST['param'] as $key => $value) {
                    ?> Текущий элемент имеет индекс <b><?= $key ?></b> и значение <b><?= $value ?></b> <br/> <?php
                }
            }
        ?>
    </p>

    <br/><hr/><br/>

    Конструкция <b>foreach</b> перебирает елементы массива (только значения)<br/>
    <p style="color: red;">
        <?php
            if (!empty($_POST['param'])) {
                foreach ($_POST['param'] as $value) {
                    ?> Текущий элемент имеет значение <b><?= $value ?></b> <br/> <?php
                }
            }
        ?>
    </p>

    <br/><hr/><br/>
</div>
</body>
</html>
