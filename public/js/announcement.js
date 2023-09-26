$(document).ready(function () {

    const locationSelect = $('#visibleLocation')
    const editLocation = $('#editLocation')

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


    //EDIT ANNOUNCEMENT

    function editLocationsDisplay(locations) {
        editLocation.empty();

        const allSelect = $('<option>', {
            value: 'ALL',
            text: 'ALL'
        });
        editLocation.append(allSelect);


        for (const key in locations) {
            if (locations.hasOwnProperty(key)) {
                const option = $('<option>', {
                    value: locations[key],
                    text: locations[key]
                });
                editLocation.append(option);
            }
        }
    }

    function fetchEditLocations() {
        fetch('/get_announcement_locations')
            .then(response => response.json())
            .then(locations => {
                editLocationsDisplay(locations);
            })

            .catch(error => console.error('Error fetching locations:', error));
    }

    fetchEditLocations();

    $('#editAnnouncementModal').on('show.bs.modal', function (event) {
        fetchEditLocations();
    });



    $('.announcement_edit_btn').click(function () {
        var announcementId = $(this).data('announcement-id');
        $.ajax({
            url: '/getAnnouncementDetails/',
            type: 'GET',
            data: { 'data-announcement-id': announcementId },

            success: function (data) {
                $('#edit_announcement_id').val(data.id);
                $('#edit_subject').val(data.subject);
                $('#edit_details').val(data.details);
                $('#editLocation').val(data.location);
            },
            error: function (error) {
                console.error(error);
            }
        })
    })

});
