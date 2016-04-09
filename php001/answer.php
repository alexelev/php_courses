<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
    <script>
        $(function() {
            var stationsCount = 0;
            var passengersCount = 0;

            function updateStationsSelect($select) {
                var selectedStation = $select.val();
                $select.empty();
                $select.append($('<option></option>'));

                $('#stations-container div').each(function() {
                    var stationName = $(this).find('input').val();
                    if (selectedStation == stationName) {
                        $select.append('<option selected>' + stationName + '</option>');
                    } else {
                        $select.append('<option>' + stationName + '</option>');
                    }
                })
            }

            function updatePassengers() {
                passengersCount = 0;
                $('#passengers-container div').each(function() {
                    passengersCount++;
                    $(this).find('.passenger-number').text(passengersCount);
                    $(this).find('.passenger-name').attr('name', 'bus[passengers][' + passengersCount + '][name]');
                    $(this).find('.station-from').attr('name', 'bus[passengers][' + passengersCount + '][station-from]');
                    $(this).find('.station-to').attr('name', 'bus[passengers][' + passengersCount + '][station-to]');
                });
            }

            function updateStations() {
                stationsCount = 0;
                $('#stations-container div').each(function() {
                    stationsCount++;
                    $(this).find('label').text('Станция ' + stationsCount);
                    $(this).find('input').attr('name', 'bus[route][' + stationsCount + ']');
                });

                $('#passengers-container div').each(function() {
                    updateStationsSelect($(this).find('.station-from'));
                    updateStationsSelect($(this).find('.station-to'));
                })
            }

            function addStation() {
                stationsCount++;
                var stationDiv = $('<div />');
                stationDiv.append($('<label>Станция ' + stationsCount + '</label> <input type="text" name="bus[route][' + stationsCount + ']" /> <button type="button">X</button>  <br/><br/>'));
                stationDiv.find('button').click(function() {
                    stationDiv.remove();
                    updateStations();
                })
                $('#stations-container').append(stationDiv);
            }

            function addPassenger() {
                passengersCount++;
                var passengerDiv = $('<div />');
                var html = 'Пассажир <b class="passenger-number">' + passengersCount + '</b> <br/><br/> ';
                html += '<label>Имя</label> <input class="passenger-name" type="text" name="bus[passengers][' + passengersCount + '][name]" /> <br/><br/> ';
                html += '<label>От станции</label> ';
                html += '<select class="station-from" name="bus[passengers][' + passengersCount + '][station-from]"></select> <br/><br/> '
                html += '<label>До станции</label> ';
                html += '<select class="station-to" name="bus[passengers][' + passengersCount + '][station-to]"></select> <br/><br/> '
                html += '<button type="button">Удалить</button> <br/><br/>';
                passengerDiv.html(html);

                updateStationsSelect(passengerDiv.find('.station-from'));
                updateStationsSelect(passengerDiv.find('.station-to'));

                passengerDiv.find('button').click(function() {
                    passengerDiv.remove();
                    updatePassengers();
                });

                $('#passengers-container').append(passengerDiv);
            }

            $('#add-station').click(addStation);
            $('#add-passenger').click(addPassenger);
        });
    </script>

</head>
<body  style="text-align: center;">
<h1>Домашнее задание</h1>

<div style="display: inline-block; text-align: center;">
    <form method="post" action="answer.php" style="border: 1px solid black; padding: 10px; margin: 5px;">
        <h3>Автобус</h3>

        <label>Имя водителя</label> <input type="text" name="bus[driver]" /> <br/><br/>

        <b>Станции</b>
        <div id="stations-container"></div>
        <button type="button" id="add-station">Добавить станцию</button> <br/><br/>

        <b>Пассажиры</b> <br/><br/>
        <div id="passengers-container"></div>

        <button type="button" id="add-passenger">Добавить пассажира</button> <br/><br/>

        <button type="submit">Отправить</button>
    </form>

    <br/><hr/><br/>

<!--    <pre style="text-align: left;">--><?php //var_dump($_POST) ?><!--</pre>-->

    <?  if (isset($_POST['bus'])){ ?>

        <div style="display: inline-block; text-align: center; font-size: 20px;">
            <p><h3>Водитель: <?=$_POST['bus']['driver']?></h3></p>

            <p>
            <h3>Маршрут автобуса</h3>

            <ul style="list-style-type: none; margin:0; padding: 0;">

                <? foreach ($_POST['bus']['route'] as $station){ ?>
                   <li><?=$station?></li>
                <? } ?>

            </ul>
            </p>

            <p>
            <h3>Пассажиры</h3>

            <ol  style="list-style-type: none;  margin:0; padding: 0;">

                <? foreach ($_POST['bus']['passengers'] as $key => $passenger) {
                    $from = array_search($passenger['station-from'], $_POST['bus']['route']);
                    $to = array_search($passenger['station-to'], $_POST['bus']['route']);
                    if ($from > $to) { ?>
                        <li>
                            <span><?=$key?>. </span>
                            <details style="display: inline-block;">
                                <summary style="color: red;">Некорректный маршрут пассажира <?=$passenger['name']?></summary>
                                <p style="text-decoration: line-through;"><?=$passenger['station-from']?> - <?=$passenger['station-to']?></p>
                            </details>
                        </li>
                    <? } elseif ($from == $to) { ?>
                        <li>
                            <span><?=$key?>. </span>
                            <details style="display: inline-block;">
                                <summary style="color: red;">Пассажир <?=$passenger['name']?> никуда не едет</summary>
                                <p style="text-decoration: line-through;"><?=$passenger['station-from']?> - <?=$passenger['station-to']?></p>
                            </details>
                        </li>
                    <? } else { ?>
                        <li><?=$key?>. <?=ucfirst($passenger['name'])?>, <?=$passenger['station-from']?> - <?=$passenger['station-to']?></li>
                    <? }} ?>

            </ol>
            </p>
        </div>

    <? } ?>




</div>
</body>
</html>