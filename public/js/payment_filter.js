// const dataLocations = $('#dataLocation');
// const recordMonthSelect = $('#recordMonth');
// const recordYearSelect = $('#recordYear');

// function paymentLocations(availableLocations) {
//     dataLocations.empty();

//     const nullOption = $('<option>', {
//         value: '',
//         text: 'Select Location'
//     });
//     dataLocations.append(nullOption);

//     const allOption = $('<option>', {
//         value: 'ALL',
//         text: 'ALL'
//     });
//     dataLocations.append(allOption);


//     for (const key in availableLocations) {
//         if (availableLocations.hasOwnProperty(key)) {
//             const option = $('<option>', {
//                 value: availableLocations[key],
//                 text: availableLocations[key]
//             });

//             dataLocations.append(option);
//         }
//     }
// }

// function fetchLocations() {
//     fetch('/get_avail_locations')
//         .then(response => response.json())
//         .then(availableLocations => {

//             paymentLocations(availableLocations);
//         })
//         .catch(error => console.error('Error fetching locations:', error));
// }

// function getMonthNumber(monthName) {
//     const months = {
//         January: 1,
//         February: 2,
//         March: 3,
//         April: 4,
//         May: 5,
//         June: 6,
//         July: 7,
//         August: 8,
//         September: 9,
//         October: 10,
//         November: 11,
//         December: 12
//     };

//     return months[monthName];
// }

// $(document).ready(function () {

//     fetchLocations();

//     const currentMonth = new Date().getMonth() + 1;
//     const currentYear = new Date().getFullYear();

//     const monthNames = [
//         "January", "February", "March", "April", "May", "June",
//         "July", "August", "September", "October", "November", "December"
//     ];

//     recordMonthSelect.val(monthNames[currentMonth - 1]);
//     recordYearSelect.val(currentYear);

// });


const dataLocation = $('#dataLocation');
const recordMonth = $('#recordMonth');
const recordYear = $('#recordYear');

function paymentLocations(locations) {
    dataLocation.empty();

    const nullOption = $('<option>', {
        value: '',
        text: 'Select Location'
    });
    dataLocation.append(nullOption);

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'ALL'
    });
    dataLocation.append(allOption);


    for (const key in locations) {
        if (locations.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: locations[key],
                text: locations[key]
            });

            dataLocation.append(option);
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

    recordMonth.val(monthNames[currentMonth - 1]);
    recordYear.val(currentYear);

});
