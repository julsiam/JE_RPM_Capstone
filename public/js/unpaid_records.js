const dataLocations = $('#dataLocation');
const recordMonthSelect = $('#recordMonth');
const recordYearSelect = $('#recordYear');

function displayLocations(availableLocations) {
    dataLocations.empty();

    const nullOption = $('<option>', {
        value: '',
        text: 'Select Location'
    });
    dataLocations.append(nullOption);

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'ALL'
    });
    dataLocations.append(allOption);


    for (const key in availableLocations) {
        if (availableLocations.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: availableLocations[key],
                text: availableLocations[key]
            });

            dataLocations.append(option);
        }
    }
}

function getLocations() {
    fetch('/get_locations')
        .then(response => response.json())
        .then(availableLocations => {
            // console.log(availableLocations)
            displayLocations(availableLocations);
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

    getLocations();

    const currentMonth = new Date().getMonth() + 1;
    const currentYear = new Date().getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    recordMonthSelect.val(monthNames[currentMonth - 1]);
    recordYearSelect.val(currentYear);

});


$('#searchButton').click(function () {
    var selectedLocation = dataLocations.val();
    var selectedYear = recordYearSelect.val();
    var selectedMonth = getMonthNumber(recordMonthSelect.val());

    $.ajax({
        url: '/get_notpaid_records',
        method: 'GET',
        data: {
            location: selectedLocation, //location key should be the same in the controller input key
            month: selectedMonth,
            year: selectedYear,
        },
        success: function (data) {
            if (data.records.length == 0) {
                $('#notYetPaidModal').modal('show');
            } else {
                populateNotPaidRecordsTable(data.records);
                displayTotalNotPaid(data.totalUnpaid);
            }

        },

        error: function (error) {
            console.error('Error fetching paid records:', error);
        }
    });
});

function populateNotPaidRecordsTable(data) {

    var notPaidRecordsTable = $('#notPaidRecordsTable tbody');
    notPaidRecordsTable.empty();

    for (var i = 0; i < data.length; i++) {
        var record = data[i];
        var row = $('<tr>');

        row.append($('<td>').text(record.user.first_name + ' ' + record.user.last_name));
        row.append($('<td>').text(record.property.location));
        row.append($('<td>').text(record.property.room_unit));
        row.append($('<td>').text(record.total_bill));
        row.append($('<td>').text(record.due_date));

        notPaidRecordsTable.append(row);
    }
}

function displayTotalNotPaid(totalUnpaid) {
    const totalUnpaidSpan = $('.total-notpaid');
    totalUnpaidSpan.text('Total Not Yet Paid: ' + totalUnpaid + '.00')
}


$('#notYetPaidModal').on('hidden.bs.modal', function () {
    // This event handler will be triggered when the modal is closed
    // You can add any necessary code here if needed
});
