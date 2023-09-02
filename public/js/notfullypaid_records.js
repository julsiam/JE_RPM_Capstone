const nfpLocation = $('#nfpLocation');
const nfpMonth = $('#nfpMonth');
const nfpYear = $('#nfpYear');

function dispLocations(availLocations) {
    nfpLocation.empty();

    const nullOption = $('<option>', {
        value: '',
        text: 'Select Location'
    });
    nfpLocation.append(nullOption);

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'ALL'
    });
    nfpLocation.append(allOption);


    for (const key in availLocations) {
        if (availLocations.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: availLocations[key],
                text: availLocations[key]
            });

            nfpLocation.append(option);
        }
    }
}

function getNfpLocations() {
    fetch('/get_locations')
        .then(response => response.json())
        .then(availLocations => {
            dispLocations(availLocations);
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

    getNfpLocations();

    const currentMonth = new Date().getMonth() + 1;
    const currentYear = new Date().getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    nfpMonth.val(monthNames[currentMonth - 1]);
    nfpYear.val(currentYear);

});


$('#searchIcon').click(function () {
    var selectedLocation = nfpLocation.val();
    var selectedYear = nfpYear.val();
    var selectedMonth = getMonthNumber(nfpMonth.val());

    $.ajax({
        url: '/get_notfullypaid_records',
        method: 'GET',
        data: {
            location: selectedLocation, //location key should be the same in the controller input key
            month: selectedMonth,
            year: selectedYear,
        },
        success: function (data) {
            console.log(data)

            if (data.records.length == 0) {
                console.log('No records found');
                $('#nfpModal').modal('show');
            } else {
                console.log('Records found:', data.records);
                populateNotFullyPaidRecordsTable(data.records);
                displayTotalBalance(data.totalBalance);
                displayTotalInitialPayment(data.totalInitialPayment);
            }

        },

        error: function (error) {
            console.error('Error fetching paid records:', error);
        }
    });
});

function populateNotFullyPaidRecordsTable(data) {

    var notFullyPaidRecordsTable = $('#notFullyPaidTable tbody');
    notFullyPaidRecordsTable.empty();

    for (var i = 0; i < data.length; i++) {
        var record = data[i];
        var row = $('<tr>');

        row.append($('<td>').text(record.user.first_name + ' ' + record.user.last_name));
        row.append($('<td>').text(record.property.location));
        row.append($('<td>').text(record.property.room_unit));
        row.append($('<td>').text(record.total_bill));
        row.append($('<td>').text(record.amount_paid));
        row.append($('<td>').text(record.balance));
        row.append($('<td>').text(record.date_paid));
        row.append($('<td>').text(record.due_date));

        notFullyPaidRecordsTable.append(row);
    }
}

function displayTotalBalance(totalBalance) {
    const totalBalanceSpan = $('.total-balance');
    totalBalanceSpan.text('Total Balance: ' + totalBalance + '.00')
}

function displayTotalInitialPayment(totalInitialPayment) {
    const totalInitialPaymentSpan = $('.total-initialPayment');
    totalInitialPaymentSpan.text('Total Initial Payment: ' + totalInitialPayment + '.00')
}


$('#nfpModal').on('hidden.bs.modal', function () {
    // This event handler will be triggered when the modal is closed
    // You can add any necessary code here if needed
});
