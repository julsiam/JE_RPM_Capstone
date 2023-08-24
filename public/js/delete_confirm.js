// $('#confirmDeleteModal').on('show.bs.modal', function (event) {
//     const deleteButton = $(event.relatedTarget); // Button that triggered the modal
//     const action = deleteButton.data('action'); // Get the form action from the button's data-action attribute
//     const form = $('#deleteForm');
//     form.attr('action', action); // Set the form action

//     // Optional: You can also update the modal title or any other content here
// });

$(document).ready(function(){
    $('.deleteBtn').click(function(e){
        e.preventDefault();

        var announcement_id = $(this).val();
        $('#announcement_id').val(announcement_id);

        $('#confirmDeleteModal').modal('show');
    })
})
