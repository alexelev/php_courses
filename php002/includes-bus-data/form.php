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
