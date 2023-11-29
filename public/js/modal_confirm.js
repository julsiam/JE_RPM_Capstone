$(document).ready(function () {
    $('#confirmAddPropertyBtn').click(function () {
        $('#confirmAddPropModal').modal('show');
    });

    // Handle form submission after confirmation
    $('#confirmAddPropModal').on('click', '.confirmAdd', function () {
        $('#addPropertyForm').submit();
    });

    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'true') {
        // Show the success modal
        $('#successAddPropModal').modal('show');
    }
});
