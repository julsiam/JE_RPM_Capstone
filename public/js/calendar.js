$(document).ready(function () {
    $('#calendar').fullCalendar({
        editable: true,
        height: 600,
        width: "100%",
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,


        events: {
            url: '/due_date',
            method: 'GET',
            // allDay: false,
        },

        eventRender: function (event, element) {

            var event_type = event.event_type;

            if (event_type === 'due_date') {
                element.popover({
                    title: 'Today\'s Due Date',
                    content: event.description,
                    trigger: 'hover',
                    placement: 'left',
                    container: 'body',
                    html: true,
                });
                element.css('background-color', 'green'); //color for due dates

            } else if (event_type === 'birthday') {
                element.popover({
                    title: 'Today\'s Birthday',
                    content: event.description,
                    trigger: 'hover',
                    placement: 'left',
                    container: 'body',
                    html: true,
                });
                element.css('background-color', 'red'); //color for birthdays

            }else if (event_type === 'maintenance'){
                element.popover({
                    title: 'Today\'s Maintenance Schedule',
                    content: event.description,
                    trigger: 'hover',
                    placement: 'left',
                    container: 'body',
                    html: true,
                });
                element.css('background-color', 'orange'); //color for birthdays
            }
        },

        eventLimit: 3,
        eventLimitClick: 'popover',




        // events: {
        //     url: '/calendar',
        //     method: 'GET',
        //     failure: function () {
        //         alert('there was an error while fetching events!');
        //     },
        //     success: function (data) {
        //         console.log(data); // Log the data received from the server
        //     },
        //     color: 'green',   // a non-ajax option
        //     textColor: 'white'
        // },

        // eventRender: function (event, element) {
        //     if (event.status === 'Not Yet Paid' || event.amount_paid === 0.00) {
        //         element.popover({
        //             title: 'Today\s Due Date',
        //             content: event.description,
        //             trigger: 'hover',
        //             placement: 'right',
        //             container: 'body',
        //             html: true
        //         });
        //         return true;

        //     } else {
        //         return false;
        //     }
        // },


        eventStartEditable: false
    });
});
