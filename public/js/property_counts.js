const prop_locs = $('#prop_locs');

function prop_locs_selection(prop_location) {
    prop_locs.empty();

    const allOption = $('<option>', {
        value: 'ALL',
        text: 'ALL'
    });

    prop_locs.append(allOption);

    for (const key in prop_location) {
        if (prop_location.hasOwnProperty(key)) {
            const option = $('<option>', {
                value: prop_location[key],
                text: prop_location[key]
            })
            prop_locs.append(option);
        }
    }
}


function get_prop_locations() {
    fetch('/get_locs')
        .then(response => response.json())
        .then(prop_location => {
            prop_locs_selection(prop_location);
            // console.log(prop_location)
        })
        .catch(error => console.error('Erro fetching locations: ', error));
}

$(document).ready(function(){
    get_prop_locations();

    function updatePropertyCount(selectedPropertyLocation){
        $.ajax({
            url: '/get_property_count_by_location',
            method: 'GET',
            data: { location: selectedPropertyLocation },
            success:function (data) {
                const total_properties = data.total_properties;
                const totalAvailable = data.totalAvailable;
                const totalOccupied = data.totalOccupied;

                $('#propertyCount').html(`${total_properties}`);
                $('#availPropertyCount').html(`Available: ${totalAvailable}`);
                $('#occupiedPropertyCount').html(`Occupied: ${totalOccupied}`);
            },

            error: function (error){
                console.error('Error fetching data: ', error);
            }
        });
    }


    $('#prop_locs').on('change', function(){
        const selectedPropertyLocation = $(this).val();
        updatePropertyCount(selectedPropertyLocation);
    });

});
