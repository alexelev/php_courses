$(function() {
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

