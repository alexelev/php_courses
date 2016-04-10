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