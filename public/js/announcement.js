$(document).ready(function () {
    
    const locationSelect = $('#visibleLocation')

    function populateLocationOptions(locations) {
        locationSelect.empty();

        const allOption = $('<option>', {
            value: 'ALL',
            text: 'ALL'
        });
        locationSelect.append(allOption);


        for (const key in locations) {
            if (locations.hasOwnProperty(key)) {
                const option = $('<option>', {
                    value: locations[key],
                    text: locations[key]
                });

                locationSelect.append(option);
            }
        }
    }

    function fetchAnnouncementLocations() {
        fetch('/get_announcement_locations')
            .then(response => response.json())
            .then(locations => {
                populateLocationOptions(locations);
            })
            .catch(error => console.error('Error fetching locations:', error));
    }

    fetchAnnouncementLocations();

    $('#addAnnouncementModal').on('show.bs.modal', function (event) {
        fetchAnnouncementLocations();
    });
});

// function populateLocationOptions() {

// }

// // Call the function to populate the location options on modal show

