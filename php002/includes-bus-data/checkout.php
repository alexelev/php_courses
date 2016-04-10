<?php

echo $var1;

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
