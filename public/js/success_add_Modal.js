$(document).ready(function() {
    if (sessionStorage.getItem('tenant_added')) {
        // Show the success modal
        $("#successModal").modal("show");
        // Remove the session data
        sessionStorage.removeItem('tenant_added');
    }
});

