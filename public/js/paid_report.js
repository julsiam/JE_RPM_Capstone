const locationSelect = $('#locationSelect');
const startMonth = $('#startMonth');
const endMonth = $('#endMonth');
const yearSelection = $('#yearSelection');

function locationSelection(rentLocations) {
    locationSelect.empty();

    const nullOption = $('<option>', {
        value: '',
        text: 'Select Location'
    });
    locationSelect.append(nullOption);

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'TANAN'
    });
    locationSelect.append(allOption);


    for (const key in rentLocations) {
        if (rentLocations.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: rentLocations[key],
                text: rentLocations[key]
            });

            locationSelect.append(option);
        }
    }
}

function getLocs() {
    fetch('/get_locations')
        .then(response => response.json())
        .then(rentLocations => {
            locationSelection(rentLocations);
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
    getLocs();

    const currentMonth = new Date().getMonth() + 1;
    const monthAfter = (new Date().getMonth() + 2) % 12;
    const currentYear = new Date().getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    startMonth.val(monthNames[currentMonth - 1]);
    endMonth.val(monthNames[monthAfter - 1]);
    yearSelection.val(currentYear);
});



$('#searchBtn').click(function () {
    var selectedlocation = locationSelect.val();
    var selectedStartMonth = getMonthNumber(startMonth.val());
    var selectedEndMonth = getMonthNumber(endMonth.val());
    var selectedYear = yearSelection.val();


    $.ajax({
        url: '/get_paid_reports',
        method: 'GET',
        data: {
            location: selectedlocation,
            start_month: selectedStartMonth,
            end_month: selectedEndMonth,
            year: selectedYear,
        },
        success: function (data) {
            console.log(data);
            if (data.records.length == 0) {
                $('#noReportModal').modal('show');
            } else {
                populatePaidReportTable(data.records);
                showTotalIncome(data.totalPayment);
            }
        },
        error: function (error) {
            console.error('Error fetching paid records:', error);
        }
    });
});

function populatePaidReportTable(data) {

    var paidHistoryTable = $('#paidHistory tbody'); //id of the table not the tbody
    paidHistoryTable.empty();

    for (var i = 0; i < data.length; i++) {
        var record = data[i];
        var row = $('<tr>');

        var dueDate = new Date(record.end_date);
        var datePaid = new Date(record.created_at);
        var options = {
            timeZone: 'UTC', // Use UTC or your desired timezone
            month: 'long',
            day: 'numeric',
            year: 'numeric',
        };
        var formattedDueDate= dueDate.toLocaleString('en-US', options);
        var formattedDatePaid= datePaid.toLocaleString('en-US', options);

        row.append($('<td>').text(record.rental.user.first_name + ' ' + record.rental.user.last_name));
        row.append($('<td>').text(record.rental.property.location));
        row.append($('<td>').text(record.rental.property.room_unit));
        row.append($('<td>').text(record.initial_paid_amount));
        row.append($('<td>').text(formattedDueDate));
        row.append($('<td>').text(formattedDatePaid));
        row.append($('<td>').text(record.initial_paid_amount));

        paidHistoryTable.append(row);
    }
}

function showTotalIncome(totalPayment) {
    const incomeSpan = $('.income_span');
    incomeSpan.text('Total Income: ' + totalPayment + '.00')
}


$('#noReportModal').on('hidden.bs.modal', function () {
    // This event handler will be triggered when the modal is closed
    // You can add any necessary code here if needed
});
