const locSelect = $('#locSelect');
const sMonthSelect = $('#sMonthSelect');
const eMonthSelect = $('#eMonthSelect');
const ySelect = $('#ySelect');

function locSelection(rentLocations) {
    locSelect.empty();

    const nullOption = $('<option>', {
        value: '',
        text: 'Select Location'
    });
    locSelect.append(nullOption);

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'LAHAT'
    });
    locSelect.append(allOption);


    for (const key in rentLocations) {
        if (rentLocations.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: rentLocations[key],
                text: rentLocations[key]
            });

            locSelect.append(option);
        }
    }
}

function dispLocations() {
    fetch('/get_locations')
        .then(response => response.json())
        .then(rentLocations => {
            locSelection(rentLocations);
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
    dispLocations();

    const currentMonth = new Date().getMonth() + 1;
    const monthAfter = (currentMonth % 12) + 1;
    const currentYear = new Date().getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    sMonthSelect.val(monthNames[currentMonth - 1]);
    eMonthSelect.val(monthNames[monthAfter - 1]);
    ySelect.val(currentYear);

    sMonthSelect.on('change', function () {
        const selectedStartMonth = getMonthNumber(sMonthSelect.val());
        eMonthSelect.empty();

        for (let i = selectedStartMonth - 1; i < 12; i++) {
            const option = $('<option>').val(monthNames[i]).text(monthNames[i]);
            eMonthSelect.append(option);
        }
    })
});



$('#searchIconBtn').click(function () {
    var selectedlocation = locSelect.val();
    var selectedStartMonth = getMonthNumber(sMonthSelect.val());
    var selectedEndMonth = getMonthNumber(eMonthSelect.val());
    var selectedYear = ySelect.val();


    $.ajax({
        url: '/get_unpaid_reports',
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
                $('#unPaidModal').modal('show');
            } else {
                showUnpaidData(data.records);
                showTotalUnpaid(data.totalUnpaid);
            }
        },
        error: function (error) {
            console.error('Error fetching paid records:', error);
        }
    });
});

function showUnpaidData(data) {

    var unpaidDataTbl = $('#unPaidHistory tbody'); //id of the table not the tbody
    unpaidDataTbl.empty();

    for (var i = 0; i < data.length; i++) {
        var record = data[i];
        var row = $('<tr>');

        var due_date = new Date(record.end_date);
        var options = {
            timeZone: 'UTC', // Use UTC or your desired timezone
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            // hour: 'numeric',
            // minute: 'numeric',
            // hour12: true
        };
        var formattedDueDate = due_date.toLocaleString('en-US', options);


        row.append($('<td>').text(record.rental.user.first_name + ' ' + record.rental.user.last_name));
        row.append($('<td>').text(record.rental.property.location));
        row.append($('<td>').text(record.rental.property.room_unit));
        row.append($('<td>').text(record.total_rent));
        row.append($('<td>').text(formattedDueDate));

        unpaidDataTbl.append(row);
    }
}

function showTotalUnpaid(totalUnpaid) {
    const incomeSpan = $('.income_span');
    incomeSpan.text('Total Income: ' + totalUnpaid + '.00')
}


$('#unPaidModal').on('hidden.bs.modal', function () {
    // This event handler will be triggered when the modal is closed
    // You can add any necessary code here if needed
});
