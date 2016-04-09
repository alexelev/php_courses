<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body  style="text-align: center;">
    <h1>Условные конструкции</h1>

    <div style="display: inline-block;">
        <form method="get" action="06.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
            <label>param</label> <input type="text" name="param" /> <br/><br/>
            <button type="submit">Отправить</button>
        </form>

        <br/><hr/><br/>

        Конструкция <b>if</b> выполнится если GET параметр <b>param</b> больше числа <b>5</b> <br/><br/>
        <p style="color: red;">
        <?php
            if ($_GET['param'] > 5) {
                ?><b>param</b> больше числа <b>5</b> <br/><br/><?php
            }
        ?>
        </p>

        <br/><hr/><br/>

        Конструкция <b>if - else</b> выполнит одно из двух действий <br/><br/>
        <p style="color: red;">
        <?php
            if ($_GET['param'] > 5) {
                ?><b>param</b> больше числа <b>5</b> <br/><br/><?php
            } else {
                ?><b>param</b> меньше числа <b>5</b> <br/><br/><?php
            }
        ?>
        </p>

        <br/><hr/><br/>

        Конструкция <b>if - else if</b> выполнит одно из двух действий или ни одного <br/><br/>
        <p style="color: red;">
            <?php
            if ($_GET['param'] > 5 and $_GET['param'] < 10) {
                ?><b>param</b> больше числа <b>5</b> и менье числа <b>10</b> <br/><br/><?php
            } else if ($_GET['param'] > 10){
                ?><b>param</b> больше числа <b>10</b> <br/><br/><?php
            }
            ?>
        </p>

        <br/><hr/><br/>

        Конструкция <b>if - else if - else</b> выполнит одно из трех действий<br/><br/>
        <p style="color: red;">
            <?php
            if ($_GET['param'] > 5 and $_GET['param'] < 10) {
                ?><b>param</b> больше числа <b>5</b> и менье числа <b>10</b> <br/><br/><?php
            } else if ($_GET['param'] > 10){
                ?><b>param</b> больше числа <b>10</b> <br/><br/><?php
            } else {
                ?><b>param</b> меньше числа <b>5</b> <br/><br/><?php
            }
            ?>
        </p>

        <br/><hr/><br/>

        Конструкция <b>switch</b> выполнит одно из трех действий или ниодного<br/><br/>
        <p style="color: red;">
            <?php
                switch($_GET['param']) {
                    case 1 : ?><b>param</b> равен <b>1</b> <br/><br/> <?php break;
                    case 2 : ?><b>param</b> равен <b>2</b> <br/><br/> <?php break;
                    case 3 : ?><b>param</b> равен <b>3</b> <br/><br/> <?php break;
                }
            ?>
        </p>

        <br/><hr/><br/>

        Конструкция <b>switch</b> выполнит одно из трех действий или действие по умолчанию<br/><br/>
        <p style="color: red;">
            <?php
            switch($_GET['param']) {
                case 1 : ?><b>param</b> равен <b>1</b> <br/><br/> <?php break;
                case 2 : ?><b>param</b> равен <b>2</b> <br/><br/> <?php break;
                case 3 : ?><b>param</b> равен <b>3</b> <br/><br/> <?php break;
                default : ?><b>param</b> равен чему-то другому <br/><br/> <?php break;
            }
            ?>
        </p>

        <br/><hr/><br/>

    </div>
</body>
</html>
