<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
    <script>
        $(function() {
            var stationsCount = <?= (empty($_POST['bus']['route']) ? 0 : count($_POST['bus']['route'])) ?>;
            var passengersCount = <?= (empty($_POST['bus']['passengers']) ? 0 : count($_POST['bus']['passengers'])) ?>;

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
            };

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
                })

                $('#passengers-container').append(passengerDiv);
            }

            $('#add-station').click(addStation);
            $('#add-passenger').click(addPassenger);

            $('#stations-container button').click(function() {
                $(this).parent().remove();
                updateStations();
            });

            $('#passengers-container button').click(function() {
                $(this).parent().remove();
                updatePassengers();
            })
        });
    </script>
</head>
<body  style="text-align: center;">
    <h1>Домашнее задание 1 (решение)</h1>

    <div style="display: inline-block; text-align: center;">
        <form method="post" style="border: 1px solid black; padding: 10px; margin: 5px;">
            <h3>Автобус</h3>

            <label>Имя водителя</label> <input type="text" name="bus[driver]" value="<?= (empty($_POST['bus']['driver']) ? '' : $_POST['bus']['driver']) ?>" /> <br/><br/>

            <b>Станции</b><br/><br/>
            <div id="stations-container">
                <?php
                    if (!empty($_POST['bus']['route'])) {
                        foreach ($_POST['bus']['route'] as $index => $station) {
                            ?>
                            <div>
                                <label>Станция <?= $index ?></label>
                                <input type="text" name="bus[route][<?= $index ?>]" value="<?= $station ?>" />
                                <button type="button">X</button>
                                <br/><br/>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <button type="button" id="add-station">Добавить станцию</button> <br/><br/>

            <b>Пассажиры</b> <br/><br/>
            <div id="passengers-container">
                <?php
                    if (!empty($_POST['bus']['passengers'])) {
                        foreach ($_POST['bus']['passengers'] as $index => $passenger) {
                            ?>
                                <div>
                                    Пассажир <b class="passenger-number"><?= $index ?></b>
                                    <br/>
                                    <br/>
                                    <label>Имя</label>
                                    <input class="passenger-name" type="text" name="bus[passengers][<?= $index ?>][name]" value="<?= $passenger['name'] ?>" />
                                    <br/>
                                    <br/>
                                    <label>От станции</label>
                                    <select class="station-from" name="bus[passengers][<?= $index ?>][station-from]">
                                        <option></option>
                                        <?php
                                            if (!empty($_POST['bus']['route'])) {
                                                foreach ($_POST['bus']['route'] as $station) {
                                                    if ($_POST['bus']['passengers'][$index]['station-from'] == $station) {
                                                        ?><option selected><?= $station ?></option><?php
                                                    } else {
                                                        ?><option><?= $station ?></option><?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    <br/>
                                    <br/>
                                    <label>До станции</label>
                                    <select class="station-to" name="bus[passengers][<?= $index ?>][station-to]">
                                        <option></option>
                                        <?php
                                            if (!empty($_POST['bus']['route'])) {
                                                foreach ($_POST['bus']['route'] as $station) {
                                                    if ($_POST['bus']['passengers'][$index]['station-to'] == $station) {
                                                        ?><option selected><?= $station ?></option><?php
                                                    } else {
                                                        ?><option><?= $station ?></option><?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    <br/>
                                    <br/>
                                    <button type="button">Удалить</button>
                                    <br/>
                                    <br/>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>

            <button type="button" id="add-passenger">Добавить пассажира</button> <br/><br/>

            <button type="submit">Отправить</button>
        </form>

        <br/><hr/><br/>

        <?php
            $has_errors = false;

            if (empty($_POST['bus']['driver'])) {
                $has_errors = true;
                ?><p style="color: red;">Поле <b>Имя водителя</b> не заполнено</p><?php
            }

            if (empty($_POST['bus']['route'])) {
                $has_errors = true;
                ?><p style="color: red;">Не задано ниодной станции</p><?php
            } else {
                foreach ($_POST['bus']['route'] as $index => $station) {
                    if (empty($station)) {
                        $has_errors = true;
                        ?><p style="color: red;">Поле <b>Станция <?= $index ?></b> не заполнено</p><?php
                    }
                }
            }

            if (empty($_POST['bus']['passengers'])) {
                $has_errors = true;
                ?><p style="color: red;">Не задано ниодного пассажира</p><?php
            } else {
                foreach ($_POST['bus']['passengers'] as $p_index => $passenger) {
                    if (empty($passenger['name'])) {
                        $has_errors = true;
                        ?><p style="color: red;">Не заполнено поле <b>Имя</b> пассажира <?= $p_index ?></p><?php
                    }

                    if (!empty($passenger['station-from']) && !empty($passenger['station-to'])) {
                        $index_station_from = 0;
                        $index_station_to = 0;

                        foreach ($_POST['bus']['route'] as $r1_index => $station) {
                            if ($passenger['station-from'] == $station) {
                                $index_station_from = $r1_index;
                                break;
                            }
                        }

                        foreach ($_POST['bus']['route'] as $r2_index => $station) {
                            if ($passenger['station-to'] == $station) {
                                $index_station_to = $r2_index;
                                break;
                            }
                        }

                        if ($index_station_from >= $index_station_to) {
                            $has_errors = true;
                            ?><p style="color: red;">Некорректный маршрут пассажира <?= $p_index ?></p><?php
                        }
                    } else {
                        if (empty($passenger['station-from'])) {
                            $has_errors = true;
                            ?><p style="color: red;">Поле <b>От станции</b> пассажира <?= $p_index ?> не заполнено</p><?php
                        }

                        if (empty($passenger['station-to'])) {
                            $has_errors = true;
                            ?><p style="color: red;">Поле <b>До станции</b> пассажира <?= $p_index ?> не заполнено</p><?php
                        }
                    }
                }
            }
        ?>

        <?php
            if (!$has_errors) {
                ?>
                <h3>Полученные данные</h3>

                <p><b>Водитель: <?= $_POST['bus']['driver'] ?></b></p>

                <div style="margin-bottom: 10px;">
                    <h4>Маршрут автобуса</h4>
                    <ul style="list-style-type: none; margin:0; padding: 0;">
                        <?php
                        foreach ($_POST['bus']['route'] as $index => $station) {
                            ?><li><?= $index ?>. <?= $station ?></li><?php
                        }
                        ?>
                    </ul>
                </div>

                <div style="margin-bottom: 10px;">
                    <h4>Пассажиры</h4>
                    <ul style="list-style-type: none; margin:0; padding: 0;">
                        <?php
                        foreach ($_POST['bus']['passengers'] as $index => $passenger) {
                            ?><li><?= $index ?>. <?= "{$passenger['name']}, {$passenger['station-from']} - {$passenger['station-to']}" ?></li><?php
                        }
                        ?>
                    </ul>
                </div>
        <?php
            }
        ?>

    </div>
</body>
</html>