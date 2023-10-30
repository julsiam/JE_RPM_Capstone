const tenant_locations = $('#locs');

function loc_selection(avail_locs) {
    tenant_locations.empty();

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'ALL'
    });
    tenant_locations.append(allOption);


    for (const key in avail_locs) {
        if (avail_locs.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: avail_locs[key],
                text: avail_locs[key]
            })
            tenant_locations.append(option);
        }
    }
}

function get_locations() {
    fetch('/get_locs')
        .then(response => response.json())
        .then(avail_locs => {
            loc_selection(avail_locs);

        })
        .catch(error => console.error('Error fetching locations:', error));
}


$(document).ready(function () {
    get_locations();

    function updateTenantCount(selectedLocation) {
        $.ajax({
            url: '/get_tenant_count_by_location',
            method: 'GET',
            data: { location: selectedLocation }, //location as key be used in the controller
            success: function (data) {
                const tenantCount = data.tenantCount;
                $('#tenantCount').html(`${tenantCount}`);
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    $('#locs').on('change', function () {
        const selectedLocation = $(this).val();
        updateTenantCount(selectedLocation);
    });
});



