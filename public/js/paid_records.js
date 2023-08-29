const paidLocations = $('#paidLocation');
const monthSelect = $('#month');
const yearSelect = $('#year');

function paymentLocations(locations) {
    paidLocations.empty();

    const nullOption = $('<option>', {
        value: '',
        text: 'Select Location'
    });
    paidLocations.append(nullOption);

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'ALL'
    });
    paidLocations.append(allOption);


    for (const key in locations) {
        if (locations.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: locations[key],
                text: locations[key]
            });

            paidLocations.append(option);
        }
    }
}

function fetchPaymentLocations() {
    fetch('/get_locations')
        .then(response => response.json())
        .then(locations => {
            paymentLocations(locations);
        })
        .catch(error => console.error('Error fetching locations:', error));
}

function getMonthNumber(monthName) {
    const months = {
        January: 1,
        February: 2,
        March: 3,
        April: 4,
        May: 5,
        June: 6,
        July: 7,
        August: 8,
        September: 9,
        October: 10,
        November: 11,
        December: 12
    };

    return months[monthName];
}


$(document).ready(function () {

    fetchPaymentLocations();

    const currentMonth = new Date().getMonth() + 1;
    const currentYear = new Date().getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    monthSelect.val(monthNames[currentMonth - 1]);
    yearSelect.val(currentYear);

});

$('#searchBtn').click(function () {
    var location = paidLocations.val();
    var year = yearSelect.val();
    var month = getMonthNumber(monthSelect.val());

    $.ajax({
        url: '/get_paid_records',
        method: 'GET',
        data: {
            location: location,
            month: month,
            year: year,
        },
        success: function (data) {
            populatePaidRecordsTable(data.records);
            displayTotalIncome(data.totalIncome);
        },
        error: function (error) {
            console.error('Error fetching paid records:', error);
        }
    });
});

function populatePaidRecordsTable(data) {

    var paidRecordsTable = $('#paidRecordsTable tbody');
    paidRecordsTable.empty();

    for (var i = 0; i < data.length; i++) {
        var record = data[i];
        var row = $('<tr>');

        row.append($('<td>').text(record.user.first_name + ' ' + record.user.last_name));
        row.append($('<td>').text(record.property.location));
        row.append($('<td>').text(record.property.room_unit));
        row.append($('<td>').text(record.total_bill));
        row.append($('<td>').text(record.date_paid));
        row.append($('<td>').text(record.amount_paid));

        paidRecordsTable.append(row);
    }
}

function displayTotalIncome(totalIncome){
    const totalIncomeSpan = $('.total-income');
    totalIncomeSpan.text('Total Income: ' + totalIncome + '.00')
}

