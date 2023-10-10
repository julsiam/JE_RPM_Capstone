// $(document).ready(function () {

//     function fetchNotifications() {
//         $.ajax({
//             url: '/get_notification', // Replace with your route URL for fetching notifications
//             method: 'GET',
//             dataType: 'json',
//             success: function (data) {
//                 var $alertList = $('.alert_list ul');
//                 $alertList.empty(); // Clear existing notifications

//                 if (data.notifications.length > 0) {
//                     data.notifications.forEach(function (notification) {
//                         var fullName = notification.user.first_name + ' ' + notification.user.last_name;
//                         // Create HTML for each notification item
//                         var notificationHtml = '<li data-alert_id="' + notification.id + '" class="alert_li">' +
//                             '<a href="#" class="alert_message">' + fullName + ' ' + notification.message + '</a>' +
//                             '<br />' + '<br />'
//                         '<div class="clearfix"></div>' +
//                             '</li>';

//                         $alertList.append(notificationHtml);
//                     });
//                 } else {
//                     // Display a message if there are no notifications
//                     $alertList.append('<li class="alert_li">No notifications</li>');
//                 }

//                 $('#notification-count').text(data.newNotification);
//             },
//             error: function (xhr, status, error) {
//                 console.error(xhr.responseText);
//             }
//         });
//     }

//     // Initialize Bootstrap Popover with dynamic content
//     $("#bell").popover({
//         'title': 'Notifications',
//         'html': true,
//         'placement': 'bottom',
//         'content': function () {
//             fetchNotifications(); // Fetch and populate notifications
//             return $(".alert_list").html(); // Return the HTML content
//         }
//     });

//     $(document).click(function (event) {
//         if (!$("#bell").is(event.target) && $(".popover").has(event.target).length === 0) {
//             // Close the popover if the click is not on #bell or inside the popover
//             $("#bell").popover('hide');
//         }
//     });

//     //Click event to turn off a notification
//     $(document).on('click', '.turn_off_alert', function (event) {
//         event.preventDefault();
//         var alert = $(this).closest('li');
//         var alert_id = alert.data("alert_id");
//         alert.hide("fast");
//         // You can add code here to mark the notification as "seen" or perform other actions.
//     });
// });

// notification.js

$(document).ready(function () {
    $("#bell").popover({
        'title': 'Notification',
        'html': true,
        'placement': 'bottom',
        'content': $(".alert_list").html()
    });

    $(document).click(function (event) {
        if (!$("#bell").is(event.target) && $(".popover").has(event.target).length === 0) {
            // Close the popover if the click is not on #bell or inside the popover
            $("#bell").popover('hide');
        }
    });
});

