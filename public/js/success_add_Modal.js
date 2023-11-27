// $(document).ready(function() {
//     if (sessionStorage.getItem('tenant_added')) {
//         // Show the success modal
//         $("#successModal").modal("show");
//         // Remove the session data
//         sessionStorage.removeItem('tenant_added');
//     }
// });

$(document).ready(function () {
    $('#addTenantForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting normally
        $('#successModal').modal('show'); // Show the success modal
    });
});

