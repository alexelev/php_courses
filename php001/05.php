<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body  style="text-align: center;">
    <h1>Входящие данные</h1>

    <div style="display: inline-block; text-align: center;">
        Эти ссылки содержат GET параметры <b>param1</b> и <b>param2</b> <br/><br/>
        <a href="05.php?param1=123">Ссылка с параметром <b>param1</b></a> <br/><br/>
        <a href="05.php?param2=456">Ссылка с параметром <b>param2</b></a> <br/><br/>
        <a href="05.php?param1=123&param2=456">Ссылка с двумя параметрами</a> <br/><br/>

        <br/><hr/><br/>

        Эта форма отправляет GET параметры <b>param1</b> и <b>param2</b>
        <form method="get" action="05.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
            <label>param1</label> <input type="text" name="param1" /> <br/><br/>
            <label>param2</label> <input type="text" name="param2" /> <br/><br/>
            <button type="submit">Отправить</button>
        </form>

        <br/><hr/><br/>

        Эта форма отправляет GET параметр <b>param3</b> в виде массива
        <form method="get" action="05.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
            <label>param3[7]</label> <input type="text" name="param3[7]" /> <br/><br/>
            <label>param3[word]</label> <input type="text" name="param3[word]" /> <br/><br/>
            <label>param3[2]</label> <input type="text" name="param3[2]" /> <br/><br/>
            <label>param3[]</label> <input type="text" name="param3[]" /> <br/><br/>
            <button type="submit">Отправить</button>
        </form>

        <br/><hr/><br/>

        Значения полученных GET параметров: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($_GET) ?></pre>

        <br/><br/><br/>

        Эта форма отправляет POST параметры <b>param1</b> и <b>param2</b>
        <form method="post" action="05.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
            <label>param1</label> <input type="text" name="param1" /> <br/> <br/>
            <label>param2</label> <input type="text" name="param2" /> <br/> <br/>
            <button type="submit">Отправить</button>
        </form>

        <br/><hr/><br/>

        Эта форма отправляет POST параметр <b>param3</b> в виде массива
        <form method="post" action="05.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
            <label>param3[7]</label> <input type="text" name="param3[7]" /> <br/> <br/>
            <label>param3[word]</label> <input type="text" name="param3[word]" /> <br/> <br/>
            <label>param3[2]</label> <input type="text" name="param3[2]" /> <br/> <br/>
            <label>param3[]</label> <input type="text" name="param3[]" /> <br/> <br/>
            <button type="submit">Отправить</button>
        </form>

        <br/><hr/><br/>

        Значения полученных POST параметров: <br/>
        <pre style="display: inline-block; text-align: left;"><?php var_dump($_POST) ?></pre>
    </div>
</body>
</html>