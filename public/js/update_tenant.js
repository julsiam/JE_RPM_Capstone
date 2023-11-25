// function updateTenantDetails() {
//     var tenantId = $('#tenant_id').val();

//     $('#updateDetailsBtn').attr('href', '/edit_tenant/' + tenantId);

// }


$(document).on('click', '.updateDetailsBtn', function() {
    // var tenantId = $(this).data('tenant-id');
    var tenantId = $('#tenant_id').val();

    $.ajax({
        type: 'GET',
        url: '/get-tenant-details',
        data: { id: tenantId },
        success: function(data) {
            // Redirect to the edit tenant page with the fetched data
            window.location.href = '/edit_tenant/' + tenantId;
        },
        error: function(error) {
            console.error('Error fetching tenant details: ', error);
        }
    });
});

