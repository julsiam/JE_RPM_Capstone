const nfpLocation = $('#nfpLocation');
const nfpStartMonth = $('#nfpStartMonth');
const nfpEndMonth = $('#nfpEndMonth');
const nfpYear = $('#nfpYear');

function display_locations(availLocations) {
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
            display_locations(availLocations);
        })
        .catch(error => console.error('Error fetching locations:', error));
}

function get_month_number(monthName) {
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
    const monthAfter = (currentMonth % 12) + 1;
    const currentYear = new Date().getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    nfpStartMonth.val(monthNames[currentMonth - 1]);
    nfpEndMonth.val(monthNames[monthAfter - 1]);
    nfpYear.val(currentYear);

    nfpStartMonth.on('change', function () {
        const selectedStartMonth = getMonthNumber(nfpStartMonth.val());
        nfpEndMonth.empty();

        for (let i = selectedStartMonth - 1; i < 12; i++) {
            const option = $('<option>').val(monthNames[i]).text(monthNames[i]);
            nfpEndMonth.append(option);
        }
    })

});


$('#searchIcon').click(function () {
    var selectedlocation = nfpLocation.val();
    var selectedStartMonth = get_month_number(nfpStartMonth.val());
    var selectedEndMonth = get_month_number(nfpEndMonth.val());
    var selectedYear = nfpYear.val();


    $.ajax({
        url: '/get_notfullypaid_reports',
        method: 'GET',
        data: {
            _location: selectedlocation,
            start_month: selectedStartMonth,
            end_month: selectedEndMonth,
            _year: selectedYear,
        },
        success: function (data) {
            console.log(data);
            if (data.notFullRecords.length == 0) {
                $('#nfpModal').modal('show');
            } else {
                populateNotFullyPaidReportTable(data.notFullRecords);
                displayTotalBalance(data.totalBalance);
            }
        },
        error: function (error) {
            console.error('Error fetching paid records:', error);
        }
    });
});

function populateNotFullyPaidReportTable(data) {

    var notFullyPaidTable = $('#notFullyPaidTable tbody'); //id of the table not the tbody
    notFullyPaidTable.empty();

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

        var balance = record.total_rent - record.initial_paid_amount;

        row.append($('<td>').text(record.rental.user.first_name + ' ' + record.rental.user.last_name));
        row.append($('<td>').text(record.rental.property.location));
        row.append($('<td>').text(record.rental.property.room_unit));
        row.append($('<td>').text(record.total_rent));
        row.append($('<td>').text(record.initial_paid_amount));
        row.append($('<td>').text(balance));
        row.append($('<td>').text(formattedDatePaid));
        row.append($('<td>').text(formattedDueDate));

        notFullyPaidTable.append(row);
    }
}

function displayTotalBalance(totalBalance) {
    const totalBalanceSpan = $('.total-balance');
    totalBalanceSpan.text('Total Balance: ' + totalBalance + '.00')
}

// function displayTotalInitialPayment(totalInitialPayment) {
//     const totalInitialPaymentSpan = $('.total-initialPayment');
//     totalInitialPaymentSpan.text('Total Initial Payment: ' + totalInitialPayment + '.00')
// }


$('#nfpModal').on('hidden.bs.modal', function () {
    // This event handler will be triggered when the modal is closed
    // You can add any necessary code here if needed
});

